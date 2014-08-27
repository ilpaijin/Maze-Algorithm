<?php

#!/usr/bin/env php 

require_once "vendor/autoload.php";

$size = isset($argv[1]) ? $argv[1] : 3;
$grid = array_pad([], $size, array_pad([], $size, 0));

$start = microtime(true);

$maze = new Ilpaijin\MazeAlgorithms\AldousBroder($size);
// $maze = new Ilpaijin\MazeAlgorithms\RecursiveBacktracker($size);

$maze->generate();

var_dump(microtime(true) - $start);

if(isset($maze->stack))
{
    // $maze->stack->rewind();
    // while($maze->stack->valid())
    // {
    //     // var_dump($maze->stack->current()); 
    //     $maze->stack->next();
    // }

    // var_dump($maze->treeManager->tree);
}

$res = array();

foreach ($maze->treeManager->tree as $n) 
{
    array_push($res, $n->getId());
}
var_dump(json_encode($res, JSON_PRETTY_PRINT));