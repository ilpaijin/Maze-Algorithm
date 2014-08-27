<?php

#!/usr/bin/env php 

require_once "vendor/autoload.php";

$size = isset($argv[1]) ? $argv[1] : 3;
$grid = array_pad([], $size, array_pad([], $size, 0));


$maze = new Ilpaijin\MazeAlgorithms\RecursiveBacktracker($size);

$maze->generate();


$res = array();
foreach($maze->treeManager->tree AS $n)
{
    array_push($res, array($n->getId() => $n->meta)); 
}

var_dump(json_encode($res, JSON_PRETTY_PRINT));