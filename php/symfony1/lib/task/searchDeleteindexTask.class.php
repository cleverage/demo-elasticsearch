<?php

class searchDeleteindexTask extends sfBaseTask
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
        $this->name             = 'delete-index';
        $this->briefDescription = '';
        $this->detailedDescription = <<<EOF
The [search:delete-index|INFO] task does things.
Call it with:

  [php symfony search:delete-index|INFO]
EOF;
    }

    protected function execute($arguments = array(), $options = array())
    {
        $ch = curl_init('http://localhost:9200/books');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        $this->log($response);
    }
}
