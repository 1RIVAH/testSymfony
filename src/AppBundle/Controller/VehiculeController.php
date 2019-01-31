<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Vehicule;
use AppBundle\Form\VehiculeType;

class VehiculeController extends Controller
{
    /**
     * @Route("/vehicule", name="indew_vehicule")
     */
    public function indexAction()
    {
      $em = $this->getDoctrine()->getManager();
      $vehicule = $em->getRepository("AppBundle:Vehicule")->findAll();

        return $this->render("Vehicule/index.html.twig", [
            'vehicule'=>$vehicule,
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
            $donnee = $form->getData();
            //dump($donnee);die;
            $vehicule->setNumero($donnee->getNumero());
            $vehicule->setMarque($donnee->getMarque());
            $vehicule->setType($donnee->getType());
            $vehicule->setNombrePlace($donnee->getNombrePlace());
            $vehicule->setDisponibilite($donnee->getDisponibilite());
            $vehicule->setVoyageur($donnee->getVoyageur());

            $em = $this->getDoctrine()->getManager();
            $em->persist($vehicule);
            $em->flush();
        }
        return $this->render("Vehicule/new.html.twig", array(
            'form'      => $form->createView(),
        ));
    }

}
