<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Films;

#[Route('/rest/films')]

class FilmsController extends AbstractController
{
    #[Route('/top-films', name: 'top-films')]
    public function getTopFilms(EntityManagerInterface $entityManager): JsonResponse
    {
        $filmsEntitys = $entityManager->getRepository(Films::class)->findAll();
        $films = [];
        foreach($filmsEntitys as $filmEntity) {
            $films[$filmEntity->getname()] = $filmEntity->getRating();
        }
        
        return $this->json($films);
    }
}
