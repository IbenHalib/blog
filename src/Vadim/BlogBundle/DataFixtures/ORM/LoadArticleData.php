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


            $article->setCategory($this->getReference('categories2'));

            switch ( rand(0, 2)) {
                            case 0:
                                 $article->setCategory($this->getReference('categories1'));
                                break;
                            case 1:
                                 $article->setCategory($this->getReference('categories2'));
                                break;
                            case 2:
                                 $article->setCategory($this->getReference('categories3'));
                                break;

                        }
            $article->setTitle("title$i");
           // $article->setImg($value['img']);
            $article->setBody('A blog (a truncation of the expression web log) is a discussion or
                                           informational site published on the World Wide Web and consisting of discrete entries
                                           ("posts") typically displayed in reverse chronological order (the most recent post appears first).
                                           Until 2009 blogs were usually the work of a single individual, occasionally of a small group, and
                                           often covered a single subject. More recently multi-author blogs (MABs) have developed, with
                                           posts written by large numbers of authors and professionally edited. MABs from newspapers,
                                           other media outlets, universities, think tanks, advocacy groups and similar institutions
                                           account for an increasing quantity of blog traffic. The rise of Twitter and other "microblogging"
                                           systems helps integrate MABs and single-author blogs into societal newstreams. Blog can also be used
                                           as a verb, meaning to maintain or add content to a blog.
                                           The emergence and growth of blogs in the late 1990s coincided with the advent of web publishing tools that
                                           facilitated the posting of content by non-technical users. (Previously, a knowledge of such technologies as
                                            HTML and FTP had been required to publish content on the Web.)
                                            A majority are interactive, allowing visitors to leave comments and even message each other via
                                            GUI widgets on the blogs, and it is this interactivity that distinguishes them from other static
                                            websites.[2] In that sense, blogging can be seen as a form of social networking service. Indeed,
                                            bloggers do not only produce content to post on their blogs, but also build social relations with
                                            their readers and other bloggers.[3] There are high-readership blogs which do not allow comments,
                                            such as Daring Fireball.

                                          Many blogs provide commentary on a particular subject; others function as more personal
                                           online diaries; others function more as online brand advertising of a particular
                                           individual or company. A typical blog combines text, images, and links to other blogs,
                                           Web pages, and other media related to its topic. The ability of readers to leave comments
                                            in an interactive format is an important contribution to the popularity of many blogs. Mos
                                            t blogs are primarily textual, although some focus on art (art blogs), photographs (photoblogs),
                                             videos (video blogs or "vlogs"), music (MP3 blogs), and audio (podcasts). Microblogging is another
                                              type of blogging, featuring very short posts. In education, blogs can be used as instructional
                                              resources. These blogs are referred to as edublogs.

                              On 16 February 2011, there were over 156 million public blogs in
                               existence. On 13 October 2012, there were around 77 million Tumblr
                                and 56.6 million WordPress[6] blogs in existence worldwide. According
                                to critics and other bloggers, Blogger is the most popular blogging service used today.');

            switch ( rand(0, 4)) {
                case 0:
                    $article->getTags()->add($this->getReference('Tag1'));

                    $this->getReference('Tag1')->getArticles()->add($article);
                    break;
                case 1:
                    $article->getTags()->add($this->getReference('Tag2'));

                    $this->getReference('Tag2')->getArticles()->add($article);
                    break;
                case 2:
                    $article->getTags()->add($this->getReference('Tag3'));

                    $this->getReference('Tag3')->getArticles()->add($article);
                    break;
                 case 3:
                      $article->getTags()->add($this->getReference('Tag4'));
                      $this->getReference('Tag4')->getArticles()->add($article);
                      break;
                case 4:
                    $article->getTags()->add($this->getReference('Tag3'),$this->getReference('Tag2'));

                    $this->getReference('Tag2')->getArticles()->add($article);
                    $this->getReference('Tag3')->getArticles()->add($article);
                    break;
            }
//            $article->getTags()->add($this->getReference('Tag1'));
//
//            $this->getReference('Tag1')->getArticles()->add($article);
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
