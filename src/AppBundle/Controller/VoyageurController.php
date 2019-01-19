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
     * @Route("/voyageur", name="test_voyageur_new")
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
            $this->addFlash('message', 'Creation voyageur enregistrer');

            }

            return $this->render('Voyageur/new.html.twig', array(
                'voyageur'=>$voyageur,
                'form'=>$form->createView(),
            ));
        }

}
