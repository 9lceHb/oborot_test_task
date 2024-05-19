<?php

namespace App\Classes;
use App\Contracts\AbstractTreeContract;
use App\Contracts\GardenContract;
use Illuminate\Support\Collection;

class Garden implements GardenContract
{
    private Collection $trees;

    public function __construct()
    {
        $this->trees = new Collection();
    }

    public function addTrees(string $treeClass, int $count): void
    {
        for ($i = 1; $i <= $count; $i++) {
            $this->trees->push(new $treeClass(uniqid()));
        }
    }

    public function growFruitsOnTrees(): void
    {
        $this->trees->map(function ($tree) {
            $tree->createFruits();
        });
    }

    public function getTrees(): Collection
    {
        return $this->trees;
    }
}