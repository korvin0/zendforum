<?php
class Application_Model_UserMapper
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
            $this->setDbTable('Application_Model_DbTable_User');
        }
        return $this->_dbTable;
    }
 
    public function save(Application_Model_User $user)
    {
        $data = array(
            'id'   => $user->getId(),
            'pass'=>$user->GetPass(),
            'role'=>$user->GetRole(),
            'name' => $user->getName(),
            'created_at' => $user->getCreated_at()
        );
 
        if (null === ($id = $user->getId())) {
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
    
    public function findByName($name)
    {
        if (!$name) return new Application_Model_UserEmpty();
        $row = $this->getDbTable()->fetchRow($this->getDbTable()->select()->where('name=?',$name));
        if (!$row) return new Application_Model_UserEmpty();
        
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
            $entry = new Application_Model_User();
            $entry->setOptions(array(
                'id'=>$row->id,
                'name'=>$row->name,
                'pass'=>$row->pass,
                'role'=>$row->role,
                'created_at' => $row->created_at
            ));
            $entries[] = $entry;
        }
        return $entries;
    }
}
