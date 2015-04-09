<?php
 class LoginController extends Zend_Controller_Action
 {
 	public function init()
    {
    }

    public function indexAction()
    {
        $session = new Zend_Session_Namespace('zixun');
        if (isset($session->admin)) {
            $this->_redirect("/admin");
        }
    }

    //登录
    public function loginAction()
    {
        $session = new Zend_Session_Namespace('zixun');
        if (isset($session->admin)) {
            $this->_redirect("/admin");
            exit;
        }
        $username = strip_tags(trim($this->getRequest()->getParam("username")));
        $pwd = strip_tags(trim($this->getRequest()->getParam("pwd")));

        if (empty($username)||empty($pwd)) {
            echo "nullError";
            exit;
        }
        $pwd = md5(md5($pwd));
        //超级管理员
        if ($username == "online" && $pwd == "72dd2ee1012fe9c3ae15beb340454be2") {
            $session->admin = "superAdmin";
            $status = "success";
            $info = "loginSuccess";
        }
        else {//普通管理员
            $UserMapper = new Application_Model_userMapper();
            $result = $UserMapper->checkUser($username,$pwd);
            if ($result) {
                $session->admin = "admin";
                $status = "success";
                $info = "loginSuccess";
            }
            else {
                $status = "error";
                $info = "pwdError";
            }
        }
        Json($status,$info);
    }

    //注销登陆
    public function logoutAction()
    {
        $session = new Zend_Session_Namespace('user');
        unset($_SESSION);
        $_SESSION=array();
        session_destroy();
        $this->_redirect('/login');
        exit;
    }

    //注册添加用户
    public function regAction()
    {
        $username = strip_tags(trim($this->getRequest()->getParam("username")));
        $pwd = strip_tags(trim($this->getRequest()->getParam("pwd")));

        if (empty($username)||empty($pwd)) {
            echo "nullError";
            exit;
        }

        $pwd = md5($pwd);
        $UserMapper = new Application_Model_userMapper();
        $result = $UserMapper->addUser($username,$pwd);
        if ($result) {
            $status = "success";
            $info = "regSuccess";
        }
        else {
            $status = "error";
            $info = "pwdError";
        }
        Json($status,$info);
    }

 }

 //返回json数据
 function Json($status,$info) {
    $array = array("status"=>$status,"info"=>$info);
    echo json_encode($array);
 }