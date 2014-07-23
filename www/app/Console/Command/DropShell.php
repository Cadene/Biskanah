<?php

class DropShell extends AppShell {

    public function main()
    {
        $load = $this->Tasks->load('Load');
        $load->execute();

        $db = new DB();

        $db->drop();

        $this->out('Done!');
    }
}