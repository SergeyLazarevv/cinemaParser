<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Doctrine\ORM\EntityManagerInterface;
use App\Servise\Kinopoisk\KinopoiskApi;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

class TopFilmsUpdateCommand extends Command
{
    protected static $defaultName = 'top-films:update';
   
    public function __construct(
        protected KinopoiskApi $kinopoiskApi, 
        protected EntityManagerInterface $em
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

        $cache = new FilesystemAdapter();

        $cacheItem = $cache->getItem('tetsFilms');
        $cacheApiFilms = $cacheItem->get();
       
        if(!$cacheApiFilms) {
            $io->note('Из апи');
            $topFilms = $this->kinopoiskApi->getTopFilms($io);
            if(!$topFilms) {
                $io->error('Получен пустой список из Api');
                return Command::FAILURE;
            }
            $cacheItem->set($topFilms);
            $cache->save($cacheItem);
        } else {
            $io->note('Из кеша'); //Не тратим лимит запросов в апи
            $topFilms = $cacheApiFilms;
        }

        var_dump($topFilms);die;
        
        $io->success("Данные успешно импортированы");
        return Command::SUCCESS;
    }
}
