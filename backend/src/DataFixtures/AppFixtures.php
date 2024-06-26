<?php

namespace App\DataFixtures;

use App\Entity\Customer;
use App\Entity\Job;
use App\Entity\Jobber;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;
use App\Enum\StatusEnum;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{

    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');
        $customers = array();
        // Generate 4 customers
        for ($i = 0; $i < 4; $i++) {
            $customers[$i] = new Customer();
            $customers[$i]->setUsername($faker->userName);
            $customers[$i]->setRoles(["ROLE_CUSTOMER"]);
            $manager->persist($customers[$i]);

            // Each one will post between 1 and 3 job
            $nbOffersMax = rand(1, 3);
            for ($o = 0; $o < $nbOffersMax; $o++) {
                $offer[$o] = new Job();
                $offer[$o]->setCustomer($customers[$i]);
                $offer[$o]->setStatus($this->getRandomStatus());
                $offer[$o]->setTitle($faker->words(3, true));
                $offer[$o]->setDescription($faker->words(20, true));
                $manager->persist($offer[$o]);
            }
        }

        // Generate 2 jobber and users
        $jobbers = array();
        $users = array();

        for ($i = 0; $i < 2; $i++) {
            $jobbers[$i] = new Jobber();
            $jobbers[$i]->setUsername($faker->userName);
            $manager->persist($jobbers[$i]);

            $users[$i] = new User();
            $users[$i]->setEmail('user' . $i . '@example.com');
            $users[$i]->setRoles(['ROLE_USER']);
            $users[$i]->setJobber($jobbers[$i]);
            $encodedPassword = $this->passwordHasher->hashPassword($users[$i], 'password');
            $users[$i]->setPassword($encodedPassword);
            $manager->persist($users[$i]);
        }

        $manager->flush();

    }

    function getRandomStatus()
    {
        $randomIndex = array_rand(StatusEnum::$status);
        return StatusEnum::$status[$randomIndex];
    }
}
