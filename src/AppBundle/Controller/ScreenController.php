<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Screen;
use AppBundle\Form\ScreenType;

/**
 * Screen controller.
 *
 * @Route("/screen")
 */
class ScreenController extends Controller
{

    /**
     * Lists all Project entities.
     *
     * @Route("/screens", name="screen_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $screen = $em->getRepository('AppBundle:Screen')->findAll();

        return $this->render('screen/index.html.twig', array(
            'screens' => $screen,
        ));
    }

    /**
     * Creates a new Screen entity.
     *
     * @Route("/new", name="screen_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        if (!$this->isGranted('ROLE_USER'))
            return ($this->redirectToRoute('index'));
        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $project = $em->getRepository('AppBundle:Project')->findByTeamLeader($user);
        if ($project == NULL)
            return ($this->redirectToRoute('index'));
        $screen = new Screen();
        $form = $this->createForm('AppBundle\Form\ScreenType', $screen);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $screen->setProject($project);
            $screen->upload();
            $em->persist($screen);
            $em->flush();

            return $this->redirectToRoute('screen_show', array('id' => $screen->getId()));
        }

        return $this->render('screen/new.html.twig', array(
            'screen' => $screen,
            'form' => $form->createView(),
        ));
    }

    /**
     * Deletes a Screen entity.
     *
     * @Route("/{id}", name="screen_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Screen $screen)
    {
        $form = $this->createDeleteForm($screen);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($screen);
            $em->flush();
        }

        return $this->redirectToRoute('screen_index');
    }

    /**
     * Creates a form to delete a Screen entity.
     *
     * @param Screen $screen The Screen entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Screen $screen)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('screen_delete', array('id' => $screen->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}