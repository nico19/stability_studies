<?php

function calcF1($x1, $x2){
	return (($x1 / $x2) - pow($x2, 3) - 4);
}

function calcF2($x1, $x2){
	return ((-4 * pow($x1, 2)) + (8 * $x2) +1);
}
?>