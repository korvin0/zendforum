<?php

class Application_Model_DbTable_Category extends Zend_Db_Table_Abstract
{

    protected $_name = 'z5_categories';
    protected $_dependentTables = array('Application_Model_DbTable_Topic');

}

