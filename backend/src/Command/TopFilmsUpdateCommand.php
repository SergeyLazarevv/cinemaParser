<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Doctrine\ORM\EntityManagerInterface;
use App\Servise\Kinopoisk\KinopoiskApi;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use App\Service\FilmService;

class TopFilmsUpdateCommand extends Command
{
    protected static $defaultName = 'top-films:update';
   
    public function __construct(
        protected KinopoiskApi $kinopoiskApi, 
        protected EntityManagerInterface $em,
        protected FilmService $filmService
        )
    {
        parent::__construct();
    }

    protected function configure()
    {
        $this->setDescription('Получение топ 250 фильмов кинопоиска с записью в БД (films)');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        
        $io->note('Получение данных с сайта Кинопоиск');

        // Лимит запросов в апи 500 в сутки, для экономии данные из Апи кешируются
        $cache = new FilesystemAdapter();
        $cacheItem = $cache->getItem('apiFilms');
        $cacheApiFilms = $cacheItem->get();
       
        if(!$cacheApiFilms) {
            $io->note('Получение данных из Апи кинопоиска');
            $topFilms = $this->kinopoiskApi->getTopFilms($io);
            if(empty($topFilms)) {
                $io->error('Получен пустой список из Api');
                return Command::FAILURE;
            }
            $cacheItem->set($topFilms);
            $cache->save($cacheItem);
        } else {
            $io->note('Получение данных Апи из кеша');
            $topFilms = $cacheApiFilms;
        }

        $io->note('Очистка таблицы перед записью');
        $this->filmService->truncateFilmsTable();

        $io->note('Запись данных в бд');
        $io->progressStart(count($topFilms));
        foreach($topFilms as $film) {
            $this->filmService->save($film);
            $io && $io->progressAdvance();
        }
        $io->progressFinish();
        
        $io->success("Данные успешно импортированы");
        return Command::SUCCESS;
    }
}
