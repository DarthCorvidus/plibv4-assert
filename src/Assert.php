<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Assert
 *
 * @author hm
 */
class Assert {
	static function isEnum($value, array $allowed): void {
		if(!in_array($value, $allowed, TRUE)) {
			throw new InvalidArgumentException("value ".$value." outside of set of allowed values (".implode(", ", $allowed).")");
		}
	}
	
	static function isClassConstant(string $class, mixed $value, string $parameterName=NULL): void {
		$reflection = new ReflectionClass($class);
		$constants = $reflection->getConstants();
		if(!in_array($value, $constants, TRUE)) {
			if($parameterName==NULL) {
				$message = "value '".$value."' not a class constant of ".$class.", allowed values are ";
			} else {
				$message = "\$".$parameterName." not a class constant of ".$class.", allowed values are ";
			}
			$allowed = array();
			foreach($constants as $key => $value) {
				$allowed[] = $class."::".$key;
			}
			$message .= implode(", ", $allowed);
			throw new InvalidArgumentException($message);
		}
	}
	
	static function fileExists(string $value): void {
		if(!file_exists($value)) {
			throw new InvalidArgumentException("filename ".$value." does not exist");
		}
	}
	
	static function isFile(string $value): void {
		if(!is_file($value)) {
			throw new InvalidArgumentException($value." is not a file");
		}
	}
	
	static function isDir(string $value):void {
		if(!is_dir($value)) {
			throw new InvalidArgumentException($value." is not a directory");
		}
	}

}
