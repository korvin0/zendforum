<?php
class Application_Form_Post_Add extends Zend_Form
{
    public function init()
    {
        $this->setMethod('post');
        $this->setAttrib('id', 'postform');
        $this->addElement(
            'textarea', 'body', array(
                'label' => 'Post body:',
                'required' => true,
                'filters'    => array('StringTrim', 'HtmlEntities'),
                'rows'=>7
            ));
        
        
 
        $this->addElement('submit', 'submit', array(
            'ignore'   => true,
            'label'    => 'Submit',
            ));
        $this->addElement('hash', 'saltstr', array('salt' => 'fha2sd5fvn'));
    }
}
?>