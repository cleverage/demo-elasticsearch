<?php

class doctrineInitdataTask extends sfBaseTask
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

    $this->namespace        = 'doctrine';
    $this->name             = 'init-data';
    $this->briefDescription = '';
    $this->detailedDescription = <<<EOF
The [doctrine:init-data|INFO] task does things.
Call it with:

  [php symfony doctrine:init-data|INFO]
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'])->getConnection();

    // add your code here
    for ($i = 0; $i < 10000; $i++) {
        $book = new Book();
        $book->fromArray(array(
            'name' => 'name_' . $i,
            'description' => 'description_' . $i,
            'category_id' => rand(1, 4),
            'is_available' => rand() % 2,
            'is_public' => rand() % 2
        ));
        $book->save();
        unset($book);
    }
  }
}
