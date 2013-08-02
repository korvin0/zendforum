<?php

class Application_Model_DbTable_Topic extends Zend_Db_Table_Abstract
{
    protected $_name = 'z5_topics';
    protected $_dependentTables = array('Application_Model_DbTable_Post');
    protected $_referenceMap    = array(
        'Category' => array(
            'columns'           => 'category_id',
            'refTableClass'     => 'Application_Model_DbTable_Category',
            'refColumns'        => 'id'
        )
    );
}

