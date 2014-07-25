<?php

class GenerateShell extends AppShell {

    public $uses = array(
        'World'
    );

    public function main()
    {
        App::uses('LGLoader','Lib/Game');
        $world = LGLoader::read('World');

        $this->World->generate($world);

        $this->out('Done!');
    }
}