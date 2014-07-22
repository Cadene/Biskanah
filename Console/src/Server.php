<?php

class Server {

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
    public function updateAll()
    {
        $db = $this->db;

        $sql = '';
        $sql .= $this->update('buildings');
        $sql .= $this->update('technos');

        if (!empty($sql))
        {
            //SQL
            $transaction = 'START TRANSACTION;'."\n";
            $transaction .= $sql;
            $transaction .= 'COMMIT;';
            $db->query($sql);
        }
    }

    public function update($nodes='buildings',$toSql=true)
    {
        $dt = $this->_getDt($nodes);

        $sql = '';
        if (!empty($dt))
        {
            if ($nodes === 'buildings')
            {
                $buildings = $this->_getBuildingsByCampIds($dt);
                $databuildings = $this->_getData('buildings');
                $sql .= $this->_updateUsersRank($dt,$buildings,$databuildings);
            }

            $sql .= $this->_update($nodes,$dt);
            $sql .= $this->_deleteDt($nodes,$dt);
        }

        return $sql;
    }

    private function _updateUsersRank($dtbuildings,$buildings,$databuildings)
    {
        $sql = '';
        foreach ($dtbuildings as $dtb)
        {
            $type = $dtb['databuilding_id'];
            $lvl = (isset($buildings[$type]['lvl'])) ? $buildings[$type]['lvl']+1 : 1;
            $points = $this->_getPoints($type,$lvl,$databuildings);

            $sql .= $this->db->update('users',
                array('rank_pts = rank_pts + '.$points),
                array('id = '.$dtb['user_id']),
                true);
        }
        return $sql;
    }

    private function _getPoints($type,$lvl,$databuildings)
    {
        $costRes = $this->_costInRes($type,$lvl,$databuildings[$type]);
        $fact = array(1,2,3);

        $pts = 0;
        foreach ($costRes as $id=>$res)
        {
            $pts += $res * $fact[$id-1];
        }
        return $pts;
    }

    private function _costInRes($id, $lvl, Array $data)
    {
        // Extracteur de métal
        if ($id == 1)
        {
            $res[1] = 60 * pow(1.5, $lvl-1);
            $res[2] = 15 * pow(1.5, $lvl-1);
            $res[3] = 0;
        }
        else if ($id == 2)
        {
            $res[1] = 48 * pow(1.6, $lvl-1);
            $res[2] = 24 * pow(1.5, $lvl-1);
            $res[3] = 0;
        }
        else if ($id == 3)
        {
            $res[1] = 225 * pow(1.6, $lvl-1);
            $res[2] = 75 * pow(1.5, $lvl-1);
            $res[3] = 0;
        }
        else
        {
            $res[1] = $data['res1'] * pow(2, $lvl-1);
            $res[2] = $data['res2'] * pow(2, $lvl-1);
            $res[3] = $data['res3'] * pow(2, $lvl-1);
        }
        return $res;
    }

    // TODO modifier peut etre
    private function _getData($nodes='buildings')
    {
        $datasPDO = $this->db->select('data'.$nodes,array('*'));

        foreach ($datasPDO as $datan)
        {
            $datas[$datan['id']] = $datan;
        }
        return $datas;
    }

    private function _getDt($nodes='buildings')
    {
        if ($nodes === 'buildings')
        {
            $selectSQL = 'SELECT '.
                'dt.id, dt.databuilding_id, dt.building_id, dt.camp_id, dt.finish, dt.begin, '.
                'c.last_update , c.user_id '.
                'FROM dtbuildings dt, camps c '.
                'WHERE dt.finish <= '.time().
                //'WHERE dt.finish > 0';
                ' AND dt.camp_id = c.id';
        }
        else
        {
            $selectSQL = 'SELECT '.
                'dt.id, dt.datatechno_id, dt.techno_id, dt.building_id, dt.user_id, dt.finish, dt.begin, '.
                'c.last_update , c.user_id '.
                'FROM dttechnos dt, camps c '.
                'WHERE dt.finish <= '.time().
                //'WHERE dt.finish > 0';
                ' AND dt.camp_id = c.id';
        }

        $dtPDO = $this->db->query($selectSQL);

        return $this->db->pdoToArray($dtPDO);
    }

    /**
     * array( 'camp_id' => array ( 'type' => 'lvl' ) )
     *
     * @param $campIds
     *
     * @return array
     */
    private function _getBuildingsByCampIds($dtbuildings)
    {
        $campIdsToUpdate = $this->_getCampIdToUpdate($dtbuildings);

        $buildings = array();
        foreach ($campIdsToUpdate as $camp_id => $last_update)
        {
            $buildingsPDO = $this->db->select('buildings',
                array('id','databuilding_id','lvl'),
                array('id = '.$camp_id));

            foreach ($buildingsPDO as $building)
            {
                $type = $building['databuilding_id'];
                $buildings[$camp_id][$type] = $building['lvl'];
                $buildings[$camp_id]['last_update'] = $last_update;
            }
        }
        return $buildings;
    }

    private function _updateCampsRes($camps)
    {
        $sql = '';
        foreach ($camps as $id => $buildings)
        {
            if (isset($buildings[1])) {
                $prod1 = 30 * $buildings[1] * pow(1.1, $buildings[1]);
            }else{
                $prod1 = 20;
            }

            if (isset($buildings[2])) {
                $prod2 = 20 * $buildings[2] * pow(1.1, $buildings[2]);
            }else{
                $prod2 = 10;
            }

            if (isset($buildings[3])) {
                $prod3 = 10 * $buildings[3] * pow(1.1, $buildings[3]);
            }else{
                $prod3 = 5;
            }

            $timeBetween = time() - $camps[$id]['last_update'];
            $hoursBetween = $timeBetween / 3600.0;
            $res1 = $prod1 * $hoursBetween;
            $res2 = $prod2 * $hoursBetween;
            $res3 = $prod3 * $hoursBetween;

            $sql .= $this->db->update('camps',
                array('res1 = res1 + '.$res1,'res2 = res2 + '.$res2,'res3 = res3 + '.$res3),
                array('id = '.$id),true);
        }
        return $sql;
    }

    private function _getCampIdToUpdate($dtbuildings)
    {
        $campIds = array();
        foreach ($dtbuildings as $dtb)
        {
            if (!isset($campIds[$dtb['camp_id']]))
            {
                $campIds[$dtb['camp_id']] = $dtb['last_update'];
            }
        }
        return $campIds;
    }

    /**
     * A partir d'un dtbuildings, rend le sql (transaction)
     * sql : delete dtbuildings, update buildings
     *
     * @param $dtbuildings
     *
     * @return string
     */
    private function _update($nodes='buildings',$dtnodes)
    {
        $node = substr($nodes,0,-1);

        $sql = '';
        foreach ($dtnodes as $dtb)
        {
            $sql .= $this->db->update($nodes,
                array('lvl = lvl+1'),
                array('id = '.$dtb[$node.'_id']),
                true);
        }
        return $sql;
    }

    private function _deleteDt($nodes='buildings',$dtnodes)
    {
        $sql = '';
        foreach ($dtnodes as $dtb)
        {
            $sql .= $this->db->delete('dt'.$nodes,
                array('id = '.$dtb['id']),
                true);
        }
        return $sql;
    }
}