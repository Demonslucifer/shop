<?php 
$db = include './pdo.php';
$cache = include './cache.php';
$data = [];
$key = 'new_1';
if($cache->has($key)){
	echo '有缓存';
	$data = $cache->get($key);
	echo $cache->get('id');
	if($cache->get('id')>9){
		$cache->del($key);
		$cache->del('id');

	}else{
		$cache->autoAdd('id');
	}

}else{
	echo '木有啊';
	$sql = "select * from news limit 10";
	$data = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
	$cache->save($key,$data);

}
// echo '<pre>';
// print_r($data);exit;
echo "<hr>";


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>嘿嘿嘿</title>
</head>
<body>
	<ul>
		<?php foreach ($data as $key => $value):?>
		<li>
			<a href="fangwen.php?key=<?php echo $key?>"><?php echo $value['news_title']?></a>
		</li>
		<?php endforeach; ?>
	</ul>
</body>
</html>