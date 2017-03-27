<?php

namespace VDM_campingBundle\Controller;

use VDM_campingBundle\Entity\Genre;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Genre controller.
 *
 */
class GenreController extends Controller
{
    /**
     * Lists all genre entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $genres = $em->getRepository('VDM_campingBundle:Genre')->findAll();

        return $this->render('@VDM_camping/genre/index.html.twig', array(
            'genres' => $genres,
        ));
    }

    /**
     * Creates a new genre entity.
     *
     */
    public function newAction(Request $request)
    {
        $genre = new Genre();
        $form = $this->createForm('VDM_campingBundle\Form\GenreType', $genre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($genre);
            $em->flush($genre);

            return $this->redirectToRoute('genre_show', array('id' => $genre->getId()));
        }

        return $this->render('@VDM_camping/genre/new.html.twig', array(
            'genre' => $genre,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a genre entity.
     *
     */
    public function showAction(Genre $genre)
    {
        $deleteForm = $this->createDeleteForm($genre);

        return $this->render('@VDM_camping/genre/show.html.twig.html.twig', array(
            'genre' => $genre,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing genre entity.
     *
     */
    public function editAction(Request $request, Genre $genre)
    {
        $deleteForm = $this->createDeleteForm($genre);
        $editForm = $this->createForm('VDM_campingBundle\Form\GenreType', $genre);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('genre_edit', array('id' => $genre->getId()));
        }

        return $this->render('@VDM_camping/genre/edit.html.twig', array(
            'genre' => $genre,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a genre entity.
     *
     */
    public function deleteAction(Request $request, Genre $genre)
    {
        $form = $this->createDeleteForm($genre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($genre);
            $em->flush($genre);
        }

        return $this->redirectToRoute('genre_index');
    }

    /**
     * Creates a form to delete a genre entity.
     *
     * @param Genre $genre The genre entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Genre $genre)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('genre_delete', array('id' => $genre->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
