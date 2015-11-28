<?php



require_once(__DIR__ . "/../src/EeWalk11/ConstContainer.php");

use EeWalk11\ConstContainer;



class ClassA extends ConstContainer
{
	const CONST1 = 1;
	const CONST2 = 2;
	const CONST3 = 3;
}

class ClassAA extends ClassA
{
	const CONST4 = 4;
	const CONST5 = 5;
	const CONST6 = 6;
}

class ClassB extends ConstContainer
{
	const STR1 = "test";
	const STR2 = "string";
}



if(true)
{
	$consts = ClassA::getConstants();
	$expected = [
		"CONST1" => 1,
		"CONST2" => 2,
		"CONST3" => 3
	];
	if(array_diff($consts, $expected) || array_diff($expected, $consts))
	{
		throw new Exception();
	}
}

if(true)
{
	$consts = ClassAA::getConstants();
	$expected = [
		"CONST1" => 1,
		"CONST2" => 2,
		"CONST3" => 3,
		"CONST4" => 4,
		"CONST5" => 5,
		"CONST6" => 6
	];
	if(array_diff($consts, $expected) || array_diff($expected, $consts))
	{
		throw new Exception();
	}
}

if(true)
{
	$consts = ClassB::getConstants();
	$expected = [
		"STR1" => "test",
		"STR2" => "string"
	];
	if(array_diff($consts, $expected) || array_diff($expected, $consts))
	{
		throw new Exception();
	}
}



if(ClassAA::getName("3") !== "CONST3")
{
	throw new Exception();
}

if(ClassA::getName("1", true) !== false)
{
	throw new Exception();
}

if(ClassA::getName(1, true) !== "CONST1")
{
	throw new Exception();
}



if(ClassA::getValue("CONST5") !== false)
{
	throw new Exception();
}

if(ClassB::getValue("stR1", false) !== "test")
{
	throw new Exception();
}

if(ClassB::getValue("stR1", true) !== false)
{
	throw new Exception();
}

if(ClassB::getValue("STR1", true) !== "test")
{
	throw new Exception();
}




if(ClassB::isValidName("CONST1"))
{
	throw new Exception();
}

if(!ClassA::isValidName("const1"))
{
	throw new Exception();
}

if(ClassAA::isValidName("const1", true))
{
	throw new Exception();
}

if(!ClassAA::isValidName("CONST1", true))
{
	throw new Exception();
}



if(!ClassAA::isValidValue("5", false))
{
	throw new Exception();
}

if(ClassAA::isValidValue("5", true))
{
	throw new Exception();
}

if(!ClassAA::isValidValue(5, true))
{
	throw new Exception();
}



echo "All tests successful!\n";


