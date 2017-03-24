<?php

namespace VDM_campingBundle\Controller;

use VDM_campingBundle\Entity\Vdm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Vdm controller.
 *
 */
class VdmController extends Controller
{
    /**
     * Lists all vdm entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $vdms = $em->getRepository('VDM_campingBundle:Vdm')->findAll();

        return $this->render('@VDM_camping/vdm/index.html.twig', array(
            'vdms' => $vdms,
        ));
    }

    /**
     * Creates a new vdm entity.
     *
     */
    public function newAction(Request $request)
    {
        $vdm = new Vdm();
        $form = $this->createForm('VDM_campingBundle\Form\VdmType', $vdm);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($vdm);
            $em->flush($vdm);

            return $this->redirectToRoute('vdm_show', array('id' => $vdm->getId()));
        }

        return $this->render('@VDM_camping/vdm/new.html.twig', array(
            'vdm' => $vdm,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a vdm entity.
     *
     */
    public function showAction(Vdm $vdm)
    {
        $deleteForm = $this->createDeleteForm($vdm);

        return $this->render('@VDM_camping/vdm/show.html.twig', array(
            'vdm' => $vdm,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing vdm entity.
     *
     */
    public function editAction(Request $request, Vdm $vdm)
    {
        $deleteForm = $this->createDeleteForm($vdm);
        $editForm = $this->createForm('VDM_campingBundle\Form\VdmType', $vdm);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('vdm_edit', array('id' => $vdm->getId()));
        }

        return $this->render('@VDM_camping/vdm/edit.html.twig', array(
            'vdm' => $vdm,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a vdm entity.
     *
     */
    public function deleteAction(Request $request, Vdm $vdm)
    {
        $form = $this->createDeleteForm($vdm);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($vdm);
            $em->flush($vdm);
        }

        return $this->redirectToRoute('vdm_index');
    }

    /**
     * Creates a form to delete a vdm entity.
     *
     * @param Vdm $vdm The vdm entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Vdm $vdm)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('vdm_delete', array('id' => $vdm->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
