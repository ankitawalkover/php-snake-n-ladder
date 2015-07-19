<?php
/**
 * Created by PhpStorm.
 * User: ankita
 * Date: 19/7/15
 * Time: 2:04 PM
 */

namespace SnakeNLadder;

include 'MinimumDistance.php';
$cell = 30;

for($i = 0;$i<$cell;$i++){
    $moves[$i] = -1;
}

//ladders
$moves[2] = 21;
$moves[4] = 7;
$moves[10] = 25;
$moves[19] = 28;

// Snakes
$moves[26] = 0;
$moves[20] = 8;
$moves[16] = 3;
$moves[18] = 6;


$result = new MinimumDistance($cell,$moves);
echo $result->getMinimumMoves();
