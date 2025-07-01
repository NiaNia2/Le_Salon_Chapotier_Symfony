<?php

namespace App\Controller;

use App\Entity\Chapeaux;
use App\Form\ChapeauxTypeForm;
use App\Repository\ChapeauxRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class ChapothequeController extends AbstractController
{
    #[Route('/chapotheque', name: 'app_chapotheque')]
    public function index(ChapeauxRepository $repository): Response
    {
        $chapeaux = $repository->findAll();
        return $this->render('chapotheque/index.html.twig', [
            'chapeaux' => $chapeaux,
        ]);
    }

    #[Route('/ajout_chapeau', name: 'create_chapeau')]
    public function create_chapeau(Request $request, EntityManagerInterface $entityManager): Response
    {
        $chapeau = new Chapeaux();

        $form = $this->createForm(ChapeauxTypeForm::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $chapeau->setUser($this->getUser());
            $entityManager->persist($chapeau);
            $entityManager->flush();

            return $this->redirectToRoute('app_chapotheque');
        }
        return $this->render('chapotheque/create_chapeau.html.twig', [
            'chapeauform' => $form->createView(),
        ]);
    }

    #[Route('/modifie_chapeau/{id}', name: 'update_chapeau')]
    public function update_chapeau(Chapeaux $chapeau, Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ChapeauxTypeForm::class, $chapeau);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($chapeau);
            $entityManager->flush();

            return $this->redirectToRoute('app_chapotheque');
        }
        return $this->render('chapotheque/modifie_chapeau.html.twig', [
            'chapeauform' => $form->createView(),
        ]);
    }
}
