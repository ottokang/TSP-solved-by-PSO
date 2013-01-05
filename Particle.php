<?php
/**
 * 粒子類別
 */
class Particle
{
	// 粒子的位置（解）
	private $position = array();

	// 粒子速度
	private $velocity = array();

	// 粒子適應值
	private $fitness = NULL;

	// 粒子個體最佳位置
	private $particleBestPostion = array();

	// 粒子個體最佳適應值
	private $particleBestFitness = NULL;

	// 產生初始粒子和速度
	public function __construct()
	{
		// 產生初始粒子
		$this->position = range(0, __PONIT_MAX__ - 1);
		shuffle($this->position);

		// 建立速度
		for ($i = 0; $i < __PONIT_MAX__; $i++) {
			$this->velocity[$i] = mt_rand(-6, 6);
		}

		// 建立初始粒子適應值以及粒子個體最佳適應值
		$this->calculateFitness();
		$this->particleBestFitness = $this->fitness;
	}

	public function getPosition()
	{
		return $this->position;
	}

	public function getFitness()
	{
		return $this->fitness;
	}

	public function setPostion($position)
	{
		$this->position = $position;
	}

	/**
	 * 更新速度
	 */
	public function updateVelocity($globalBestPosition)
	{
		// 設定速度更新參數
		$w = 0.4;
		$c1 = 2;
		$c2 = 2;
		$r1 = mt_rand(0, 100) / 100;
		$r2 = mt_rand(0, 100) / 100;

		// 計算粒子和粒子最佳值以及群體最佳值距離
		$particleDistances = $this->_calculateDistances($this->position, $this->particleBestPostion);
		$globalDistances = $this->_calculateDistances($this->position, $globalBestPosition);

		// 更新速度
		for ($i = 0; $i < __PONIT_MAX__; $i++) {
			$this->velocity[$i] = $w * $this->velocity[$i] + c1 * r1 * $particleDistances[$i] + c1 * r1 * $globalDistances[$i];
		}
	}

	/**
	 * 套用速度
	 */
	public function applyVelocity()
	{

		for ($i = 0; $i < Particle::ARRAY_SIZE; $i++) {
			$this->position[$i] += $this->velocity[$i];

			// 限定粒子範圍
			if ($this->position[$i] < $this->range[$i]['min']) {
				$this->position[$i] = $this->range[$i]['min'];
			} elseif ($this->position[$i] > $this->range[$i]['max']) {
				$this->position[$i] = $this->range[$i]['max'];
			}
		}
	}

	/**
	 * 計算適應值
	 */
	public function calculateFitness()
	{
		// 計算各點之間的距離
		for ($i = 0; $i < __PONIT_MAX__ - 1; $i++) {
			$x2 = pow($GLOBALS['travelPoints'][$this->position[$i]][0] - $GLOBALS['travelPoints'][$this->position[$i + 1]][0], 2);
			$y2 = pow($GLOBALS['travelPoints'][$this->position[$i]][1] - $GLOBALS['travelPoints'][$this->position[$i + 1]][1], 2);
			$this->fitness += sqrt($x2 + $y2);
		}

		// 加上尾端到起始點的距離
		$x2 = pow($GLOBALS['travelPoints'][0][0] - $GLOBALS['travelPoints'][__PONIT_MAX__][0], 2);
		$y2 = pow($GLOBALS['travelPoints'][0][1] - $GLOBALS['travelPoints'][__PONIT_MAX__][1], 2);
		$this->fitness += sqrt($x2 + $y2);

		// 判斷是否為個體最佳值
		if ($this->particleBestFitness > $this->fitness) {
			$this->particleBestPostion = $this->position;
			$this->particleBestFitness = $this->fitness;
		}
	}

	/**
	 * 計算粒子位置間距離
	 */
	private function _calculateDistances($array1, $array2)
	{
		$result = array();
		for ($i = 0; $i < __PONIT_MAX__; $i++) {
			$result[$i] = array_search($array1[$i], $array2) - $i;
		}

		return $result;
	}

}
?>