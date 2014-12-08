<?php
abstract class Framework_Json_Serializer
{
	public static function serialize($object)
	{
		if ($object instanceof Framework_Collection_Array)
		{
			return self::serializeArray($object);
		}
	}

	private static function serializeArray(Framework_Collection_Array $array)
	{
		$serializeAbleArray = array();

		foreach ($array as $key => $item)
		{
			if ($item instanceof Framework_Json_ISerializable)
			{
				$serializeAbleArray[$key] = $item->serialize();
			}
			else
			{
				$serializeAbleArray[$key] =  $item;
			}
		}

		return json_encode($serializeAbleArray);
	}
}
