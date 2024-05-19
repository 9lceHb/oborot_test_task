<?php

namespace App\Contracts;
use Illuminate\Support\Collection;

interface GardenContract
{
    public function addTrees(string $treeClass, int $count): void;

    public function getTrees(): Collection;

    public function growFruitsOnTrees(): void;
}