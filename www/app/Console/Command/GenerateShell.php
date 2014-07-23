<?php

class GenerateShell extends AppShell {

    public function main()
    {
        $load = $this->Tasks->load('Load');
        $load->execute();

        $db = new DB();

        $biskanah = Factory::makeBiskanah();
        $biskanah->generateAll($db);

        $this->out('Done!');
    }
}