<?php
class SemOperationLock{
	private $_is_lock=false;
	
	private $_sem_key='';
	
	private $_sem_lock=null;
	
	public function __construct(){
		if (!function_exists('sem_get')) {
			throw new Exception('can`t use this kind of lock');
		}
		$this->_sem_key=ftok(__FILE__, 'a');
		$this->_sem_lock=sem_get($this->_sem_key,1);
	}
	
	public function lock(){
		if (sem_acquire($this->_sem_lock)) {
			$this->_is_lock=true;
		}
		return $this->_is_lock;
	}
	
	public function unlock(){
		if ($this->_is_lock===false||!$this->_sem_lock) {
			return true;
		}
		if (sem_release($this->_sem_lock)) {
			$this->_is_lock=false;
			return true;
		}
		return false;
	}
	
	public function isLock(){
		return $this->_is_lock;
	}
	
	public function __destruct(){
		sem_remove($this->_sem_lock);
	}
}