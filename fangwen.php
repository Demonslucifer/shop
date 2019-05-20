<?php 
$id = $_GET['key'];

function addFw($id){
$cache = include './cache.php';
if($cache->has('fw'.$id)){
	$cache->autoAdd('fw'.$id);
}else{
	$cache->save('fw'.$id,1);
}

echo $cache->get('fw'.$id);
}

addFw($id);
