<?php

namespace Vadim\BlogBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Collections\ArrayCollection;
use Vadim\BlogBundle\Entity\Tag;



class LoadTagData extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $tagsData = array('css' ,'symfony',
            'php','html');


        foreach ($tagsData as  $value) {
            $tag = new Tag();

            $tag->setName($value);

            $manager->persist($tag);
            $this->addReference($value, $tag);
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
        return 4;
    }

}
