<?php
// src/Controller/PostsController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use App\Entity\Posts;
use App\Entity\Comments;

/**
 * @Route("/posts")
 */
class PostsController extends AbstractController
{
    /**
     * @Route("/", name="post_list")
     */
    public function list()
    {
        $repository = $this->getDoctrine()->getRepository(Posts::class);
        $post = $repository->findAll();

        return $this->render('posts/list.html.twig', array(
            "posts" => $post
        ));
    }

    /**
     * @Route("/{id}/detail", name="post_detail")
     */
    public function show($id)
    {
        $repository = $this->getDoctrine()->getRepository(Posts::class);
        $post_detail = $repository->find($id);

        $stmt = $this->getDoctrine()->getManager()->getConnection()
        ->prepare("SELECT * FROM comments WHERE idPost = ".$id);
        $stmt->execute();
        $results = $stmt->fetchAll();

        return $this->render('posts/show.html.twig', array(
            "post_detail"    => $post_detail,
            "comments" => $results
        ));
    }

    /**
     * @Route("/{id}/edit", name="post_edit")
     */
    public function edit($id, Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(Posts::class);
        $post = $repository->find($id);

        $form = $this->createFormBuilder($post)
            ->add('Title', TextType::class)
            ->add('Body', TextareaType::class)
            ->add('save', SubmitType::class, array('label' => 'Save'))
            ->getForm();
        
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($post);
            $entityManager->flush();
    
            return $this->redirectToRoute('post_list');
        }

        return $this->render('posts/edit.html.twig', array(
            "id"    => $id,
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/new", name="new_post")
     */
    public function new(Request $request)
    {
        $post = new Posts();

        $form = $this->createFormBuilder($post)
            ->add('Title', TextType::class)
            ->add('Body', TextareaType::class)
            ->add('Author', TextType::class)
            ->add('Picture', TextType::class)
            ->add('Media', TextType::class)
            ->add('save', SubmitType::class, array('label' => 'Save'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($post);
            $entityManager->flush();
    
            return $this->redirectToRoute('post_list');
        }

        return $this->render('posts/new.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/{id}/delete", name="post_delete") 
     */
    public function delete($id){
        $repository = $this->getDoctrine()->getRepository(Posts::class);
        $post = $repository->find($id);

        $entityManager = $this->getDoctrine()->getEntityManager();
        $entityManager->remove($post);
        $entityManager->flush();

        return $this->redirectToRoute('post_list');
    }
}