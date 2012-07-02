<?php

class searchInitmappingTask extends sfBaseTask
{
    protected function configure()
    {
        // // add your own arguments here
        // $this->addArguments(array(
        //   new sfCommandArgument('my_arg', sfCommandArgument::REQUIRED, 'My argument'),
        // ));

        $this->addOptions(array(
            new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name', 'search'),
            new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
            new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'doctrine'),
            // add your own options here
        ));

        $this->namespace        = 'search';
        $this->name             = 'init-mapping';
        $this->briefDescription = '';
        $this->detailedDescription = <<<EOF
The [search:init-mapping|INFO] task does things.
Call it with:

  [php symfony search:init-mapping|INFO]
EOF;
    }

    protected function execute($arguments = array(), $options = array())
    {
        $client = new Elastica_Client(array('host' => 'localhost', 'port' => 9200));
        $index = $client->getIndex('books');
        $type = $index->getType('offre');
        $mapping = new Elastica_Type_Mapping();
        $mapping->setProperties(array(
            'name' => array('index' => 'not_analyzed', 'type' => 'string'),
            'description' => array('index' => 'not_analyzed', 'type' => 'string'),
            'category' => array('type' => 'string', 'index' => 'not_analyzed')
            //'category' => array('type' => 'nested', 'include_in_parent' => true, 'properties' => array(
                //'name' => array('type' => 'string', 'index' => 'not_analyzed')
            //)
        ));
        $response = $type->setMapping($mapping);
        $data = $response->getData();
        $this->log(json_encode($data));
    }
}
