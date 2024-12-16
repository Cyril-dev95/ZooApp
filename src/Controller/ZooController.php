<?php

namespace App\Controller;

use App\Entity\Zoo;
use App\Form\ZooType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ZooController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    
    #[Route('/zoos', name: 'app_zoos')]
    public function index(): Response
    {
        $zoos = $this->entityManager->getRepository(Zoo::class)->findAll();

        return $this->render('zoo/index.html.twig', [
            'zoos' => $zoos,
        ]);
    }

    #[Route('/zoos/add', name: 'add_zoos')]
    public function add(Request $request): Response
    {
        $zoo = new Zoo();
        $form = $this->createForm(ZooType::class, $zoo);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($zoo);
            $this->entityManager->flush();

            return $this->redirectToRoute('app_zoos');
        }

        return $this->render('zoo/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
