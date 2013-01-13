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
		'coordinate' => '()'
	),
	array(
		36,
		26,
		'coordinate' => '()'
	),
	array(
		21,
		45,
		'coordinate' => '()'
	),
	array(
		45,
		35,
		'coordinate' => '()'
	),
	array(
		55,
		20,
		'coordinate' => '()'
	),
	array(
		33,
		34,
		'coordinate' => '()'
	),
	array(
		50,
		50,
		'coordinate' => '()'
	),
	array(
		55,
		45,
		'coordinate' => '()'
	),
	array(
		26,
		59,
		'coordinate' => '()'
	),
	array(
		40,
		66,
		'coordinate' => '()'
	),
	array(
		55,
		65,
		'coordinate' => '()'
	),
	array(
		35,
		51,
		'coordinate' => '()'
	),
	array(
		62,
		35,
		'coordinate' => '()'
	),
	array(
		62,
		57,
		'coordinate' => '()'
	),
	array(
		62,
		24,
		'coordinate' => '()'
	),
	array(
		21,
		36,
		'coordinate' => '()'
	),
	array(
		33,
		44,
		'coordinate' => '()'
	),
	array(
		9,
		56,
		'coordinate' => '()'
	),
	array(
		62,
		48,
		'coordinate' => '()'
	),
	array(
		66,
		14,
		'coordinate' => '()'
	),
	array(
		44,
		13,
		'coordinate' => '()'
	),
	array(
		26,
		13,
		'coordinate' => '()'
	),
	array(
		11,
		28,
		'coordinate' => '()'
	),
	array(
		7,
		43,
		'coordinate' => '()'
	),
	array(
		17,
		64,
		'coordinate' => '()'
	),
	array(
		41,
		46,
		'coordinate' => '()'
	),
	array(
		55,
		34,
		'coordinate' => '()'
	),
	array(
		35,
		16,
		'coordinate' => '()'
	),
	array(
		52,
		26,
		'coordinate' => '()'
	),
	array(
		43,
		26,
		'coordinate' => '()'
	),
	array(
		31,
		76,
		'coordinate' => '()'
	),
	array(
		22,
		53,
		'coordinate' => '()'
	),
	array(
		26,
		29,
		'coordinate' => '()'
	),
	array(
		50,
		40,
		'coordinate' => '()'
	),
	array(
		55,
		50,
		'coordinate' => '()'
	),
	array(
		54,
		10,
		'coordinate' => '()'
	),
	array(
		60,
		15,
		'coordinate' => '()'
	),
	array(
		47,
		66,
		'coordinate' => '()'
	),
	array(
		30,
		60,
		'coordinate' => '()'
	),
	array(
		30,
		50,
		'coordinate' => '()'
	),
	array(
		12,
		17,
		'coordinate' => '()'
	),
	array(
		15,
		14,
		'coordinate' => '()'
	),
	array(
		16,
		19,
		'coordinate' => '()'
	),
	array(
		21,
		48,
		'coordinate' => '()'
	),
	array(
		50,
		30,
		'coordinate' => '()'
	),
	array(
		51,
		42,
		'coordinate' => '()'
	),
	array(
		50,
		15,
		'coordinate' => '()'
	),
	array(
		48,
		21,
		'coordinate' => '()'
	),
	array(
		12,
		38,
		'coordinate' => '()'
	),
	array(
		15,
		56,
		'coordinate' => '()'
	),
	array(
		29,
		39,
		'coordinate' => '()'
	),
	array(
		54,
		38,
		'coordinate' => '()'
	),
	array(
		55,
		57,
		'coordinate' => '()'
	),
	array(
		67,
		41,
		'coordinate' => '()'
	),
	array(
		10,
		70,
		'coordinate' => '()'
	),
	array(
		6,
		25,
		'coordinate' => '()'
	),
	array(
		65,
		27,
		'coordinate' => '()'
	),
	array(
		40,
		60,
		'coordinate' => '()'
	),
	array(
		70,
		64,
		'coordinate' => '()'
	),
	array(
		64,
		4,
		'coordinate' => '()'
	),
	array(
		36,
		6,
		'coordinate' => '()'
	),
	array(
		30,
		20,
		'coordinate' => '()'
	),
	array(
		20,
		30,
		'coordinate' => '()'
	),
	array(
		15,
		5,
		'coordinate' => '()'
	),
	array(
		50,
		70,
		'coordinate' => '()'
	),
	array(
		57,
		72,
		'coordinate' => '()'
	),
	array(
		45,
		42,
		'coordinate' => '()'
	),
	array(
		38,
		33,
		'coordinate' => '()'
	),
	array(
		50,
		4,
		'coordinate' => '()'
	),
	array(
		66,
		8,
		'coordinate' => '()'
	),
	array(
		59,
		5,
		'coordinate' => '()'
	),
	array(
		35,
		60,
		'coordinate' => '()'
	),
	array(
		27,
		24,
		'coordinate' => '()'
	),
	array(
		40,
		20,
		'coordinate' => '()'
	),
	array(
		40,
		37,
		'coordinate' => '()'
	),
	array(
		40,
		40,
		'coordinate' => '()'
	)
);
?>