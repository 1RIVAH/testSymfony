<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Voyageur;
use AppBundle\Form\VoyageurType;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class VoyageurController extends Controller
{
    /**
     * @Route("/voyageur", name="index_voyageur")
     */
    public function indexAction()
    {
        //$tab = [];
        $em = $this->getDoctrine()->getManager();
        //$voy = new Voyageur();
        $voyageurs  = $em->getRepository("AppBundle:Voyageur")->findAll();
       // $nom = $voy->getNom();
       // $nom = strtoupper($nom);

        //dump($voyageurs); die();
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
        $nom = $form['nom'];
        $prenom = $form['prenom'];
        $adresse = $form['adresse'];
        $telephone = $form['telephone'];


            $form->handleRequest($request);
            if($form->isSubmitted() && $form->isValid()){

                $em = $this->getDoctrine()->getManager();
                $em->persist($voyageur);
                $em->flush();
            //$this->addFlash("success", "Creation voyageur enregistrer");
                return $this->redirectToRoute("index_voyageur", array('id'=> $voyageur->getId()));

            }

            return $this->render('Voyageur/new.html.twig', array(
                'voyageur'=>$voyageur,
                'form'=>$form->createView(),

            ));
        }
/**
 * @Route("/voyageur/update/{id}", name="modif_voyageur")
 */
    public function modifAction(Request $request, $id){
        $em = $this->getDoctrine()->getManager();
        $voyageur = $em->getRepository("AppBundle:Voyageur")->find($id);

        if($voyageur === null){
            throw new NotFoundHttpException("L'annonce d'id ".$id. "n'existe pas.");

        }
        $editForm = $this->createForm(VoyageurType::class, $voyageur);
        $editForm->handleRequest($request);
        //dump($editForm);die();
        if($request->isMethod('POST') && $editForm->isValid()){
            $em->flush();
            //$this->addFlash("success", "modification ok");

            return $this->redirectToRoute('index_voyageur', array('id'=>$voyageur->getId()));
        }
        return $this->render('Voyageur/modif.html.twig', array(
            'voyageur' => $voyageur,
            'editForm' => $editForm->createView(),
        ));
    }

    /**
     * @Route("/voyageur/view/{id}", name="affiche_voyageur")
     */
    public function afficherAction($id){
        $voyageur = $this->getDoctrine()->getRepository("AppBundle:Voyageur")->find($id);
        return $this->render("Voyageur/view.html.twig", ['voyageur'=>$voyageur]);
    }
    /**
     * @Route("/voyageur/delete/{id}", name="supprimer_voyageur")
     */
    public function supprimerAction($id){
        $em = $this->getDoctrine()->getManager();
        $voyageur = $em->getRepository("AppBundle:Voyageur")->find($id);
        $em->remove($voyageur);
        $em->flush();
        $this->addFlash('message', 'Suppression reussi');
        return $this->redirectToRoute("index_voyageur");
    }
}
