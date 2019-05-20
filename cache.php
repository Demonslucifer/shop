<?php 
class cache{
	private $mem = null;
	public function __construct(string $host,int $port){
		$this->connect($host,$port);
	}
	private function connect(string $host,int $port){
		if(extension_loaded('memcached')){
			$mem = new memcached();
		}else{
			$mem = new Memcache();
		}
		$mem->addServer($host,$port);
		$this->mem = $mem;
	}
	public function save(string $key,$value,int $expire=3600):void {
		if(extension_loaded('memcached')){
			$this->mem->set($key,$value,$expire);
			$this->mem->set('id',1,$expire);
			// $this->mem->increment('id');
		}else{
			$this->mem->set($key,$value,MEMCACHE_COMPRESSED,$expire);
			$this->mem->set('id',1,MEMCACHE_COMPRESSED,$expire);
			// $this->mem->increment('id');
		}
		return;
	}
	public function get(string $key,string $default = '值为空'){
		// $this->mem->increment('id');
		return $this->mem->get($key) ? $this->mem->get($key) : $default;
	}
	public function autoAdd(string $key){
		$this->mem->increment($key);
	}

	public function has (string $key){
		return $this->mem->get($key) ? true : false;
	}
	public function del (string $key): void{
		$this->mem->delete($key);
		return;
	}
}
return new cache('127.0.0.1',11211);