<?php

namespace App\Controller;

use App\Entity\Continents;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContinentsController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/continents', name: 'app_continents')]
    public function index(): Response
    {
        $continents = $this->entityManager->getRepository(Continents::class)->findAll();

        return $this->render('continents/index.html.twig', [
            'continents' => $continents,
        ]);
    }
}
