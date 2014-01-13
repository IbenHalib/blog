<?php

 namespace Vadim\BlogBundle\DataFixtures\ORM;

 use Doctrine\Common\DataFixtures\AbstractFixture;
 use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
 use Doctrine\Common\Persistence\ObjectManager;
 use Doctrine\Common\Collections\ArrayCollection;
 use Vadim\BlogBundle\Entity\Category;

 /**
  * Class LoadCategoryData.php
  * @package Vadim\BlogBundle\DataFixtures\ORM
  */
 class LoadCategoryData extends AbstractFixture implements OrderedFixtureInterface
 {
     /**
      * {@inheritDoc}
      */
     public function load(ObjectManager $manager)
     {
     $categoriesData = array('symfony categories' ,'programing categories',
     'php categories','html categories');



         foreach ($categoriesData as $value) {
             $categories = new Category();

             $categories->setName($value) ;

             $manager->persist($categories);
             $this->addReference($value, $categories);
         }

         $manager->flush();
     }

     /**
      * {@inheritDoc}
      */
     public function getOrder()
     {
         return 3;
     }


 }
