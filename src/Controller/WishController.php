<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WishController extends AbstractController
{
    /**
     * @Route("/list", name="wish_list")
     */
    public function list(): Response
    {
        return $this->render('wish/list.html.twig', [
            'controller_name' => 'WishController',
        ]);
    }

    /**
     * @Route("/detail/{id}", name="wish_detail", requirements={"id":"[0-9]+"})
     */
    public function detail($id): Response
    {
        return $this->render('wish/detail.html.twig', [
            'controller_name' => 'WishController',
            'id' => $id,
        ]);
    }
}