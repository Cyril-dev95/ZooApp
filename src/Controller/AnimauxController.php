<?php

namespace App\Controller;

use App\Entity\Animaux;
use App\Form\AnimauxType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AnimauxController extends AbstractController
{
    private $entityManager;

    // Injection du service EntityManagerInterface via le constructeur
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/animaux', name: 'app_animaux')]
    public function index(): Response
    {
        // Utilisation de l'EntityManager pour récupérer tous les animaux
        $animaux = $this->entityManager->getRepository(Animaux::class)->findAll();

        return $this->render('animaux/index.html.twig', [
            'animaux' => $animaux,
        ]);
    }

    #[Route('/animaux/add', name: 'add_animaux')]
    public function add(Request $request): Response
    {
        $animal = new Animaux();
        $form = $this->createForm(AnimauxType::class, $animal);

        // Gérer la requête
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Persister l'animal dans la base de données
            $this->entityManager->persist($animal);
            $this->entityManager->flush();

            // Rediriger vers la page des animaux après l'ajout
            return $this->redirectToRoute('app_animaux');
        }

        return $this->render('animaux/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
