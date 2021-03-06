<?php
namespace App\Controller\api;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\Response;

use App\Entity\Posts;
use App\Entity\Comments;
/**
 * @Route("/api/posts")
 */
class CommentAPIController extends AbstractController{

    //================================ DONE =============================================
    /**
     * @Route("/{id}/comment/getAllComments", name="get_all_comments_post")
     */

    //  need to test it with angular
    public function getAllCommentsOfPost($id){
        $repository = $this->getDoctrine()->getRepository(Comments::class);
        $allComments = $repository->findAll();

        $encoder = new JsonEncoder();
        $normalizer = new ObjectNormalizer();
        $normalizer->setCircularReferenceLimit(0);
        $normalizer->setCircularReferenceHandler(function ($object){
            return $object->getId();
        });

        $normalizer = array(new DateTimeNormalizer(), $normalizer);
        $serializer = new Serializer($normalizer, array($encoder));
        $jsonContent = $serializer->serialize($allComments, "json");

        return new Response($jsonContent);
    }

    //================================ DONE =============================================
    /**
     * @Route("/{id}/comment/addComment", name="add_comment")
     */
    public function addComment($id, Request $request){
        $repository_post = $this->getDoctrine()->getRepository(Posts::class);
        $post = $repository_post->findOneById($id);
        
        //set my comment entity
        $Comment = new Comments();
        $Comment->setUsername($request->get("userName"));
        $Comment->setUserpicture($request->get("userPicture"));
        $Comment->setComment($request->get("comment"));

        // pass my comment entity to the post
        // so Posts entity addComment can set the id_post_id to my comment
        $post->addComment($Comment);

        // push the comment to my db
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($Comment);
        $entityManager->flush();

        // get all the comment of this post orther by id "ASC"
        $repository = $this->getDoctrine()->getRepository(Comments::class);
        $allComments = $repository->findBy(
            ["idPost"   =>  $post],
            ["id"   =>  "ASC"]
        );

        // show all my comments of this post
        $data = [];
        foreach($allComments as $allComment){
            $table[] = [
                "id"    =>  $allComment->getId(),
                "username"  =>  $allComment->getUsername(),
                "userPicture"   =>  $allComment->getUserpicture(),
                "comment"  =>  $allComment->getComment(),
                "id_post"    =>  $post->getId()
            ];
        }

        // send the data in json format
        array_push($data, $table);
        return new JsonResponse($data);
    }

    //================================ DONE =============================================
    /**
     * @Route("/{idP}/comment/getComment/{idC}", name="get_comment")
     */
    public function getComment($idP, $idC){
        // get the actuel post
        $repository = $this->getDoctrine()->getRepository(Posts::class);
        $post = $repository->findOneById($idP);

        // get the actuel comment
        $repository = $this->getDoctrine()->getRepository(Comments::class);
        $getComment = $repository->findById($idC);

        // get the data of the comment
        foreach($getComment as $comment){
            $table[] = [
                "id"    =>  $comment->getId(),
                "username"  =>  $comment->getUsername(),
                "userPicture"   =>  $comment->getUserpicture(),
                "comment"  =>  $comment->getComment(),
                "id_post"    =>  $post->getId()
            ];
        }

        // send the data in json format
        return new JsonResponse($table);
    }

    //================================ DONE =============================================
    /**
     * @Route("/{idP}/comment/modifyComment/{idC}", name="modify_comment")
     */
    public function modifyComment($idP, $idC, Request $request){

        $modifyComment = new Comments();    

        // get the comment
        $repository = $this->getDoctrine()->getRepository(Comments::class);
        $Comment = $repository->find($idC);

        //check the user input
        if($request->get("comment") != null){
            $modifyComment->setComment($request->get("comment"));

            // change the comment data
            $Comment->setComment($modifyComment->getComment());
        }

        // push the data to the db (aka update the comment)
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($Comment);
        $entityManager->flush();

        // get the actual post
        $repository_P = $this->getDoctrine()->getRepository(Posts::class);
        $post = $repository_P->find($idP);

        // find all the comments of that post
        $repository = $this->getDoctrine()->getRepository(Comments::class);
        $getRestComments = $repository->findBy(
            ["idPost" => $post->getId()],
            ["id" => "ASC"]
        );

        // get the data of the comment
        foreach($getRestComments as $comment){
            $table[] = [
                "id"    =>  $comment->getId(),
                "username"  =>  $comment->getUsername(),
                "userPicture"   =>  $comment->getUserpicture(),
                "comment"  =>  $comment->getComment(),
                "id_post"    =>  $post->getId()
            ];
        }

        // send the data in json format
        return new JsonResponse($table);
    }

    //================================ DONE =============================================
    /**
     * @Route("/{idP}/comment/delete/{idC}", name="delete_comment")
     */
    public function deleteComment($idP, $idC){
        $repository = $this->getDoctrine()->getRepository(Comments::class);
        $deleteComment = $repository->find($idC);

        $repository = $this->getDoctrine()->getRepository(Posts::class);
        $post = $repository->find($idP);

        $entityManager = $this->getDoctrine()->getEntityManager();
        $entityManager->remove($deleteComment);
        $entityManager->flush();

        $repository = $this->getDoctrine()->getRepository(Comments::class);
        $getRestComments = $repository->findBy(
            ["idPost" => $post->getId()],
            ["id" => "ASC"]
        );

        // get the data of the comment
        foreach($getRestComments as $comment){
            $table[] = [
                "id"    =>  $comment->getId(),
                "username"  =>  $comment->getUsername(),
                "userPicture"   =>  $comment->getUserpicture(),
                "comment"  =>  $comment->getComment(),
                "id_post"    =>  $post->getId()
            ];
        }

        // send the data in json format
        return new JsonResponse($table);
    }

    //================================ DONE =============================================
    /**
     * @Route("/{idP}/comment/delete/{idC}", name="like_comment")
     */
    public function addLikeComment($idP, $idC){
        $repository = $this->getDoctrine()->getRepository(Posts::class);
        $getComment = $repository->find($idC);

        $getCommentLike = $getComment->getNumberoflikes();
        if($getComment->getNumberoflikes() != null){
            $getComment->setNumberoflikes($getCommentLike + 1);    
        }else{
            $getComment->setNumberoflikes(1);
        }

        $entityManager = $this->getDoctrine()->getEntityManager();
        $entityManager->persist($getComment);
        $entityManager->flush();

        $repository = $this->getDoctrine()->getRepository(Posts::class);
        $post = $repository->find($idP);

        $repository = $this->getDoctrine()->getRepository(Comments::class);
        $getComments = $repository->findBy(
            ["idPost" => $post->getId()],
            ["id" => "ASC"]
        );

        // get the data of all the comments
        foreach($getComments as $getComment){
            $table[] = [
                "id"    =>  $comment->getId(),
                "username"  =>  $comment->getUsername(),
                "userPicture"   =>  $comment->getUserpicture(),
                "comment"  =>  $comment->getComment(),
                "id_post"    =>  $post->getId()
            ];
        }

        // send the data in json format
        return new JsonResponse($table);
    }
}