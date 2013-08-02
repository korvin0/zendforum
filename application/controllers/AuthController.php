<?php

class AuthController extends Zend_Controller_Action
{
    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
    }
    
    public function loginAction()
    {
        $form = new Application_Form_Auth_Login();
        
        if ($this->getRequest()->isPost() && $this->getRequest()->getPost('username'))
        {
            $db = Zend_Registry::get('db');
              if ($form->isValid($_POST))
              {
                $adapter = new Zend_Auth_Adapter_DbTable(
                    $db,
                    'z5_users',
                    'name',
                    'pass',
                    'MD5(?)'
                );

                $adapter->setIdentity($form->getValue('username'));
                $adapter->setCredential($form->getValue('password'));

                $auth   = Zend_Auth::getInstance();
                $result = $auth->authenticate($adapter);

                if ($result->isValid()) {
                    
                    //$flash = Zend_Controller_Action_HelperBroker::getStaticHelper('FlashMessenger');
                    //$flash->flashMessenger('Successful Login');
                    $redirector = Zend_Controller_Action_HelperBroker::getStaticHelper('redirector');
                    $redirector->gotoUrl('/');
                    return;
                }
                else
                {
                    
                }
            }
        }
        $this->view->form = $form;
    }
    public function signupAction()
    {
        $form = new Application_Form_Auth_Register();
        if ($this->getRequest()->isPost() && $this->getRequest()->getPost('submit'))
        {
            if ($form->isValid($_POST))
            {
                $usermapper = new Application_Model_UserMapper();
                $data = array(
                    'name'=>$form->getValue('user'),
                    'pass'=>md5($form->getValue('pass')),
                    'role'=>'user',
                    'created_at'=>new Zend_Db_Expr('NOW()')
                );
                $user = new Application_Model_User($data);
                $usermapper->save($user);
                
                $db = Zend_Registry::get('db');
                $adapter = new Zend_Auth_Adapter_DbTable(
                    $db,
                    'z5_users',
                    'name',
                    'pass',
                    'MD5(?)'
                );

                $adapter->setIdentity($form->getValue('user'));
                $adapter->setCredential($form->getValue('pass'));

                $auth   = Zend_Auth::getInstance();
                $result = $auth->authenticate($adapter);
                
                $this->_redirect('/');
            }
        }
        
        $this->view->form = $form;
    }
    
    public function logoutAction()
    {
        $auth = Zend_Auth::getInstance();
        $auth->clearIdentity();
        $this->_redirect('/');
    }

}

