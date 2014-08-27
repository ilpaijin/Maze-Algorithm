<?php

namespace Ilpaijin\MazeAlgorithms;

use Ilpaijin\TreeManager;
use Ilpaijin\Cell;

/**
* BaseMaze Description
*
* @author ilpaijin <ilpaijin@gmail.com>
*/

abstract class BaseMaze 
{
    /**
     * [$size description]
     * @var [type]
     */
    protected $size;

    /**
     * [$tree description]
     * @var [type]
     */
    public $treeManager;

    /**
     * [__construct description]
     * @param [type] $size [description]
     */
    public function __construct($size)
    {
        $this->size = $size;
        $this->treeManager = new TreeManager();
    }

    /**
     * [move description]
     * @param  [type] $node [description]
     * @return [type]       [description]
     */
    abstract function move($node);

    /**
     * [generateMaze description]
     * @return [type] [description]
     */
    public function generate()
    {
        $first = new Cell();

        $this->setVisited($first);

        $current = $first;

        while(!$this->isGenerationComplete())
        {   
            $next = $this->move($current);
            
            if($next)
            {
                if($this->gotoNode($next,$current))
                {
                    $current = $this->treeManager[$next];
                }
            }
        }
    }

    public function gotoNode($node, $parent)
    {
        if ($this->isVisited($node))
        {
            return false;
        }

        $node = $this->treeManager[$node];
        
        if (!$node->hasParent())
        {
            $node->setParent($parent->getId());
        }
        
        $parent->addChild($node);

        $this->setVisited($node);

        return true;
    }

    /**
     * [setVisited description]
     * @param [type] $node [description]
     */
    public function setVisited($node)
    {
        if (isset($this->treeManager[$node->getId()]))
        {
            $this->treeManager[$node->getId()]->setVisited(true);
        }
        else 
        {
            $this->treeManager->append($node); 
            $this->setVisited($node);
        }
    }

    /**
     * [possibleChoices description]
     * @param  [type] $node [description]
     * @return [type]       [description]
     */
    public function possibleChoices($nodeId)
    {
        list($x,$y) = explode(":", $nodeId);
        $moves = [];

        if ($x-1 >= 0) array_push($moves,  ($x-1).":".$y);
        if ($y-1 >= 0) array_push($moves, $x.":".($y-1));
        if ($x+1 < $this->size) array_push($moves, ($x+1).":".$y);
        if ($y+1 < $this->size) array_push($moves, $x.":".($y+1));

        return $moves;
    }

    /**
     * [isGenerationComplete description]
     * @return boolean [description]
     */
    public function isGenerationComplete()
    {
        return ($this->size * $this->size) === count(array_filter($this->treeManager->tree, function($n)
        {
            return $n->isVisited();
        }));
    }

    /**
     * [isVisited description]
     * @param  [type]  $node [description]
     * @return boolean       [description]
     */
    public function isVisited($nodeId)
    {
        if(isset($this->treeManager[$nodeId]))
        {
            return $this->treeManager[$nodeId]->isVisited() ?: false;
        } 
        else 
        {
            list($x, $y) = explode(":", $nodeId);

            $this->treeManager->append(new Cell($x, $y)); 

            return false;
        }
    }
}