<?php

namespace App\Controller;
use App\Entity\Utilisateur;
use App\Entity\Article;
use App\Entity\Commentaire;
use App\Form\ArticleType;
use App\Form\CommentaireType;
use App\Repository\ArticleRepository;
use App\Repository\CommentaireRepository;
use App\Repository\CategorieRepository;
use DateTime;
use Doctrine\ORM\Mapping\Id;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @Route("/article")
 */
class ArticleController extends AbstractController
{
    /**
     * @Route("/", name="app_article_index", methods={"GET"})
     */
    public function index(ArticleRepository $articleRepository,CategorieRepository $categorieRepository): Response
    {   
        
        return $this->render('article/index.html.twig', [
            'articles' => $articleRepository->findAll(),
            'categories' => $categorieRepository->findAll(),
            
            
        ]);
    }

    /**
     * @Route("/new", name="app_article_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ArticleRepository $articleRepository,CategorieRepository $categorieRepository,UserInterface $utilisateur): Response
    {
        $article = new Article();
        
        $form = $this->createForm(ArticleType::class, $article);
        $article->setUtilisateur($utilisateur);
        $form->handleRequest($request);
        

        if ($form->isSubmitted() && $form->isValid()) {
            
            $articleRepository->add($article);
            return $this->redirectToRoute('app_article_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('article/new.html.twig', [
            'article' => $article,
            'form' => $form->createView(),
            'categories' => $categorieRepository->findAll(),
            
        ]);
    }

    /**
     * @Route("/{id}", name="app_article_show", methods={"GET", "POST"})
     * 
     */
    public function show(Article $article,Request $request, CommentaireRepository $commentaireRepository,CategorieRepository $categorieRepository,UserInterface $utilisateur): Response
    {
         
            $commentaire = new Commentaire();
        
            $form = $this->createForm(CommentaireType::class,$commentaire);
            
            $commentaire->setIdUser($utilisateur->getId());
            $commentaire->setArticle($article);
            $commentaire->setDateCreation(new DateTime());
           
            $form->handleRequest($request); 
         
        
        

        if ($form->isSubmitted() && $form->isValid()) {
           
            $commentaireRepository->add($commentaire);
            return $this->redirectToRoute('app_article_index', [], Response::HTTP_SEE_OTHER);


           
        }

        return $this->render('article/show.html.twig', [
            'article' => $article,
            'commentaire' => $commentaire,
            'form' => $form->createView(),
            'categories' => $categorieRepository->findAll(),
            
            
        ]);
    } 
    
    public function showano(Article $article,Request $request, CommentaireRepository $commentaireRepository,CategorieRepository $categorieRepository): Response
    {
         

        return $this->render('article/show.html.twig', [
            'article' => $article,
            'categories' => $categorieRepository->findAll(),
            
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_article_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Article $article, ArticleRepository $articleRepository,CategorieRepository $categorieRepository): Response
    {
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $articleRepository->add($article);
            return $this->redirectToRoute('app_article_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('article/edit.html.twig', [
            'article' => $article,
            'form' => $form->createView(),
            'categories' => $categorieRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_article_delete", methods={"POST"})
     */
    public function delete(Request $request, Article $article, ArticleRepository $articleRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$article->getId(), $request->request->get('_token'))) {
            $articleRepository->remove($article);
        }

        return $this->redirectToRoute('app_article_index', [], Response::HTTP_SEE_OTHER);
    }
    public function admin()
    {
        $articles = $this->getDoctrine()->getRepository(Article::class)->findBy(
            [],
            ['lastUpdateDate' => 'DESC']
        );

        $users = $this->getDoctrine()->getRepository(Utilisateur::class)->findAll();

        return $this->render('admin/index.html.twig', [
            'articles' => $articles,
            'users' => $users
        ]);
    }
}
