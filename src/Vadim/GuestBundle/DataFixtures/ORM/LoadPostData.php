<?php

namespace Vadim\GuestBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Vadim\GuestBundle\Entity\Post;


/**
 * Class LoadPostData
 * @package Vadim\GuestBundle\DataFixtures\ORM
 */
class LoadPostData extends AbstractFixture implements OrderedFixtureInterface{

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {

        //Here can be any data provider
        $postsData = array(
            array('name' => 'Mobile phones',),
            array('name' => 'Laptops'),
            array('name' => 'Desktop'),
            array('name' => 'Printer'),
        );


        for ($i = 0; $i < 10 ; $i++) {

            $post = new Post();

            $post->setName("name$i");
            $post->setEmail("name$i@gmail.ru");
            $post->setPost("post$i   Пост (англ. post ; эрратив псто, поцт) — отдельное сообщение на веб-форуме. Пост верхнего уровня называется корневым, или сабжем (англ. subject).
Для того, чтобы оставить («запостить», от (англ. to post)) сообщение на веб-форуме, необходимо заполнить соответствующую форму на сайте. В сообщениях на веб-форумах, кроме содержания, обычно указывается имя автора (ник), дата, и некоторые другие данные относящиеся к сообщению или автору");

            $manager->persist($post);
            }
        $manager->flush();
    }

    /**
     * @return int
     */
    public function getOrder()
    {
        return 1;
    }

}