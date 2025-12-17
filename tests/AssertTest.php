<?php
declare(strict_types=1);

namespace plibv4\assert;
use PHPUnit\Framework\TestCase;
use InvalidArgumentException;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AssertTest
 *
 * @author hm
 */
class AssertTest extends TestCase {
	const TEST0 = 0;
	const TEST1 = 1;
	const TEST2 = 2;
	function testAssertEnumValid() {
		$value = 1;
		$enum = array(1, 2, 3, 4);
		$this->assertEquals(NULL, Assert::isEnum($value, $enum));
	}
	
	function testAssertEnumInvalid() {
		$value = 5;
		$enum = array(1, 2, 3, 4);
		$this->expectException(InvalidArgumentException::class);
		Assert::isEnum($value, $enum);
	}
	/**
	 * loose comparison may cast the string "four" to int 0, if strict 
	 * comparison is not used on in_array; this behaviour is changed
	 * since PHP 8.
	 */
	function testAssertEnumType() {
		$value = "four";
		$enum = array(0, 1, 2, 3, 4);
		$this->expectException(InvalidArgumentException::class);
		Assert::isEnum($value, $enum);
	}
	
	function testAssertClassConstant() {
		$this->assertEquals(NULL, Assert::isClassConstant(self::class, 1));
	}
	
	function testAssertNotClassConstant() {
		$this->expectException(InvalidArgumentException::class);
		Assert::isClassConstant(self::class, 15);
	}

	/**
	 * Same as testAssertEnumType
	 */
	function testAssertClassConstantType() {
		$this->expectException(InvalidArgumentException::class);
		$this->expectExceptionMessage("value 'four' not a class constant of plibv4\assert\AssertTest, allowed values are plibv4\assert\AssertTest::TEST0, plibv4\assert\AssertTest::TEST1, plibv4\assert\AssertTest::TEST2");
		$this->assertEquals(NULL, Assert::isClassConstant(AssertTest::class, "four"));
	}
	
	function testAssertFileExists() {
		$this->assertEquals(NULL, Assert::fileExists(__DIR__));
	}

	function testAssertFileDoesNotExists() {
		$this->expectException(InvalidArgumentException::class);
		Assert::fileExists("testing");
	}

	function testAssertIsFile() {
		$this->assertEquals(NULL, Assert::isFile(__DIR__."/AssertTest.php"));
	}

	function testAssertIsNoFile() {
		$this->expectException(InvalidArgumentException::class);
		Assert::isFile(__DIR__);
	}

	function testAssertIsDir() {
		$this->assertEquals(NULL, Assert::isDir(__DIR__));
	}

	function testAssertIsNoDir() {
		$this->expectException(InvalidArgumentException::class);
		Assert::isDir(__DIR__."/AssertTest.php");
	}

}
