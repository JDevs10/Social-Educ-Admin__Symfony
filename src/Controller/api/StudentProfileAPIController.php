<?php

namespace App\Controller\api;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use App\Entity\StudentProfile;
use App\Entity\Posts;
use App\Entity\Experience;
use App\Entity\Education;
use App\Entity\Skills;

/**
 * @Route("/api/student")
 */
class StudentProfileAPIController extends AbstractController{

    //================================ nope =============================================
    /**
     * @Route("/{idS}/getPosts", name="getPosts_student")
     */
    public function getPosts($idS){
        $repository_S = $this->getDoctrine()->getRepository(StudentProfile::class);
        $student = $repository_S->findOneById($idS);

        $repository = $this->getDoctrine()->getRepository(Posts::class);
        $studentPost = $repository->findBy(
            ["idstudent" => $student->getId()],
            ["id" => "ASC"]
        );

        // get the data of the post
        foreach($studentPost as $post){
            $table[] = [
            "id"    =>  $post->getId(),
            "idStudent" => $student->getId(),
            "title"    =>  $post->getTitle(),
            "body"    =>  $post->getBody(),
            "author"    =>  $post->getAuthor(),
            "picture"    =>  $post->getPicture(),
            "media"    =>  $post->getMedia(),
            "numberOfLikes"    =>  $post->getNumberoflikes(),
            "numberOfComments"    =>  $post->getNumberofcomments()
            ];
        }

        // send the data in json format
        return new JsonResponse($table);
    }

    //================================ DONE =============================================
    /**
     * @Route("/{idS}/getExperiences", name="getExperiences_student")
     */
    public function getExperiences($idS){
        $repository_S = $this->getDoctrine()->getRepository(StudentProfile::class);
        $student = $repository_S->findOneById($idS);

        $repository = $this->getDoctrine()->getRepository(Experience::class);
        $studentExperience = $repository->findBy(
            ["idstudent" => $student->getId()],
            ["id" => "ASC"]
        );

        $table = [];
        // get the data of the experience
        foreach($studentExperience as $experience){
            $table[] = [
            "id"    =>  $experience->getId(),
            "IdStudent"    =>  $student->getId(),
            "Title"    =>  $experience->getTitle(),
            "CompanyName"    =>  $experience->getCompanyname(),
            "CompanyAddress"    =>  $experience->getCompanyaddress(),
            "CompanyWebsite"    =>  $experience->getCompanywebsite(),
            "Period"    =>  $experience->getPeriod(),
            "Description"    =>  $experience->getDescription()
            ];
        }

        // send the data in json format
        return new JsonResponse($table);
    }

    //================================ DONE =============================================
    /**
     * @Route("/{idS}/getEducations", name="getEducations_student")
     */
    public function getEducation($idS){
        $repository_S = $this->getDoctrine()->getRepository(StudentProfile::class);
        $student = $repository_S->findOneById($idS);

        $repository = $this->getDoctrine()->getRepository(Education::class);
        $studentEducation = $repository->findBy(
            ["idstudent" => $student->getId()],
            ["id" => "ASC"]
        );

        // $table = [];
        // get the data of the education
        foreach($studentEducation as $education){
            $table[] = [
            "id"    =>  $education->getId(),
            "IdStudent"    =>  $student->getId(),
            "SchollName"    =>  $education->getSchoolname(),
            "Diploma"    =>  $education->getDiploma(),
            "FieldOfStudy"    =>  $education->getFieldofstudy(),
            "DiplomaLevel"    =>  $education->getDiplomalevel(),
            "Period"    =>  $education->getPeriod(),
            "Description"    =>  $education->getDescription()
            ];
        }

        // send the data in json format
        return new JsonResponse($table);
    }

    //================================ Done =============================================
    /**
     * @Route("/{idS}/getSkills", name="getSkills_student")
     */
    public function getSkills($idS){
        $repository_S = $this->getDoctrine()->getRepository(StudentProfile::class);
        $student = $repository_S->findOneById($idS);

        $repository = $this->getDoctrine()->getRepository(Skills::class);
        $studentSkills = $repository->findBy(
            ["idstudent" => $student->getId()],
            ["id" => "ASC"]
        );

        // get the data of the skills
        foreach($studentSkills as $skill){
            $table[] = [
            "id"    =>  $skill->getId(),
            "IdStudent"    =>  $student->getId(),
            "SchollName"    =>  $skill->getSkillname()
            ];
        }

        // send the data in json format
        return new JsonResponse($table);
    }
}