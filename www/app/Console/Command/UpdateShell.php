<?php

class UpdateShell extends AppShell {

    public function main()
    {
        $load = $this->Tasks->load('Load');
        $load->execute();

        $db = new DB();

        $server = new Server($db);

        $this->out('Serveur en ligne '.gmdate("M D Y H:i:s", time()+2*3600)."\n...\n");

        while (true)
        {
            $server->updateAll();
            sleep(1);
        }
    }

}