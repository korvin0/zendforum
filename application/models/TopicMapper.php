<?php
class Application_Model_TopicMapper
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
            $this->setDbTable('Application_Model_DbTable_Topic');
        }
        return $this->_dbTable;
    }
 
    public function save(Application_Model_Topic $topic)
    {
        $data = array(
            'id'   => $topic->getId(),
            'name' => $topic->getName(),
            'created_at' => $topic->getCreated_at(),
            'category_id'   => $topic->getCategory_id(),
        );
 
        if (null === ($id = $topic->getId())) {
            unset($data['id']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('id = ?' => $id));
        }
    }
 
    public function find($id)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $topic = new Application_Model_Topic();
        $topic->setOptions(array(
            'id'=>$row->id,
            'name'=>$row->name,
            'created_at'=>$row->created_at,
            'category_id' => $row->category_id,
        ));
        
        return $topic;
    }
 
    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_Topic();
            $entry->setOptions(array(
                'id'=>$row->id,
                'name'=>$row->name,
                'created_at'=>$row->created_at,
                'category_id' => $row->category_id,
            ));
            $entries[] = $entry;
        }
        return $entries;
    }
    
    public function findCategory($id)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current()->findParentRow('Application_Model_DbTable_Category');
        $parent = new Application_Model_Category();
        $parent->setOptions(array(
            'id'=>$row->id,
            'name'=>$row->name,
            'created_at' => $row->created_at
        ));
        
        return $parent;
    }
    
    public function findPostsByTopicId($id)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $resultSet = $row->findDependentRowset('Application_Model_DbTable_Post');
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
