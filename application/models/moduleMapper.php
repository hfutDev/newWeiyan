<?php
  /**
  * 板块管理
  */
  class Application_Model_moduleMapper
  {
  	
  	function __construct()
  	{
      $this->db = new Application_Model_DbTable_Module();
  	}

    public function findAll()
    {
      $res = $this->db->fetchAll()->toarray();
      return $res;
    }

    //根据id获取板块信息
    public function getById($module_id)
    {
      $ab = $this->db->select();
      $ab = $ab->from("module",'module_name');
      $where = $ab->where("module_id =?",$module_id);
      $res = $this->db->fetchRow($where)->toarray();
      return $res;
    }

    //更新板块
    public function Update($module_id,$module_info)
    {
      if ($module_info['name']) {
        $module_name = $module_info['name'];
      } else {
        $module_name = new Zend_Db_Expr('module_name');
      }

      if ($module_info['img']) {
        $module_img = $module_info['img'];
      } else {
        $module_name = new Zend_Db_Expr('module_name');
      }
      
      if ($module_info['title']) {
        $module_title = $module_info['title'];
      } else {
        $module_name = new Zend_Db_Expr('module_name');
      }

      $upArr = array(
        'module_name'=>$module_name,
        'module_img'=>$module_img,
        'module_title'=>$module_title
        );
      $ab = $this->db->getAdapter();
      $where = $ab->quoteInto('module_id=?',$module_id);
      $res = $this->db->update($set=$upArr,$where);
      return $res;
    }
  }
?>