<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\UserType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class MainController extends Controller
{
    /**
     * @Route("/index", name="homepage")
     */
    public function indexAction(){
        return $this->render('default/index.html.twig' );
    }

    /**
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request, AuthenticationUtils $authUtils){

        $error = $authUtils->getlastAuthenticationError();

        $lastUserName = $authUtils->getLastUsername();

        return $this->render('security/login.html.twig', array(
            'last_username'=> $lastUserName,
            'error' => $error) );
    }

    /**
     * @Route("/register", name="register")
     */
    public function registerAction(Request $request, UserPasswordEncoderInterface $encoder){

        $User = new User();

        $form = $this->createForm(UserType::class, $User);

        $form->handleRequest($request);

        if($form->issubmitted() && $form->isValid()) {
            $User->setRole("ROLE_USER");
            $encoded = $encoder->encodePassword($User, $User->getPassword());
            $User->setPassword($encoded);
            $em=$this->getDoctrine()->getManager();
            $em->persist($User);
            $em->flush();


            return $this->redirectToRoute('homepage');
        }

        return $this->render('default/register.html.twig', array('form'=> $form->createView()) );
    }
}
