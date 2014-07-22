<?php

function euclidienne($x1,$y1,$x2,$y2)
{
	$rslt = sqrt(pow($x1-$x2,2) + pow($y1-$y2,2));
	$string = "($x1;$y1) -> ($x2;$y2) : ";
	$string .= $rslt;
	echo $string."\n";
}

//http://stackoverflow.com/questions/5084801/distance-between-tiles-in-a-hexagonal-field
function manathan($x1,$y1,$x2,$y2)
{
	$dx = $x2 - $x1;
	$dy = $y2 - $y1;

	if (($dx >= 0) == ($dy >= 0))
	    $rslt = abs($dx + $dy);
	else
	    $rslt = max(abs($dx), abs($dy));

	$string = "($x1;$y1) -> ($x2;$y2) : ";
	$string .= $rslt;
	echo $string."\n";

}

class Box {

	private $x;
	private $y;

	public function __construct($x,$y){
		$this->x = $x;
		$this->y = $y;
	}

	public function toString(){
		return "($this->x ; $this->y)";
	}

	public function getX()
	{
		return $this->x;
	}

	public function getY()
	{
		return $this->y;
	}
}

function generation_cases($distance, $x0, $y0)
{
	$cases[] = new Box($x0,$y0);

	for ($d=1; $d <= $distance; $d++)
	{
		// Zone +Y
		$cases[] = new Box($x0, $y0 + $d);

		// Zone +Yd
		for ($i=0; $i < $d-1; $i++)
		{
			$cases[] = new Box($x0+$i+1, $y0+$d-$i-1);
		}

		// Zone +X
		$cases[] = new Box($x0 + $d, $y0);

		// Zone +Xb
		for ($i=0; $i < $d-1; $i++)
		{
			$cases[] = new Box($x0+$d, $y0-$i-1);
		}

		// Zone Zb
		$cases[] = new Box($x0+$d, $y0-$d);

		// Zone Zbg
		for ($i=0; $i < $d-1; $i++)
		{
			$cases[] = new Box($x0+$d-$i-1, $y0-$d);
		}	

		// Zone -Y
		$cases[] = new Box($x0, $y0 - $d);

		// Zone -Yg
		for ($i=0; $i < $d-1; $i++)
		{
			$cases[] = new Box($x0-$i-1, $y0-$d+$i+1);
		}

		// Zone -X
		$cases[] = new Box($x0 - $d, $y0);

		// Zone -Xh
		for ($i=0; $i < $d-1; $i++)
		{
			$cases[] = new Box($x0-$d, $y0+$i+1);
		}

		// Zone Zh
		$cases[] = new Box($x0-$d, $y0+$d);

		// Zone Zhd
		for ($i=0; $i < $d-1; $i++)
		{
			$cases[] = new Box($x0-$d+$i+1, $y0+$d);
		}	

	}

	//print_r($cases);
	return $cases;
}


foreach(generation_cases(10,0,0) as $id=>$box)
{	
	if ($box->getX() == 0 && $box->getY() >= 0)
		echo "$id ".$box->toString()."\n";
}
