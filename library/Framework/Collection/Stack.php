<?php
/**
 * A basic stack, with both FIFO and LIFO access.
 * @package Framework_Collection
 */
class Framework_Collection_Stack
	extends Framework_Collection_Collections
{
    /**
     * Remove all elements from the stack.
     * @throws Framework_Common_InvalidOperationException
     */
    public function clear()
    {
        $this->array = array();
    }

    /**
     * Computes the intersection of arrays.
     * @param Framework_Collection_Array $array
     */
    public function intersect(Framework_Collection_Array $array)
    {
            $this->array = array_intersect($this->array, $array->toNativeArray());
    }

    /**
     * Remove and return the last element of the stack.
     * @return mixed The last element of the stack.
     * @throws Framework_Common_InvalidOperationException
     */
    public function pop()
    {
        return array_pop($this->array);
    }

    /**
     * Add the element at the end of the stack.
     * @param mixed $element The element to be added at the end of the stack.
     * @throws Framework_Common_InvalidOperationException
     */
    public function push($element)
    {
        array_push($this->array, $element);
    }

    /**
     * Remove and return the first element of the stack.
     * @return mixed The first element of the stack.
     * @throws Framework_Common_InvalidOperationException
     */
    public function shift()
    {
        return array_shift($this->array);
    }

    /**
     * Shuffles the stack.
     */
    public function shuffle()
    {
            shuffle($this->array);
    }

    /**
     * Calculate the sum of values in an array
     * @return float Returns the sum of values as an float.
     */
    public function sum()
    {
            return (float)array_sum($this->array);
    }

    /**
     * Add the element at the beginning of the stack.
     * @param mixed $element The element to be added at the beginning of the stack.
     * @throws Framework_Common_InvalidOperationException
     */
    public function unshift($element)
    {
        array_unshift($this->array, $element);
    }
}