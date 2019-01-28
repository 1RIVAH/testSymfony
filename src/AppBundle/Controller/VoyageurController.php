<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Voyageur;
use AppBundle\Form\VoyageurType;


class VoyageurController extends Controller
{
    /**
     * @Route("/voyageur", name="index_voyageur")
     */
    public function indexAction()
    {
        //$tab = [];
        $em = $this->getDoctrine()->getManager();
        $voyageurs = $em->getRepository("AppBundle:Voyageur")->findAll();
        dump($voyageurs); die();
        /*
         * foreach($voyageurs as $val){
            $tab[] = array($val->getNom(), $val->getPrenom(), $val->getAdresse(), $val->getTelephone());
        }
         */


        return $this->render("Voyageur/index.html.twig", array(
            'voyageurs'=>$voyageurs,
        ));
    }

    /**
     * @Route("/voyageur/ajout", name="ajout_voyageur")
     */
    public function newAction(Request $request)
    {
        $voyageur = new Voyageur();
        $form = $this->createForm(VoyageurType::class, $voyageur);
        $nom =$form['nom']->isEmpty();
        $prenom = $form['prenom']->isEmpty();
        $adresse = $form['adresse']->isEmpty();
        $telephone = $form['telephone']->isEmpty();

            $form->handleRequest($request);
            if($form->isSubmitted() && $form->isValid()){

                $em = $this->getDoctrine()->getManager();
                $em->persist($voyageur);
                $em->flush();
            $this->addFlash("success", "Creation voyageur enregistrer");
                return $this->redirectToRoute("index_voyageur", array('id'=> $voyageur->getId()));

            }

            return $this->render('Voyageur/new.html.twig', array(
                'voyageur'=>$voyageur,
                'form'=>$form->createView(),
            ));
        }
/**
 * @Route("/post/update/{id}", name="modif_voyageur")
 */
    public function modifAction(Request $request, $id){
        
    }
}
