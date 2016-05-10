<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use EpitechAPI\Connector;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
        ]);
    }

    /**
     * @Route("/log", name="login")
     */
    public function loginAction(Request $request)
    {
        /*$connector = new Connector();
        if ($connector->isSignedIn())
        {
            echo 'you are already connect';
        }
        $usr = new User();// Starting to initializing a new object of Connector.

        $form = $this->createFormBuilder()
            ->add('login', TextType::class)
            ->add('pass', PasswordType::class)
            ->add('save', SubmitType::class, array('label' => 'Connection'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
        }
        return $this->render('AppBundle:User:connection.html.twig', [
            'form' => $form->createView()
        ]);*/

        $authenticationUtils = $this->get('security.authentication_utils');
        return $this->render('AppBundle:User:connection.html.twig', array(
            'last_username' => $authenticationUtils->getLastUsername(),
            'error'         => $authenticationUtils->getLastAuthenticationError(),
        ));
    }

    /**
     * @Route("/new_project", name="newproject")
     */
    public function createProjectAction(Request $request)
    {
        if (!$this->isGranted('IS_AUTHENTICATED_REMEMBERED'))
            return ($this->redirectToRoute('app_index'));

        

        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
        ]);
    }
}
