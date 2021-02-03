<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AdminController
 * @package App\Controller
 * @Route ("/admin")
 */

class AdminController extends AbstractController
{
    /**
     * @Route("", name="admin_home")
     */
    public function home(): Response
    {
        return $this->render('admin/home.html.twig', [
        ]);
    }
}
