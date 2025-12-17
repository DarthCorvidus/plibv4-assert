<?php
namespace plibv4\assert;
use InvalidArgumentException;
use ReflectionClass;

/**
 * Description of Assert
 *
 * @author hm
 */
final class Assert {
	/**
	 * 
	 * @param mixed $value
	 * @param list<mixed> $allowed
	 * @return void
	 * @throws InvalidArgumentException
	 */
	static function isEnum(mixed $value, array $allowed): void {
		if(!in_array($value, $allowed, TRUE)) {
			/**
			 * @psalm-suppress MixedArgumentTypeCoercion
			 */
			throw new InvalidArgumentException("value ".(string)$value." outside of set of allowed values (".implode(", ", $allowed).")");
		}
	}
	
	static function isClassConstant(string $class, mixed $value, string $parameterName=NULL): void {
		/**
		 * @psalm-suppress ArgumentTypeCoercion
		 */
		$reflection = new ReflectionClass($class);
		$constants = $reflection->getConstants();
		if(!in_array($value, $constants, TRUE)) {
			if($parameterName==NULL) {
				$message = "value '".(string)$value."' not a class constant of ".$class.", allowed values are ";
			} else {
				$message = "\$".$parameterName." not a class constant of ".$class.", allowed values are ";
			}
			$allowed = array();
			foreach(array_keys($constants) as $value) {
				$allowed[] = $class."::".$value;
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
	
	static function isDir(string $value): void {
		if(!is_dir($value)) {
			throw new InvalidArgumentException($value." is not a directory");
		}
	}

}
