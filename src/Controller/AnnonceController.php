<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use App\Repository\AnnonceRepository;
use App\Entity\Annonce;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

#[Route('/annonce', name: 'app_annonce_')]
class AnnonceController extends AbstractController
{

    #[Route('/', name: 'index')]
    public function index(AnnonceRepository $annonceRepository): Response
    {
        // $annonces = $entityManager->getRepository(Annonce::class)->findAll();
        $annonces = $annonceRepository->findAll();

        return $this->render('annonce/index.html.twig', [
            "annonces" => $annonces
        ]);
    }
    
    #[Route('/create', name: 'create')]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        if ($request->getMethod() === 'POST') {
            $user = $entityManager->getRepository(User::class)->findAll();

            $annonce = new Annonce();
            $annonce->setTitle($request->request->get('title'));
            $annonce->setDescription($request->request->get('description'));
            $annonce->setPrice($request->request->get('price'));
            $annonce->setImage('image/logo.png');
            // $annonce->setAuthor($request->user);
            $annonce->setAuthor($user[0]);

            $entityManager->persist($annonce);
            $entityManager->flush();

            return $this->redirectToRoute('app_annonce_index');
        }
        return $this->render('annonce/create.html.twig');
    }
    
    #[Route('/{id}', name: 'show')]
    public function show(Annonce $annonce): Response
    {
        // $annonce = $annonceRepository->findOneBy([
        //     'id' => $id
        // ]);

        return $this->render('annonce/show.html.twig', [
            'annonce' => $annonce
        ]);
    }
    
    #[Route('/{id}/edit', name: 'edit')]
    public function edit(Annonce $annonce): Response
    {
        return $this->render('annonce/edit.html.twig', [ "annonce" => $annonce ]);
    }
    
    #[Route('/{id}/delete', name: 'delete')]
    public function delete(Annonce $annonce, EntityManagerInterface $entityManager): RedirectResponse
    {
        $entityManager->remove($annonce);
        $entityManager->flush();
        return $this->redirectToRoute('app_annonce_index');
    }
}