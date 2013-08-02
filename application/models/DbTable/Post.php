<?php

class Application_Model_DbTable_Post extends Zend_Db_Table_Abstract
{

    protected $_name = 'z5_posts';
    
    protected $_referenceMap    = array(
        'Topic' => array(
            'columns'           => 'topic_id',
            'refTableClass'     => 'Application_Model_DbTable_Topic',
            'refColumns'        => 'id'
        ),
        'User' => array(
            'columns'           => 'user_id',
            'refTableClass'     => 'Application_Model_DbTable_User',
            'refColumns'        => 'id'
        ),
    );

}

