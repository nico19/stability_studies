<?php

function calcF1($x1, $x2){
	return (($x1 / $x2) - pow($x2, 3) - 4);
}

function calcF2($x1, $x2){
	return ((-4 * pow($x1, 2)) + (8 * $x2) +1);
}

function detA($arr){

	return (($arr[0][0] + $arr[1][1]) - ($arr[0][1] + $arr[1][0]));
}

/*
* matrix - матриця
* i - рядок
* j - стопчик
*/

function getAij($matrix, $i, $j){
	//видаляю рядок
	unset($matrix[$i]);

	//видаляю стопчик
	unset($matrix[0][$j]);
	unset($matrix[1][$j]);

	$matrix = array_values($matrix);
	$matrix[0] = array_values($matrix[0]);
	
	if(($i + $j) % 2 == 0){
		$koef = 1;
	}
	else {
		$koef = -1;
	}
	return $koef * $matrix[0][0];
}

function reverseMatrix($matrix){
	$size = count($matrix[0]);
	$tempAr = [];
	for ($i = 0; $i < $size; $i++) { 
		for ($j = 0; $j < $size; $j++) { 
			$tempAr[$i][$j] = getAij($matrix, $i, $j) / getA($matrix);
		}
	}
	return $tempAr;
}

function transposeMatrix($matrix){
	$temp = $matrix[0][1];
	$matrix[0][1] = $matrix[1][0];
	$matrix[1][0] = $temp;
	return $matrix;
}
?>