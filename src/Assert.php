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
	static function isEnum($value, array $allowed) {
		if(!in_array($value, $allowed)) {
			throw new InvalidArgumentException("value ".$value." outside of set of allowed values (".implode(", ", $allowed).")");
		}
	}
	
	static function isClassConstant($class, $value, string $parameterName=NULL) {
		$reflection = new ReflectionClass($class);
		$constants = $reflection->getConstants();
		if(!in_array($value, $constants)) {
			if($parameterName==NULL) {
				$message = "value ".$value." not a class constant, allowed values are ";
			} else {
				$message = "\$".$parameterName." not a class constant, allowed values are ";
			}
			$allowed = array();
			foreach($constants as $key => $value) {
				$allowed[] = $class."::".$key;
			}
			$message .= implode(", ", $allowed);
			throw new InvalidArgumentException($message);
		}
	}
}
