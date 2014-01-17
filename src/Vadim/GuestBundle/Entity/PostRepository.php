<?php

namespace Vadim\GuestBundle\Entity;

use Doctrine\ORM\EntityRepository;

class PostRepository extends EntityRepository
{
    public function findByLastPosts($limit)
    {
        return $this->getEntityManager()
            ->createQuery('SELECT a FROM VadimGuestBundle:Post a ORDER BY a.id DESC')
            ->setMaxResults($limit)
            ->getResult();
    }

    public function findByLastPostsQuery()
    {
        return $this->getEntityManager()
            ->createQuery('SELECT a FROM VadimGuestBundle:Post a ORDER BY a.id DESC');

    }
}