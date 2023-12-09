<?php
declare(strict_types=1);
use PHPUnit\Framework\TestCase;
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

	function testAssertEnumType() {
		$value = "four";
		$enum = array(0, 1, 2, 3, 4);
		$this->expectException(InvalidArgumentException::class);
		Assert::isEnum($value, $enum);
	}
	
	function testAssertClassConstant() {
		$this->assertEquals(NULL, Assert::isClassConstant("AssertTest", 1));
	}

	function testAssertNotClassConstant() {
		$this->expectException(InvalidArgumentException::class);
		Assert::isClassConstant("AssertTest", 15);
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
