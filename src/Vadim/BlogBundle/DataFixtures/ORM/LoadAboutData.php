<?php

namespace Vadim\BlogBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Vadim\BlogBundle\Entity\About;
use Vadim\BlogBundle\Entity\Article;
use Vadim\BlogBundle\Entity\Tag;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\QueryBuilder;

class LoadAboutData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * @param ObjectManager $manager
     */

    public function load(ObjectManager $manager)
    {
            $about = new About();

            $about->setTitle("About me");
            $about->setBody('A blog (a truncation of the expression web log) is a discussion or
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