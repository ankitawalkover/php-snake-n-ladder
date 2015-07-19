<?php
/**
 * Created by PhpStorm.
 * User: ankita
 * Date: 19/7/15
 * Time: 12:25 PM
 */

namespace SnakeNLadder;

include 'Cell.php';
/*
 * This class finds the minimum distance to reach on the top of the snake and ladder board
 */
class MinimumDistance {

    private $numberOfCell;
    private $movesArray;
    private $minimumMoves;
    private $shortestPath = array();

    function __construct($n,$moves){

        $this->numberOfCell = $n;
        $this->movesArray = $moves;

    }
    /*
     * @param number of cells on the board $n
     * array specifying the moves of cell $movesArray
     */
    public function getMinimumMoves(){

        $cellArray = array();
        $queue = array();
        /*
         * Create n new cell objects for each cell on board
         * Assign initial values to each cell
         * Make an array of these objects
         */
        for($i=0; $i<$this->numberOfCell;$i++){
            $cellObject = new Cell();
            $cellObject->vertex = $i;
            $cellObject->moves = $this->movesArray[$i];
            $cellObject->visited = 0;
            $cellObject->distance = 0;
            $cellObject->path = array($i+1);

            $cellArray[$i] = $cellObject;
        }

        /*
         * Enqueue first cell into queue array and mark as visited
         */
        $queue[0] = $cellArray[0];
        $queue[0]->visited = 1;
        //process for whole quwuw
        while(!empty($queue)){

            $currentCell = $queue[0];

            //dequeue first element of queue
            array_shift($queue);
           // print_r($currentCell);
            //if reached on top of board then return distance
            if($currentCell->vertex == $this->numberOfCell-1){
                $this->minimumMoves = $currentCell->distance;
                $this->shortestPath = $currentCell->path;
                break;
            }

            //loop for next 6 vertex of dice
            for($j=$currentCell->vertex+1;$j <= $currentCell->vertex + 6 && $j < $this->numberOfCell;$j++){
                /*
                 * move is the movement of cell if snake and ladder found otherwise it will be same position
                 * add into queue only if not visited
                 * increase distance by 1
                 * mark cell as visited
                 */
                $move = $cellArray[$j]->moves == -1 ? $j : $cellArray[$j]->moves;
                if($cellArray[$move]->visited == 0){

                    $cellArray[$move]->distance = $currentCell->distance + 1;
                    $cellArray[$j]->visited = 1;
                    $cellArray[$move]->visited = 1;
                    $cellArray[$move]->path = array_merge($currentCell->path,$cellArray[$j]->path);
                    array_push($queue,$cellArray[$move]);
                }

            } //end of for loop
        } // end of while queue not empty

        //if here means distance not found
        return "Minimum no of moves required: ".$this->minimumMoves." and path followed is: ".json_encode($this->shortestPath);
    } //end of minimum distance function

}