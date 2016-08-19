<?php
class OperationLock{

	private static $_instance;

	public static function getInstance(){	
		if (!is_null(self::$_instance)) {
			return self::$_instance;
		}
		$args=func_get_args();
		$class=array_shift($args);
		$class=ucfirst($class).'OperationLock';
		if (class_exists($class)) {
			self::$_instance=new $class($args);
			return self::$_instance;
		}else{
			throw new Exception('instance '.$class.' failed');
		}
	}
}