<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Bin;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AppBundle\Entity\Project;
use AppBundle\Form\ProjectType;

/**
 * Project controller.
 *
 * @Route("/project")
 */
class ProjectController extends Controller
{
    /**
     * Lists all Project entities.
     *
     * @Route("/", name="project_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $projects = $em->getRepository('AppBundle:Project')->findAll();

        return $this->render('project/index.html.twig', array(
            'projects' => $projects,
        ));
    }

    /**
     * Creates a new Project entity.
     *
     * @Route("/new", name="project_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();

        if (!$this->isGranted('ROLE_USER') || $user->getProject() != null)
            return ($this->redirectToRoute('index'));
        if ($user->getProject() != null)
            return ($this->redirectToRoute('project_show', array('project' => $user->getProject()->getId())));

        $project = new Project();
        $form = $this->createForm('AppBundle\Form\ProjectType', $project);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $data = $form->getData();
            $project->getBin()->setProject($project);
            $project->getSources()->setProject($project);
            $project->getSources()->upload();
            $project->getBin()->upload();
            $project->setTeamLeader($user);
            $em->persist($project);
            $em->flush();

            $user->setProject($project);
            $em->flush();
            return $this->redirectToRoute('project_show', array('project' => $project->getId()));
        }

        return $this->render('project/new.html.twig', array(
            'project' => $project,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Project entity.
     *
     * @Route("/show/{project}", name="project_show")
     * @Method("GET")
     */
    public function showAction(Request $request, Project $project)
    {
        return $this->render('project/show.html.twig', array('project' => $project));
    }

    /**
     * Displays a form to edit an existing Project entity.
     *
     * @Route("/{id}/edit", name="project_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Project $project)
    {
        if (!$this->isGranted('ROLE_USER'))
            return ($this->redirectToRoute('index'));
        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.token_storage')->getToken()->getUser();
            if (($t = $em->getRepository('AppBundle:Project')->findOneByTeamLeader($user)) == NULL || $t->getId() != $project->getId())
            return ($this->redirectToRoute('index'));
        $deleteForm = $this->createDeleteForm($project);
        $editForm = $this->createForm('AppBundle\Form\ProjectType', $project);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            if (!empty($project->getBin()->getFile()))
                $project->getBin()->upload();
            if (!empty($project->getSources()->getFile()))
                $project->getSources()->upload();
            $em->persist($project);
            $em->flush();

            return $this->redirectToRoute('project_show', array('project' => $project->getId()));
        }

        return $this->render('project/edit.html.twig', array(
            'project' => $project,
            'form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Project entity.
     *
     * @Route("/{id}", name="project_delete")
     * @Method({"DELETE", "GET"})
     */
    public function deleteAction(Request $request, Project $project)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $form = $this->createDeleteForm($project);
        $form->handleRequest($request);

        if ($user->getProject() != $project)
            throw $this->createNotFoundException('You are not the owner of this project');
        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('security.token_storage')->getToken()->getUser()->setProject(NULL);
            $em = $this->getDoctrine()->getManager();
            $em->remove($project);
            $em->flush();
        }
        else
        {
            return $this->render('project/delete.html.twig', array('projet' => $project, 'form' => $this->createDeleteForm($project)->createView()));
        }

        return $this->redirectToRoute('project_index');
    }

    /**
     * Creates a form to delete a Project entity.
     *
     * @param Project $project The Project entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Project $project)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('project_delete', array('id' => $project->getId())))
            ->add('save', SubmitType::class, array(
                'attr' => array('class' => 'btn btn-danger'),
                'label' => "Supprimer"
            ))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
