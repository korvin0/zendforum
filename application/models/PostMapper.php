<?php
class Application_Model_PostMapper
{
    protected $_dbTable;
 
    public function setDbTable($dbTable)
    {
        if (is_string($dbTable)) {
            $dbTable = new $dbTable();
        }
        if (!$dbTable instanceof Zend_Db_Table_Abstract) {
            throw new Exception('Invalid table data gateway provided');
        }
        $this->_dbTable = $dbTable;
        return $this;
    }
 
    public function getDbTable()
    {
        if (null === $this->_dbTable) {
            $this->setDbTable('Application_Model_DbTable_Post');
        }
        return $this->_dbTable;
    }
 
    public function save(Application_Model_Post $post)
    {
        $data = array(
            'id'   => $post->getId(),
            'body' => $post->getBody(),
            'created_at' => $post->getCreated_at(),
            'topic_id'   => $post->getTopic_id(),
            'user_id'   => $post->getUser_id(),
        );
 
        if (null === ($id = $post->getId())) {
            unset($data['id']);
            $id = $this->getDbTable()->insert($data);
            $post->setId($id);
            return $post;
        } else {
            $this->getDbTable()->update($data, array('id = ?' => $id));
        }
    }
    
    public function delete(Application_Model_Post $post)
    {
        $this->getDbTable()->delete($this->getDbTable()->getAdapter()->quoteInto('id = ?', $post->getId()));
    }
 
    public function find($id)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $post = new Application_Model_Post();
        $post->setOptions(array(
            'id'=>$row->id,
            'body'=>$row->body,
            'created_at'=>$row->created_at,
            'topic_id' => $row->topic_id,
            'user_id' => $row->user_id,
        ));
            
        return $post;
    }
    
    public function findTopic($id)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current()->findParentRow('Application_Model_DbTable_Topic');
        $topic = new Application_Model_Topic();
        $topic->setOptions(array(
            'id'=>$row->id,
            'name'=>$row->name,
            'created_at' => $row->created_at
        ));
        
        return $topic;
    }
    
    public function findUser($id)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current()->findParentRow('Application_Model_DbTable_User');
        $user = new Application_Model_User();
        $user->setOptions(array(
            'id'=>$row->id,
            'name'=>$row->name,
            'pass'=>$row->pass,
            'role'=>$row->role,
            'created_at' => $row->created_at
        ));
        
        return $user;
    }
 
    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_Post();
            $entry->setOptions(array(
                'id'=>$row->id,
                'body'=>$row->body,
                'created_at'=>$row->created_at,
                'topic_id' => $row->topic_id,
                'user_id' => $row->user_id,
            ));
            $entries[] = $entry;
        }
        return $entries;
    }
    

}
