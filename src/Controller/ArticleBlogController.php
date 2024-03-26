<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ArticleBlogController extends AbstractController
{
    #[Route('/blog', name: 'app_blog')]
    public function index(ArticleRepository $ArticleRepository): Response
    {
        return $this->render('article_blog/blog.html.twig', [
            'controller_name' => 'ArticleController',
            'articles' => $ArticleRepository->findBy([], ['createAt' => 'DESC'])
        ]);
    }

    #[Route('/article/{id}', name: 'app_article', requirements: ['id' => '\d+'])]
    public function article(int $id, ArticleRepository $ArticleRepository): Response
    {
        return $this->render('article_blog/article.html.twig', [
            'article' => $ArticleRepository->find($id)
        ]);
    }
}
