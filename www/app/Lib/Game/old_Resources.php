<?php

class Resources {

    public function __construct()
    {

    }

    public function update($db)
    {
        $camps = $db->select('camps',
            array('id','prod1','prod2','prod3','res1','res2','res3','last_update'),
            array('finish <= '.time()));

        $transaction = '';
        $nbBuildings = 0;
        foreach ($dtbuildings as $dtb)
        {
            print_r($dtb);

            $transaction .= $db->delete('dtbuildings',
                array('id = '.$dtb['id']),
                true);

            $transaction .= $db->update('buildings',
                array('lvl = lvl+1'),
                array('id = '.$dtb['building_id']),
                true);
            /*
            // TODO récupérer le niveau du building et compute les points
            $pts = 1;

            // il faudra sans doute rajouter le champ user_id dans dtbuildings pour éviter de faire un JOINT
            $sql .= $db->update('users',
                array('rank_pts = rank_pts + '.$pts),
                array('id = '.$user_id),
                true);

            $sql .= 'VAR @team_id = '
            $sql .= $db->select('users',array('team_id'),array('id = '.$user_id),true);

            $sql .= 'IF @team_id EXIST ';
            $sql .= $db->update('teams',array('rank = rank+'.$pts),array('id = @team_id'));

            // TODO mettre à jour les autres rankx*/
            $nbBuildings++;
        }

        if (!empty($transaction))
        {
            $sql = 'START TRANSACTION;'."\n";
            $sql .= $transaction;
            $sql .= 'COMMIT;';

            echo $sql."\n";
            return $db->query($sql);
        }
        else
        {
            echo "Buildings maj : $nbBuildings\n";
            return false;
        }
    }
}