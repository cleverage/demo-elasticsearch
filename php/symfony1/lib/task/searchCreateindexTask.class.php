<?php

class searchCreateindexTask extends sfBaseTask
{
    protected function configure()
    {
        // // add your own arguments here
        // $this->addArguments(array(
        //   new sfCommandArgument('my_arg', sfCommandArgument::REQUIRED, 'My argument'),
        // ));

        $this->addOptions(array(
            new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name'),
            new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
            new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'doctrine'),
            // add your own options here
        ));

        $this->namespace        = 'search';
        $this->name             = 'create-index';
        $this->briefDescription = '';
        $this->detailedDescription = <<<EOF
The [search:create-index|INFO] task does things.
Call it with:

  [php symfony search:create-index|INFO]
EOF;
    }

    protected function execute($arguments = array(), $options = array())
    {
        $ch = curl_init('http://localhost:9200/books');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        $this->log($response);
    }
}
