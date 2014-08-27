<?php

namespace ilpaijin;

/**
* TreeManager Description
*
* @author ilpaijin <ilpaijin@gmail.com>
*/
class TreeManager implements \ArrayAccess
{
    /**
     * [$tree description]
     * @var [type]
     */
    public $tree;

    /**
     * [__construct description]
     */
    public function __construct()
    {
        // This could be instead an adapter pointing to other storage data interface, default or injected via setter
        // $this->tree = new SplObjectStorage();
    }

    /**
     * [append description]
     * @param  [type] $cell [description]
     * @return [type]       [description]
     */
    public function append($cell)
    {
        $this->tree[$cell->getId()] = $cell;
    }

    /**
     * [offsetExists description]
     * @param  [type] $key [description]
     * @return [type]      [description]
     */
    public function offsetExists($key)
    {
        return isset($this->tree[$key]);
    }

    /**
     * [offsetGet description]
     * @param  [type] $key [description]
     * @return [type]      [description]
     */
    public function offsetGet($key)
    {
        if($this->offsetExists($key))
        {
            return $this->tree[$key];
        }
    } 

    /**
     * [offsetSet description]
     * @param  [type] $key   [description]
     * @param  [type] $value [description]
     * @return [type]        [description]
     */
    public function offsetSet($key, $value)
    {
        $this->tree[$key] = $value;
    }

    /**
     * [offsetUnset description]
     * @param  [type] $key [description]
     * @return [type]      [description]
     */
    public function offsetUnset($key)
    {
        unset($this->tree[$key]);
    }
}