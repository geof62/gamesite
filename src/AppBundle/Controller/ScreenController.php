<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Screen;
use AppBundle\Form\ScreenType;
use AppBundle\Entity\Project;

/**
 * Screen controller.
 *
 * @Route("/project/{project}/screen")
 */
class ScreenController extends Controller
{

    /**
     * Lists all Project entities.
     *
     * @Route("/", name="screen_index")
     * @Method("GET")
     */
    public function indexAction(Project $project)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        if ($user == null || $user->getProject() != $project)
            throw $this->createNotFoundException('You are not the owner of this project');
        return $this->render('screen/index.html.twig', array(
            'project' => $project,
        ));
    }

    /**
     * Creates a new Screen entity.
     *
     * @Route("/new", name="screen_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request, Project $project)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        if (!$this->isGranted('ROLE_USER') || $project != $user->getProject())
            throw $this->createNotFoundException('You are not the owner of this project');

        $screen = new Screen();
        $form = $this->createForm('AppBundle\Form\ScreenType', $screen);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $screen->setProject($project);
            $screen->upload();
            $em->persist($screen);
            $em->flush();

            return $this->redirectToRoute('screen_index', array('project' => $project->getId()));
        }

        return $this->render('screen/new.html.twig', array(
            'project' => $project,
            'form' => $form->createView(),
        ));
    }

    /**
     * Deletes a Screen entity.
     *
     * @Route("/remove/{screen}", name="screen_delete")
     * @Method({"DELETE", "GET"})
     */
    public function deleteAction(Request $request, Project $project, Screen $screen)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        if (!$this->isGranted('ROLE_USER') || $project != $user->getProject())
            throw $this->createNotFoundException('You are not the owner of this project');
        $em = $this->getDoctrine()->getManager();
        $em->remove($screen);
        $em->flush();
        return $this->redirectToRoute('screen_index', array("project" => $project->getId()));
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