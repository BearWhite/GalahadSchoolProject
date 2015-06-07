<?php

namespace Biblio\LecteurBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Validator\Constraints\DateTime;
use Biblio\EntityBundle\Entity\Pret;
use Biblio\EntityBundle\Entity\Livre;

class LecteurController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('BiblioLecteurBundle:Default:index.html.twig', array('name' => $name));
    }
    
    public function listPretsEtReservationsAction()
    {
       $em = $this->getDoctrine()->getManager();
       $user = $this->getUser();
       
       $entities = $em->getRepository('BiblioEntityBundle:Pret')->findByLecteur($user);
       if($this->informationsDroits($user) == 0 && $user->getCycle()->getId() != 3)
                $this->getRequest()->getSession()->getFlashBag()->add('info', 'Votre limite d\'emprunts/réservations est atteinte.');
       
       return $this->render('BiblioLecteurBundle:Lecteur:list.html.twig', array('entities' => $entities));
    }
    
    public function rechercheLivreAction()
    {
        
    }
    
    public function informationsDroits($lecteur)
    {
       $repositoryPret = $this->getDoctrine()->getManager()
           ->getRepository('BiblioEntityBundle:Pret');  
                
        $nbPretActuel = $repositoryPret->findNbPret($lecteur->getId());
        $nbPretAutorise = $lecteur->getCycle()->getNbLivre() - $nbPretActuel;
        
        return $nbPretAutorise;
    }
    
    public function annulerReservationAction($id){
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('BiblioEntityBundle:Pret')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pret entity.');
        }

        $em->remove($entity);
        $em->flush();
        
        $request = $this->getRequest();
        $session = $request->getSession();
        $this->getRequest()->getSession()->getFlashBag()->add('success', 'La réservation a bien été annulée.');
                
        return $this->redirect($this->generateUrl('biblio_lecteur_listPrets'));
    }
    
    public function voirLivreAction($id){
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('BiblioEntityBundle:Livre')->find($id);
        
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pret entity.');
        }
        
        return $this->render('BiblioLecteurBundle:Lecteur:infoLivre.html.twig', array('entity' => $entity));
    }
    
    public function reserverLivreAction($id){
        if($this->getUser()->getCycle()->getId() == 3 || $this->informationsDroits($this->getUser()))
        { 
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $reservation = new Pret();
        
        $reservation->setLecteur($user);
        $reservation->setIsReservation(1);
        $reservation->setLivre($em->getRepository('BiblioEntityBundle:Livre')->find($id));
        $em->persist($reservation);
        $em->flush();
        
        $this->getRequest()->getSession()->getFlashBag()->add('success', 'La réservation a bien été prise en compte.');
        }else
        {
        $this->getRequest()->getSession()->getFlashBag()->add('alert', 'Vous ne pouvez pas réserver ce livre car votre limite d\'emprunts/réservations est atteinte.');            
        }        
        return $this->redirect($this->generateUrl('biblio_lecteur_listPrets'));
    }
}
