<?php

namespace Flywheel\Html\Form;

class Checkbox extends Input {
    protected $_type = 'checkbox';

    protected $_expect_value = '';

    /**
     * @param string $expect_value
     * @return $this
     */
    public function setExpectValue($expect_value)
    {
        $this->_expect_value = $expect_value;
        return $this;
    }

    public function setType($type)
    {
//        parent::setType($type); // TODO: Change the autogenerated stub
        return $this;
    }

    /**
     * display
     */
    public function display() {
        if ($this->_value == $this->_expect_value) {
            $this->_htmlOptions['checked'] = true;
        }

        parent::display();
    }
}