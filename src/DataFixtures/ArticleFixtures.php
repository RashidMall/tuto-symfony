<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Article;
use App\Entity\Category;
use App\Entity\Comment;

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create();

        // Create fake categories
        for($i = 1; $i <= 3; $i++){
            $category = new Category();
            $category->setTitle($faker->sentence())
                     ->setDescription($faker->paragraph());

            $manager->persist($category);

            // Create fake articles
            for($j = 1; $j <= 10; $j++){
                $article = new Article();
                $article->setTitle($faker->sentence())
                        ->setContent('<p>' . join($faker->paragraphs(4), '</p><p>') . '</p>')
                        ->setImage("http://placehold.it/350x150")
                        ->setCreatedAt(new \DateTime());
    
                $manager->persist($article);
            }
        }

        $manager->flush();
    }
}
