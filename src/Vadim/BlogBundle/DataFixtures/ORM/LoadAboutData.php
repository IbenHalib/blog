<?php

namespace Vadim\BlogBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Vadim\BlogBundle\Entity\About;


class LoadAboutData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * @param ObjectManager $manager
     */

    public function load(ObjectManager $manager)
    {
            $about = new About();

            $about->setTitle("About me");
            $about->setBody("Bla Bla Bla");
            $manager->persist($about);

        $manager->flush();
    }

    /**
     * @return int
     */
    public function getOrder()
    {
        return 2;
    }
}