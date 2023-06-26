<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\FilmService;

#[Route('/rest/films')]

class FilmsController extends AbstractController
{
    #[Route('/top-films', name: 'top-films')]
    public function getTopFilms(FilmService $filmService): JsonResponse
    {

        $films = $filmService->getFilmsBy();
        return $this->json($films);
    }
}
