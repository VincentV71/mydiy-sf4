<?php

namespace App\Controller;

use App\Entity\Arome;
use App\Repository\AromeRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * @Route("/connection", name="login")
     */
    public function connectUser()
    {
        return $this->render('home/connection.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
    // public function connectUser(ObjectManager $manager, AromeRepository $repo)
    // {
    //     // $myArome = new Arome ;
    //     // $myArome = $repo->find(1);
    //     // $manager->remove($myArome);
    //     // $manager->flush();

    //     return $this->render('home/connection.html.twig', [
    //         'controller_name' => 'HomeController',
    //     ]);
    // }

    /**
     * @Route("/inscription", name="register")
     */
    public function registerUser()
    {
        return $this->render('home/inscription.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * @Route("/mes_recettes", name="mydiy")
     */
    public function showMyDiy()
    {
        return $this->render('home/mes_recettes.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * @Route("/new_diy", name="newdiy")
     */
    public function makeNewDiy()
    {
        return $this->render('home/new_diy.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
