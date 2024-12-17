<?php

namespace App\Controller;

use App\Entity\Continents;
use App\Form\ContinentsType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

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

    #[Route('/continents/add', name: 'add_continents')]
    public function add(Request $request): Response
    {
        $continent = new Continents();
        $form = $this->createForm(ContinentsType::class, $continent);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($continent);
            $this->entityManager->flush();

            return $this->redirectToRoute('app_continents');
        }

        return $this->render('continents/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
