<?php

namespace App\Contracts;
use Illuminate\Support\Collection;

interface FruitsCollectorContract
{
    public function collect(GardenContract $garden);

    public function getContainersInfo(): Collection;
}