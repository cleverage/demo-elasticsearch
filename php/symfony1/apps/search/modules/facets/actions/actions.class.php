<?php

/**
 * facets actions.
 *
 * @package    elasticsearch
 * @subpackage facets
 * @author
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class facetsActions extends sfActions
{
    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request)
    {
        $this->form = new searchForm();
        $this->params = $request->getGetParameter('search', array());

        $q = new Elastica_Query();
        $q->setSort(array('name' => array('order' => 'asc')));

        $facet = new Elastica_Facet_Terms('category');
        $facet->setField('category')->setSize(100)->setGlobal()->setOrder('term');
        $q->addFacet($facet);

        $client = new Elastica_Client(array('host' => 'localhost', 'port' => 9200));

        $search = new Elastica_Search($client);
        $search->addIndex($client->getIndex('books'));

        $q->setParam('size', 20);
        $q->setFields(array('name', 'description', 'category'));

        $this->books = new sfOutputEscaperSafe($search->search($q));
    }
}
