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
        $faker = \Faker\Factory::create();

        // Create fake categories
        for($i = 0; $i < 3; $i++){
            $category = new Category();
            $category->setTitle($faker->word)
                     ->setDescription($faker->paragraph());

            $manager->persist($category);

            // Create fake articles
            for($j = 0; $j < 5; $j++){
                $article = new Article();
                $article->setTitle($faker->sentence())
                        ->setContent('<p>' . join($faker->paragraphs(6), '</p><p>') . '</p>')
                        ->setImage($faker->imageUrl())
                        ->setCreatedAt($faker->dateTimeBetween('-9 months'))
                        ->setCategory($category);
    
                $manager->persist($article);

                // Create comments
                for($k = 0; $k < 9; $k++){
                    $comment = new Comment();

                    $now = new \DateTime();
                    $days = $now->diff($article->getCreatedAt())->days; // Difference between article's creation time and the current time

                    $comment->setAuthor($faker->name())
                            ->setContent('<p>' . implode(" ", $faker->paragraphs()) . '</p>')
                            ->setCreatedAt($faker->dateTimeBetween('-' . $days . ' days'))
                            ->setArticle($article);
                    
                    $manager->persist($comment);    
                }
            }
        }

        $manager->flush();
    }
}
