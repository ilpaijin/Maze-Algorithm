<?php

namespace Ilpaijin\MazeAlgorithms;

use \SplStack;

/**
* RecursiveBacktracker Description
*
* @author ilpaijin <ilpaijin@gmail.com>
*/
class RecursiveBacktracker 
{
    /**
     * [$stack description]
     * @var [type]
     */
    public $stack;

    /**
     * [__construct description]
     * @param [type] $size [description]
     */
    public function __construct($size)
    {
        $this->stack = new SplStack();

        parent::__construct($size);
    }

    //////////// NOT WORKING YET ///////////
    public function move($node)
    {
        //but not visited choices
        $choices = $this->possibleChoices($node->getId());

        return $choices[rand(0, (count($choices) - 1))];

        if($choices)
        {
            $this->stack->append($node);

            return $choice, $node;
        }

        return $this->move($this->stack->pop())
    }
}