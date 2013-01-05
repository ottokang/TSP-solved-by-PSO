<?php
require_once 'Particle.php';
require_once 'Swarm.php';

/**
 * 以PSO計算TSP
 */

// 旅行點數量
define('__PONIT_MAX__', 7);

// 粒子數量
define('__SWARM_COUNT__', 5);

// 演算迭代量
define('__ITER__COUNT', 50);

// 產生旅行點
for ($i = 0; $i < __PONIT_MAX__; $i++) {
	$GLOBALS['travelPoints'][$i] = array(
		mt_rand(-150, 150),
		mt_rand(-150, 150)
	);
}

// 初始粒子群
$swarm = new Swarm(__SWARM_COUNT__);

// 開始演算
for ($i = 0; $i < __ITER__COUNT; $i++) {
	$swarm->calculateParticleFitness();
	$swarm->findGlobalBest();
	$swarm->updateParticleVelocity();
	$swarm->applyParticleVelocity();

	echo '<' . $swarm->getResult() . '>';
	echo "<br />";
}

// 載入顯示樣板
require 'template.html';
?>