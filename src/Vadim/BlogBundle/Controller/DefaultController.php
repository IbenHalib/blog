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


class DefaultController extends Controller
{
    /**
     * @Template()
     */
    public function blogAction()
    {
//        $em = $this->getDoctrine()->getManager();
//
//
//        $articles = $em
//            ->getRepository('VadimBlogBundle:Article')
//            ->findAll();
        //$category = $articles->getArticles();
        return array('mostViewArticles'=> $this->mostViewArticles(),
                     'lastArticles' =>  $this->lastArticles(),
                     'lastPosts' => $this->lastPosts(),
                     'tagCloud' => $this->tagCloud());//,
                    // 'search' =>$this->searchArticleAction($request));

    }


    public function showArticlesAction($page)
    {
        $em = $this->getDoctrine()->getManager();

        $queryBuilder = $em
            ->getRepository('VadimBlogBundle:Article')
            ->findByLastArticlesQuery();

        $adapter = new DoctrineORMAdapter($queryBuilder);
        $pagerfanta = new Pagerfanta($adapter);
        $pagerfanta->setMaxPerPage(2);
        $pagerfanta->setCurrentPage($page);
        $nextPage = $page + 1;

        return $this->render(
            'VadimBlogBundle:Default:showArticles.html.twig',
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

        return array('about' => $about,
            'mostViewArticles'=> $this->mostViewArticles(),
            'lastArticles' =>  $this->lastArticles(),
            'lastPosts' => $this->lastPosts(),
//            'search' =>$this->searchArticleAction($request));//,
            'tagCloud' => $this->tagCloud());

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

        return array('article' => $article,
            'mostViewArticles'=> $this->mostViewArticles(),
            'lastArticles' =>  $this->lastArticles(),
            'lastPosts' => $this->lastPosts(),
            'tagCloud' => $this->tagCloud());//,
          //  'search' =>$this->searchArticleAction($request));
    }

    public function searchArticleAction(Request $request)
    {

        $search = new Search();


        $form =$this->createFormBuilder($search)
            ->add('name', 'text')
            ->add('save', 'submit')
            ->getForm();
//            (new SearchType(), $search);
        $form->handleRequest($request);

        if ($form->isValid()) {
            //var_dump($form->getData('name'));
            $this->redirect("localhost/web/app_dev.php/resultSearch/");
     }
//
        //echo('blala fjv');
        return
            $this->render(
                'VadimBlogBundle:Default:searchArticle.html.twig',
                       array( 'form' => $form->createView()));

    }
    /**
     * @Template()
     */
    public function resultSearchAction()
    {
        $title = 'title';
        $em = $this->getDoctrine()->getManager();
        $articles = $em
            ->getRepository('VadimBlogBundle:Article')
            ->findByTitleLike($title,10);
        return array('article' => $articles,
            'mostViewArticles'=> $this->mostViewArticles(),
            'lastArticles' =>  $this->lastArticles(),
            'lastPosts' => $this->lastPosts(),
            'tagCloud' => $this->tagCloud());//,
//            'search' =>$this->searchArticleAction($request));
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
    public function tagAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $tag = $em
            ->getRepository('VadimBlogBundle:Tag')
            ->find($id);
        $articles = $tag->getArticles();
        return array('articles' => $articles, 'tag' => $tag,
            'mostViewArticles'=> $this->mostViewArticles(),
            'lastArticles' =>  $this->lastArticles(),
            'lastPosts' => $this->lastPosts(),
            'tagCloud' => $this->tagCloud());//,
//            'search' =>$this->searchArticleAction($request));

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
        return array('articles' => $articles, 'category' => $category,
            'mostViewArticles'=> $this->mostViewArticles(),
            'lastArticles' =>  $this->lastArticles(),
            'lastPosts' => $this->lastPosts(),
            'tagCloud' => $this->tagCloud());//,
            //'search' =>$this->searchArticleAction($request));

    }

    public function tagCloud()
    {
        $em = $this->getDoctrine()->getManager();

        return $em
            ->getRepository('VadimBlogBundle:Tag')
            ->findAll();


    }

}
