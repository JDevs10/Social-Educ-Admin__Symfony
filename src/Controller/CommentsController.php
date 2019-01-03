<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use App\Entity\Comments;

/**
 * @Route("/comments")
 */
class CommentsController extends AbstractController
{
    // /**
    //  * @Route("/{id}/detail", name="comment_list")
    //  */
    // public function comment_list()
    // {
    //     $repository = $this->getDoctrine()->getRepository(Comments::class);
    //     $comment = $repository->find($id);

    //     return $this->render('posts/list.html.twig', array(
    //         "comments" => $comment
    //     ));
    // }
}