<?php

namespace App\DataFixtures;
use App\Entity\Article;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\User\User;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $faker = Factory::create('fr_FR');

        

        for($i=0;$i<10;$i++){

         $article = new Article();

        $article->setTitre($faker->sentence($nbWords = 2, $variableNbWords = true))
        ->setContenu($faker->sentence($nbWords = 10, $variableNbWords = true))
        ->setDateCreation($faker->dateTimeBetween(' -6 months '))
        ->setDateModif(null);


        $manager->persist($article);

        }
        $manager->flush(); 


    }
}
