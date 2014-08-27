<?php

namespace Ilpaijin;

/**
* Cell Description
*
* @author ilpaijin <ilpaijin@gmail.com>
*/
class Cell
{
    /**
     * [$id description]
     * @var [type]
     */
    public $id;

    /**
     * [$x description]
     * @var [type]
     */
    public $x;

    /**
     * [$y description]
     * @var [type]
     */
    public $y;

    /**
     * [$meta description]
     * @var [type]
     */
    public $meta = []; 

    /**
     * [__construct description]
     */
    public function __construct($x = 0, $y = 0)
    {
        $this->x = $x;
        $this->y = $y;
        $this->id = $this->x.':'.$this->y;
        $this->meta = [
            'parent' => null,
            'direction' => [],
            'visited' => false
        ];
    }

    /**
     * [getId description]
     * @return [type] [description]
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * [isVisited description]
     * @return boolean [description]
     */
    public function isVisited()
    {
        return $this->meta['visited'];
    }

    /**
     * [setVisited description]
     * @param [type] $value [description]
     */
    public function setVisited($value)
    {
        $this->meta['visited'] = $value;
    }

    /**
     * [hasParent description]
     * @return boolean [description]
     */
    public function hasParent()
    {
        return is_null($this->meta['parent']);
    }

    /**
     * [setParent description]
     * @param [type] $parent [description]
     */
    public function setParent($parentId)
    {
        $this->meta['parent'] = $parentId;
    }

    /**
     * [addChild description]
     * @param [type] $node [description]
     */
    public function addChild($node)
    {
        $direction = $this->getDirection($this->getId(), $node->getId());

        if (false === array_search($direction, $this->meta['direction']))
        {
            $this->setDirection($direction);
        }        
    }

    /**
     * [setDirection description]
     * @param [type] $direction [description]
     */
    public function setDirection($direction)
    {
        array_push($this->meta['direction'], $direction);
    }

    /**
     * [getDirection description]
     * @param  [type] $from [description]
     * @param  [type] $to   [description]
     * @return [type]       [description]
     */
    public function getDirection($from, $to)
    {
        list($x1,$y1) = explode(":", $from);
        list($x2,$y2) = explode(":", $to);

        if ($x1 < $x2) return 'S';
        if ($x1 > $x2) return 'N';
        if ($y1 > $y2) return 'E';
        if ($y1 < $y2) return 'W';
    }
}