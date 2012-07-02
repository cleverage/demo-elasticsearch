<?php

class searchInitdataTask extends sfBaseTask
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
        $this->name             = 'init-data';
        $this->briefDescription = '';
        $this->detailedDescription = <<<EOF
The [search:init-data|INFO] task does things.
Call it with:

  [php symfony search:init-data|INFO]
EOF;
    }

    protected function execute($arguments = array(), $options = array())
    {
        // initialize the database connection
        $databaseManager = new sfDatabaseManager($this->configuration);
        $connection = $databaseManager->getDatabase($options['connection'])->getConnection();

        $q = <<<EOF
        select b.id as id, b.name as name, b.description as description, c.name as category
        from book b
        left join category c on b.category_id = c.id
EOF;
        $stmt = $connection->prepare($q);
        $stmt->execute();
        $books = $stmt->fetchAll(Doctrine_Core::FETCH_ASSOC);

        foreach ($books as $book) {
            $url = 'http://localhost:9200/books/book/' . $book['id'];
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($book));
            curl_exec($curl);
            unset($curl);
        }
    }
}
