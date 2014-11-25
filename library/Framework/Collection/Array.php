<?php
/**
 * The Array class behaves just like a native PHP array, with the additional benefit of being
 * passed by reference by default.
 * @package Framework_Collection
 */
class Framework_Collection_Array
	extends Framework_Collection_Stack
	implements ArrayAccess
{
    /**
     * Split an array into chunks
     * @param int $size The size of each chunk
     * @return Framework_Collection_Array A multidimensional numerically indexed array, starting with zero,
     * with each dimension containing $size elements.
     */
    public function chunk($size)
    {
            $result = new self();

            $chunks = array_chunk($this->array, (int)$size, true);

            foreach ($chunks as $chunk)
            {
                    $result->push(
                            new self($chunk)
                    );
            }

            return $result;
    }

    /**
     * Iterates over each value in this Framework_Collection_Array object,
     * passing them to the callback function.
     * If the callback function returns true, the current value from input is returned into
     * the result Framework_Collection_Array object. Array keys are preserved.
     * @param mixed $callback The callback function (either callable or closure).
     * @return Framework_Collection_Array filtered array.
     */
    public function filter($callback)
    {
            return new Framework_Collection_Array(
                    array_filter($this->toNativeArray(), $callback)
            );
    }

    /**
     * Determine whether a value for the index offset exists.
     * @param mixed $offset The index offset for which to determine whether it has a value.
     * @return bool Whether a value for the index offset exists.
     */
    public function offsetExists($offset)
    {
            return array_key_exists($offset, $this->array);
    }

    /**
     * Get the value for the index offset.
     * @param mixed $offset The index offset for which to return the value.
     * @return mixed The value of the index offset.
     * @throws Exception
     */
    public function offsetGet($offset)
    {
        if (array_key_exists($offset, $this->array) === false)
        {
                throw new Exception("Undefined offset: " . $offset);
        }

        return $this->array[$offset];
    }

    /**
     * Set the value for the index offset.
     * @param mixed $offset The index offset for which to set the value.
     * @param mixed $value The value to set for the index offset.
     * @throws Exception
     */
    public function offsetSet($offset, $value)
    {
        if ($offset === null)
        {
                $this->array[] = $value;
        }
        else
        {
                $this->array[$offset] = $value;
        }
    }

    /**
     * Unset the value of the index offset.
     * @param mixed $offset The index offset for which to unset the value.
     */
    public function offsetUnset($offset)
    {
        unset($this->array[$offset]);
    }

    /**
     * Set internal pointer based on the key.
     * @param mixed $key The key value.
     * @return boolean True when pointer is set.
     */
    public function setPointer($key)
    {
        if ($this->keyExists($key) === false)
        {
                return false;
        }

        $needle = $this->offsetGet($key);
        //reset pointer.
        $this->rewind();

        // First element?
        if ($this->current() === $needle)
        {
            return true;
        }

        while ($this->next() !== false)
        {
            if ($this->current() === $needle)
            {
                return true;
            }
        }

        return false;
    }

    /**
     * Shuffle the array.
     */
    public function shuffle()
    {
            shuffle($this->array);
    }

    /**
     * Splice the array.
     * @param int $offset The offset from where the array will be removed.
     * @param int $length The length of the array portion to remove.
     */
    public function splice($offset, $length)
    {
        array_splice($this->array, $offset, $length);
    }

    /**
     * Gets the intersection of the arrays.
     *
     * Returns an array containing all the values of current array that are present in all the other arrays.
     * Note that keys are preserved.
     *
     * @param Framework_Collection_Array $array
     * @param Framework_Collection_Array $_ One or more additional arrays.
     * @return Framework_Collection_Array
     */
    public function intersect(Framework_Collection_Array $array, Framework_Collection_Array $_ = null)
    {
            $args = func_get_args();
            array_unshift($args, $this);

            return new Framework_Collection_Array(
                    call_user_func_array("array_intersect", array_map(
                            function ($e)
                            {
                                    /** @var Framework_Collection_Array $e */
                                    return $e->toNativeArray();
                            },
                            $args
                     ))
             );
    }

    /**
     * Returns the highest value in an array.
     * @return mixed The highest value in an array.
     */
    public function max()
    {
            return max($this->array);
    }

    /**
     * Returns the lowest value in an array.
     * @return mixed The lowest value in an array.
     */
    public function min()
    {
            return min($this->array);
    }
}