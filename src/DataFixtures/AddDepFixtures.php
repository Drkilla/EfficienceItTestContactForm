<?php

namespace App\DataFixtures;

use App\Entity\Departements;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AddDepFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $deps = ['direction','rh','com','dev'];
        foreach($deps as $dep)
        {
            $department = new Departements();
            $department->setNom($dep);
            $department->setEmail($dep.'@'.$dep.'.fr');
            $manager->persist($department);
        }
        $manager->flush();
    }
}
