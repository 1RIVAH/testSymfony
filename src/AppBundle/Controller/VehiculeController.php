<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Voyageur;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Vehicule;
//use AppBundle\Controller\VoyageurController;
use AppBundle\Form\VehiculeType;

class VehiculeController extends Controller
{
    /**
     * @Route("/vehicule", name="index_vehicule")
     */
    public function indexAction()
    {
        $veh = new Vehicule();
        $em = $this->getDoctrine()->getManager();
      $vehicules = $em->getRepository("AppBundle:Vehicule")->findAll();
      //$voyageurs = $em->getRepository("AppBundle:Voyageur")->findAll();
          $vehi =  $veh->setDisponibilite($veh->getDisponibilite());
        //$vehicules = $vehi;

       //dump($vehicules); die();

        return $this->render("Vehicule/index.html.twig", [
            'vehicules'=> $vehicules,
         //   'voyageurs'=>$voyageurs,
            'vehi' => $vehi,

        ]);
    }
    /**
     * @Route("/vehicule/new", name="vehicule_new")
     */
    public function newVehicule(Request $requete)
    {
        $vehicule = new Vehicule();
        $form = $this->createForm(VehiculeType::class, $vehicule);
        $form->handleRequest($requete);
       if($form->isValid() && $form->isSubmitted()){
            //dump($donnee);die;

           $vehicule->setDisponibilite($vehicule->getDisponibilite());
          dump($vehicule); die();

           $em = $this->getDoctrine()->getManager();
            $em->persist($vehicule);
            $em->flush();
            return $this->redirectToRoute("index_vehicule");
        }
        return $this->render("Vehicule/new.html.twig", array(
            'form'      => $form->createView(),
        ));
    }
    /**
     * @Route("/vehicule/delete/{id}", name="supprimer_vehicule" )
     */
    public function supprimerVehicule($id){
        $em = $this->getDoctrine()->getManager();
       $vehicule =   $em->getRepository("AppBundle:Vehicule")->find($id);
        $em->remove($vehicule);
        $em->flush($vehicule);
        return $this->redirectToRoute("index_vehicule");

    }

    /**
     * @Route("/vehicule/update/{id}", name="modif_vehicule")
     */
        public function modifVehicule(Request $request, $id){
            $em = $this->getDoctrine()->getManager();
            $vehicule = $em->getRepository("AppBundle:Vehicule")->find($id);
            $editForm = $this->createForm(VehiculeType::class, $vehicule);
            $editForm->handleRequest($request);
   //         $disponible = $vehicule->getDisponibilite();
            if($request->isMethod('POST') && $editForm->isValid()){

            }
        }

}
