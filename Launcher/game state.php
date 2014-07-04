<?php
function generateRandomString($length = 10) 
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) 
    {
    	if($i!=0)
    	    $randomString .= $characters[rand(0, strlen($characters) - 1)];
		else
    		$randomString .= $characters[rand(11,strlen($characters)-1)];
    }
    return $randomString;
}

function generateUsersfile()
{
	$file = fopen("users.php", "w+");
	fwrite($file, "<?php \n");
	for($i=0;$i<20; $i++)
	{
		$username = generateRandomString();
		$password = generateRandomString();
		$email = "test@test.com";
		$access = $diam = $team_id = $team_access = $biskanah = $rank_pts = $rank_units = $unread_msg = 0;

		$input ="";
		$input = "\$u".$i." = array('username' => ".$username.", 'password' => ".$password.", 'access' => ".$access.", 'diam'=> ".$diam.",";
		$input .=" 'team_id'=> ".$team_id.", 'team_access'=> ".$team_access.", 'biskanah'=>".$biskanah.", 'rank_pts'=>".$rank_pts.", ";
		
		$input .=" 'rank_units'=>".$rank_units.", 'unread_msg'=> ".$unread_msg." );\n";
		
		fwrite($file, $input);

	}
	fclose($file);
}

function generateWorldsfile($max_x,$max_y)
{

	$file = fopen("worlds.php", "w+");
	fwrite($file, "<?php \n");
	$values = array();
	 for($i=0-$max_x; $i<$max_x; $i++){
            for($j=0-$max_y; $j<$max_y; $j++){
            	$x=($i<0)?"_".-$i:$i;
            	$y=($j<0)?"_".-$j:$j;
                $input ="\$w".$x.$y." = array('x' => ".$i.", 'y' => ".$j.", 'type' => 0); \n";
                fwrite($file, $input);
            }
        }
    fclose($file);
}

function generateDatabuildingsfile($nb_type,$nb_lvl = 100)
{
	$file = fopen("databuildings.php", "w+");
	fwrite($file, "<?php \n");
	for($type=0; $type<$nb_type; $type++){
            for($lvl=0; $lvl<100; $lvl++){
                
                $input = "\$dtb".$type.$lvl." = array(".
                    "'id' => ".(($type*100)+$lvl).", ".
                    "'lvl' => ".$lvl.", ".
                    "'type' => ".$type.", ".
                    "'res1' => ".(3*$lvl).", ".
                    "'res2' => ".(2*$lvl).", ".
                    "'res3' => ".(1*$lvl).", ".
                    "'struct' => ".(100*$lvl).", ".
                    "'conso' => ".$lvl.", ".
                    "'time' => ".(5*$lvl).
                	" ); \n";
			fwrite($file, $input);
            }
        }
    fclose($file);
}

function generateDatatechnosfile($nb_type,$nb_lvl = 100)
{

	$file = fopen("datatechnos.php", "w+");
	fwrite($file, "<?php \n");
	for($type=0; $type<$nb_type; $type++){
            for($lvl=0; $lvl<100; $lvl++){
                
                $input = "\$dtb".$type.$lvl." = array(".
                    "'id' => ".(($type*100)+$lvl).", ".
                    "'lvl' => ".$lvl.", ".
                    "'type' => ".$type.", ".
                    "'res1' => ".(3*$lvl).", ".
                    "'res2' => ".(2*$lvl).", ".
                    "'res3' => ".(1*$lvl).", ".
                    "'prod1' => ".(10*$lvl).", ".
                    "'prod2' => ".(20*$lvl).", ".
                    "'prod3' => ".(30*$lvl).
                    "'struct' => ".($lvl).
                    "'conso' => ".($lvl).
                    "'time' => ".(5*$lvl).
                	" ); \n";
			fwrite($file, $input);
            }
        }
    fclose($file);
}

function generateCampsfile()
{
	$file = fopen("datatechnos.php", "w+");
	fwrite($file, "<?php \n");

	$input = "\$dtb".$type.$lvl." = array(".
                    "'id' => ".(($type*100)+$lvl).", ".
                    "'world_id' => ".$lvl.", ".
                    "'type' => ".$type.", ".
                    "'res1' => ".(3*$lvl).", ".
                    "'res2' => ".(2*$lvl).", ".
                    "'res3' => ".(1*$lvl).", ".
                    "'prod1' => ".(10*$lvl).", ".
                    "'prod2' => ".(20*$lvl).", ".
                    "'prod3' => ".(30*$lvl).
                    "'struct' => ".($lvl).
                    "'conso' => ".($lvl).
                    "'time' => ".(5*$lvl).
                	" ); \n";
}

?>
