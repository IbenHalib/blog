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


class PageContentController extends Controller
{
    /**
     * @Template()
     */
    public function blogAction()
    {

        return array();

    }


    public function showArticlesAction($page)
    {
        $em = $this->getDoctrine()->getManager();

        $queryBuilder = $em
            ->getRepository('VadimBlogBundle:Article')
            ->findByLastArticlesQuery();

        $adapter = new DoctrineORMAdapter($queryBuilder);
        $pagerfanta = new Pagerfanta($adapter);
        $pagerfanta->setMaxPerPage($this->container->getParameter('article_in_page'));
        $pagerfanta->setCurrentPage($page);
        $nextPage = $page + 1;

        return $this->render(
            'VadimBlogBundle:PageContent:showArticles.html.twig',
            array(
                'articles' => $pagerfanta->getCurrentPageResults(),
                'nextPage'=> $nextPage
            ));
    }


    /**
     * @Template()
     */
    public function aboutAction(Request $request)
    {
        $about = $this->getDoctrine()
            ->getRepository('VadimBlogBundle:About')
            ->findAll();

        return array('about' => $about);

    }

    /**
     * @Template()
     */
    public function seeAction($id,Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $article = $em
            ->getRepository('VadimBlogBundle:Article')
            ->find($id);


        $article->setNumberOfViews($article->getNumberOfViews() + 1);
        $em->flush();

        return array('article' => $article);

    }

    public function searchArticleAction(Request $request)
    {
        $search = new Search();
        $form =$this->createForm(new SearchType(),$search);
        $form->handleRequest($request);

         return
            $this->render(
                'VadimBlogBundle:PageContent:searchArticle.html.twig',
                       array( 'form' => $form->createView()));

    }
    /**
     * @Template()
     */
    public function resultSearchAction( Request $request)
    {
        $search = new Search();
        $form =$this->createForm(new SearchType(),$search);
        $form->handleRequest($request);

        if ($form->isValid()) {

        $title = $search->getName();
           // $title = $formData->Name;
        $em = $this->getDoctrine()->getManager();
        $articles = $em
            ->getRepository('VadimBlogBundle:Article')
            ->findByTitleLike($title);
            }
        else{
            $articles = '';
        }

        return array('articles' => $articles);
    }

    /**
     * @Template()
     */
    public function lastArticlesAction()
    {
        $em = $this->getDoctrine()->getManager();

        $articles = $em
            ->getRepository('VadimBlogBundle:Article')
            ->findByLastArticles($this->container->getParameter('panel_link'));
        return array('articles' => $articles);
    }

    /**
     * @Template()
     */
    public function mostViewAction()
    {
        $em = $this->getDoctrine()->getManager();

        $articles = $em
            ->getRepository('VadimBlogBundle:Article')
            ->findByMostViewArticles($this->container->getParameter('panel_link'));
        return array('articles' => $articles);
    }

    /**
     * @Template()
     */
    public function tagAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $tag = $em
            ->getRepository('VadimBlogBundle:Tag')
            ->find($id);
        $articles = $tag->getArticles();
        return array('articles' => $articles, 'tag' => $tag);
    }

    /**
     * @Template()
     */
    public function categoryAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $category = $em
            ->getRepository('VadimBlogBundle:Category')
            ->find($id);
        $articles = $category->getArticles();
        return array('articles' => $articles, 'category' => $category);

    }


}
