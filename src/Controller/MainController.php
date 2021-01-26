<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route ("/", name="main_home" , methods={"GET"})
     */
    public function home()
    {
        return $this->render('main/home.html.twig');
    }

    /**
     * @Route ("/about-us", name="main_about_us")
     */
    public function aboutUs()
    {
        return $this->render('main/about_us.html.twig');
    }

    /**
     * @Route ("/legal-stuff", name="main_legal_stuff")
     */
    public function legalStuff()
    {
        return $this->render('main/legal_stuff.html.twig');
    }

}
