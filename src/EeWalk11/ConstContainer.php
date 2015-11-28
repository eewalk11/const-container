<?php



namespace EeWalk11;

use ReflectionClass;



/**
 * A class extending this abstract class is a wrapper for class constants.
 */
abstract class ConstContainer
{



	/*
	 * PRIVATE STATIC VARIABLES
	 */




	/**
	 * @var array Contains class names as keys and arrays of class constants as values. This array
	 * is updated each time a sub-class' getConstants() function is called.
	 */
	private static $cache = [];



	/*
	 * PUBLIC STATIC FUNCTIONS
	 */



	/**
	 * Determine if a string matches one of the sub-class' constant names.
	 * @param string $name The name to check.
	 * @param boolean $strict True for a case-sensitive name check, false for a case-insensitive
	 * name check.<br>
	 * <i>(default = false)</i>
	 * @return boolean True if the string is a valid class constant name.
	*/
	public static function isValidName($name, $strict = false)
	{
		$keys = array_keys(self::getConstants());
		if(!$strict)
		{
			$name = strtolower($name);
			$keys = array_map("strtolower", $keys);
		}
		return in_array($name, $keys);
	}



	/**
	 * Determine if a value matches one of the sub-class' class constant values.
	 * @param mixed $val The value to check.
	 * @param boolean $strict True for a strict value check.<br>
	 * <i>(default = false)</i>
	 * @return boolean If the value is a valid class constant.
	 */
	public static function isValidValue($val, $strict = false)
	{
		return in_array($val, self::getConstants(), $strict);
	}



	/**
	 * Get an array of the sub-class' constants.
	 * @return array An array of class constants. The constant name is the array key, the constant
	 * value is the array value.
	 */
	public static function getConstants()
	{
		$called = get_called_class();
		if(!array_key_exists($called, self::$cache))
		{
			$ref = new ReflectionClass($called);
			self::$cache[$called] = $ref->getConstants();
		}
		return self::$cache[$called];
	}



	/**
	 * Get a constant's name from its value.
	 * <p>This function will only work properly if each constant has a unique value. If the value
	 * matches more than one constant, the first will be returned.</p>
	 * @param mixed $val The value to get a name for.
	 * @param boolean $strict True for a strict value comparison.<br>
	 * <i>(default = false)</i>
	 * @return string A constant name, false if the value is invalid.
	 */
	public static function getName($val, $strict = false)
	{
		return array_search($val, self::getConstants(), $strict);
	}



	/**
	 * Get a constant's value from its name.
	 * @param string $name The constant name.
	 * @param boolean $strict True for a case-sensitive name comparison, false for a
	 * case-insensitive name comparison.<br>
	 * <i>(default = false)</i>
	 * @return mixed A constant value, false if the name is invalid.
	 */
	public static function getValue($name, $strict = false)
	{
		$consts = self::getConstants();
		if(!$strict)
		{
			$name = strtolower($name);
			$consts = array_change_key_case($consts);
		}
		return array_key_exists($name, $consts) ? $consts[$name] : false;
	}



}


