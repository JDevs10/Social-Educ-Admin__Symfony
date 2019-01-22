<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Request;

use App\Entity\Posts;

/**
* @Route("/api/posts")
*/
class PostAPIController extends AbstractController{

    /**
     * @Route("/getPosts", name="get_posts")
     */
    public function getPosts(){
        $repository = $this->getDoctrine()->getRepository(Posts::class);
        $getPosts = $repository->findAll();

        $data = [];
        foreach($getPosts as $Post){
            $table = [
                "id"    =>  $Post->getId(),
                "title"    =>  $Post->getTitle(),
                "body"    =>  $Post->getBody(),
                // "date"    =>  $Post->getId(),
                "author"    =>  $Post->getAuthor(),
                "picture"    =>  $Post->getPicture(),
                "media"    =>  $Post->getMedia(),
                "numberOfLikes"    =>  $Post->getNumberoflikes(),
                "numberOfComments"    =>  $Post->getNumberofcomments()
            ];
            array_push($data, $table);
        }

        return new JsonResponse($data);
    }

    /**
     * @Route("/addPost")
     */
    public function addPost(Request $request){
        $addPost = new Posts();

        $addPost->setTitle($request->get("title"));
        $addPost->setBody($request->get("body"));
        $addPost->setAuthor($request->get("author"));
        $addPost->setPicture($request->get("picture"));
        $addPost->setMedia($request->get("media"));
        $addPost->setNumberoflikes($request->get("numberOfLikes"));
        $addPost->setNumberofcomments($request->get("numberOfComments"));

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($addPost);
        $entityManager->flush();
        
        $data = [
            "title" =>  $addPost->getTitle(),
            "body" =>  $addPost->getBody(),
            "author" =>  $addPost->getAuthor(),
            "picture" =>  $addPost->getPicture(),
            "media" =>  $addPost->getMedia(),
            "numberOfLikes" =>  $addPost->getNumberoflikes(),
            "numberOfComments" =>  $addPost->getNumberofcomments()
        ];

        return new JsonResponse($data);
    }

    /**
     * @Route("/getPost/{id}")
     */
    public function getPost($id){
        $repository = $this->getDoctrine()->getRepository(Posts::class);
        $getPost = $repository->find($id);

        $data = [
            "id"    =>  $getPost->getId(),
            "title"    =>  $getPost->getTitle(),
            "body"    =>  $getPost->getBody(),
            // "date"    =>  $getPost->getId(),
            "author"    =>  $getPost->getAuthor(),
            "picture"    =>  $getPost->getPicture(),
            "media"    =>  $getPost->getMedia(),
            "numberOfLikes"    =>  $getPost->getNumberoflikes(),
            "numberOfComments"    =>  $getPost->getNumberofcomments()
        ];

        return new JsonResponse($data);
    }

    /**
     * @Route("/modifyPost/{id}")
     */
    public function modifyPost($id, Request $request){

        // get user input
        $modifyPost = new Posts();
        
        if($request->get("title") != null){$modifyPost->setTitle($request->get("title"));}
        if($request->get("body") != null){$modifyPost->setBody($request->get("body"));}
        if($request->get("media") != null){$modifyPost->setMedia($request->get("media"));}

        // get the post
        $repository = $this->getDoctrine()->getRepository(Posts::class);
        $post = $repository->find($id);

        // change the post data
        $post->setTitle($modifyPost->getTitle());
        $post->setBody($modifyPost->getBody());
        $post->setMedia($modifyPost->getMedia());

        // push the data to the db (aka update the post)
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($post);
        $entityManager->flush();

        // return the modified post
        $data = [
            "id"    =>  $post->getId(),
            "title"    =>  $post->getTitle(),
            "body"    =>  $post->getBody(),
            // "date"    =>  $Post->getId(),
            "author"    =>  $post->getAuthor(),
            "picture"    =>  $post->getPicture(),
            "media"    =>  $post->getMedia(),
            "numberOfLikes"    =>  $post->getNumberoflikes(),
            "numberOfComments"    =>  $post->getNumberofcomments()
        ];
        
        return new JsonResponse($data);
    }

    /**
     * @Route("/deletePost/{id}")
     */
    public function deletePost($id){
        $repository = $this->getDoctrine()->getRepository(Posts::class);
        $delete = $repository->find($id);

        $entityManager = $this->getDoctrine()->getEntityManager();
        $entityManager->remove($delete);
        $entityManager->flush();

        $repository = $this->getDoctrine()->getRepository(Posts::class);
        $getPosts = $repository->findAll();

        $data = [];
        foreach($getPosts as $Post){
            $table = [
                "id"    =>  $Post->getId(),
                "title"    =>  $Post->getTitle(),
                "body"    =>  $Post->getBody(),
                // "date"    =>  $Post->getId(),
                "author"    =>  $Post->getAuthor(),
                "picture"    =>  $Post->getPicture(),
                "media"    =>  $Post->getMedia(),
                "numberOfLikes"    =>  $Post->getNumberoflikes(),
                "numberOfComments"    =>  $Post->getNumberofcomments()
            ];
            array_push($data, $table);
        }

        return new JsonResponse($data);
    }

    /**
     * @Route("/likePost/{id}")
     */
    public function addLike($id){
        $repository = $this->getDoctrine()->getRepository(Posts::class);
        $getPost = $repository->find($id);

        $getPostLike = $getPost->getNumberoflikes();
        if($getPost->getNumberoflikes() != null){
            $getPost->setNumberoflikes($getPostLike + 1);    
        }else{
            $getPost->setNumberoflikes(1);
        }

        $entityManager = $this->getDoctrine()->getEntityManager();
        $entityManager->persist($getPost);
        $entityManager->flush();

        $data = [
            "id"    =>  $getPost->getId(),
            "title"    =>  $getPost->getTitle(),
            "body"    =>  $getPost->getBody(),
            // "date"    =>  $getPost->getId(),
            "author"    =>  $getPost->getAuthor(),
            "picture"    =>  $getPost->getPicture(),
            "media"    =>  $getPost->getMedia(),
            "numberOfLikes"    =>  $getPost->getNumberoflikes(),
            "numberOfComments"    =>  $getPost->getNumberofcomments()
        ];

        return new JsonResponse($data);
    }

    /**
     * @Route("/nbLikePost/{id}")
     */
    public function getNumberOfLikes($id){
        $repository = $this->getDoctrine()->getRepository(Posts::class);
        $post = $repository->find($id);

        $nbLike = $post->getNumberofcomments();
        $data = [
            "numberOfComments" => $nbLike
        ];

        return new JsonResponse($data);
    }
}