<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Classes\AppleTree;
use App\Classes\FruitsCollector;
use App\Classes\Garden;
use App\Classes\PearTree;

// Инициализация Сада, Сборщика фруктов
echo "Создаем Сад \n";
$garden = new Garden();
$collector = new FruitsCollector();

echo "Сажаем деревья \n";
// Добавление деревьев
$garden->addTrees(PearTree::class, 15);
$garden->addTrees(AppleTree::class, 10);

echo "Выращиваем фрукты \n";
// генерация фруктов
$garden->growFruitsOnTrees();

echo "Собираем фрукты \n\n";
// Сбор фруктов

$collector->collect($garden);
$сontainersInfo = $collector->getContainersInfo();


// Пользовательский вывод
try {
    $biggestApple = $сontainersInfo->get('applesContainer')->get('biggestFruitsInfo')?->first();
    $totalApplesWeight = $сontainersInfo->get('applesContainer')->get('fruitsTotalWaight') / 1000;
    $totalApplesCount = $сontainersInfo->get('applesContainer')->get('fruitsCount');

    echo "Количество собранных Яблок: {$totalApplesCount}\n";
    echo "Общий вес собранных Яблок: {$totalApplesWeight} кг. \n";
    echo "Самое тяжелое Яблоко весом {$biggestApple?->get('weight')} грамм собрано с дерева id {$biggestApple?->get('treeId')} \n\n";
} catch (Throwable $exception) {
    echo "Яблоки не посажены! \n\n";
}

try {
    $totalPearsWeight = $сontainersInfo->get('pearsContainer')->get('fruitsTotalWaight') / 1000;
    $totalPearsCount = $сontainersInfo->get('pearsContainer')->get('fruitsCount');

    echo "Количество собранных Груш: {$totalPearsCount}\n";
    echo "Общий вес собранных Груш: {$totalPearsWeight} кг. \n\n";
} catch (Throwable $exception) {
    echo "Груши не посажены! \n\n";
}
