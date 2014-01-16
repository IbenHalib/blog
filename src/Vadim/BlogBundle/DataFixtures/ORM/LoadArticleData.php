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

            $article->getTags()->add($this->getReference('html'));

            $this->getReference('html')->getArticles()->add($article);
            $article->setNumberOfViews($i);

            $manager->persist($article);
            $this->addReference("titlre$i", $article);
        }

        $manager->flush();

        $manager->clear();


        $ar = $manager->getRepository('VadimBlogBundle:Article');
        $articles = $ar->findAll();

        $tr = $manager->getRepository('VadimBlogBundle:Tag');
        $tags = $tr->findAll();
                foreach ($tags as $tag) {
            $arr[$tag->getName()] = 0;
        }

        foreach ($articles as $article) {


            foreach ($article->getTags() as $tag) {
                $arr[$tag->getName()]++;
            }
        }

$maxTimesUsed = 0;
        foreach ($tags as $tag) {
        if ($arr[$tag->getName()] > $maxTimesUsed)
        {
        $maxTimesUsed = $arr[$tag->getName()];
        }
            $tag->setTimesUsed($arr[$tag->getName()] );
        }
        $manager->flush();


        $tr = $manager->getRepository('VadimBlogBundle:Tag');

                $tags = $tr->findByTimesUsed();
                $maxFontSize = 40;
                $sizeOne = $maxFontSize/$maxTimesUsed;
                foreach ($tags as $tag) {
                    $tag->setFontSize( $sizeOne * $tag->getTimesUsed());

                }

 $manager->flush();

    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 5;
    }

    protected function updateTag(ObjectManager $manager)
        {


            $manager->clear();

            $articles = $manager
                ->getRepository('VadimBlogBundle:Article')
                ->findAll();
            $array = array();
            foreach ($articles->getTags as $tag) {
                $array["$tag->getName" ]++;

            }


            foreach ($array as $key =>$usetTag) {
                $tag = $manager
                    ->getRepository('VadimBlogBundle:Tag')
                    ->findOneByName($key);
                $tag->setTimesUsed($usetTag);
                $manager->flush();
            }


        }



}
