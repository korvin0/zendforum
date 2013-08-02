<?php
class Application_Form_Auth_Register extends Zend_Form
{
    public function init()
    {
        $this->setMethod('post');
        $this->setAttrib('id', 'registerform');
        $this->addElement(
            'text', 'user', array(
                'label' => 'Username:',
                'required' => true,
                'filters'    => array('StringTrim'),
            ));
 
        $this->addElement('password', 'pass', array(
            'label' => 'Password:',
            'required' => true,
            ));
            
        $this->addElement('password', 'pass2', array(
            'label' => 'Password Repeat:',
            'required' => true,
            'validators' => array(
              array('Identical', false, array('token' => 'pass'))
            )));
 
        $this->addElement('submit', 'submit', array(
            'ignore'   => true,
            'label'    => 'Sign Up',
            ));
 
    }
}
?>