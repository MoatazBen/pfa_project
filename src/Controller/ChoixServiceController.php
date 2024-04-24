<?php

namespace App\Controller;

use App\Entity\Service;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface; // Importation l'EntityManagerInterface

class ChoixServiceController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route("/choix-service", name: "choix_service")]
    public function index(): Response
    {
        $serviceRepository = $this->entityManager->getRepository(Service::class);
        $services = $serviceRepository->findAll();

        return $this->render('choix_service/index.html.twig', [
            'services' => $services,
            'controller_name' => 'ChoixServiceController',
        ]);
    }
}
?>
