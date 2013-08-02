<?php

class TopicController extends Zend_Controller_Action
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
        
        $form = new Application_Form_Post_Add();
        
        
        $topicmapper = new Application_Model_TopicMapper();
        $this->view->posts = $topicmapper->findPostsByTopicId($this->getRequest()->getParam('id'));
        
        
        Zend_View_Helper_PaginationControl::setDefaultViewPartial('controls.phtml'); 
        $paginator = Zend_Paginator::factory($this->view->posts);
        
        $perpage = 5;
        if ($this->_getParam('post'))
        {
            $count = 0;
            foreach ($this->view->posts as $v)
            {
                if ($v->getId() != $this->_getParam('post')) $count++;
                else break;
            }
            $page = ceil($count/$perpage);
        }
        else $page = $this->_getParam('page', 1);
        $paginator->setCurrentPageNumber($page);
        $paginator->setItemCountPerPage($perpage);
        $paginator->setView(Zend_Controller_Front::getInstance()->getParam('bootstrap')->getResource('view'));
        $this->view->paginator = $paginator;

        $this->view->topic = $topicmapper->find($this->getRequest()->getParam('id'));
        $this->view->category = $topicmapper->findCategory($this->getRequest()->getParam('id'));
        
        $acl = Zend_Controller_Front::getInstance()->getParam('bootstrap')->getResource('Acl');
        $usermapper = new Application_Model_UserMapper();
        $username = Zend_Auth::getInstance()->getIdentity();
        
        $user = $usermapper->findByName($username);
        
        if ($acl->isAllowed($user, 'forumpost', 'add'))
        {
            $this->view->postform = $form;
            $helperUrl = new Zend_View_Helper_Url();
            $this->view->postform->setAction($helperUrl->url(array('controller'=>'forumpost', 'action'=>'add', 'id'=>null,'topic'=>$this->getRequest()->getParam('id'))));
        }
    }

}

