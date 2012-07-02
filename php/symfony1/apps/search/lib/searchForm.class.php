<?php

class searchForm extends sfForm
{
    public function __construct()
    {
        parent::__construct();

        $this->setWidgets(array(
            'name' => new sfWidgetFormInputText(),
            'description' => new sfWidgetFormInputText(),
            'category' => new sfWidgetFormInputText()
        ));

        $this->setValidators(array(
            'name' => new sfValidatorPass(),
            'description' => new sfValidatorPass(),
            'category' => new sfValidatorPass()
        ));

        $this->widgetSchema->setNameFormat('search[%s]');
    }
}
