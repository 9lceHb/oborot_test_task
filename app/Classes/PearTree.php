<?php

namespace App\Classes;
use Illuminate\Support\Collection;

class PearTree extends AbstractTree
{

    protected static int $minFruitsCountPerCollect = 0;

    protected static int $maxFruitsCountPerCollect = 20;

    protected static int $minFruitWeight = 130;

    protected static int $maxFruitWeight = 170;

    public static string $fruitsType = 'pears';

    public string $id;

    public function __construct($id)
    {
        $this->id = $id;
        $this->fruits = new Collection();
    }
}
