﻿<!DOCTYPE html>
<html lang="zh">
	<head>
		<meta charset="utf-8" />
		<title>Travelling salesman problem sovle by PSO algorithm</title>
		<link href="style.css" media="screen" rel="stylesheet" type="text/css" />
	</head>
	<body onload="drawAll();">
		<header>
			<h1>以粒子群最佳化演算法解決旅行商問題示範</h1>
		</header>
		<div id="inputArea">
			<form name="paramSetting" method="post">
				資料來源：
				<select name="dataSource">
					<option value ="custom">隨機產生</option>
					<option value ="berlin52"<?php if ($_POST['dataSource'] == 'berlin52'):?> selected="selected"<?php endif;?>>berlin52</option>
				</select>
				<br />
				<div id="isGenerateNewPoints">
					<input type="checkbox" name="isGenerateNewPoints" value="1" />
					下次運算產生新的旅行點
				</div>
				<div id="isShowBest">
					<input type="checkbox" name="isShowBest" value="1" />
					顯示最佳值
				</div>
				<?= $pointInputData ?>
				<!--
				請建立四個select選單：
				旅行點數量（5、10、15……）
				運算粒子數（20、30、40、50………）
				運算迭代數（10、20、30……）
				毀滅次數（1、2、3……）
				-->
				<input type="submit" name="submit" value="再次演算" />
			</form>
		</div>
		<h2 id="autor">作者：康家豪、溫國光、邱順得</h2>
		<div id="systemMessage">
			執行時間：<?= $executeTime ?>秒，使用記憶體：<?= $memoryUsage ?>KB。
		</div>
		<canvas id="paintArea" width="<?= PAINT_SIZE + PAINT_PADDING ?>" height="<?= PAINT_SIZE + PAINT_PADDING ?>">
			繪圖區
		</canvas>
		<?php if($routeLength): ?>
		<div id="result">
			<h2 id="routeLength"> 最短路徑長：<?= $routeLength ?></h2>
			<?php if ($bestFitness): ?>
				<h2 id="bestFitness">實際最短路徑長：<?= $bestFitness ?></h2>
			<?php endif;?>
			<h2 id="fitnessHistory">粒子群最佳適應值</h2>
			<table>
				<?php
				if ($fitnessHistory) {
					$generation = 0;
					foreach ($fitnessHistory as $fitness) {
						if (!is_array($fitness)) {
							echo '<tr><td>' . $generation . '：</td><td>' . $fitness . '</td></tr>';
							$generation++;
						} else {
							echo '<tr><td class="distinctionCount" colspan="2">第' . $fitness[0] . '次毀滅：</td></tr>';
							$generation = 0;
						}
					}
				}
				?>
			</table>
		</div>
		<?php endif; ?>
	</body>
	<script type="text/javascript" src="jquery-1.8.3.min.js"></script>
	<script type="text/javascript">
        if ($('#inputArea select[name="dataSource"]').val() == 'custom') {
            $('#isGenerateNewPoints').show();
            $('#isShowBest').hide();
        } else {
            $('#isGenerateNewPoints').hide();
            $('#isShowBest').show();
        }

        $('#inputArea select[name="dataSource"]').change(function() {
            if ($(this).val() == 'custom') {
                $('#isGenerateNewPoints').show();
                $('#isShowBest').hide();
            } else {
                $('#isGenerateNewPoints').hide();
                $('#isShowBest').show();
            }
        });
	</script>

	<?php if ($route && $points): ?>
    	<script type="text/javascript">
    		var route =<?= $route ?>;
        	var points = <?= $points ?>;
    	</script>
	<?php endif; ?>

	<script type="text/javascript" src="canvas.js"></script>
</html>