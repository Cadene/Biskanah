<?php

class UpdateShell extends AppShell {

    public $uses = array(
        'Dtbuilding',
        'Dttechno',
        'Dtunit'
    );


    public function main()
    {
        $dataSource = $this->Dtbuilding->getDataSource();

        $this->out('Serveur en ligne '.gmdate("M D Y H:i:s", time()+2*3600)."\n...\n");

        while (true)
        {
            $dataSource->begin();

            $this->update('buildings');
            $this->update('technos');
            $this->update('units');

            $dataSource->commit();
            //$sql .= $this->_updateCampsRes();

            sleep(1);
        }
    }


    public function update($nodes='buildings')
    {
        $DtnodeModel = 'Dt'.substr($nodes,0,-1);

        $dtnodes = $this->$DtnodeModel->getFinished();

        if (!empty($dtnodes))
        {
            if ($nodes == 'units')
                $NodeModel = 'UnitsCamp';
            else
                $NodeModel = ucfirst(substr($nodes,0,-1));

            $this->loadModel($NodeModel);

            foreach ($dtnodes as $dt)
            {
                $this->$NodeModel->dtUpdate($dt);
            }
            $this->$DtnodeModel->deleteFinished();

        }


        /*
        for


        if (!empty($dt))
        {
            // TODO rank for techn and units
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
        */
    }







}