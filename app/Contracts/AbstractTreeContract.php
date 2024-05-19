<?php

namespace App\Contracts;
use Illuminate\Support\Collection;

interface AbstractTreeContract
{
    public function createFruits(): Collection;

    public function getFruits(): Collection;

    public function getId(): string;

    public function clearFruits(): void;
}
