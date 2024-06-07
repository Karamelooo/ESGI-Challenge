<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Services;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $name = ['Company 1', 'Company 2', 'Company 3', 'Company 4', 'Company 5', 'Company 6', 'Company 7', 'Company 8', 'Company 9', 'Company 10'];
        $category = ['Category 1', 'Category 2', 'Category 3', 'Category 4', 'Category 5', 'Category 6', 'Category 7', 'Category 8', 'Category 9', 'Category 10'];
        $sellingPrice = [100, 200, 300, 400, 500, 600, 700, 800, 900, 1000];
        $purchasePrice = [50, 100, 150, 200, 250, 300, 350, 400, 450, 500];
        $tax = [10, 20, 30, 40, 50, 60, 70, 80, 90, 100];

        for ($i=0; $i < count($name); $i++) {
            $service = new Services();
            $service->setName($name[$i]);
            $service->setCategory($category[$i]);
            $service->setSellingPrice($sellingPrice[$i]);
            $service->setPurchasePrice($purchasePrice[$i]);
            $service->setTax($tax[$i]);
            $service->setLastUpdate(new \DateTime());
            $service->setStatus(false);
            $service->setServiceNumber(uniqid());
            
            $manager->persist($service);
        }
        $manager->flush();
    }
}
