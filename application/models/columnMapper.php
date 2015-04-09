<?php
  /**
  * 板块分列管理
  */
  class Application_Model_columnMapper
  {
  	
  	function __construct()
  	{
      $this->db = new Application_Model_DbTable_Column();
  	}

    //根据id获取子板块信息
    public function getById($column_id)
    {
      $ab = $this->db->select();
      $ab = $ab->from("column",'column_name');
      $where = $ab->where("column_id =?",$column_id);
      $res = $this->db->fetchRow($where)->toarray();
      return $res;
    }

    //根据板块获取子版块
    public function getColumn($module_id)
    {
      $ab = $this->db->select();
      $where = $ab->where("module_id =?",$module_id);
      $res = $this->db->fetchAll($where)->toarray();
      return $res;
    }

    public function getModule($column_id)
    {
      $ab = $this->db->select();
      $ab = $ab->from("column",'module_id');
      $where = $ab->where("column_id =?",$column_id);
      $result = $this->db->fetchRow($where)->toarray();
      if ($result) {
        return $result;
      }
    }

    public function findOther($column_id)
    {
      $ab = $this->db->select();
      $where = $ab->where("column_id =?",$column_id);
      $result = $this->db->fetchRow($where)->toarray();
      if ($result) {
        $ab = $this->db->select();
        $where = $ab->where("module_id =?",$result['module_id']);
        $res = $this->db->fetchAll($where)->toarray();
        if ($res) {
          return $res;
        }
      }
    }


    //根据板块获取子版块id
    public function getColumnId($module_id)
    {
      $ab = $this->db->select();
      $ab = $ab->from("column",'column_id');
      $where = $ab->where("module_id =?",$module_id);
      $res = $this->db->fetchAll($where)->toarray();
      return $res;
    }
  }
?>