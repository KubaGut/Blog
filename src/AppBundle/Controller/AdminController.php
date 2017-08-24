<?php
/**
 * Created by PhpStorm.
 * User: jakub
 * Date: 20.08.17
 * Time: 08:37
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class AdminController extends Controller
{
    /**
     * @Route("/admin", name="admin")
     */
    public function adminAction()
    {
        $em = $this->getDoctrine()->getManager();
        $Users = $em->getRepository('AppBundle:User')->findAll();

        return $this->render('default/admin.html.twig', array('users'=>$Users));
    }
}