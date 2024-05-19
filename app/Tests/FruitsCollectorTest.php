<?php

namespace App\Tests;
use App\Classes\AppleTree;
use App\Classes\FruitsCollector;
use App\Classes\Garden;
use App\Classes\PearTree;
use PHPUnit\Framework\TestCase;


class FruitsCollectorTest extends TestCase
{
    private Garden $garden;

    private FruitsCollector $collector;

    public function setUp(): void
    {
        $this->garden = new Garden();
        $this->collector = new FruitsCollector();

        $this->garden->addTrees(PearTree::class, 3);
        $this->garden->addTrees(AppleTree::class, 2);
    // Генерация фруктов на деревьях (не рандомных)
        $this->garden
            ->getTrees()
            ->each(function($tree) {
                $reflection = new \ReflectionObject($tree);
                $property = $reflection->getProperty('fruits');
                switch ($tree::$fruitsType) {
                    case 'pears':
                        $property->setValue($tree, collect([10, 40, 20]));
                        break;
                    default: // apples
                        $property->setValue($tree, collect([100, 400, 200]));
                }
            });
        $this->collector->collect($this->garden);
    }

    public function testReverse(): void
    {
        $pearsContainer = $this->collector->getContainersInfo()->get('pearsContainer');
        $applesContainer = $this->collector->getContainersInfo()->get('applesContainer');
        
        $this->assertEquals($applesContainer->get('fruitsCount'), 6);
        $this->assertEquals($applesContainer->get('fruitsTotalWaight'), 1400);
        $this->assertEquals($applesContainer->get('biggestFruitsInfo')->first()->get('weight'), 400);

        $this->assertEquals($pearsContainer->get('fruitsCount'), 9);
        $this->assertEquals($pearsContainer->get('fruitsTotalWaight'), 210);
        $this->assertEquals($pearsContainer->get('biggestFruitsInfo')->first()->get('weight'), 40);
    }
}