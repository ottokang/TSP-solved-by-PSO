<?php
/**
 * 群體類別
 */
class Swarm
{
    // 粒子數量
    private $particleCount;

    // 粒子群
    private $swarm = array();

    // 群體最佳粒子位置
    private $globalBestPosition;

    // 群體最佳適應值
    private $globalBestFitness = NULL;

    /**
     * 建構子，產生粒子群體
     */
    public function __construct($particleCount)
    {
        // 產生運算粒子
        $this->particleCount = $particleCount;
        for ($i = 0; $i < $this->particleCount; $i++) {
            $this->swarm[$i] = new Particle();
        }

        // 設定第一個點為初始粒子群體最佳位置和群體最佳適應值
        $this->swarm[0]->calculateFitness();
        $this->globalBestPosition = $this->swarm[0]->getPosition();
        $this->globalBestFitness = $this->swarm[0]->getFitness();
    }

    /**
     * 更新粒子群速度
     */
    public function updateParticleVelocity()
    {
        for ($i = 0; $i < $this->particleCount; $i++) {
            $this->swarm[$i]->updateVelocity($this->globalBestPosition);
        }
    }

    /**
     * 計算粒子群適應值
     */
    public function calculateParticleFitness()
    {
        for ($i = 0; $i < $this->particleCount; $i++) {
            $this->swarm[$i]->calculateFitness();
        }
    }

    /**
     * 套用粒子群速度
     */
    public function applyParticleVelocity()
    {
        for ($i = 0; $i < $this->particleCount; $i++) {
            $this->swarm[$i]->applyVelocity();
        }
    }

    /**
     * 設定粒子群最佳解
     */
    public function findGlobalBest()
    {
        for ($i = 0; $i < $this->particleCount; $i++) {
            $fitness[] = ceil($this->swarm[$i]->getFitness());
            if ($this->swarm[$i]->getFitness() < $this->globalBestFitness) {
                $this->globalBestPosition = $this->swarm[$i]->getPosition();
                $this->globalBestFitness = $this->swarm[$i]->getFitness();
            }
        }
    }

    /**
     * 取得最佳適應值
     */
    public function getBestFitness()
    {
        return $this->globalBestFitness;
    }

    /**
     * 取得最佳位置
     */
    public function getBestPosition()
    {
        return $this->globalBestPosition;
    }

    /**
     * 取得所有粒子（除錯用）
     */
    public function getParticles()
    {
        foreach ($this->swarm as $particle) {
            $result[] = $particle->getPosition();
        }

        return $result;
    }

}
?>