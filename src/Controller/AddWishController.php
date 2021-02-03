<?php

namespace App\Controller;

use App\Entity\Wish;
use App\Form\WishType;
use App\TextValidation\Censurator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AddWishController extends AbstractController
{
    /**
     * @Route("/add-wish", name="add_wish")
     */
    public function create(Request $request, EntityManagerInterface $entityManager, Censurator $censurator): Response
    {
        $newWish = new Wish();

        $user = $this->getUser();
        $newWish->setAuthor($user->getUsername());

        //instance du form en lui associant notre entité
        $form = $this->createForm(WishType::class, $newWish);

        //prend les données du formulaire fourni et les hydrate dans  mon entité
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            //hydrater les propriété manquante
            $newWish->setIsPublished(true);
            $newWish->setDateCreated(new \DateTime());

            $wishTitle = $newWish->getTitle();
            $wishNewTitle = $censurator->purify($wishTitle);
            $newWish->setTitle($wishNewTitle);

            $wishDescription = $newWish->getDescription();
            $wishNewDescription = $censurator->purify($wishDescription);
            $newWish->setDescription($wishNewDescription);

            //declenche l'insert dans la bdd
            $entityManager->persist($newWish);
            $entityManager->flush();

            //crée un message en session pour afficher sur prochaine page
            $this->addFlash('success','Idea successfully added');

            //redirige
            return $this->redirectToRoute('wish_detail',['id'=>$newWish->getId()]);

        }

        return $this->render('add_wish/addWish.html.twig', [
            "wish_form" => $form->createView()
        ]);

        //throw $this->createNotFoundException('This wish is gone.');
    }
}
