<?php
class MemcacheOperationLock {
	
	private $_is_lock=false;
	
	private $_memcache=null;
	
	public function __construct($configs){
		if (extension_loaded('memcache')) {
			$this->_memcache=new Memcache();
			if(!$this->_memcache->connect($configs[0],$configs[1])){
				throw new Exception('can`t connect to memcache server');
			}
		}else{
			throw new Exception('extension memcache not loaded');
		}
	}
	
	public function lock(){
		if ($this->_is_lock!==false) {
			return false;
		}
		if ($this->_memcache->add('php_lock_key',1,false,0)){
			$this->_is_lock=true;
		}else{
			return false;
		}
		return $this->_is_lock;
	}
	
	public function unlock(){
		if ($this->_is_lock===false||!$this->_memcache) {
			return true;
		}
		$this->_memcache->delete('php_lock_key');
		$this->_is_lock=false;
		$this->_memcache->close();
		return true;
	}
	
	public function isLock(){
		return $this->_is_lock;
	}
}