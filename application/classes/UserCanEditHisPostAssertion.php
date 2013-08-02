<?php
class UserCanEditHisPostAssertion implements Zend_Acl_Assert_Interface
{
    /**
     * This assertion should receive the actual User and BlogPost objects.
     *
     * @param Zend_Acl $acl
     * @param Zend_Acl_Role_Interface $user
     * @param Zend_Acl_Resource_Interface $blogPost
     * @param $privilege
     * @return bool
     */
    public function assert(Zend_Acl $acl,
                           Zend_Acl_Role_Interface $user = null,
                           Zend_Acl_Resource_Interface $blogPost = null,
                           $privilege = null)
    {
        if (!$user instanceof Application_Model_User) {
            throw new Exception(__CLASS__
                              . '::'
                              . __METHOD__
                              . ' expects the role to be'
                              . ' an instance of User');
        }
 
        if (!$blogPost instanceof Application_Model_Post) {
            throw new Exception(__CLASS__
                              . '::'
                              . __METHOD__
                              . ' expects the resource to be'
                              . ' an instance of Application_Model_Post');
        }
 
        // if role is publisher, he can always modify a post
        if ($user->getRoleId() == 'publisher') return true;
 
        // check to ensure that everyone else is only modifying their own post
        return ($user->getId() == $blogPost->getUser_id());
    }
}