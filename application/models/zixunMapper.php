<?php
  /**
  * 资讯文章管理
  */
  class Application_Model_zixunMapper
  {
  	
  	function __construct()
  	{
      $this->db = new Application_Model_DbTable_Zixun();
  	}

    //获取资讯
    public function getAll()
    {
      $order = 'addtime DESC';
      $resArr = $this->db->fetchAll($order)->toArray();
      return $resArr;
    }

    //分板块组资讯
    public function findByModule($module_id)
    {
      $ab = $this->db->getAdapter();
      $where = $ab->quoteInto('module_id IN(?)',$module_id);
      $order = 'addtime DESC';
      $resArr = $this->db->fetchAll($where,$order)->toArray();
      return $resArr;
    }

    //子版块组
    public function findByColumnArr($columnArr)
    {
      $ab = $this->db->getAdapter();
      $where = $ab->quoteInto('column_id IN(?)',$columnArr);
      $order = 'addtime DESC';
      $resArr = $this->db->fetchAll($where,$order)->toArray();
      return $resArr;
    }

    public function findByColumn($column)
    {
      $ab = $this->db->getAdapter();
      $where = $ab->quoteInto('column_id =?',$column);
      $order = 'addtime DESC';
      $resArr = $this->db->fetchAll($where,$order)->toArray();
      return $resArr;
    }

    //根据id获取文章详情
    public function getById($id)
    {
      $ab = $this->db->select();
      $where = $ab->where("id =?",$id);
      $res = $this->db->fetchAll($where)->toarray();
      return $res;
    }

    //更新浏览量
    public function visitUpdate($id)
    {
      $upArr = array('visited' => new Zend_Db_Expr('visited+1'));
      $ab = $this->db->getAdapter();
      $where = $ab->quoteInto('id=?',$id);
      $res = $this->db->update($set=$upArr,$where);
      return $res;
    }
  }
?>