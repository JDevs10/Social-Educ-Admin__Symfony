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

        // show all my comments of this post
        $repository = $this->getDoctrine()->getRepository(Comments::class);
        $allComments = $repository->findBy(
            ["idPost"   =>  $post],
            ["id"   =>  "ASC"]
        );

        $data = [];
        foreach($allComments as $allComment){
            $table = [
                "id"    =>  $allComment->getId(),
                "username"  =>  $allComment->getUsername(),
                "userPicture"   =>  $allComment->getUserpicture(),
                "comment"  =>  $allComment->getComment(),
                "id_post"    =>  $post->getId()
            ];
        }

        array_push($data, $table);
        return new JsonResponse($data);
    }
}