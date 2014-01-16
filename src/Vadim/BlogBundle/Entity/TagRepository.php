<?php

namespace Vadim\BlogBundle\Entity;

use Doctrine\ORM\EntityRepository;

class TagRepository extends EntityRepository
{

    public function findByTimesUsed()
    {
        return $this->getEntityManager()
            ->createQuery('SELECT t FROM VadimBlogBundle:Tag t ORDER BY t.fontSize DESC')
            ->getResult();
    }
} 