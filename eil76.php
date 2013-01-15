<?php
// 座標縮放
$scale = 10;

// 最佳值
$bestFitness = 545.39;

// 最佳順序
$bestOrder = array(
	1,
	33,
	63,
	16,
	3,
	44,
	32,
	9,
	39,
	72,
	58,
	10,
	31,
	55,
	25,
	50,
	18,
	24,
	49,
	23,
	56,
	41,
	43,
	42,
	64,
	22,
	61,
	21,
	47,
	36,
	69,
	71,
	60,
	70,
	20,
	37,
	5,
	15,
	57,
	13,
	54,
	19,
	14,
	59,
	66,
	65,
	38,
	11,
	53,
	7,
	35,
	8,
	46,
	34,
	52,
	27,
	45,
	29,
	48,
	30,
	4,
	75,
	76,
	67,
	26,
	12,
	40,
	17,
	51,
	6,
	68,
	2,
	74,
	28,
	62,
	73
);

foreach ($bestOrder as &$value) {
	$value -= 1;
}

$tspData = array(
	array(
		22,
		22,
		'coordinate' => '(22,22)'
	),
	array(
		36,
		26,
		'coordinate' => '(36,26)'
	),
	array(
		21,
		45,
		'coordinate' => '(21,45)'
	),
	array(
		45,
		35,
		'coordinate' => '(45,35)'
	),
	array(
		55,
		20,
		'coordinate' => '(55,20)'
	),
	array(
		33,
		34,
		'coordinate' => '(33,34)'
	),
	array(
		50,
		50,
		'coordinate' => '(50,50)'
	),
	array(
		55,
		45,
		'coordinate' => '(55,45)'
	),
	array(
		26,
		59,
		'coordinate' => '(26,59)'
	),
	array(
		40,
		66,
		'coordinate' => '(40,66)'
	),
	array(
		55,
		65,
		'coordinate' => '(55,65)'
	),
	array(
		35,
		51,
		'coordinate' => '(35,51)'
	),
	array(
		62,
		35,
		'coordinate' => '(62,35)'
	),
	array(
		62,
		57,
		'coordinate' => '(62,57)'
	),
	array(
		62,
		24,
		'coordinate' => '(62,24)'
	),
	array(
		21,
		36,
		'coordinate' => '(21,36)'
	),
	array(
		33,
		44,
		'coordinate' => '(33,44)'
	),
	array(
		9,
		56,
		'coordinate' => '(9,56)'
	),
	array(
		62,
		48,
		'coordinate' => '(62,48)'
	),
	array(
		66,
		14,
		'coordinate' => '(66,14)'
	),
	array(
		44,
		13,
		'coordinate' => '(44,13)'
	),
	array(
		26,
		13,
		'coordinate' => '(26,13)'
	),
	array(
		11,
		28,
		'coordinate' => '(11,28)'
	),
	array(
		7,
		43,
		'coordinate' => '(7,43)'
	),
	array(
		17,
		64,
		'coordinate' => '(17,64)'
	),
	array(
		41,
		46,
		'coordinate' => '(41,46)'
	),
	array(
		55,
		34,
		'coordinate' => '(55,34)'
	),
	array(
		35,
		16,
		'coordinate' => '(35,16)'
	),
	array(
		52,
		26,
		'coordinate' => '(52,26)'
	),
	array(
		43,
		26,
		'coordinate' => '(43,26)'
	),
	array(
		31,
		76,
		'coordinate' => '(31,76)'
	),
	array(
		22,
		53,
		'coordinate' => '(22,53)'
	),
	array(
		26,
		29,
		'coordinate' => '(26,29)'
	),
	array(
		50,
		40,
		'coordinate' => '(50,40)'
	),
	array(
		55,
		50,
		'coordinate' => '(55,50)'
	),
	array(
		54,
		10,
		'coordinate' => '(54,10)'
	),
	array(
		60,
		15,
		'coordinate' => '(60,15)'
	),
	array(
		47,
		66,
		'coordinate' => '(47,66)'
	),
	array(
		30,
		60,
		'coordinate' => '(30,60)'
	),
	array(
		30,
		50,
		'coordinate' => '(30,50)'
	),
	array(
		12,
		17,
		'coordinate' => '(12,17)'
	),
	array(
		15,
		14,
		'coordinate' => '(15,14)'
	),
	array(
		16,
		19,
		'coordinate' => '(16,19)'
	),
	array(
		21,
		48,
		'coordinate' => '(21,48)'
	),
	array(
		50,
		30,
		'coordinate' => '(50,30)'
	),
	array(
		51,
		42,
		'coordinate' => '(51,42)'
	),
	array(
		50,
		15,
		'coordinate' => '(50,15)'
	),
	array(
		48,
		21,
		'coordinate' => '(48,21)'
	),
	array(
		12,
		38,
		'coordinate' => '(12,38)'
	),
	array(
		15,
		56,
		'coordinate' => '(15,56)'
	),
	array(
		29,
		39,
		'coordinate' => '(29,39)'
	),
	array(
		54,
		38,
		'coordinate' => '(54,38)'
	),
	array(
		55,
		57,
		'coordinate' => '(55,57)'
	),
	array(
		67,
		41,
		'coordinate' => '(67,41)'
	),
	array(
		10,
		70,
		'coordinate' => '(10,70)'
	),
	array(
		6,
		25,
		'coordinate' => '(6,25)'
	),
	array(
		65,
		27,
		'coordinate' => '(65,27)'
	),
	array(
		40,
		60,
		'coordinate' => '(40,60)'
	),
	array(
		70,
		64,
		'coordinate' => '(70,64)'
	),
	array(
		64,
		4,
		'coordinate' => '(64,4)'
	),
	array(
		36,
		6,
		'coordinate' => '(36,6)'
	),
	array(
		30,
		20,
		'coordinate' => '(30,20)'
	),
	array(
		20,
		30,
		'coordinate' => '(20,30)'
	),
	array(
		15,
		5,
		'coordinate' => '(15,5)'
	),
	array(
		50,
		70,
		'coordinate' => '(50,70)'
	),
	array(
		57,
		72,
		'coordinate' => '(57,72)'
	),
	array(
		45,
		42,
		'coordinate' => '(45,42)'
	),
	array(
		38,
		33,
		'coordinate' => '(38,33)'
	),
	array(
		50,
		4,
		'coordinate' => '(50,4)'
	),
	array(
		66,
		8,
		'coordinate' => '(66,8)'
	),
	array(
		59,
		5,
		'coordinate' => '(59,5)'
	),
	array(
		35,
		60,
		'coordinate' => '(35,60)'
	),
	array(
		27,
		24,
		'coordinate' => '(27,24)'
	),
	array(
		40,
		20,
		'coordinate' => '(40,20)'
	),
	array(
		40,
		37,
		'coordinate' => '(40,37)'
	),
	array(
		40,
		40,
		'coordinate' => '(40,40)'
	)
);
?>