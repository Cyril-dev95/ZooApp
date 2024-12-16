<?php

namespace App\Controller;

use App\Entity\Animaux;
use App\Entity\Familles;
use App\Form\AnimauxType;
use App\Form\FamillesType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FamillesController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/familles', name: 'app_familles')]
    public function index(): Response
    {
        $familles = $this->entityManager->getRepository(Familles::class)->findAll();

        return $this->render('familles/index.html.twig', [
            'familles' => $familles,
        ]);
    }

    #[Route('/familles/add', name: 'add_familles')]
    public function add(Request $request): Response
    {
        $famille = new Familles();
        $form = $this->createForm(FamillesType::class, $famille);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($famille);
            $this->entityManager->flush();

            return $this->redirectToRoute('app_familles');
        }

        return $this->render('familles/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
