<?php
/**
 * Represents an abstract collection of items. Except for the collection properties and iterator
 * methods, it does not provide any way to manipulate the collection. This behaviour is up
 * to its implementors to define.
 * @package Framework_Collection
 */
abstract class Framework_Collection_Collections
	implements Iterator
{
	/**
	 * Internal storage array.
	 * @var array
	 */
	protected $array = array();

	/**
	 * A value indicating whether the collection is read only.
	 * @var bool
	 */
	private $readOnly = false;

	/**
	 * Initialize a new Collection object.
	 * @param array $array An optional array which may be used to prefill the collection.
	 * @param bool $readOnly A value indicating whether the collection is read only.
	 */
	public function __construct(array $array = array(), $readOnly = false)
	{
		$this->array = $array;
		$this->readOnly = (bool)$readOnly;
	}

	/**
	 * Deep clone the objects in the array.
	 */
	public function __clone()
	{
		$clonedArray = array();

		foreach ($this->array as $key => $value)
		{
			if (is_object($value) === true)
			{
				$clonedArray[$key] = clone $value;
			}
			else
			{
				$clonedArray[$key] = $value;
			}
		}

		$this->array = $clonedArray;
	}

	/**
	 * Appends the contents from the specified collection to this collection. Overlapping keys are not overwritten.
	 * @param Framework_Collection_Collection $collection The collection from which to append the contents.
	 * @throws Framework_Common_InvalidOperationException
	 */
	public function appendFrom(Framework_Collection_Collection $collection)
	{
		if ($this->isReadOnly() === true)
		{
			throw new Framework_Common_InvalidOperationException("Collection is read only.");
		}

		$this->array = $this->array + $collection->array;
	}

	/**
	 * Appends the contents from this collection to the specified collection. Overlapping keys are not overwritten.
	 * @param Framework_Collection_Collection $collection The collection to which to append the contents from this collection.
	 */
	public function appendTo(Framework_Collection_Collection $collection)
	{
		$collection->appendFrom($this);
	}

	/**
	 * Get the value of the current element.
	 * @return mixed The value of the current element.
	 */
	public function current()
	{
		return current($this->array);
	}

	/**
	 * Get the value of the last element.
	 * @return mixed The value of the last element or false if the array is empty.
	 */
	public function end()
	{
		return end($this->array);
	}

	/**
	 * Get a value indicating whether the collection is read only.
	 * @return bool Whether the collection is read only.
	 */
	public function isReadOnly()
	{
		return $this->readOnly;
	}

	/**
	 * Joins each primitive element of the collection, seperated by the delimiter, together.
	 * @param string $delimiter The delimiter seperating each element.
	 * @return string All primitive elements in the collection joined together.
	 */
	public function join($delimiter)
	{
		$joinedString = "";

		foreach ($this->array as $element)
		{
			if (is_array($element) === false &&
				is_object($element) === false &&
				is_resource($element) === false)
			{
				if ($joinedString !== "")
				{
					$joinedString .= $delimiter;
				}

				$joinedString .= $element;
			}
		}

		return $joinedString;
	}

	/**
	 * Returns the current index offset.
	 * @return mixed The current index offset.
	 */
	public function key()
	{
		return key($this->array);
	}

	/**
	 * Returns if a key exists in the collection.
	 * @param string $key The key to look for.
	 * @return bool Wether the key exists.
	 */
	public function keyExists($key)
	{
		return array_key_exists($key, $this->array) === true;
	}

	/**
	 * Merges the contents from the specified collection to this collection. Overlapping non-numeric keys are overwritten. Numeric keys are re-ordered.
	 * @param Framework_Collection_Collection $collection The collection from which to merge the contents.
	 * @throws Framework_Common_InvalidOperationException
	 */
	public function mergeFrom(Framework_Collection_Collection $collection)
	{
		if ($this->isReadOnly() === true)
		{
			throw new Framework_Common_InvalidOperationException("Collection is read only.");
		}

		$this->array = array_merge($this->array, $collection->array);
	}

	/**
	 * Merges the contents from this collection to the specified collection. Overlapping non-numeric keys are overwritten. Numeric keys are re-ordered.
	 * @param Framework_Collection_Collection $collection The collection to which to merge the contents from this collection.
	 */
	public function mergeTo(Framework_Collection_Collection $collection)
	{
		$collection->mergeFrom($this);
	}

	/**
	 * Move forward to the next element.
	 * @return mixed The value of the next element.
	 */
	public function next()
	{
		return next($this->array);
	}

	/**
	 * Move to the previous element.
	 * @return mixed The value of the previous element or false if the array is empty.
	 */
	public function previous()
	{
		return prev($this->array);
	}

	/**
	 * Prepare the object or array for serialization.
	 * @return mixed The prepared object or array.
	 */
	public function prepareJsonObject()
	{
		return $this->toNativeArray();
	}

	/**
	 * Removes the element with the specified key from the collection.
	 * @param mixed $key The key to delete.
	 * @throws Framework_Common_InvalidOperationException if key not found.
	 */
	public function remove($key)
	{
		if ($this->keyExists($key) === false)
		{
			throw new Framework_Common_InvalidOperationException("Key not found.");
		}

		unset($this->array[$key]);
	}

	/**
	 * Set the collection with elements in reverse order.
	 * @param bool $preserveKeys If set to true keys are preserved.
	 * @return mixed The collection with elements in reverse order.
	 */
	public function reverse($preserveKeys)
	{
		$this->array = array_reverse($this->array, $preserveKeys);
	}

	/**
	 * Rewind the collection to its first element.
	 */
	public function rewind()
	{
		reset($this->array);
	}

	/**
	 * Searches the array for the element and returns its key if found. Otherwise, null.
	 * @param mixed $element The element for which to search the array.
	 * @return mixed The key of the element if found, otherwise null.
	 */
	public function search($element)
	{
		$key = array_search($element, $this->array, true);

		return ($key === false ? null : $key);
	}

	/**
	 * Extract part of the Collection.
	 * @param integer $offset Start of slice
	 * @param integer $length Size to extract
	 * @return Framework_Collection_Array
	 */
	public function slice($offset, $length)
	{
		$clone = clone $this;

		// $length cannot be null due to a bug in PHP 5.1.6
		if ($length === null)
		{
			$length = count($clone->array);
		}

		$clone->array = array_slice($clone->array, $offset, $length, true);

		return $clone;
	}

	/**
	 * Sorts the collection. Items are compared using a callback
	 * @param Framework_Collection_ICompare $compare Compare object that implements a callback function.
	 * @throws Framework_Common_UnexpectedResultException on failure.
	 */
	public function sort(Framework_Collection_ICompare $compare)
	{
		if (uasort($this->array, array($compare, "compare")) === false)
		{
			throw new Framework_Common_UnexpectedResultException("Failed to sort the collection");
		}
	}

	/**
	 * Sorts the collection by key.
	 * @throws Framework_Common_UnexpectedResultException on failure.
	 */
	public function sortByKey()
	{
		if (ksort($this->array) === false)
		{
			throw new Framework_Common_UnexpectedResultException("Failed to sort the collection");
		}
	}

	/**
	 * Sorts the collection. Items are compared by value. Keys are preserved.
	 * @throws Framework_Common_UnexpectedResultException on failure.
	 */
	public function sortByValue()
	{
		if (asort($this->array) === false)
		{
			throw new Framework_Common_UnexpectedResultException("Failed to sort the collection");
		}
	}

	/**
	 * Returns the collection as a native PHP array.
	 * @return array The collection as a native PHP array.
	 */
	public function toNativeArray()
	{
		return $this->array;
	}

	/**
	 * Determines if the current index offset exists.
	 * @return bool Whether the current index offset exists.
	 */
	public function valid()
	{
		$key = key($this->array);

        return ($key !== null && $key !== false);
	}

	/**
	 * Determine whether the specified value exists
	 * @param string $name The value of which is to be determined whether it exists.
	 * @return bool Whether the specified value exists.
	 */
	public function valueExists($name)
	{
		return in_array($name, $this->array, true);
	}

	/**
	 * Get an array containing the keys of this collection.
	 * @return Framework_Collection_Array An array containing the keys of this collection.
	 */
	public function getKeys()
	{
		return new Framework_Collection_Array(array_keys($this->array));
	}

	/**
	 * Get the number of elements in the collection.
	 * @return int The number of elements in the collection.
	 */
	public function getLength()
	{
		return count($this->array);
	}
}