<?php
// src/Controller/PostsController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
        return $this->render('posts/show.html.twig', array(
            "id"    => $id
        ));
    }

    /**
     * @Route("/{id}/detail/edit", name="post_detail_edit")
     */
    public function edit($id)
    {
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