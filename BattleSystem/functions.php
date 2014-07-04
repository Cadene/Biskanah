<?php

$debug_cmpt_1337 = 0;

function debug($var, $def='')
{
	global $debug_cmpt_1337;

	$rslt = "/*  debug n°".$debug_cmpt_1337." ".$def." */\n";
	ob_start();
	print_r($var);
	$rslt .= '> '.ob_get_contents()."\n";
	ob_end_clean();

	$debug_cmpt_1337++;

	echo $rslt;
}