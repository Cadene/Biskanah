<?php

class Update {

    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }


    /**
     * Rend un array de camp_id à mettre à jour au niveau des resources
     *
     * @param $db
     *
     * @return array|bool
     */
    public function update($db)
    {
        $dtbuildings = $db->select('dtbuildings',
            array('id','databuilding_id','building_id','camp_id','finish','begin'),
            array('finish <= '.time()));

        $transaction = '';
        $nbBuildings = 0;
        $camp_ids = array();
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

            // Liste des camp à maj resources
            if (!isset($camp_ids[$dtb['camp_id']]))
                $camp_ids[$dtb['camp_id']] = true;

            $nbBuildings++;
        }

        if (!empty($transaction))
        {
            $sql = 'START TRANSACTION;'."\n";
            $sql .= $transaction;
            $sql .= 'COMMIT;';

            echo $sql."\n";
            $db->query($sql);
            return $camp_ids;
        }
        else
        {
            echo "Buildings maj : $nbBuildings\n";
            return false;
        }

    }
}