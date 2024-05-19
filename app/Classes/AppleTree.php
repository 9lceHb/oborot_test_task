<?php

namespace App\Classes;
use Illuminate\Support\Collection;

class AppleTree extends AbstractTree
{
    protected static int $minFruitsCountPerCollect = 40;

    protected static int $maxFruitsCountPerCollect = 50;

    protected static int $minFruitWeight = 150;

    protected static int $maxFruitWeight = 180;

    public static string $fruitsType = 'apples';

    public string $id;

    public function __construct($id)
    {
        $this->id = $id;
        $this->fruits = new Collection();
    }
}