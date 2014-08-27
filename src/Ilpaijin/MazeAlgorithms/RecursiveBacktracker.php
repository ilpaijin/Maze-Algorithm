<?php

namespace Ilpaijin\MazeAlgorithms;

use Ilpaijin\BaseMaze;
use \SplStack;

/**
* RecursiveBacktracker Description
*
* @author ilpaijin <ilpaijin@gmail.com>
*/
class RecursiveBacktracker extends BaseMaze
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

    /**
     * [move description]
     * @param  [type] $node [description]
     * @return [type]       [description]
     */
    public function move($node)
    {
        $choices = array_values(array_filter($this->possibleChoices($node->getId()), function($n)
        {
            return !$this->isVisited($n);
        }));

        if($choices)
        {
            $this->stack->push($node);

            return $choices[rand(0, (count($choices) - 1))];
        }

        return $this->move($this->stack->pop());
    }
}