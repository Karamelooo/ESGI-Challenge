<?php

namespace App\DataFixtures;

use App\Entity\Client;
use App\Entity\Compagny;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 100; $i++) {
            $client = new Client();
            $client->setCompany($faker->company);
            $client->setFirstname($faker->firstName);
            $client->setLastname($faker->lastName);
            $client->setEmail($faker->email);
            $client->setPhone($faker->phoneNumber);
            $client->setAddress($faker->address);
            $client->setCity($faker->city);
            $client->setZipCode($faker->postcode);
            $client->setSiret($faker->randomNumber(9, true));
            $client->setNaf($faker->regexify('[A-Z]{2}[0-9]{3}'));

            $manager->persist($client);
        }

        for ($i = 0; $i < 100; $i++) {
            $compagny = new Compagny();
            $compagny->setName($faker->company);
            $compagny->setLogoPath('public/uploads');
            $compagny->setAdress($faker->address);
            $compagny->setCity($faker->city);
            $compagny->setZipCode($faker->postcode);
            $compagny->setEmail($faker->email);
            $compagny->setSiret($faker->randomNumber(9, true));
            $compagny->setNaf($faker->regexify('[A-Z]{2}[0-9]{3}'));
            $compagny->setWebsite($faker->url);
            $compagny->setPhone($faker->phoneNumber);
            $compagny->setCapital($faker->randomNumber(6));
            $compagny->setCreatedAt($faker->dateTimeBetween('-2 years', 'now'));

            $manager->persist($compagny);
        }

        $manager->flush();
    }
}
