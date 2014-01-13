<?php

namespace Vadim\BlogBundle\Entity;

use Doctrine\ORM\EntityRepository;

class ArticleRepository extends EntityRepository
{
    public function findByLastArticles($limit)
    {
        return $this->getEntityManager()
            ->createQuery('SELECT a FROM VadimBlogBundle:Article a ORDER BY a.created DESC')
            ->setMaxResults($limit)
            ->getResult();
    }

    public function findByMostViewArticles($limit)
    {
        return $this->getEntityManager()
            ->createQuery('SELECT a FROM VadimBlogBundle:Article a ORDER BY a.numberOfViews DESC')
            ->setMaxResults($limit)
            ->getResult();
    }

    public function findByTitleLike($title, $limit)
    {

        return $this->getEntityManager()
            ->createQuery("SELECT a FROM VadimBlogBundle:Article a WHERE a.title LIKE :title ORDER BY a.id DESC")
            ->setParameter('title', '%'.$title.'%')
            ->setMaxResults($limit)
            ->getResult();
    }
    public function findByTag($tag, $limit)
    {
        return $this->getEntityManager()
            ->createQuery("SELECT a FROM VadimBlogBundle:Article a WHERE a.title LIKE :title ORDER BY a.id DESC")
            ->setParameter('title', '%'.$tag.'%')
            ->setMaxResults($limit)
            ->getResult();
    }
}
