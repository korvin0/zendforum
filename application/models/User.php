<?php

class Application_Model_User implements Zend_Acl_Role_Interface
{
    protected $_name;
    protected $_created_at;
    protected $_id;
    protected $_pass;
    protected $_role;
 
    public function __construct(array $options = null)
    {
        if (is_array($options)) {
            $this->setOptions($options);
        }
    }
 
    public function __set($name, $value)
    {
        $method = 'set' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid category property');
        }
        $this->$method($value);
    }
 
    public function __get($name)
    {
        $method = 'get' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid category property');
        }
        return $this->$method();
    }
    
    public function getRoleId()
    {
        return $this->getRole();
    }
 
    public function setOptions(array $options)
    {
        $methods = get_class_methods($this);
        foreach ($options as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (in_array($method, $methods)) {
                $this->$method($value);
            }
        }
        return $this;
    }
    
    public function setId($id)
    {
        $this->_id = (int) $id;
        return $this;
    }

    public function getId()
    {
        return $this->_id;
    }
    
    public function setName($name)
    {
        $this->_name = $name;
        return $this;
    }

    public function getName()
    {
        return $this->_name;
    }
    
    public function setPass($pass)
    {
        $this->_pass = $pass;
        return $this;
    }

    public function getPass()
    {
        return $this->_pass;
    }
    
    public function setRole($role)
    {
        $this->_role = $role;
        return $this;
    }

    public function getRole()
    {
        return $this->_role;
    }
    
    public function setCreated_at($created)
    {
        $this->_created_at = $created;
        return $this;
    }

    public function getCreated_at()
    {
        return $this->_created_at;
    }

}

