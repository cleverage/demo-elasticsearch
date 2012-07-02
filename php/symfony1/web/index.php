<?php


require_once(dirname(__FILE__).'/../config/ProjectConfiguration.class.php');

//$configuration = ProjectConfiguration::getApplicationConfiguration('search', 'prod', false);
$configuration = ProjectConfiguration::getApplicationConfiguration('search', 'dev', true);
sfContext::createInstance($configuration)->dispatch();
