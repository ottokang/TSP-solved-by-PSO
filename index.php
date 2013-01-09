<?php
/**
 * 以粒子群最佳化演算法（Particle swarm optimization）解決旅行商問題（Travelling salesman problem）
 * 程式作者：康家豪
 */
require_once 'Particle.php';
require_once 'Swarm.php';

// 旅行點數量
define('POINT_MAX', 52);

// 粒子數量
define('PARTICLE_COUNT', 30);

// 演算迭代量
define('ITERATION_COUNT', 20);

// 毀滅次數
define('DISTICNTION_COUNT', 10);

// 繪圖區padding
define('PAINT_SIZE', 600);

// 繪圖區padding
define('PAINT_PADDING', 40);

// 判斷是否產生新的旅行點產生隨機旅行點
if ($_POST['isGenerateNewPoints'] == 1 || count($_POST) == 0) {
    for ($i = 0; $i < POINT_MAX; $i++) {
        $GLOBALS['travelPoints'][$i] = array(
            '0' => mt_rand(0, 600),
            '1' => mt_rand(0, 600),
            'e' => ''
        );
    }
} else {
    $GLOBALS['travelPoints'] = $_POST['pointsInput'];
}

// 將旅行點資料寫入為<Input>
for ($i = 0; $i < count($GLOBALS['travelPoints']); $i++) {
    $pointInputData .= '<input type="hidden" name="pointsInput[' . $i . '][0]" value="' . $GLOBALS['travelPoints'][$i][0] . '" />';
    $pointInputData .= '<input type="hidden" name="pointsInput[' . $i . '][1]" value="' . $GLOBALS['travelPoints'][$i][1] . '" />';
    $pointInputData .= '<input type="hidden" name="pointsInput[' . $i . '][e]" value="" />';
}

// TEST
require 'berlin52.php';
$GLOBALS['travelPoints'] = $tspData;

//$scale = 1;

// 初始粒子群，開始進行計算，取得最佳結果
$result = array();
$swarm = new Swarm();
for ($d = 0; $d < DISTICNTION_COUNT; $d++) {

    if ($d > 0) {
        $swarm->resetAll();
    }

    for ($i = 0; $i < ITERATION_COUNT; $i++) {               
        $swarm->updateParticleVelocity();
        $swarm->applyParticleVelocity();
        $swarm->calculateParticleFitness();
        $swarm->findGlobalBest();
    }

    if ($d == 0 || $swarm->getBestFitness() < $result[fitness]) {
        $result[fitness] = $swarm->getBestFitness();
        $result[position] = $swarm->getBestPosition();
    }
}

// 設定樣板資料（最佳路徑長度、路徑順序、平均適應值歷史資料）
$routeLength = round($result[fitness], 2);
$route = $result[position];
ksort($route);
$route = json_encode($route);
$fitnessHistory = $swarm->getFitnessHistory();

// 進行旅行點座標轉換、縮放
foreach ($GLOBALS['travelPoints'] as $p) {
    $p[0] = ($p[0]* $scale) + PAINT_PADDING ;
    $p[1] = PAINT_SIZE + PAINT_PADDING - ($p[1] * $scale);
    $points[] = $p;
}
$points = json_encode($points);

// 載入顯示樣板
require 'template.php';
?>