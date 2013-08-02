<?php

class Application_Model_Topic
{
    protected $_name;
    protected $_created_at;
    protected $_id;
    protected $_category_id;
 
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
            throw new Exception('Invalid topic property');
        }
        $this->$method($value);
    }
 
    public function __get($name)
    {
        $method = 'get' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid topic property');
        }
        return $this->$method();
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
    
    public function setCreated_at($created)
    {
        $this->_created_at = $created;
        return $this;
    }

    public function getCreated_at()
    {
        return $this->_created_at;
    }
    
    public function setCategory_Id($category_id)
    {
        $this->_category_id = (int) $category_id;
        return $this;
    }

    public function getCategory_Id()
    {
        return $this->_category_id;
    }

}

