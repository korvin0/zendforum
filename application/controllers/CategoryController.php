<?php

class CategoryController extends Zend_Controller_Action
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
        //$categorymapper = new Application_Model_CategoryMapper();
        //$usermapper = new Application_Model_UserMapper();
        
        //$post = $postmapper->find(1);
        //$this->view->content = $topicmapper->findCategory(1)->getName();
        
        $categorymapper = new Application_Model_CategoryMapper();
        $this->view->topics = $categorymapper->findTopicsByCategoryId($this->getRequest()->getParam('id'));
        Zend_View_Helper_PaginationControl::setDefaultViewPartial('controls.phtml'); 
        $paginator = Zend_Paginator::factory($this->view->topics);
        $paginator->setCurrentPageNumber($this->_getParam('page', 1));
        $paginator->setItemCountPerPage(5);
        $paginator->setView(Zend_Controller_Front::getInstance()->getParam('bootstrap')->getResource('view'));
        $this->view->paginator = $paginator;
        
        $this->view->category = $categorymapper->find($this->getRequest()->getParam('id'));
    }


}

