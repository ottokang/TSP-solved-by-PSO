<?php
/**
 * 群體類別
 */
class Swarm
{
	// 粒子數量
	private $_particleCount;

	// 粒子群
	private $_swarm = array();

	// 群體最佳粒子位置
	private $_globalBestPosition = array();

	// 群體最佳適應值
	private $_globalBestFitness = NULL;

	// 群體平均適應值歷程
	private $_fitnessHistory = array();

	/**
	 * 建構子，產生粒子群體
	 */
	public function __construct($particleCount)
	{
		// 產生運算粒子
		$this->_particleCount = $particleCount;
		for ($i = 0; $i < $this->_particleCount; $i++) {
			$this->_swarm[$i] = new Particle();
		}

		// 設定第一個點為初始粒子群體最佳位置和群體最佳適應值
		$this->_swarm[0]->calculateFitness();
		$this->_globalBestPosition = $this->_swarm[0]->getPosition();
		$this->_globalBestFitness = $this->_swarm[0]->getFitness();
	}

	/**
	 * 更新粒子群速度
	 */
	public function updateParticleVelocity()
	{
		for ($i = 0; $i < $this->_particleCount; $i++) {
			$this->_swarm[$i]->updateVelocity($this->_globalBestPosition);
		}
	}

	/**
	 * 計算粒子群適應值，儲存本次粒子群的適應值平均
	 */
	public function calculateParticleFitness()
	{
		$particleAverageFitness = array();
		for ($i = 0; $i < $this->_particleCount; $i++) {
			$this->_swarm[$i]->calculateFitness();
			$particleAverageFitness[] = $this->_swarm[$i]->getFitness();
		}

		$this->_fitnessHistory[] = round((array_sum($particleAverageFitness) / $this->_particleCount), 2);
	}

	/**
	 * 套用粒子群速度
	 */
	public function applyParticleVelocity()
	{
		for ($i = 0; $i < $this->_particleCount; $i++) {
			$this->_swarm[$i]->applyVelocity();
		}
	}

	/**
	 * 設定粒子群最佳解
	 */
	public function findGlobalBest()
	{
		for ($i = 0; $i < $this->_particleCount; $i++) {
			$fitness[] = ceil($this->_swarm[$i]->getFitness());
			if ($this->_swarm[$i]->getFitness() < $this->_globalBestFitness) {
				$this->_globalBestPosition = $this->_swarm[$i]->getPosition();
				$this->_globalBestFitness = $this->_swarm[$i]->getFitness();
			}
		}
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
	public function getFitnessHistory()
	{
		return $this->_fitnessHistory;
	}

	/**
	 * 重新建立粒子速度
	 */
	public function resetVelocity()
	{
		foreach ($this->_swarm as $particle) {
			$particle->resetVelocity();
		}
	}

	/**
	 * 重新建立粒子位置、速度
	 */
	public function resetAll()
	{
		foreach ($this->_swarm as $particle) {
			$particle->__construct();
		}
	}

	/**
	 * 取得所有粒子（除錯用）
	 */
	public function getParticles()
	{
		foreach ($this->_swarm as $particle) {
			$result[] = $particle->getPosition();
		}

		return $result;
	}

}
?>