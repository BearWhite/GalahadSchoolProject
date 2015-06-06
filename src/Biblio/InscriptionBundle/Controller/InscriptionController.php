<?php

namespace Biblio\InscriptionBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Biblio\EntityBundle\Entity\Lecteur;
use Biblio\InscriptionBundle\Form\LecteurType;
use Biblio\EntityBundle\Entity\Faculte;
use Biblio\InscriptionBundle\Form\FaculteType;
use Biblio\EntityBundle\Entity\Constants;
/**
 * Lecteur controller.
 *
 */
class InscriptionController extends Controller
{


    public function indexAction()
    {
        return $this->render('BiblioInscriptionBundle:Default:index.html.twig');
    }
    
    private function manageNotifications($type, $value, $action = null, $more = null, $statusCode = null)
    {
        switch($type)
        {
            case Constants::LECTEUR_PARAMETER:
                if($value == "success")
                    $this->getRequest()->getSession()->getFlashBag()->add('success', $action.': Lecteur '.$more);
                else
                    $this->getRequest()->getSession()->getFlashBag()->add('alert',  $action.': Houston ! Nous avons un problème avec ce lecteur. Exception: '.$more.'('.$statusCode.')');
                break;
            case Constants::FACULTE_PARAMETER:
                if($value == "success")
                    $this->getRequest()->getSession()->getFlashBag()->add('success', $action.': Faculté '.$more);
                else
                    $this->getRequest()->getSession()->getFlashBag()->add('alert',  $action.': Houston ! Nous avons un problème avec cette faculté. Exception: '.$more.'('.$statusCode.')');
                break;
        }
    }
    
    //Lister lecteurs ou Facultés selon la variable GET
    
    public function listAllAction($type)
    {
        $entity = null;
        $em = $this->getDoctrine()->getManager();
        
        switch(strtoupper($type))
        {
            case strtoupper(Constants::FACULTE_PARAMETER):
                 $entity = Constants::FACULTE_PARAMETER;
            break;
            default:
                 $entity = Constants::LECTEUR_PARAMETER;
        }
        
        $entities = $em->getRepository('BiblioEntityBundle:'.$entity)->findAll();
        return $this->render('BiblioInscriptionBundle:'.$entity.':list.html.twig', array(
            'entities' => $entities,
        ));
        
    }
    
    /**
     * Creates a new Lecteur entity.
     *
     */
    public function createAction(Request $request)
    {
        try
        {
        $entity = new Lecteur();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $this->manageNotifications(Constants::LECTEUR_PARAMETER,'success',Constants::ADD,$entity->getPrenom().' '.$entity->getNom());
            return $this->redirect($this->generateUrl('biblio_inscription_list', array('id' => $entity->getId())));
        }
        }
        catch(NotFoundHttpException $e)
        {
            $this->manageNotifications(Constants::LECTEUR_PARAMETER,'alert',Constants::ADD,'NotFoundHttpException',$e->getStatusCode());
        }
        catch(Exception $e)
        {
            $this->manageNotifications(Constants::LECTEUR_PARAMETER,'alert',Constants::ADD,'GlobalException',$dbE->getStatusCode());
        }

        return $this->render('BiblioInscriptionBundle:Lecteur:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Lecteur entity.
     *
     * @param Lecteur $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Lecteur $entity)
    {
        $form = $this->createForm(new LecteurType(), $entity, array(
            'action' => $this->generateUrl('biblio_inscription_lecteur_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Créer', 'attr' => array('class' => 'marge-button btn btn-success')));

        return $form;
    }

    /**
     * Displays a form to create a new Lecteur entity.
     *
     */
    public function newAction()
    {
        $entity = new Lecteur();
        $form   = $this->createCreateForm($entity);

        return $this->render('BiblioInscriptionBundle:Lecteur:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Lecteur entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BiblioEntityBundle:Lecteur')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Lecteur entity.');
        }

        $editForm = $this->createEditForm($entity);

        return $this->render('BiblioInscriptionBundle:Lecteur:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Lecteur entity.
    *
    * @param Lecteur $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Lecteur $entity)
    {
        $form = $this->createForm(new LecteurType(), $entity, array(
            'action' => $this->generateUrl('biblio_inscription_lecteur_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update', 'attr' => array('class' => 'marge-button btn btn-success')));

        return $form;
    }
    /**
     * Edits an existing Lecteur entity.
     *
     */
    public function updateAction(Request $request, $id)
    {

        try
        {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BiblioEntityBundle:Lecteur')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Lecteur entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
             $em->flush();
             $this->manageNotifications(Constants::LECTEUR_PARAMETER,'success',Constants::UPDATE,$entity->getPrenom().' '.$entity->getNom());
           
            return $this->redirect($this->generateUrl('biblio_inscription_lecteur_edit', array('id' => $id)));
        }
        }
        catch(NotFoundHttpException $e)
        {
            $this->manageNotifications(Constants::LECTEUR_PARAMETER,'alert',Constants::UPDATE,'NotFoundHttpException',$e->getStatusCode());
        }
        catch(Exception $e)
        {
            $this->manageNotifications(Constants::LECTEUR_PARAMETER,'alert',Constants::UPDATE,'GlobalException',$dbE->getStatusCode());
        }

        return $this->render('BiblioInscriptionBundle:Lecteur:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }
    /**
     * Deletes a Lecteur entity.
     *
     */
    public function deleteAction($id)
    {
        try
        {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BiblioEntityBundle:Lecteur')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Lecteur entity.');
            }

            $em->remove($entity);
            $em->flush();
            
            $this->manageNotifications(Constants::LECTEUR_PARAMETER,'success',Constants::DELETE,$entity->getPrenom().' '.$entity->getNom());
        }
        catch(NotFoundHttpException $e)
        {
            $this->manageNotifications(Constants::LECTEUR_PARAMETER,'alert',Constants::DELETE,'NotFoundHttpException',$e->getStatusCode());
        }
        catch(Exception $e)
        {
            $this->manageNotifications(Constants::LECTEUR_PARAMETER,'alert',Constants::DELETE,'GlobalException',$dbE->getStatusCode());
        }
        
        return $this->redirect($this->generateUrl('biblio_inscription_list'));
    }
    
    /**
     * Creates a form to delete a Lecteur entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('biblio_inscription_lecteur_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
    
        /**
     * Creates a new Faculte entity.
     *
     */
    public function createFaculteAction(Request $request)
    {
        try
        {
        $entity = new Faculte();
        $form = $this->createCreateFaculteForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $this->manageNotifications(Constants::FACULTE_PARAMETER,'success',Constants::ADD,$entity->getNom());
            return $this->redirect($this->generateUrl('faculte_show', array('id' => $entity->getId())));
        }
        }
        catch(NotFoundHttpException $e)
        {
            $this->manageNotifications(Constants::FACULTE_PARAMETER,'alert',Constants::ADD,'NotFoundHttpException',$e->getStatusCode());
        }
        catch(Exception $e)
        {
            $this->manageNotifications(Constants::FACULTE_PARAMETER,'alert',Constants::ADD,'GlobalException',$dbE->getStatusCode());
        }

        return $this->render('BiblioInscriptionBundle:Faculte:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Faculte entity.
     *
     * @param Faculte $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateFaculteForm(Faculte $entity)
    {
        $form = $this->createForm(new FaculteType(), $entity, array(
            'action' => $this->generateUrl('biblio_inscription_faculte_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Créer', 'attr' => array('class' => 'marge-button btn btn-success')));

        return $form;
    }

    /**
     * Displays a form to create a new Faculte entity.
     *
     */
    public function newFaculteAction()
    {
        $entity = new Faculte();
        $form   = $this->createCreateFaculteForm($entity);

        return $this->render('BiblioInscriptionBundle:Faculte:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }
    
       /**
     * Displays a form to edit an existing Lecteur entity.
     *
     */
    public function editFaculteAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BiblioEntityBundle:Faculte')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Faculte entity.');
        }

        $editForm = $this->createEditFaculteForm($entity);

        return $this->render('BiblioInscriptionBundle:Faculte:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Faculte entity.
    *
    * @param Faculte $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditFaculteForm(Faculte $entity)
    {
        $form = $this->createForm(new FaculteType(), $entity, array(
            'action' => $this->generateUrl('biblio_inscription_faculte_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update', 'attr' => array('class' => 'marge-button btn btn-success')));

        return $form;
    }
    /**
     * Edits an existing Lecteur entity.
     *
     */
    public function updateFaculteAction(Request $request, $id)
    {

        try
        {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BiblioEntityBundle:Faculte')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Faculte entity.');
        }

        $deleteForm = $this->createDeleteFaculteForm($id);
        $editForm = $this->createEditFaculteForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
             $em->flush();
             $this->manageNotifications(Constants::FACULTE_PARAMETER,'success',Constants::UPDATE,$entity->getNom());
           
            return $this->redirect($this->generateUrl('biblio_inscription_faculte_edit', array('id' => $id)));
        }
        }
        catch(NotFoundHttpException $e)
        {
            $this->manageNotifications(Constants::FACULTE_PARAMETER,'alert',Constants::UPDATE,'NotFoundHttpException',$e->getStatusCode());
        }
        catch(Exception $e)
        {
            $this->manageNotifications(Constants::FACULTE_PARAMETER,'alert',Constants::UPDATE,'GlobalException',$dbE->getStatusCode());
        }

        return $this->render('BiblioInscriptionBundle:FACULTE:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }
    /**
     * Deletes a Lecteur entity.
     *
     */
    public function deleteFaculteAction($id)
    {
        try
        {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BiblioEntityBundle:Faculte')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Faculte entity.');
            }

            $em->remove($entity);
            $em->flush();
            
            $this->manageNotifications(Constants::FACULTE_PARAMETER,'success',Constants::DELETE,$entity->getNom());
        }
        catch(NotFoundHttpException $e)
        {
            $this->manageNotifications(Constants::FACULTE_PARAMETER,'alert',Constants::DELETE,'NotFoundHttpException',$e->getStatusCode());
        }
        catch(Exception $e)
        {
            $this->manageNotifications(Constants::FACULTE_PARAMETER,'alert',Constants::DELETE,'GlobalException',$dbE->getStatusCode());
        }
        
        return $this->redirect($this->generateUrl('biblio_inscription_faculte_list'));
    }
    
    /**
     * Creates a form to delete a Lecteur entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteFaculteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('biblio_inscription_faculte_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
 
}
