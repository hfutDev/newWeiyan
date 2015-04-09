<?php
  /**
  * 用户管理
  */
  class Application_Model_userMapper
  {
  	function __construct()
  	{
      $this->db = new Application_Model_DbTable_User();
  	}

    //检查用户名密码
    public function checkUser($uname,$pwd)
    {
      $ab = $this->db->getAdapter();
      $where = $ab->quoteInto('uname = ?',$uname)
      .$ab->quoteInto('AND pwd = ?',$pwd);
      $arr = $this->db->fetchAll($where)->toArray();
      return $arr;
    }

    //添加用户
    public function addUser($uname,$pwd)
    {
      $pwd = md5($pwd);
      $arr = array(
        'uname' => $uname,
        'pwd' => $pwd
        );
      $res = $this->db->insert($arr);
      return $res;
    }
  }
?>