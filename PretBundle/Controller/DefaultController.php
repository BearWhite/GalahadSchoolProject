<?php

namespace Biblio\PretBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Biblio\EntityBundle\Entity\Pret;
use Biblio\EntityBundle\Entity\Livre;
use Biblio\EntityBundle\Entity\Archivage;
use Symfony\Component\HttpFoundation\Request;
use Biblio\PretBundle\Form\Type\PretType;
use Symfony\Component\Validator\Constraints\DateTime;

class DefaultController extends Controller
{
    public function indexAction(){
        return $this->render('BiblioPretBundle:Default:index.html.twig');
    }
    
     public function listPretAction() {
        $repository = $this->getDoctrine()->getManager()    
                              ->getRepository('BiblioEntityBundle:Pret');
        $prets = $repository->findAll();
        return $this->render('BiblioPretBundle:Pret:list.html.twig',
                             array('prets' => $prets));
    }
    
     public function nbLivre($livre){
        $repositoryPret = $this->getDoctrine()->getManager()
           ->getRepository('BiblioEntityBundle:Pret');  
                
        $nbReservation = $repositoryPret->findNbReservation($livre->getId());
        $nbLivre = $livre->getNbExemplaire() - $nbReservation;
        
        return $nbLivre;
    }
    
     public function nbPret($emprunteur){
        $repositoryPret = $this->getDoctrine()->getManager()
           ->getRepository('BiblioEntityBundle:Pret');  
                
        $nbPretActuel = $repositoryPret->findNbPret($emprunteur->getId());
        $nbPretAutorise = $emprunteur->getCycle()->getNbLivre() - $nbPretActuel;
        
        return $nbPretAutorise;
    }
    
    
    public function listPretByLivreAction(){
        $form = $this->createFormBuilder()
        ->add('livre', 'entity', array('class' => 'BiblioEntityBundle:Livre'))
        ->add('Rechercher', 'submit')
        ->getForm();
        
        $request = $this->getRequest();
        
        if($request->getMethod() == 'POST'){
            $form->bind($request);
            
            if($form->isValid()){
                $repository = $this->getDoctrine()->getManager()    
                                  ->getRepository('BiblioEntityBundle:Pret');
    
                $livre = $form->get('livre')->getData();
                $prets = $repository->findByLivre($livre->getTitre());
                return $this->render('BiblioPretBundle:Pret:list.html.twig', array('prets' => $prets));
            }
        }
        return $this->render('BiblioPretBundle:Pret:listByLivre.html.twig', array('form' => $form->createView())); 
    }
    
    public function listPretByEmprunteurAction(){
        $form = $this->createFormBuilder()
        ->add('emprunteur', 'entity', array('class' => 'BiblioEntityBundle:Lecteur'))
        ->add('Rechercher', 'submit')
        ->getForm();
        
        $request = $this->getRequest();
        
        if($request->getMethod() == 'POST'){
            $form->bind($request);

            if($form->isValid()){
                $repository = $this->getDoctrine()->getManager()    
                                  ->getRepository('BiblioEntityBundle:Pret');
    
                $emprunteur = $form->get('emprunteur')->getData();
                $prets = $repository->findByEmprunteur($emprunteur->getNom(),$emprunteur->getPrenom());
                return $this->render('BiblioPretBundle:Pret:list.html.twig', array('prets' => $prets));
            }
        }
        return $this->render('BiblioPretBundle:Pret:listByEmprunteur.html.twig', array('form' => $form->createView())); 
    }
    

      public function isAvailableAction(){
        $form = $this->createFormBuilder()
            ->add('livre', 'entity', array('class' => 'BiblioEntityBundle:Livre'))
            ->add('Rechercher', 'submit')
            ->getForm();
        
        $request = $this->getRequest();
        $session = $request->getSession();
        
        if($request->getMethod() == 'POST'){
            $form->bind($request);

            if($form->isValid()){
                $repositoryLivre = $this->getDoctrine()->getManager()
                           ->getRepository('BiblioEntityBundle:Livre');           
                $livre = $form->get('livre')->getData();         
               
                if ( $this->nbLivre($livre) > 0){
                    $session->getFlashBag()->add('info', 'Le livre '.$livre->getTitre().' est disponible : '.$this->nbLivre($livre).' exemplaire(s) disponible(s)');
                }
                else{
                    $session->getFlashBag()->add('info', 'Le livre '.$livre->getTitre().' n est pas disponible');
                }     
            }
        }
        return $this->render('BiblioPretBundle:Pret:livreAvailable.html.twig', array('form' => $form->createView()));       
      }
      
      public function listPretHorsDelaiAction() {
        $repository = $this->getDoctrine()->getManager()    
                              ->getRepository('BiblioEntityBundle:Pret');
        $prets = $repository->findPretHorsDelai();
        return $this->render('BiblioPretBundle:Pret:listPretHorsDelai.html.twig',array('prets' => $prets));
    } 
    
    public function createAction(Request $request){
        $entity = new Pret();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);
        
        $session = $request->getSession();
            
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $livre = $form->get('livre')->getData();
            $emprunteur = $form->get('lecteur')->getData();
            
            if($this->nbLivre($livre) <= 0){
                $session->getFlashBag()->add('info', "Il n'y a plus d'exemplaires du livre " .$livre->getTitre()." pour le moment.");
                
                return $this->render('BiblioPretBundle:Pret:sortie.html.twig', array(
                    'entity' => $entity,
                    'form'   => $form->createView(),));
            }
            
            if($emprunteur->getCycle()->getId() != 3){
                if($this->nbPret($emprunteur) <= 0){
                    $session->getFlashBag()->add('info', "L'emprunteur a atteint son nombre limite de prêts");
                    
                    return $this->render('BiblioPretBundle:Pret:sortie.html.twig', array(
                        'entity' => $entity,
                        'form'   => $form->createView(),));
                }
            }
            
            $em->persist($entity);
            
            
            $livre = $em->getRepository('BiblioEntityBundle:Livre')->find($entity->getLivre()->getId());
            $livre->setNbExemplaire($livre->getNbExemplaire()-1);
            
            $em->flush();

            $session->getFlashBag()->add('info', 'Le livre a bien été prêté');
        }

        return $this->render('BiblioPretBundle:Pret:sortie.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }


    private function createCreateForm(Pret $entity){
        $form = $this->createForm(new PretType(), $entity, array(
            'action' => $this->generateUrl('biblio_pret_sortie2'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Emprunter'));

        return $form;
    }

    public function newAction() {
        $entity = new Pret();
        $form   = $this->createCreateForm($entity);

        return $this->render('BiblioPretBundle:Pret:sortie.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }
    
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('BiblioEntityBundle:Pret')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pret entity.');
        }

        $em->remove($entity);
        
        
        $livre = $em->getRepository('BiblioEntityBundle:Livre')->find($entity->getLivre()->getId());
        $livre->setNbExemplaire($livre->getNbExemplaire()+1);

        $date = new \Datetime();
        $archivage = new Archivage;
        $archivage->setNomLivre($entity->getLivre()->getTitre());
        $archivage->setNomLecteur($entity->getLecteur()->getNom());
        $archivage->setPrenomLecteur($entity->getLecteur()->getPrenom());
        $archivage->setDateEmprunt($entity->getDateReservation());
        $archivage->setDateRetour($date);
        
        $em->persist($archivage);
        $em->flush();
        
        $request = $this->getRequest();
        $session = $request->getSession();
        
        if($date > $entity->getDateReservation()->modify(" + ". $entity->getLecteur()->getCycle()->getDureePret(). "days")){
            $session->getFlashBag()->add('info', 'Retour hors delai !!');
        }
                
        return $this->redirect($this->generateUrl('biblio_pret_list'));
    }
    
}
