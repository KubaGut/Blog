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
        return $this->render('default/user.html.twig');
    }
    /**
     * @Route("/user/post/show/{postId}", name="show")
     */
    public function showAction($postId, Request $request)
    {
        $post = new Posts();
        $em=$this->getDoctrine()->getManager();
        $post = $em->getRepository('AppBundle:Posts')->findOneById($postId);
        return $this->render('default/userPostShow.html.twig', array('post' => $post));
    }
    /**
     * @Route("/user/post/delete/{postId}", name="delete")
     */
    public function deleteAction($postId)
    {
        $post = new Posts();
        $em=$this->getDoctrine()->getManager();
        $post = $em->getRepository('AppBundle:Posts')->findOneById($postId);
        $em->remove($post);
        $em->flush();
        return $this->render('default/user.html.twig');
    }


    /**
     * @Route("/user/post/add", name="add")
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

        return $this->render('default/userPostAdd.html.twig', array('form'=> $form->createView()) );
    }
    /**
     * @Route("/user/post/edit/{postId}", name="editPost")
     */
    public function editPostAction($postId, Request $request) {

        $Post = new Posts();
        $em=$this->getDoctrine()->getManager();
        $Post->setTitle($em->getRepository('AppBundle:Posts')->findOneById($postId)->getTitle());
        $Post->setText($em->getRepository('AppBundle:Posts')->findOneById($postId)->getText());
        $editedPost = new Posts();
        $form = $this->createForm(PostsType::class, $Post);

        $form->handleRequest($request);

        if($form->issubmitted() && $form->isValid()) {

            $editedPost=$em->getRepository('AppBundle:Posts')->findOneById($postId);
            $editedPost->setText($Post->getText());
            $editedPost->setTitle($Post->getTitle());
            $em->flush();


            return $this->redirectToRoute('user');
        }
        return $this->render('default/userPostEdit.html.twig', array('form'=> $form->createView()) );
    }

}

