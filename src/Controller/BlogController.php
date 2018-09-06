<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Doctrine\Common\Persistence\ObjectManager;

class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog")
     */
    public function index(ArticleRepository $repo)
    {
        $articles = $repo->findAll();

        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
            'articles' => $articles
        ]);
    }

    /**
     * @Route("/", name="home")
     */
    public function home(){
        return $this->render('blog/home.html.twig', [
            'title' => "Welcome", 
            'age' => 29]);
    }

    /**
     * @Route("/blog/{id}", name="blog_show", requirements={"id"="\d+"})
     */
    public function show(Article $article){
        return $this->render('blog/show.html.twig', [
            'article' => $article
        ]);
    }

    /**
     * @Route("/blog/new", name="new_article")
     */
    public function new(Request $request){
        $article = new Article();

        $form = $this->createFormBuilder($article)
            ->add('title', TextType::class, ['attr' => [
                'placeholder' => "Title",
                'class' => "form-control"
                ]])
            ->add('content', TextareaType::class, ['attr' => [
                'placeholder' => "Content",
                'class' => "form-control"
                ]])
            ->add('image', TextType::class, ['attr' => [
                'placeholder' => "Image",
                'class' => "form-control"
                ]])
            ->getForm();

        return $this->render('blog/new.html.twig', [
            'formArticle' => $form->createView()
        ]);
    }
}
