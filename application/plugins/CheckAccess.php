<?php
class CheckAccess extends Zend_Controller_Plugin_Abstract {
    public function preDispatch(Zend_Controller_Request_Abstract $request) {
        $acl = Zend_Controller_Front::getInstance()->getParam('bootstrap')->getResource('Acl');
        $storage_data = Zend_Auth::getInstance()->getIdentity();
        $username = !empty($storage_data) ? $storage_data : '';
        
        $usermapper = new Application_Model_UserMapper();
        $user = $usermapper->findByName($username);
        
        //echo $user->getRoleId();exit;
        //if ($acl->isAllowed($user, $request->getControllerName(), $request->getActionName())) echo 'allow'; else echo 'dis'; exit;
        //echo $request->getControllerName();exit;
        
        $postmapper = new Application_Model_PostMapper();
        if ($request->getControllerName() == 'forumpost' && $request->getActionName() == 'edit') $resource = $postmapper->find($request->getParam('id'));
        else $resource = $request->getControllerName();
        if (!$acl->isAllowed($user, $resource, $request->getActionName())) $this->generateAccessError();
    }

    public function generateAccessError($msg='test!'){
        $request = $this->getRequest();
        $request->setControllerName ('error');
        $request->setActionName('error');
        $request->setParam('message', $msg);
    }
}