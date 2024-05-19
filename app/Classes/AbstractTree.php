<?php

namespace App\Classes;
use App\Contracts\AbstractTreeContract;
use Illuminate\Support\Collection;


class AbstractTree implements AbstractTreeContract
{

    protected static int $minFruitsCountPerCollect;

    protected static int $maxFruitsCountPerCollect;

    protected static int $minFruitWeight;
    
    protected static int $maxFruitWeight;

    public static string $fruitsType;

    protected Collection $fruits;

    public string $id;
    
    public function createFruits(): Collection
    {
        $fruits = new Collection();
        $fruitCount = rand(static::$minFruitsCountPerCollect, static::$maxFruitsCountPerCollect);
        for ($fruitCounter = 1; $fruitCounter <= $fruitCount; $fruitCounter++) {
            $frutWaight = rand(static::$minFruitWeight, static::$maxFruitWeight);

            $fruits->push($frutWaight);
        }
        $this->fruits = $fruits;
        
        return $fruits;
    }

    public function getFruits(): Collection
    {
        return $this->fruits;
    }


    public function getId(): string
    {
        return $this->id;
    }

    public function clearFruits(): void
    {
        $this->fruits = new Collection();
    }

}