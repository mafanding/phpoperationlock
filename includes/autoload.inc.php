<?php
class Autoload{
	public static function autoloadCore($class){
		$path=__DIR__.'/core/'.$class.'.class.php';
		if (file_exists($path)) {
			include $path;
		}
	}
	
	public static function autoloadClass($class){
		$path=__DIR__.'/core/classes/'.$class.'.php';
		if (file_exists($path)) {
			include $path;
		}
	}
}

spl_autoload_register('Autoload::autoloadCore');
spl_autoload_register('Autoload::autoloadClass');