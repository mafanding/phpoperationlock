<?php
class FileOperationLock{
	const FILE_LOCK='php_lock.sock';
	
	private $_is_lock=false;
	
	private $_fp=null;
	
	public function lock(){
		if ($this->_is_lock!==false) {
			return false;
		}
		if (!$this->_fp=fopen(self::FILE_LOCK, 'w+b')){
			return $this->_is_lock;
		}
		if (flock($this->_fp, LOCK_EX)) {
			$this->_is_lock=true;
		}
		return $this->_is_lock;
	}
	
	public function unlock(){
		if ($this->_is_lock===false||!$this->_fp) {
			return true;
		}
		flock($this->_fp,LOCK_UN);
		$this->_is_lock=false;
		fclose($this->_fp);
		return true;
	}
	
	public function isLock(){
		return $this->_is_lock;
	}
}