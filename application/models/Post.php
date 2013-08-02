<?php

class Application_Model_Post implements Zend_Acl_Resource_Interface
{
    protected $_body;
    protected $_created_at;
    protected $_id;
    protected $_topic_id;
    protected $_user_id;


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
            throw new Exception('Invalid post property');
        }
        $this->$method($value);
    }

    public function __get($name)
    {
        $method = 'get' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid post property');
        }
        return $this->$method();
    }
    
    public function getResourceId()
    {
        return 'forumpost';
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
    
    public function setBody($body)
    {
        $this->_body = $body;
        return $this;
    }

    public function getBody()
    {
        return $this->_body;
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
    
    public function setUser_id($user_id)
    {
        $this->_user_id = $user_id;
        return $this;
    }

    public function getUser_id()
    {
        return $this->_user_id;
    }
    
    public function setTopic_id($topic_id)
    {
        $this->_topic_id = $topic_id;
        return $this;
    }

    public function getTopic_id()
    {
        return $this->_topic_id;
    }
    
    public function getUser()
    {
        $mapper = new Application_Model_PostMapper();
        return $mapper->findUser($this->getId());;
    }


}

