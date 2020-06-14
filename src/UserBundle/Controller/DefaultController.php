<?php

namespace UserBundle\Controller;

use UserBundle\Entity\User;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
       $u=$this->container->get('security.token_storage')->getToken()->getUser();

            try {
                switch ($u->getRoles()[0]) {
                    case "ADMIN":
                        return $this->redirect('access/admin');
                        break;
                    case "ELEVE":
                        return $this->redirect('access/eleve');
                        break;
                    case "ENSEIGNANT":
                        return $this->redirect('access/enseignant');
                        break;

                }
            } catch (\Throwable $e) {
                return $this->redirect('http://localhost/Pi-final/web/app_dev.php/login');

            };



    }






    public function adminAction()
    {   $user=$this->getUser();
        $user = $this->container->get('security.token_storage')->getToken()->getUser()->getId();


        return $this->render('@User/Default/admin.html.twig',['u'=>$user]);

    }

    public function eleveAction()
    {   $user = $this->getUser();


        return $this->render('@User/Default/eleve.html.twig', array('u'=>$user));

    }


    public function enseignantAction()
    {    $user = $this->container->get('security.token_storage')->getToken()->getUser()->getNom();
        return $this->render('@User/Default/enseignant.html.twig',['u'=>$user]);

    }

    public function homeAction()
    {
        return $this->render('@User/Default/home.html.twig');

    }



}
