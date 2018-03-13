<?php

namespace Orca\MailBundle\Controller;

use Orca\MailBundle\Entity\MailTblRegle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Mailtblregle controller.
 *
 * @Route("mailtblregle")
 */
class MailTblRegleController extends Controller
{
    /**
     * Lists all mailTblRegle entities.
     *
     * @Route("/", name="mailtblregle_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $mailTblRegles = $em->getRepository('OrcaMailBundle:MailTblRegle')->findAll();

        return $this->render('OrcaMailBundle:mailtblregle:index.html.twig', array(
            'mailTblRegles' => $mailTblRegles,
        ));
    }

    /**
     * Creates a new mailTblRegle entity.
     *
     * @Route("/new", name="mailtblregle_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $mailTblRegle = new Mailtblregle();
        $form = $this->createForm('Orca\MailBundle\Form\MailTblRegleType', $mailTblRegle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($mailTblRegle);
            $em->flush();

            return $this->redirectToRoute('mailtblregle_show', array('id' => $mailTblRegle->getId()));
        }

        return $this->render('OrcaMailBundle:mailtblregle:new.html.twig', array(
            'mailTblRegle' => $mailTblRegle,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a mailTblRegle entity.
     *
     * @Route("/{id}", name="mailtblregle_show")
     * @Method("GET")
     */
    public function showAction(MailTblRegle $mailTblRegle)
    {
        $deleteForm = $this->createDeleteForm($mailTblRegle);

        return $this->render('OrcaMailBundle:mailtblregle:show.html.twig', array(
            'mailTblRegle' => $mailTblRegle,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing mailTblRegle entity.
     *
     * @Route("/{id}/edit", name="mailtblregle_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, MailTblRegle $mailTblRegle)
    {
        $deleteForm = $this->createDeleteForm($mailTblRegle);
        $editForm = $this->createForm('Orca\MailBundle\Form\MailTblRegleType', $mailTblRegle);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('mailtblregle_edit', array('id' => $mailTblRegle->getId()));
        }

        return $this->render('OrcaMailBundle:mailtblregle:edit.html.twig', array(
            'mailTblRegle' => $mailTblRegle,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a mailTblRegle entity.
     *
     * @Route("/{id}", name="mailtblregle_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, MailTblRegle $mailTblRegle)
    {
        $form = $this->createDeleteForm($mailTblRegle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($mailTblRegle);
            $em->flush();
        }

        return $this->redirectToRoute('mailtblregle_index');
    }

    /**
     * Creates a form to delete a mailTblRegle entity.
     *
     * @param MailTblRegle $mailTblRegle The mailTblRegle entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(MailTblRegle $mailTblRegle)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('mailtblregle_delete', array('id' => $mailTblRegle->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
