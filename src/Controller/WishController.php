<?php

namespace App\Controller;

use App\Repository\WishRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WishController extends AbstractController
{
    /**
     * @Route("/wishes", name="wish_list")
     */
    public function list(WishRepository $wishRepository): Response
    {
       $wishes = $wishRepository->findBy(["isPublished" => "true"],["title" => "desc"]);

        return $this->render('wish/list.html.twig', [
            'wishes' => $wishes,
        ]);
    }

    /**
     * @Route("/wishes/detail/{id}", name="wish_detail", requirements={"id":"[0-9]+"})
     */
    public function detail($id,WishRepository $wishRepository): Response
    {
        $wish = $wishRepository->find($id);

        return $this->render('wish/detail.html.twig', [
            'id' => $id,
            'wish'=> $wish,
        ]);
    }
}
