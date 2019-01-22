<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Response;
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
    /**
     * @Route("/post/{id}/addComment", name="add_comment")
     */
    public function index($id, Request $request)
    {
        $comment = new Comments();

        $form = $this->createFormBuilder($comment)
            // ->add("idPost", setData($id))
            ->add("username", TextType::class)
            ->add("userpicture", TextType::class)
            ->add('Comment', TextareaType::class)
            ->add('Save', SubmitType::class, array('label' => 'Save'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($comment);
            $entityManager->flush();
    
            return $this->redirectToRoute('post_list');
        }

        return $this->render('comments/add.html.twig', array(
            'form' => $form->createView(),
            'id' => $id
        ));
    }

    /**
     * @Route("/{id}/edit", name="edit_comment")
     */
    public function modifyComment($id, Request $request){

        $repository = $this->getDoctrine()->getRepository(Comments::class);
        $comment = $repository->find($id);

        $form = $this->createFormBuilder($comment)
            ->add('Comment', TextareaType::class)
            ->add('Save', SubmitType::class, array('label' => 'Save'))
            ->getForm();
        
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($comment);
            $entityManager->flush();
    
            return $this->redirectToRoute('post_list');
        }

        return $this->render('comments/edit.html.twig', array(
            "id"    => $id,
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/{id}/delete", name="delete_comment") 
     */
    public function delete($id){
        $repository = $this->getDoctrine()->getRepository(Comments::class);
        $comment = $repository->find($id);

        $entityManager = $this->getDoctrine()->getEntityManager();
        $entityManager->remove($comment);
        $entityManager->flush();

        return $this->redirectToRoute('post_list');
    }
}
