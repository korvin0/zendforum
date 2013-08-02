<?php
class CheckAuth extends Zend_Controller_Plugin_Abstract
{
    public function preDispatch(Zend_Controller_Request_Abstract $request) {

    }
    public function  postDispatch(Zend_Controller_Request_Abstract $request) {
        $form = new Application_Form_Auth_Login();
        $layout = Zend_Layout::getMvcInstance();
        $view = $layout->getView();
        

        
        //$view = $this->getResource('view');
        
        
        $view->render('_authblock.phtml');
    }
    


}
?>