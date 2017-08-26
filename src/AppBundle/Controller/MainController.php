<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\UserType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Swift_Mailer;
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
            $User->setIsActive(false);
            $em=$this->getDoctrine()->getManager();
            $em->persist($User);
            $em->flush();

            $transport = new \Swift_SmtpTransport('smtp.gmail.com', 465,'ssl');
            $transport->setUsername('gutkowski.jakub1');
            $transport->setPassword('Zyxw1234');
            $mailer = new \Swift_Mailer($transport);
            $message = (new \Swift_Message('Blog Authentication'))
            ->setFrom('gutkowski.jakub1@gmail.com')
            ->setTo($User->getEmail())
            ->setBody($this->renderView('emails/emails.html.twig',array('id'=>$User->getId())),'text/html');

            $mailer->send($message);

            return $this->redirectToRoute('homepage');
        }

        return $this->render('default/register.html.twig', array('form'=> $form->createView()) );
    }
    /**
     * @Route("/confirmation/{id}", name="confirmation")
     */
    public function confirmationAction($id, Request $request) {
        $user = new User();
        $em=$this->getDoctrine()->getManager();
        $user = $em->getRepository('AppBundle:User')->findOneById($id);
        $user->setIsActive(true);

        $em->flush();
        return $this->render('default/index.html.twig' );
    }

}
