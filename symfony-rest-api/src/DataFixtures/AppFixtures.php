<?php

namespace App\DataFixtures;

use App\Entity\Company;
use App\Entity\Place;
use App\Entity\Vol;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class AppFixtures extends Fixture
{
    protected Generator $faker;

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('Fr-fr');

        for ($i = 1; $i < 4; $i++) {
            $company = (new Company())
                ->setName($faker->company)
                ->setWebSite($faker->domainName);

            for ($j = 0; $j < 3; $j++) {
                $vol = (new Vol())
                    ->setName($faker->randomNumber(8))
                    ->setCompany($company)
                    ->setDate($faker->dateTimeThisYear('2021-12-31', 'Europe/Paris'));

                for ($k = 0; $k < 30; $k++) {
                    $place = (new Place())
                        ->setAffected($faker->boolean)
                        ->setAlley($faker->randomLetter)
                        ->setNumber($faker->randomDigit);

                    $vol->addPlace($place);

                    $manager->persist($place);
                }

                $manager->persist($vol);
            }

            $manager->persist($company);
        }

        $manager->flush();
    }
}
