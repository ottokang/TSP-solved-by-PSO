<?php
/**
 * 以粒子群最佳化演算法（Particle swarm optimization）解決旅行商問題（Travelling salesman problem）
 * 程式作者：康家豪
 */
require_once 'Particle.php';
require_once 'Swarm.php';

// 最大允許執行時間
set_time_limit(3600);

// 繪圖區大小
define('PAINT_SIZE', 800);

// 繪圖區邊界距離
define('PAINT_PADDING', 40);

if ($_POST) {
    // 設定開始時間
    $timeStart = microtime(true);

    // 粒子數量
    define('PARTICLE_COUNT', $_POST['particleCount']);

    // 演算迭代量
    define('ITERATION_COUNT', $_POST['iterationCount']);

    // 最大未改進迭代數
    define('MAX_NO_PROGRESS_ITERATION_COUNT', $_POST['maxNoProgressIterationCount']);

    // 速度重置（毀滅）次數
    define('EXTINCTION_COUNT', $_POST['extinctionCount']);

    // 最大未改進速度重置（毀滅）次數
    define('MAX_NO_PROGRESS_EXTINCTION_COUNT', $_POST['maxNoProgressExtinctionCount']);

    // 判斷資料來源
    if ($_POST['dataSource'] == 'custom') {

        // 旅行點數量
        define('POINT_MAX', $_POST['travelPointCount']);

        // 設定圖形縮放
        $scale = 1;

        // 判斷是否產生新的旅行點產生隨機旅行點
        if ($_POST['isGenerateNewPoints'] == 1 || count($_POST['pointsInput']) == 0) {
            for ($i = 0; $i < POINT_MAX; $i++) {
                $x = mt_rand(0, 600);
                $y = mt_rand(0, 600);
                $GLOBALS['travelPoints'][$i] = array(
                    '0' => $x,
                    '1' => $y,
                    'coordinate' => "($x, $y)"
                );
            }
        } else {
            // 用上一次的旅行點來運算
            $GLOBALS['travelPoints'] = $_POST['pointsInput'];
        }

        // 將旅行點資料寫入為<Input>，作為再次演算用
        for ($i = 0; $i < count($GLOBALS['travelPoints']); $i++) {
            $pointInputData .= '<input type="hidden" name="pointsInput[' . $i . '][0]" value="' . $GLOBALS['travelPoints'][$i][0] . '" />';
            $pointInputData .= '<input type="hidden" name="pointsInput[' . $i . '][1]" value="' . $GLOBALS['travelPoints'][$i][1] . '" />';
            $pointInputData .= '<input type="hidden" name="pointsInput[' . $i . '][coordinate]" value="' . $GLOBALS['travelPoints'][$i][coordinate] . '" />';
        }
    } elseif ($_POST['dataSource'] == 'berlin52') {
        // 使用berlin52為資料
        require 'data/berlin52.php';
        $GLOBALS['travelPoints'] = $tspData;
        define('POINT_MAX', count($tspData));
    } elseif ($_POST['dataSource'] == 'eil76') {
        // 使用eil76為資料
        require 'data/eil76.php';
        $GLOBALS['travelPoints'] = $tspData;
        define('POINT_MAX', count($tspData));
    }

    // 判斷是否直接顯示最佳結果
    $result = array();
    if ($_POST['isShowBest'] == 1) {
        $particle = new Particle($bestOrder);
        $particle->calculateFitness();
        $result[position] = $bestOrder;
        $result[fitness] = $particle->getFitness();
    } else {
        // 或者進行計算
        $swarm = new Swarm();
        $noProgressExtinction = 0;
        $massExtinctionCount = 0;

        for ($extinction = 0; $extinction <= EXTINCTION_COUNT; $extinction++) {
            // 進行粒子毀滅，判斷是否在沒有改進的毀滅次數到達一定程度後，進行大滅絕（位置重置）
            if ($extinction > 0 && $noProgressExtinction < MAX_NO_PROGRESS_EXTINCTION_COUNT) {
                $swarm->resetVelocity($extinction);
                $swarm->restNoProgressCount();
            } elseif ($extinction > 0 && $noProgressExtinction > MAX_NO_PROGRESS_EXTINCTION_COUNT - 1) {
                $swarm->resetAll($extinction);
                $swarm->restNoProgressCount();
                $noProgressExtinction = 0;
                $massExtinctionCount++;
            }

            // 進行粒子群演算
            for ($i = 0; $i < ITERATION_COUNT; $i++) {
                $swarm->updateParticleVelocity();
                $swarm->applyParticleVelocity();
                $swarm->calculateParticleFitness();
                $swarm->findGlobalBest();
                // 檢查是否要提前結束運算
                if ($swarm->getNoProgressCount() > MAX_NO_PROGRESS_ITERATION_COUNT) {
                    $swarm->restNoProgressCount();
                    break;
                }
            }

            // 紀錄最佳結果
            if ($extinction == 0 || $swarm->getBestFitness() < $result[fitness]) {
                $result[fitness] = $swarm->getBestFitness();
                $result[position] = $swarm->getBestPosition();
                $noProgressExtinction = 0;
            } else {
                $noProgressExtinction++;
            }
        }
        // 紀錄最佳適應值歷史資料
        $fitnessHistory = $swarm->getGlobalBestFitnessHistory();
    }

    // 設定樣板資料（最佳路徑長度、路徑順序）
    $routeLength = round($result[fitness], 2);
    $route = $result[position];
    ksort($route);
    $route = json_encode($route);

    // 進行旅行點座標轉換、縮放
    foreach ($GLOBALS['travelPoints'] as $p) {
        $p[0] = ($p[0] * $scale) + PAINT_PADDING;
        $p[1] = ($p[1] * $scale) + PAINT_PADDING;
        $points[] = $p;
    }
    $points = json_encode($points);

    // 設定結束時間、記憶體用量
    $executeTime = round((microtime(true) - $timeStart), 2);
    $memoryUsage = round((memory_get_peak_usage(true) / 1024), 2);
}
// 載入顯示樣板
require 'template.php';
?>