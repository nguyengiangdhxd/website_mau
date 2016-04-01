<?php
/**
 * Created by PhpStorm.
 * User: nobita
 * Date: 2/3/15
 * Time: 11:12 AM
 */

namespace Frontend\Controller;

class Error extends FrontendBase {

    public function executeDefault() {
        $this->setView('Error/default');
        return $this->renderComponent();
    }

}