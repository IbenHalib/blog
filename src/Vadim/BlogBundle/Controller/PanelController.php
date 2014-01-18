<?php

namespace Vadim\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Vadim\BlogBundle\Entity\Article;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;
use Vadim\BlogBundle\Form\Type\SearchType;
use Vadim\BlogBundle\Entity\Search;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\HttpFoundation\RedirectResponse;


class PanelController extends Controller
{
    /**
     * @Template()
     */
    public function mostViewArticlesAction()
    {
        $em = $this->getDoctrine()->getManager();

        $mostViewArticles = $em
            ->getRepository('VadimBlogBundle:Article')
            ->findByMostViewArticles($this->container->getParameter('panel_link'));
        return array('mostViewArticles' => $mostViewArticles);

    }

    /**
     * @Template()
     */
    public function lastArticlesAction()
    {
        $em = $this->getDoctrine()->getManager();

        $lastArticles = $em
            ->getRepository('VadimBlogBundle:Article')
            ->findByLastArticles($this->container->getParameter('panel_link'));
        return array('lastArticles' => $lastArticles);
    }

    /**
     * @Template()
     */
    public function lastPostsAction()
    {
        $em = $this->getDoctrine()->getManager();

        $lastPosts =  $em
            ->getRepository('VadimGuestBundle:Post')
            ->findByLastPosts($this->container->getParameter('panel_link'));
        return array('lastPosts' => $lastPosts);
    }

    /**
     * @Template()
     */
    public function tagCloudAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tagsInCloud = $em
            ->getRepository('VadimBlogBundle:Tag')
            ->findAll();
        return array('tagsInCloud' => $tagsInCloud);

    }
}