<?php
/**
 * 群體類別
 */
class Swarm
{
	// 粒子群
	private $_swarm = array();

	// 群體最佳粒子位置
	private $_globalBestPosition = array();

	// 群體最佳適應值
	private $_globalBestFitness = NULL;

	// 群體最佳值歷程
	private $_globalBestFitnessHistory = array();

	// 未改進次數
	private $_noProgressCount = 0;

	/**
	 * 建構子，產生粒子群體
	 */
	public function __construct()
	{
		// 產生粒子
		for ($i = 0; $i < PARTICLE_COUNT; $i++) {
			$this->_swarm[$i] = new Particle();
		}

		// 初始粒子群體最佳位置和群體最佳適應值
		$this->_initGlobalBest();
	}

	/**
	 * 更新粒子群速度
	 */
	public function updateParticleVelocity()
	{
		for ($i = 0; $i < PARTICLE_COUNT; $i++) {
			$this->_swarm[$i]->updateVelocity($this->_globalBestPosition);
		}
	}

	/**
	 * 計算粒子群適應值
	 */
	public function calculateParticleFitness()
	{
		$particleAverageFitness = array();
		for ($i = 0; $i < PARTICLE_COUNT; $i++) {
			$this->_swarm[$i]->calculateFitness();
		}
	}

	/**
	 * 套用粒子群速度
	 */
	public function applyParticleVelocity()
	{
		for ($i = 0; $i < PARTICLE_COUNT; $i++) {
			$this->_swarm[$i]->applyVelocity();
		}
	}

	/**
	 * 設定粒子群最佳解，將最佳解記錄到歷程中，設定是否有改進
	 */
	public function findGlobalBest()
	{
		$isProgress = false;
		for ($i = 0; $i < PARTICLE_COUNT; $i++) {
			$fitness[] = ceil($this->_swarm[$i]->getFitness());
			if ($this->_swarm[$i]->getFitness() < $this->_globalBestFitness) {
				$this->_globalBestPosition = $this->_swarm[$i]->getPosition();
				$this->_globalBestFitness = $this->_swarm[$i]->getFitness();
				$isProgress = true;
			}
		}

		if ($isProgress == true) {
			$this->restNoProgressCount();
		} else {
			$this->_noProgressCount++;
		}

		$this->_globalBestFitnessHistory[] = $this->_globalBestFitness;
	}

	/**
	 * 取得最佳適應值
	 */
	public function getBestFitness()
	{
		return $this->_globalBestFitness;
	}

	/**
	 * 取得最佳位置
	 */
	public function getBestPosition()
	{
		return $this->_globalBestPosition;
	}

	/**
	 * 取得粒子平均適應值
	 */
	public function getGlobalBestFitnessHistory()
	{
		return $this->_globalBestFitnessHistory;
	}

	/**
	 * 取得群體未改進迭代數
	 */
	public function getNoProgressCount()
	{
		return $this->_noProgressCount;
	}

	/**
	 * 重設群體未改進迭代數
	 */
	public function restNoProgressCount()
	{
		$this->_noProgressCount = 0;
	}

	/**
	 * 重新建立粒子速度，不重置群體最佳值
	 */
	public function resetVelocity($distinctionCount)
	{
		$this->_addExtinctionTag($distinctionCount);

		foreach ($this->_swarm as $particle) {
			$particle->resetVelocity();
		}
	}

	/**
	 * 重新建立粒子位置、速度，群體最佳值
	 */
	public function resetAll($distinctionCount)
	{
		$this->_addExtinctionTag($distinctionCount . '(大滅絕)');

		foreach ($this->_swarm as $particle) {
			$particle->__construct();
		}

		$this->_initGlobalBest();
	}

	/**
	 * 在紀錄中插入毀滅標誌
	 */
	private function _addExtinctionTag($distinctionCount)
	{
		$this->_globalBestFitnessHistory[] = array($distinctionCount);
	}

	/**
	 * 重新建立群體最佳適應值、最佳粒子
	 */
	private function _initGlobalBest()
	{
		$this->calculateParticleFitness();
		$this->_globalBestFitness = $this->_swarm[0]->getFitness();
		$this->findGlobalBest();
	}

}
?>