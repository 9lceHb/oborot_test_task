<?php

namespace App\Classes;

use App\Contracts\AbstractTreeContract;
use App\Contracts\FruitsCollectorContract;
use App\Contracts\GardenContract;
use Illuminate\Support\Collection;

class FruitsCollector implements FruitsCollectorContract
{
    private Collection $containers;

    public function __construct()
    {
        $this->containers = new Collection();
    }

    public function collect(GardenContract $garden)
    {
        $trees = $garden->getTrees();
        $trees->map(function ($tree) {
            $containerName = $tree::$fruitsType . 'Container';
            $this->addFruitsToContainer($containerName, $tree);
        });
    }

    public function getContainersInfo(): Collection
    {
        $result = $this->containers->map(function ($containerFruits) {
            $maxWeight = $containerFruits->max('weight');
            $biggestFriuts = $containerFruits->filter(fn($fruit) => $fruit['weight'] === $maxWeight);
            return collect([
                'fruitsCount' => $containerFruits->count(),
                'fruitsTotalWaight' => $containerFruits->sum('weight'),
                'biggestFruitsInfo' => $biggestFriuts,
            ]);
        });
        return $result;
    }

    private function addFruitsToContainer(string $containerName, AbstractTreeContract $tree)
    {   
        $labledFruits = $this->addTreeLabelsOnFruits($tree->getFruits(), $tree->getId());
        if ($this->containers->has($containerName)) {
            $this->containers[$containerName] = $this->containers[$containerName]->concat($labledFruits);
        } else {
            $this->containers->put($containerName, $labledFruits);
        }
        $tree->clearFruits();
    }

    private function addTreeLabelsOnFruits(Collection $fruits, string $treeId)
    {
        return $fruits->map(function ($fruit) use ($treeId) {
            $fruit = collect([
                'weight' => $fruit,
                'treeId' => $treeId,
            ]);
            return $fruit;
        });
    }
}