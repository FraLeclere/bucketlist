<?php

namespace App\Controller;

use App\Form\WishType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AddWishController extends AbstractController
{
    /**
     * @Route("/add-wish", name="add_wish")
     */
    public function create(): Response
    {
        $form = $this->createForm(WishType::class);
        return $this->render('add_wish/addWish.html.twig', [
            "wish_form" => $form->createView()
        ]);

        //throw $this->createNotFoundException('This wish is gone.');
    }
}
