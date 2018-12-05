<?php
// src/Controller/PostsController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;

use App\Entity\Posts;

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

        return $this->render('posts/show.html.twig', array(
            "post_detail"    => $post_detail
        ));
    }

    /**
     * @Route("/{id}/edit", name="post_edit")
     */
    public function edit($id, Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(Posts::class);
        $post_edit = $repository->find($id);

        $post = new Posts();
        $post->setTask('Write a blog post');
        $post->setDueDate(new \DateTime('tomorrow'));

        $form = $this->createFormBuilder($post)
            ->add('task', TextType::class)
            ->add('dueDate', DateType::class)
            ->add('save', SubmitType::class, array('label' => 'Create Task'))
            ->getForm();

        return $this->render('posts/edit.html.twig', array(
            "id"    => $id
        ));
    }

    /**
     * @Route("/new", name="new_post")
     */
    public function new()
    {
        return $this->render('posts/new.html.twig');
    }
}