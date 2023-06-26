<?

namespace App\Service;

use App\Entity\Films;
use Doctrine\ORM\EntityManagerInterface;

class FilmService
{
    public function __construct(protected EntityManagerInterface $em)
    {
     
    }

    public function save(array $film): void
    {

        $filmEntity = new Films();
        $filmEntity->setName((string)$film['nameRu']);
        $filmEntity->setRating((int)$film['year']);
        $filmEntity->setYear((float)$film['rating']);
        $filmEntity->setRatingVoteCount((int)$film['ratingVoteCount']);
        $filmEntity->setPosterUrl((string)$film['posterUrl']);
        $filmEntity->setPosterUrlPreview((string)$film['posterUrlPreview']);
        $this->em->persist($filmEntity);
		$this->em->flush();
    }

    public function getFilmsBy(): array
    {
        $films = $this->em->createQuery('SELECT f.name, f.year, f.rating, f.rating_vote_count, f.poster_url, f.poster_url_preview FROM App\Entity\Films f')->getResult();
        return $films;
    }

    public function truncateFilmsTable(): void
    {
        $this->em->createQuery('DELETE FROM App\Entity\Films')->execute();
    }



}