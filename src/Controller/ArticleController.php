<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ArticleRepository;
use App\Entity\Article;

/**
 * @Route("/article")
 */
class ArticleController extends AbstractController
{
    /**
     * @Route("/", name="article_index")
     */
    public function index()
    {
        return $this->render('article/index.html.twig');
    }

    /**
     * @Route("/{slug}", name="article_show")
     */
    public function show(Article $article) {

        return $this->render('article/article_show.html.twig', ['article' => $article]);
    }

    public function recentArticles($max = 3, ArticleRepository $articleRepository)
    {
        // make a database call or other logic
        // to get the "$max" most recent articles

        return $this->render(
            'article/recent_list.html.twig',
            array('articles' => $articleRepository->findAll())
        );
    }

    public function featuredArticles($max = 3, ArticleRepository $articleRepository)
    {
        // make a database call or other logic
        // to get the "$max" most recent articles

        return $this->render(
            'article/_featured_article.html.twig',
            array('articles' => $articleRepository->findAll())
        );
    }
}
