<?

namespace App\Servise\Kinopoisk;
use App\Servise\Kinopoisk\KinopoiskRequest;
use Symfony\Component\Console\Style\SymfonyStyle;

class KinopoiskApi
{

    protected $pagesCount = 0;

    public function __construct(protected KinopoiskRequest $request) 
    {
      
    }

    public function getTopFilms(SymfonyStyle $io = null, int $page = 1): array
    {
    
        $jsonResponse = $this->request->send("https://kinopoiskapiunofficial.tech/api/v2.2/films/top?type=TOP_250_BEST_FILMS&page=$page");
        $topFilmsData = json_decode($jsonResponse, true);
        $this->pagesCount = (int)$topFilmsData['pagesCount'];
        $films = $topFilmsData['films'];

        $io && $page === 1 && $io->progressStart($this->pagesCount);
        
        if($page === $this->pagesCount) {
            $io && $io->progressFinish();
            return $films;
        } else {
            $page++;
            $io && $io->progressAdvance();
            return array_merge($films, $this->getTopFilms($io, $page));
        }
    }
}