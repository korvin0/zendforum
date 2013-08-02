<?php
class Acl extends Zend_Acl {
    public function  __construct() {
        //Äîáàâëÿåì ðîëè
        $this->addRole('guest');
        $this->addRole('user', 'guest');
        $this->addRole('admin', 'user');

        

        // ÐÅÑÓÐÑÛ ÏÎËÜÇÎÂÀÒÅËß !
        $this->add(new Zend_Acl_Resource('forumpost'));
        $this->add(new Zend_Acl_Resource('index'));
        $this->add(new Zend_Acl_Resource('category'));
        $this->add(new Zend_Acl_Resource('topic'));
        $this->add(new Zend_Acl_Resource('auth'));
        $this->add(new Zend_Acl_Resource('error'));
        //$this->add(new Zend_Acl_Resource('user/index'), 'user_allow');
        // ...

        // ÐÅÑÓÐÑÛ ÀÄÌÈÍÀ !
        //$this->add(new Zend_Acl_Resource('admin_allow'));
        //$this->add(new Zend_Acl_Resource('admin/index'), 'admin_allow');
        //...        

        //Âûñòàâëÿåì ïðàâà, ïî-óìîë÷àíèþ âñ¸ çàïðåùåíî
        $this->deny(null, null, null);
        //$this->allow('owner', 'blogPost', 'publish', new OwnerCanPublishBlogPostAssertion());
        //$this->allow('guest', 'guest_allow', 'index');
        //$this->allow('user', 'user_allow', 'show');
        //$this->allow('guest', 'error');
        $this->allow('guest', 'index');
        $this->allow('guest', 'auth');
        $this->allow('guest', 'category');
        $this->allow('guest', 'topic');
        $this->allow('user', 'forumpost', 'edit', new UserCanEditHisPostAssertion());
        $this->allow('user', 'forumpost', 'add');
        $this->allow('admin');
    }
}