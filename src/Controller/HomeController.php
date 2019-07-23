<?php

namespace App\Controller;

use App\Entity\Arome;
use App\Entity\Member;
use App\Entity\Recette;
use App\Form\MemberType;
use App\Form\NewDiyType;
use App\Repository\BaseRepository;
use App\Repository\AromeRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

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
     * @Route("/connexion", name="login")
     */
    public function connectUser()
    {
        return $this->render('home/connection.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * @Route("/deconnexion", name="logout")
     */
    public function logout()
    {
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
    public function registerUser(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder)
    {
        $myMember = new Member();

        $memberForm = $this->createForm(MemberType::class, $myMember);

        $memberForm->handleRequest($request);

        if ($memberForm->isSubmitted() && $memberForm->isValid()) {
            $myMember->setAffMember("oui");
            
            $hash = $encoder->encodePassword($myMember, $myMember->getPassword());
            $myMember->setPassword($hash);

            $manager->persist($myMember);
            $manager->flush();

            $this->addFlash(
                'info',
                'Vous êtes maintenant enregistré'
            );

            return $this->redirectToRoute('login');
        }

        return $this->render('home/inscription.html.twig', [
            'controller_name' => 'HomeController',
            'form_register' => $memberForm->createView()
        ]);

        // return $this->render('home/inscription.html.twig', [
        //     'controller_name' => 'HomeController',
        // ]);
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
    public function makeNewDiy(Request $request, ObjectManager $manager, AromeRepository $repo, BaseRepository $repoBase)
    {
        $maRecette = new Recette();
        // $maRecette->setEtoiles(0);

        $newDiyForm = $this->createForm(NewDiyType::class, $maRecette);

        $listeAromes = $repo->findAll();
        
        $listeBases = $repoBase->findAll();

        $newDiyForm->handleRequest($request);

        return $this->render('home/new_diy.html.twig', [
            'controller_name' => 'HomeController',
            'form_newdiy' => $newDiyForm->createView(),
            'listeAromes' => $listeAromes,
            'listeBases' => $listeBases,
            'test' => 12,
            'original_new_diy_form' => $newDiyForm
        ]);

        // return $this->render('home/new_diy.html.twig', [
        //     'controller_name' => 'HomeController',
        // ]);
    }
}
