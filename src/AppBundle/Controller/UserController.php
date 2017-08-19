<?php


namespace AppBundle\Controller;

use AppBundle\Entity\Posts;
use AppBundle\Form\PostsType;
use DateTime;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class UserController extends Controller
{
    /**
     * @Route("/user", name="user")
     */
    public function indexAction()
    {
        return $this->render('default/indexUser.html.twig');
    }

    /**
     * @Route("/user/add", name="add")
     */
    public function addPostAction(Request $request){

        $Post = new Posts();

        $form = $this->createForm(PostsType::class, $Post);

        $form->handleRequest($request);

        if($form->issubmitted() && $form->isValid()) {
            $Post->setUser($this->getUser());
            $Post->setDate(new DateTime());
            $em=$this->getDoctrine()->getManager();
            $em->persist($Post);
            $em->flush();


            return $this->redirectToRoute('user');
        }

        return $this->render('default/addPost.html.twig', array('form'=> $form->createView()) );
    }

}

