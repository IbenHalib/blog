<?php

namespace Vadim\GuestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Vadim\GuestBundle\Entity\Post;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Vadim\GuestBundle\Form\Type\PostType;
use Doctrine\ORM\Query;
use Knp\Bundle\PaginatorBundle\Pagination\SlidingPagination;
use Knp\Component\Pager\Paginator;

class DefaultController extends Controller
{
    /**
     * @Template()
     */
    public function indexAction($numberPage = 1, Request $request)
    {
        $post = new Post();

        $form =$this->createForm(new PostType(), $post);


        $manager = $this->getDoctrine()->getManager();

        $query = $manager->createQuery('SELECT t FROM VadimGuestBundle:Post t ORDER BY t.id DESC');

        $paginator = $this->get('knp_paginator');


        $posts = $paginator->paginate(
            $query,
            $numberPage,
            10
            //$this->container->getParameter('posts_on_page')
        );

        //var_dump($paginator);
        $form->handleRequest($request);

        if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($post);
                $em->flush();
//                return $this->redirect($this->generateUrl('vadim_guest_create'));
        }

        return $this->render('VadimGuestBundle:Default:index.html.twig', array(
            'posts' => $posts,
            'form' => $form->createView(),
        ));
    }

    public function createAction()
    {
        return $this->render('VadimGuestBundle:Default:layout.html.twig');
    }

    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $post = $em->getRepository('VadimGuestBundle:Post')->find($id);
        $em->remove($post);
        $em->flush();

        return $this->redirect($this->generateUrl('vadim_guest_index'));


    }

    public function seeAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $post = $em->getRepository('VadimGuestBundle:Post')->find($id);


        return $this->render('VadimGuestBundle:Default:see.html.twig', array(
            'post' => $post ));
    }
}
