<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    protected function _initDoctype()
    {
        $this->bootstrap('view');
        $view = $this->getResource('view');
        $view->doctype('HTML5');
        $this->bootstrap('db');
        $db = $this->getResource('db');
        Zend_Registry::set('db', $db);
        $view->placeholder('authblock');
        $auth = Zend_Auth::getInstance();
        if ($auth->hasIdentity())
        {
            $usermapper = new Application_Model_UserMapper();
            $view->user = $usermapper->findByName($auth->getIdentity());
        }
    }
    
    public function _initAcl()
    {
        
        Zend_Loader::loadClass('Acl');
        Zend_Loader::loadClass('CheckAccess');
        Zend_Loader::loadClass('UserCanEditHisPostAssertion');
        Zend_Controller_Front::getInstance()->registerPlugin(new CheckAccess());
        Zend_Loader::loadClass('CheckAuth');
        Zend_Controller_Front::getInstance()->registerPlugin(new CheckAuth());
        
        
        return new Acl();
    } 
}
