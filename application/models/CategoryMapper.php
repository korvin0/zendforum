<?php
class Application_Model_CategoryMapper
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
            $this->setDbTable('Application_Model_DbTable_Category');
        }
        return $this->_dbTable;
    }
 
    public function save(Application_Model_Category $category)
    {
        $data = array(
            'id'   => $category->getId(),
            'name' => $category->getName(),
            'created_at' => $category->getCreated_at()
        );
 
        if (null === ($id = $category->getId())) {
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
        $category = new Application_Model_Category();
        $category->setOptions(array(
            'id'=>$row->id,
            'name'=>$row->name,
            'created_at'=>$row->created_at
        ));
        
        return $category;
    }
 
    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll($this->getDbTable()->select()->order('created_at desc'));
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_Category();
            $entry->setOptions(array(
                'id'=>$row->id,
                'name'=>$row->name,
                'created_at'=>$row->created_at
            ));
            $entries[] = $entry;
        }
        return $entries;
    }
    
    public function findTopicsByCategoryId($id)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $resultSet = $row->findDependentRowset('Application_Model_DbTable_Topic');
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
}
