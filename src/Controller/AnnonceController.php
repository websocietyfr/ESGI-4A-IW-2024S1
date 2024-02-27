<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

#[Route('/annonce', name: 'app_annonce_')]
class AnnonceController extends AbstractController
{

    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('annonce/index.html.twig');
    }
    
    #[Route('/create', name: 'create')]
    public function create(): Response
    {
        return $this->render('annonce/create.html.twig');
    }
    
    #[Route('/{id}', name: 'show')]
    public function show(int $id): Response
    {
        return $this->render('annonce/show.html.twig', [
            'id' => $id,
            'price' => 23.55
        ]);
    }
    
    #[Route('/{id}/edit', name: 'edit')]
    public function edit(int $id): Response
    {
        return $this->render('annonce/edit.html.twig');
    }
    
    #[Route('/{id}/delete', name: 'delete')]
    public function delete(int $id): RedirectResponse
    {
        return $this->redirectToRoute('app_annonce_index');
    }
}