# phpoperationlock
php操作锁类，为了实现原子操作，有三种方法可以使用file，memcache，sem。
使用方法：
include 'operationlock.php';
$lock=new OperationLock('file');
$re=$lock->lock();
if($re){
  do something
  $lock->unlock();
}
