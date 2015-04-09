<?php
header("Content-Type:text/html; charset=UTF-8");
class AdminController extends Zend_Controller_Action
{

    public function init()
    {
        $session = new Zend_Session_Namespace('zixun');
    	if (!isset($session->admin)) {
    		$this->_redirect("/login");
    	}
    }

    public function indexAction()
    {
    }

    public function moduleAction()
    {
    }
}
   