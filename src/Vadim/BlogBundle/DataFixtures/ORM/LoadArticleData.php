<?php

namespace Vadim\BlogBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Collections\ArrayCollection;
use Vadim\BlogBundle\Entity\Article;


class LoadArticleData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {

        for($i=0;$i < 21; $i++) {
            $article = new Article();

            $article->setCategory($this->getReference('symfony categories'));
            $article->setTitle("title$i");
           // $article->setImg($value['img']);
            $article->setBody("body$i dnddv");
            $article->setTags($this->getReferencesFromArray(array('html')));
            $article->setNumberOfViews($i);

            $manager->persist($article);
            $this->addReference("titlre$i", $article);
        }

        $manager->flush();
    }

    protected function getReferencesFromArray(array $array)
        {
            $outputReferences = new ArrayCollection();

            foreach ($array as $reference) {
                $outputReferences->add($this->getReference($reference));
            }

            return $outputReferences;
        }


    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 5;
    }


}
