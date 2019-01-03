<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

use App\Entity\StudentProfile;

class StudentProfileFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
     {
         $this->passwordEncoder = $passwordEncoder;
     }

    public function load(ObjectManager $manager)
    {
        $userStudent = new StudentProfile();
        $userStudent->setEmail('test-symfony@hotmail.com');
        $userStudent->setRoles(['User-Admin']);
        $userStudent->setPassword($this->passwordEncoder->encodePassword(
            $userStudent,
            'the_new_password'
        ));

        $manager->persist($userStudent);
        $manager->flush();
    }

}
