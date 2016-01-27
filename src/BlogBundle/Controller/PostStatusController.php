<?php

namespace BlogBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use BlogBundle\Entity\PostStatus;
use BlogBundle\Form\PostStatusType;

/**
 * @author  Alaa Attya <alaa.attya91@gmail.com>
 * PostStatus controller.
 *
 * @Route("/admin/post-status")
 */
class PostStatusController extends Controller
{
    /**
     * Lists all PostStatus entities.
     *
     * @Route("/", name="admin_post-status_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $postStatuses = $em->getRepository('BlogBundle:PostStatus')->findAll();

        return $this->render('poststatus/index.html.twig', array(
            'postStatuses' => $postStatuses,
        ));
    }

    /**
     * Creates a new PostStatus entity.
     *
     * @Route("/new", name="admin_post-status_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $postStatus = new PostStatus();
        $form = $this->createForm('BlogBundle\Form\PostStatusType', $postStatus);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($postStatus);
            $em->flush();

            return $this->redirectToRoute('admin_post-status_show', array('id' => $postStatus->getId()));
        }

        return $this->render('poststatus/new.html.twig', array(
            'postStatus' => $postStatus,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a PostStatus entity.
     *
     * @Route("/{id}", name="admin_post-status_show")
     * @Method("GET")
     */
    public function showAction(PostStatus $postStatus)
    {
        $deleteForm = $this->createDeleteForm($postStatus);

        return $this->render('poststatus/show.html.twig', array(
            'postStatus' => $postStatus,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing PostStatus entity.
     *
     * @Route("/{id}/edit", name="admin_post-status_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, PostStatus $postStatus)
    {
        $deleteForm = $this->createDeleteForm($postStatus);
        $editForm = $this->createForm('BlogBundle\Form\PostStatusType', $postStatus);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($postStatus);
            $em->flush();

            return $this->redirectToRoute('admin_post-status_edit', array('id' => $postStatus->getId()));
        }

        return $this->render('poststatus/edit.html.twig', array(
            'postStatus' => $postStatus,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a PostStatus entity.
     *
     * @Route("/{id}", name="admin_post-status_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, PostStatus $postStatus)
    {
        $form = $this->createDeleteForm($postStatus);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($postStatus);
            $em->flush();
        }

        return $this->redirectToRoute('admin_post-status_index');
    }

    /**
     * Creates a form to delete a PostStatus entity.
     *
     * @param PostStatus $postStatus The PostStatus entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(PostStatus $postStatus)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_post-status_delete', array('id' => $postStatus->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
