<?php
/**
 * 以粒子群最佳化演算法（Particle swarm optimization）解決旅行商問題（Travelling salesman problem）
 * 程式作者：康家豪
 */
require_once 'Particle.php';
require_once 'Swarm.php';

// 旅行點數量
define('__PONIT_MAX__', 17);

// 粒子數量
define('__SWARM_COUNT__', 5);

// 演算迭代量
define('__ITER__COUNT', 50);

// 產生隨機旅行點
for ($i = 0; $i < __PONIT_MAX__; $i++) {
	$GLOBALS['travelPoints'][$i] = array(
		'0' => mt_rand(-300, 300),
		'1' => mt_rand(-300, 300),
		'e' => ''
	);
}

// 初始粒子群，開始進行計算
$swarm = new Swarm(__SWARM_COUNT__);
for ($i = 0; $i < __ITER__COUNT; $i++) {
	$swarm->calculateParticleFitness();
	$swarm->findGlobalBest();
	$swarm->updateParticleVelocity();
	$swarm->applyParticleVelocity();
}

// 設定樣板資料（最佳路徑長度、路徑順序）
$routeLength = $swarm->getBestFitness();
$route = $swarm->getBestPosition();
ksort($route);
$route = json_encode($route);

// 進行旅行點座標轉換
foreach ($GLOBALS['travelPoints'] as $p) {
	$p[0] += 340;
	$p[1] = -($p[1] - 340);
	$points[] = $p;
}
$points = json_encode($points);

// 載入顯示樣板
require 'template.php';
?>