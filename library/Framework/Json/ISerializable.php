<?php
interface Framework_Json_ISerializable
{
	/**
	 * Creates a serializable object.
	 * @returns stdClass The serializable object.
	 */
	public function serialize();
}
