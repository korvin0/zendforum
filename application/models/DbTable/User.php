<?php

class Application_Model_DbTable_User extends Zend_Db_Table_Abstract
{

    protected $_name = 'z5_users';
    protected $_dependentTables = array('Application_Model_DbTable_Post');


}

