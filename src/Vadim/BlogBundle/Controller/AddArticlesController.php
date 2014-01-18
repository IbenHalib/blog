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


class AddArticlesController extends Controller
{

}