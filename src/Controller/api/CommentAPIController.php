<?php
namespace App\Controller\api;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\Comments;
/**
 * @Route("/api/posts")
 */
class CommentAPIController extends AbstractController{

    /**
     * @Route("/{id}/comment/getAllComments", name="get_all_comments_post")
     */
    public function getAllCommentsOfPost($id){
        $repository = $this->getDoctrine()->getRepository(Comments::class);
        $allComments = $repository->findBy(
            ["idpost"   =>  (int) $id],
            ["id"   =>  "ASC"]
        );

        $data = [];
        foreach($allComments as $allComment){
            $table = [
                "id"    =>  $allComment->getId(),
                "username"  =>  $allComment->getUsername(),
                "userPicture"   =>  $allComment->getUserpicture(),
                "comment"  =>  $allComment->getComment(),
                "idPost"    =>  $id /*$allComment->getIdpost()*/
            ];
        }

        array_push($data, $table);
        return new JsonResponse($data);
    }

    /**
     * @Route("/{id}/comment/addComment", name="add_comment")
     */
    public function addComment($id, Request $request){
        $addComment = new Comments();

        $addComment->setUsername($request->get("userName"));
        $addComment->setUserpicture($request->get("userPicture"));
        $addComment->setComment($request->get("comment"));
        $addComment->setIdpost($request->get("idPost"));

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($addComment);
        $entityManager->flush();


        $repository = $this->getDoctrine()->getRepository(Comments::class);
        $allComments = $repository->findBy(
            ["idpost"   =>  (int) $id],
            ["id"   =>  "ASC"]
        );

        $data = [];
        foreach($allComments as $allComment){
            $table = [
                "id"    =>  $allComment->getId(),
                "username"  =>  $allComment->getUsername(),
                "userPicture"   =>  $allComment->getUserpicture(),
                "comment"  =>  $allComment->getComment(),
                "date"   =>  $allComment->getDate(),
                "idPost"    =>  $id
            ];
        }

        array_push($data, $table);
        return new JsonResponse($data);
    }
}