<?php

class Application_Model_UserEmpty implements Zend_Acl_Role_Interface
{
    public function getRoleId()
    {
        return 'guest';
    }
 
}

