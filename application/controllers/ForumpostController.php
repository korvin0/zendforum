<?php

class ForumpostController extends Zend_Controller_Action
{
    public function init()
    {
        /* Initialize action controller here */
    }

    public function addAction()
    {
        // action body
        
        //$postmapper = new Application_Model_PostMapper();
        //$topicmapper = new Application_Model_TopicMapper();
        //$categorymapper = new Application_Model_CategoryMapper();
        //$usermapper = new Application_Model_UserMapper();
        
        //$post = $postmapper->find(1);
        //$this->view->content = $topicmapper->findCategory(1)->getName();
        
        $form = new Application_Form_Post_Add();
        if ($this->getRequest()->isPost() && $this->getRequest()->getPost('submit'))
        {
            if ($form->isValid($_POST))
            {
                $postmapper = new Application_Model_PostMapper();
                $usermapper = new Application_Model_UserMapper();
                $user = $usermapper->findByName(Zend_Auth::getInstance()->getIdentity());
                
                $data = array(
                    'body'=>$form->getValue('body'),
                    'user_id'=>$user->getId(),
                    'topic_id'=>$this->getRequest()->getParam('topic'),
                    'created_at'=>new Zend_Db_Expr('NOW()')
                );
                $post = new Application_Model_Post($data);
                $post = $postmapper->save($post);
                $helperUrl = new Zend_View_Helper_Url();
                $this->_redirect($helperUrl->url(array('controller'=>'topic', 'action'=>'index', 'topic'=>null, 'id'=>$this->getRequest()->getParam('topic'), 'post'=>$post->getId())));
            }
        }
        $this->view->postform = $form;
    }

    public function editAction()
    {
        // action body
        
        //$postmapper = new Application_Model_PostMapper();
        //$topicmapper = new Application_Model_TopicMapper();
        //$categorymapper = new Application_Model_CategoryMapper();
        //$usermapper = new Application_Model_UserMapper();
        
        //$post = $postmapper->find(1);
        //$this->view->content = $topicmapper->findCategory(1)->getName();
        
        $form = new Application_Form_Post_Add();
        $helperUrl = new Zend_View_Helper_Url();
        $postmapper = new Application_Model_PostMapper();
        if ($this->getRequest()->isPost() && $this->getRequest()->getPost('submit'))
        {
            if ($form->isValid($_POST))
            {
                $post = $postmapper->find($this->getRequest()->getParam('id'));
                
                $post->setBody($form->getValue('body'));
                $postmapper->save($post);
                
                $topic = $postmapper->findTopic($post->getId());
                $this->_redirect($helperUrl->url(array('controller'=>'topic', 'action'=>'index', 'id'=>$topic->getId(), 'post'=>$post->getId())));
            }
        }
        $post = $postmapper->find($this->getRequest()->getParam('id'));
        $form->setAction($helperUrl->url(array('controller'=>'forumpost', 'action'=>'edit', 'id'=>$this->getRequest()->getParam('id'))));
        $form->body->setValue($post->getBody());
        $this->view->postform = $form;
    }
    
    public function deleteAction()
    {
        $postmapper = new Application_Model_PostMapper();
        $post = $postmapper->find($this->getRequest()->getParam('id'));
        if ($post)
        {
            $topic = $postmapper->findTopic($post->getId());
            $postmapper->delete($post);
        }
        $helperUrl = new Zend_View_Helper_Url();
        if ($topic) $this->_redirect($helperUrl->url(array('controller'=>'topic', 'action'=>'index', 'id'=>$topic->getId())));
        else $this->_redirect('/');
    }
}

