<?php

namespace App\Controller;

use id;
use App\Entity\Chapeaux;
use App\Form\ChapeauTypeForm;
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

        $form = $this->createForm(ChapeauTypeForm::class, $chapeau);

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
        $form = $this->createForm(ChapeauTypeForm::class, $chapeau);

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

    #[Route('/delete_chapeau/{id}', name: 'delete_chapeau')]
    public function delete(Chapeaux $chapeau, Request $request, EntityManagerInterface $entityManager): Response
    {

        if ($this->isCsrfTokenValid("SUP" . $chapeau->getId(), $request->get('_token'))) {

            $entityManager->remove($chapeau);

            $entityManager->flush();

            $this->addFlash('succes', 'Chapeau supprimer');
            return $this->redirectToRoute('app_chapotheque');
        }
        return $this->redirectToRoute('app_chapotheques');
    }

    #[Route('/chapeau/{id}', name: 'detail')]
    public function detail(Chapeaux $chapeau, ChapeauxRepository $repository): Response
    {
        // $chapeau = $repository->find('id');

        return $this->render('chapotheque/detail.html.twig', [
            'chapeau' => $chapeau,
        ]);
    }
}
