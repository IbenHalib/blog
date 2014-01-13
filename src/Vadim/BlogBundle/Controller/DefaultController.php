<?php

namespace Vadim\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Vadim\BlogBundle\Entity\Article;

class DefaultController extends Controller
{
    /**
     * @Template()
     */
    public function blogAction()
    {
        $em = $this->getDoctrine()->getManager();

        $articles = $em
            ->getRepository('VadimBlogBundle:Article')
            ->findAll();
        //$category = $articles->getArticles();
        return array('articles' => $articles);

    }

    /**
     * @Template()
     */
    public function aboutAction()
    {
        $about = $this->getDoctrine()
            ->getRepository('VadimBlogBundle:About')
            ->findAll();
        return array('about' => $about);

    }

    /**
     * @Template()
     */
    public function seeAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $article = $em
            ->getRepository('VadimBlogBundle:Article')
            ->find($id);


        $article->setNumberOfViews($article->getNumberOfViews() + 1);
        $em->flush();

        return array('article' => $article);


    }
    /**
     * @Template()
     */
    public function searchArticleAction($title)
    {
        $em = $this->getDoctrine()->getManager();
        $articles = $em
            ->getRepository('VadimBlogBundle:Article')
            ->findByTitleLike($title,10);
        return array('articles' => $articles);

    }

    /**
     * @Template()
     */
    public function lastArticlesAction()
    {
        $articles = $this->getDoctrine()
            ->getRepository('VadimBlogBundle:Article')
            ->findByLastArticles(10);
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
            ->findByMostViewArticles(20);
        return array('articles' => $articles);
    }

    /**
     * @Template()
     */
    public function tagAction($id)
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
    public function categoryAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $category = $em
            ->getRepository('VadimBlogBundle:Category')
            ->find($id);
        $articles = $category->getArticles();
        return array('articles' => $articles, 'category' => $category);

    }


}
