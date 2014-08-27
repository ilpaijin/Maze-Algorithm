<?php

namespace Ilpaijin\MazeAlgorithms;

/**
* AldousBroder Description
*
* @author ilpaijin <ilpaijin@gmail.com>
*/
class AldousBroder extends BaseMaze
{
    /**
     * [move description]
     * @param  [type] $node [description]
     * @return [type]       [description]
     */
    public function move($node)
    {
        $choices = $this->possibleChoices($node->getId());
        return $choices[rand(0, (count($choices) - 1))];
    }
}