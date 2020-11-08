<?php
namespace App\DataFixtures\Sliders;

use App\DataFixtures\Fixtures;
use App\Entity\Entities\Sliders\Sliders;

class SlidersFixture extends Fixtures
{
    public function load()
    {
        $slider = new Sliders();
        $slider->setName('homepage_sliders');
        $slider->setDescription('Główny slider na stronie głównej');
        $slider->setActive(true);
        $this->entityManager->persist($slider);
        $this->entityManager->flush();
    }
}
