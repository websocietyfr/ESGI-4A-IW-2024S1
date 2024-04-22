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
use App\Repository\UserRepository;
use App\Form\AnnonceType;

#[Route('/annonce', name: 'app_annonce_')]
class AnnonceController extends AbstractController
{

    #[Route('/', name: 'index')]
    public function index(AnnonceRepository $annonceRepository, Request $request): Response
    {
        // dd($request);
        if ($request->getMethod() === 'GET' && $request->query->get('searchkey')) {
            $annonces = $annonceRepository->findByTitleField($request->query->get('searchkey'));
        } else {
            // $annonces = $entityManager->getRepository(Annonce::class)->findAll();
            $annonces = $annonceRepository->findAll();
        }

        return $this->render('annonce/index.html.twig', [
            "annonces" => $annonces,
            "searchkey" => $request->query->get('searchkey') ? $request->query->get('searchkey') : null
        ]);
    }
    
    #[Route('/create', name: 'create')]
    public function create(Request $request, AnnonceRepository $annonceRepository): Response
    {
        $annonce = new Annonce();
        $form = $this->createForm(AnnonceType::class, $annonce);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {    
                $annonceRepository->add($annonce);
                return $this->redirectToRoute('app_annonce_index');
            } else {
                echo 'Erreur dans la validation du formulaire';
            }
        }
        return $this->render('annonce/create.html.twig', [
            'form_obj' => $form
        ]);
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