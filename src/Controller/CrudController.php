<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CrudController extends AbstractController
{
    /**
     * @Route("/create", name="create")
     */
    public function newArticle(Request $request, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN',null,'User not qualified enough. ADMIN required.');

        // creates an article object and initializes some data for this example
        $article = new Article();
        $article->setTitre('La covid-19 disparaît');
        //$article->setPublished(new \DateTime());
        $article->setContent('Alexy sauve la planète en éradiquant le virus par la force de son poing.');

        $form = $this->createFormBuilder($article)
            ->add('titre', TextType::class, ['label' => 'Titre : '])
            // inutile de choisir la date si on met l'attribut timestampable
            //->add('published', DateType::class, ['label' => 'Date de sortie : '])
            ->add('content', TextareaType::class, ['label' => 'Contenu : '])
            ->add('save', SubmitType::class, ['label' => 'Créer'])
            ->getForm();

        

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $article = $form->getData();


            $entityManager->persist($article);
            $entityManager->flush();

            return $this->redirectToRoute('homepage');
        }

        return $this->render('formPost.html.twig', [
            'form' => $form->createView(),
            'nom_page' => 'New article'
        ]);
    }



    /**
     * @Route("/edit/{alias}", name="edit")
     */
    public function editArticle(Request $request, EntityManagerInterface $entityManager, ArticleRepository $articleRepo, String $alias): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN',null,'User not qualified enough. ADMIN required.');

        // update an article object and initializes some data for this example
        $article = $articleRepo->findOneByAlias($alias);
        $article->setTitre('Nouveau titre');
        $article->setContent('Ceci est le nouveau contenu. Vous pouvez me modifier.');

        $form = $this->createFormBuilder($article)
            ->add('titre', TextType::class, ['label' => 'Nouveau titre : '])
            ->add('content', TextareaType::class, ['label' => 'Nouveau contenu : '])
            ->add('save', SubmitType::class, ['label' => 'Modifer'])
            ->getForm();

        

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $article = $form->getData();


            //$entityManager->persist($article); inutile
            $entityManager->flush();

            return $this->redirectToRoute('homepage');
        }

        return $this->render('formPost.html.twig', [
            'form' => $form->createView(),
            'nom_page' => 'Edit article'
        ]);
    }






    /**
     * @Route("/delete/{alias}", name="delete")
     */
    public function deleteArticle(Request $request, ArticleRepository $articleRepo, EntityManagerInterface $entityManager, String $alias): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN',null,'User not qualified enough. ADMIN required.');

        $article = $articleRepo->findOneByAlias($alias);

        $entityManager->remove($article);
        $entityManager->flush();

        return $this->redirectToRoute('homepage');

    }



    // méthode de test créée au début du projet
    // inutile maintenant
    /**
     * @Route("/creerpost", name="creer")
     */
    /*public function creerArticle(EntityManagerInterface $entityManager):Response
    {

        //$entityManager = $this->getDoctrine()->getManager();

        $article = new Article();
        $article->setTitre('MASSI EST UN BOSS');
        $article->setPublished(new \Datetime());
        $article->setContent("Massinissa est mon ami, il est très gentil. Il recherche un stage en dev web pour pouvoir rester en France, sinon il doit rentrer dans son bled. Prenez le, c'est un boss !!!");
        $article->setUrlAlias('');
        //$article->setImg("massiPhoto");

        $entityManager->persist($article);

        $entityManager->flush();

        return new Response('Saved new article with titre : '.$article->getTitre());
    } */
}
