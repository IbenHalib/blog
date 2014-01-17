<?php

namespace Vadim\BlogBundle\Entity;

use Doctrine\ORM\EntityRepository;

class ArticleRepository extends EntityRepository
{
    public function findByLastArticles($limit)
    {
        return $this->getEntityManager()
            ->createQuery('SELECT a FROM VadimBlogBundle:Article a ORDER BY a.id DESC')
            ->setMaxResults($limit)
            ->getResult();
    }

    public function findByLastArticlesQuery()
    {
        return $this->getEntityManager()
            ->createQuery('SELECT a FROM VadimBlogBundle:Article a ORDER BY a.id DESC');
    }

    public function findByMostViewArticles($limit)
    {
        return $this->getEntityManager()
            ->createQuery('SELECT a FROM VadimBlogBundle:Article a ORDER BY a.numberOfViews DESC')
            ->setMaxResults($limit)
            ->getResult();
    }

    public function findByTitleLike($title)
    {

        return $this->getEntityManager()
            ->createQuery("SELECT a FROM VadimBlogBundle:Article a WHERE a.title LIKE :title ORDER BY a.id DESC")
            ->setParameter('title', '%'.$title.'%')
            ->getResult();
    }

}
