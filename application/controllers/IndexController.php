<?php

class IndexController extends Zend_Controller_Action
{
    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
        
        //$postmapper = new Application_Model_PostMapper();
        //$topicmapper = new Application_Model_TopicMapper();
        //$categorymapper = new Application_Model_categoryMapper();
        //$usermapper = new Application_Model_UserMapper();
        
        //$post = $postmapper->find(1);
        //$this->view->content = $topicmapper->findCategory(1)->getName();
        
        $categorymapper = new Application_Model_categoryMapper();
        $this->view->categories = $categorymapper->fetchAll();
    }


}

