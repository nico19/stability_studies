<?php
require_once("lib/math.php");
//внесемо значення в масив
$Xk = [2, 1];

//створимо масив x з яким будемо звірятись по ходу ітерацій
//$arX = [];
$arX[] = $Xk;
//введемо обраховані похідні рівняння r1 (по х1 ($r1x1) і по x2 ($r1x2)) 
//і по рівнянню r2 (по х1 ($r2x1) і по x2 ($r2x2)) 

for ($i=0; $i < 2000; $i++) { 
	$lastIndex = count($arX) - 1;

	$r1x1 = 1/$arX[$lastIndex][1];
	$r1x2 = -(3 * pow($arX[$lastIndex][1], 4) + $arX[$lastIndex][0]) / pow($arX[$lastIndex][1], 2);
	$r2x1 = -8 * $arX[$lastIndex][0];
	$r2x2 = 8;
	
	// $r1x1 = 1;
	// $r1x2 = -sin($arX[$lastIndex][1]);
	// $r2x1 = cos($arX[$lastIndex][0]);
	// $r2x2 = 0.5;
	
	// $r1x1 = 2 * cos($arX[$lastIndex][1]);
	// $r1x2 = -2 * sin($arX[$lastIndex][1]) * $arX[$lastIndex][0];
	// $r2x1 = -1;
	// $r2x2 = 3 * pow($arX[$lastIndex][1], 2);
	// з цих значень побудую матрицю Якобі
	$Yak = [
				[$r1x1, $r1x2],
				[$r2x1, $r2x2]
			];

	$FXk = [ 
			calcF1($arX[$lastIndex][0], $arX[$lastIndex][1]),
			calcF2($arX[$lastIndex][0], $arX[$lastIndex][1])
		];

	

	//обертаємо матрицю Якобі
	$reverseMatrix = reverseMatrix($Yak);
	
	//потім транспонуємо
	$transposeMatrix = transposeMatrix($reverseMatrix);
	
	//перемножимо транспоновану матрицю х вектором FXk
	$multRes = matrixPerVector($transposeMatrix, $FXk);
	
	//віднімаємо від попереднього х отриманий вектор після множення
	
	// if($i == 1){
	// 	var_dump($multRes);
	// 	exit;
	// }
	$newX = divisonMatrix($arX[0], $multRes);
	
	
	$check = false;
	foreach ($arX as $value) {
		if(equalMatrixs($value, $newX, 8))
		{
			$check = true;
			echo "Ура!!! Iteration #$i";
			exit();
		}
	}
	if(!$check){
		$arX[] = $newX;
	}
	var_dump($newX);
}

?>