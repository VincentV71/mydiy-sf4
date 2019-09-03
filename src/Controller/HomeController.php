<?php

namespace App\Controller;

use App\Entity\Base;
use App\Entity\Arome;
use App\Entity\Member;
use App\Form\BaseType;
use App\Entity\Recette;
use App\Form\MemberType;
use App\Form\RecetteType;
use App\Entity\AromeRecette;
use App\Form\AromeRecetteType;
use App\Repository\BaseRepository;
use App\Repository\AromeRepository;
use App\Repository\RecetteRepository;
use Symfony\Component\Validator\Validation;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
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
                'success',
                'Vous êtes maintenant enregistré. Connectez-vous...'
            );
            return $this->redirectToRoute('login');
        }

        return $this->render('home/inscription.html.twig', [
            'controller_name' => 'HomeController',
            'form_register' => $memberForm->createView()
        ]);
    }

    /**
     * @Route("/mes_recettes/{status}", name="mydiy", requirements={"status"="oui|non"})
     * @IsGranted("ROLE_USER")
     */
    public function showRecettesMember(Request $request, RecetteRepository $repo, ObjectManager $manager, $status='oui')
    {
        $idMember = $this->getUser()->getIdMember();
        $order = [0 => 'r.datRecet', 1 => 'desc'];

        if ($request->request->get('tri_recette') !== null) {
            $order = explode(":", $request->request->get('tri_recette'), 2);
        }
        $recettes = $repo->getDataRecettesByMember($idMember, $status, $order[0], $order[1]);
        
        return $this->render('home/mes_recettes.html.twig', [
            'controller_name' => 'HomeController',
            'recettes' => $recettes,
            'status' => $status,
            'selectedTri' => $order[0].":".$order[1]
        ]);
    }

    /**
    * @Route("/mes_recettes/{id}", name="edit_recette")
    * @IsGranted("ROLE_USER")
    */
    public function editRecetteMember(Request $request, Recette $recette, ObjectManager $manager)
    {
        $paramRecette[]= $request->query->all();

        $recetteForm = $this->createForm(RecetteType::class, $recette)
                            ->add('affRecet', ChoiceType::class, [
                                'choices' => [
                                    'Désactiver' => 'non',
                                    'Activer' => 'oui',]
                            ]);

        $recetteForm->handleRequest($request);
        
        if ($recetteForm->isSubmitted() && $recetteForm->isValid()) {
            $manager->persist($recette);
            $manager->flush();

            $this->addFlash(
                'success',
                'Votre recette a été modifiée'
            );
            return $this->redirectToRoute('mydiy');
        }

        return $this->render('home/edit_recette.html.twig', [
        'controller_name' => 'HomeController',
        'recetteForm' => $recetteForm->createView(),
        'paramRecette'=> $paramRecette
        ]);
    }

    /**
     * @Route("/new_diy", name="newdiy")
     * @IsGranted("ROLE_USER")
     */
    public function makeNewDiy(Request $request, ObjectManager $manager, AromeRepository $repo, BaseRepository $repoBase, RecetteRepository $repoRecet)
    {
        $maRecette = new Recette();
        $maRecette->setIdMember($this->getUser());

        $newDiyForm = $this->createForm(RecetteType::class, $maRecette);

        // Json datas for AngularJS :
        $listeAromes = $repo->findBy(array('affAro' => 'oui'));
        $json_aromes = $repo->arrayOfAromesToJson($listeAromes);
        $listeBases = $repoBase->findAll();
        $json_bases = $repoBase->arrayOfBasesToJson($listeBases);

        
        $newDiyForm->handleRequest($request);
        // For rehydrating the view if the submitted datas failed :
        $datas = json_encode($request->request->all());

        
        if ($newDiyForm->isSubmitted() && $newDiyForm->isValid()) {
            $manager->persist($maRecette);
            $manager->flush();
            $this->addFlash(
                'success',
                'Votre nouvelle recette est désormais sauvegardée'
            );
            return $this->redirectToRoute('mydiy');
        }
 
        return $this->render('home/new_diy.html.twig', [
            'controller_name' => 'HomeController',
            'form_newdiy' => $newDiyForm->createView(),
            'listeAromes' => $listeAromes,
            'listeBases' => $listeBases,
            'json_aromes' => $json_aromes,
            'json_bases' => $json_bases,
            'datas_on_request' => $datas
        ]);
    }
}
