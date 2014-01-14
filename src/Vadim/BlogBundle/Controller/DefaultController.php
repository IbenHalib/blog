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

class DefaultController extends Controller
{
    /**
     * @Template()
     */
    public function blogAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();


        $articles = $em
            ->getRepository('VadimBlogBundle:Article')
            ->findAll();
        //$category = $articles->getArticles();
        return array('articles' => $articles,
                     'mostViewArticles'=> $this->mostViewArticles(),
                     'lastArticles' =>  $this->lastArticles(),
                     'lastPosts' => $this->lastPosts());
                    // 'formSearch' => $this->search($request));

    }

    public function search(Request $request)
    {
        $search = new Search();

        $form =$this->createForm(new SearchType(), $search);

        $form->handleRequest($request);

        if ($form->isValid()) {
           return $this->redirect($this->generateUrl('_searchArticle',array('title' => $search)));
        }

        return  $form->createView();
    }
    /**
     * @Template()
     */
    public function aboutAction()
    {
        $about = $this->getDoctrine()
            ->getRepository('VadimBlogBundle:About')
            ->findAll();
        return array('about' => $about,
            'mostViewArticles'=> $this->mostViewArticles(),
            'lastArticles' =>  $this->lastArticles(),
            'lastPosts' => $this->lastPosts());

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

        return array('article' => $article,
            'mostViewArticles'=> $this->mostViewArticles(),
            'lastArticles' =>  $this->lastArticles(),
            'lastPosts' => $this->lastPosts());


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
        return array('articles' => $articles,
            'mostViewArticles'=> $this->mostViewArticles(),
            'lastArticles' =>  $this->lastArticles(),
            'lastPosts' => $this->lastPosts());

    }

    /**
     * @Template()
     */
    public function lastArticlesAction()
    {
        $em = $this->getDoctrine()->getManager();

        $articles = $em
            ->getRepository('VadimBlogBundle:Article')
            ->findByLastArticles(10);
        return array('articles' => $articles);
    }

    public function lastArticles()
    {   $em = $this->getDoctrine()->getManager();

        return $em
            ->getRepository('VadimBlogBundle:Article')
            ->findByLastArticles(10);
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

    public function mostViewArticles()
    {
        $em = $this->getDoctrine()->getManager();

        return  $em
            ->getRepository('VadimBlogBundle:Article')
            ->findByMostViewArticles(20);

    }

    public function lastPosts()
    {
        $em = $this->getDoctrine()->getManager();

        return  $em
            ->getRepository('VadimGuestBundle:Post')
            ->findByLastPosts(20);
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
        return array('articles' => $articles, 'tag' => $tag,
            'mostViewArticles'=> $this->mostViewArticles(),
            'lastArticles' =>  $this->lastArticles(),
            'lastPosts' => $this->lastPosts());

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
        return array('articles' => $articles, 'category' => $category,
            'mostViewArticles'=> $this->mostViewArticles(),
            'lastArticles' =>  $this->lastArticles(),
            'lastPosts' => $this->lastPosts());

    }


}
