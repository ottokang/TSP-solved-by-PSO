<!DOCTYPE html>
<html lang="zh">
	<head>
		<meta charset="utf-8" />
		<title>Travelling salesman problem sovle by PSO algorithm</title>
		<link href="style.css" media="screen" rel="stylesheet" type="text/css" />
	</head>
	<body onload="drawAll();">
		<header>
			<h1>粒子群最佳化演算法解決旅行商問題</h1>
		</header>
		<div id="inputArea">
			<form name="paramSetting" method="post">
				資料來源：
				<select name="dataSource" id="dataSource">
					<option value ="custom">隨機產生</option>
					<option value ="berlin52"<?php if ($_POST['dataSource'] == 'berlin52'):?> selected="selected"<?php endif; ?>>berlin52</option>
					<option value ="eil76"<?php if ($_POST['dataSource'] == 'eil76'):?> selected="selected"<?php endif; ?>>eil76</option>
				</select>

				&nbsp;&nbsp;&nbsp;

				<span id="isGenerateNewPoints">
					<input type="checkbox" id="isGenerateNewPointsInput" name="isGenerateNewPoints" value="1" />
					下次運算產生新的旅行點
				</span>
				<span id="isShowBest">
					<input type="checkbox" name="isShowBest" value="1" />
					顯示最佳值
				</span>

				<br />
				<br />

				<span id="travelPointCount">
					<label for="travelPointCountInput">旅行點數量：</label>
					<input type="text" id="travelPointCountInput" name="travelPointCount" required="required" placeholder="1 ～ 99" pattern="[0-9]{1,2}" title="請輸入1 ～ 99之間的數字" value="<?php echo $_POST['travelPointCount'] ?>" />
					&nbsp;&nbsp;&nbsp;
				</span>

				<label for="particleCount">運算粒子數：</label>
				<input type="text" id="particleCount" name="particleCount" required="required" placeholder="1 ～ 99" pattern="[0-9]{1,2}" title="請輸入1 ～ 99之間的數字" value="<?php echo $_POST['particleCount'] ?>" />
				&nbsp;&nbsp;&nbsp;

				<label for="iterationCount">迭代量：</label>
				<input type="text" id="iterationCount" name="iterationCount" required="required" placeholder="1 ～ 99" pattern="[0-9]{1,2}" title="請輸入1 ～ 99之間的數字" value="<?php echo $_POST['iterationCount'] ?>" />
				&nbsp;&nbsp;&nbsp;

				<label for="maxNoProgressIterationCount">未改進終止迭代量：</label>
				<input type="text" id="maxNoProgressIterationCount" name="maxNoProgressIterationCount" required="required" placeholder="1 ～ 99" pattern="[0-9]{1,2}" title="請輸入1 ～ 99之間的數字" value="<?php echo $_POST['maxNoProgressIterationCount'] ?>" />
				&nbsp;&nbsp;&nbsp;

				<br />
				<br />

				<label for="extinctionCount">速度重置（毀滅）數：</label>
				<input type="text" id="extinctionCount" name="extinctionCount" required="required" placeholder="1 ~ 99" pattern="[0-9]{1,2}" title="請輸入1 ～ 99之間的數字" value="<?php echo $_POST['extinctionCount'] ?>" />
				&nbsp;&nbsp;&nbsp;


				<label for="maxNoProgressExtinctionCount">未改進速度重置數（觸發大滅絕）：</label>
				<input type="text" id="maxNoProgressExtinctionCount" name="maxNoProgressExtinctionCount" required="required" placeholder="1 ~ 99" pattern="[0-9]{1,2}" title="請輸入1 ～ 99之間的數字" value="<?php echo $_POST['maxNoProgressExtinctionCount'] ?>" />
				&nbsp;&nbsp;&nbsp;

				<br />
				<br />

				<?php echo $pointInputData ?>
				<input type="submit" name="submit" value="進行運算" />
				&nbsp;&nbsp;&nbsp;

				<span id="autor">作者：康家豪、溫國光、邱順得</span>
				&nbsp;&nbsp;&nbsp;

				<span id="projectSite"><a href="http://code.google.com/p/tsp-by-pso-algoritm/">專案網站</a></span>
			</form>
		</div>

		<?php if($executeTime): ?>
			<div id="systemMessage">
				執行時間：<?php echo $executeTime ?>秒，使用記憶體：<?php echo $memoryUsage ?>KB。
			</div>
		<?php endif; ?>

		<canvas id="paintArea" width="<?php echo PAINT_SIZE + PAINT_PADDING ?>" height="<?php echo PAINT_SIZE + PAINT_PADDING ?>">
			繪圖區
		</canvas>

		<?php if($routeLength): ?>
		<div id="result">
			<h2 id="routeLength"> 最短路徑長：<?php echo $routeLength ?></h2>

			<?php if ($bestFitness): ?>
				<h2 id="bestFitness">實際最短路徑長：<?php echo $bestFitness ?></h2>
			<?php endif; ?>

			<?php if ($massExtinctionCount): ?>
				<h2 id="massExtinctionCount">大滅絕次數：<?php echo $massExtinctionCount ?></h2>
			<?php endif; ?>

			<h2 id="fitnessHistory">粒子群最佳適應值：</h2>

			<table>
				<?php
				if ($fitnessHistory) {
					$generation = 0;
					foreach ($fitnessHistory as $fitness) {
						if (!is_array($fitness)) {
							echo '<tr><td>' . $generation . '：</td><td>' . $fitness . '</td></tr>';
							$generation++;
						} else {
							echo '<tr><td class="extinctionCount" colspan="2">〔第' . $fitness[0] . '次毀滅〕</td></tr>';
							$generation = 0;
						}
					}
				}
				?>
			</table>
		</div>
		<?php endif; ?>
	<script src="jquery-1.8.3.min.js"></script>
	<script>
        function showCustomInput() {
            $('#isGenerateNewPoints').show();
            $('#travelPointCount').show();
            $('#isShowBest').hide();
        };

        function showFixInput() {
            $('#isGenerateNewPoints').hide();
            $('#travelPointCount').hide();
            $('#isShowBest').show();
        }

        if ($('#dataSource').val() == 'custom') {
            showCustomInput();
        } else {
            showFixInput();
        }

        // 選擇隨機產生模式，隱藏產生新的旅行點、旅行點數量欄位
        $('#dataSource').change(function() {
            if ($(this).val() == 'custom') {
                showCustomInput();
            } else {
                showFixInput();
            }
        });
        // 修改旅行點數量自動勾選產生新的旅行點
        $('#travelPointCountInput').change(function() {
            $('#isGenerateNewPointsInput').attr('checked', 'checked');
        });
        </script>

	<?php if ($route && $points): ?>
    	<script>
    		<?php echo 'var route = ' . $route . ';' ?>
    		<?php echo 'var points = ' . $points . ';' ?>
		</script>
	<?php endif; ?>

	<script src="canvas.js"></script>
	</body>
</html>