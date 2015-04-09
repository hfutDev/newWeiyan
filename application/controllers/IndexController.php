<?php
header("Content-Type:text/html; charset=UTF-8");
class IndexController extends Zend_Controller_Action
{

    public function init()
    {
    }

    public function indexAction()
    {
    	$moduleMapper = new Application_Model_moduleMapper();
    	$moduleAll = $moduleMapper->findAll();
        $i = 1;
    	foreach ($moduleAll as $key => $module_v) {
            $moduleA[$i]['id'] = $module_id = $module_v['module_id'];//板块名称
    		$moduleA[$i]['name'] = $module_v['module_name'];//板块名称
            $moduleA[$i]['img'] = $module_v['module_img'];
            $moduleA[$i]['title'] = $module_v['module_title'];

    		$columnMapper = new Application_Model_columnMapper();
    		$query_column = $columnMapper->getColumn($module_id);
    		if ($query_column) {
                $y = 1;
    			foreach ($query_column as $key => $column_v) {
                    $columnA[$i][$y]['name'] = $column_v['column_name'];//子版块
    				$columnA[$i][$y]['id'] = $column_v['column_id'];//子版块
                    $y++;            
    			}
    		}
            $i++;
    	}
        $this->view->module = $moduleA;
        $this->view->column = $columnA;
    }

    public function columnAction()
    {
    	if ($this->getRequest()->getParam('cid')) {
    		$c = trim($this->getRequest()->getParam('cid'));
    		if (!empty($c)) {
    			$column = trim($this->getRequest()->getParam('cid'));
    			 
    		}
    	}
    	else if (!empty($this->getRequest()->getParam('mid'))) {
    		$m = trim($this->getRequest()->getParam('mid'));
    		if (!empty($m)) {
    			$columnMapper = new Application_Model_columnMapper();
    			$query_column = $columnMapper->getColumnId($m);
    			if ($query_column) {
    				$column = $query_column[0]['column_id'];
    			}
    		}
    	}
        else {
            $column = 1;
        }
        if (!is_numeric($column)) {
            $column = 1;
        }
    	if (isset($column)&&!empty($column)) {
            $columnMapper = new Application_Model_columnMapper();
            $this->view->colNow = $columnMapper->getById($column);
            $this->view->col = $columnMapper->findOther($column);
            $column = array($column);
    		$zixunMapper = new Application_Model_zixunMapper();
    		$article = $zixunMapper->findByColumnArr($column);
    		// if ($article) {
    		// 	$this->view->article = $article;
    		// }
            $num=10; $page=1; //设置每一页显示学生信息数目 //设置第一页显示
            $paginator_articleinfo = new Zend_Paginator(new Zend_Paginator_Adapter_Array($article)); //调用分页
            $paginator_articleinfo->setItemCountPerPage($num); //设置每一页显示的学生信息数目
            $paginator_articleinfo->setCurrentPageNumber($page); //设置第一页显示
            $paginator_articleinfo->setCurrentPageNumber($this->_getParam('page')); //从url获取需要显示的页码
            $this->view->paginator_articleinfo = $paginator_articleinfo;
    	}
    }

    //板块
    public function moduleAction()
    {
        if ($this->getRequest()->getParam('cid')) {
            $c = trim($this->getRequest()->getParam('cid'));
            if (!empty($c)) {
                $column = trim($this->getRequest()->getParam('cid'));
                $columnMapper = new Application_Model_columnMapper();
                $module = $columnMapper->getModule($column);
                $module_id = $module['module_id'];
            }
        }
        else if (!empty($this->getRequest()->getParam('mid'))) {
            $m = trim($this->getRequest()->getParam('mid'));
            if (!empty($m)) {
                $module_id = $m;
            }
        }
        else {
            $module_id = 1;
        }
        if (!is_numeric($module_id)) {
            $module_id = 1;
        }

        if (isset($module_id)&&!empty($module_id)) {
            $columnMapper = new Application_Model_columnMapper();
            $col_id = $this->view->col = $columnMapper->getColumn($module_id);
            $countUl = $this->view->ul = count($col_id);
            $zixunMapper = new Application_Model_zixunMapper();
            for ($i=1; $i <= $countUl; $i++) {
                $column_id = $col_id[$i-1]['column_id'];
                $article = $zixunMapper->findByColumn($column_id);
                $articleArr[$i] = $article;
            }
            $this->view->articleArr = $articleArr;
            // $num=10; $page=1; //设置每一页显示学生信息数目 //设置第一页显示
            // $paginator_articleinfo = new Zend_Paginator(new Zend_Paginator_Adapter_Array($articleArr)); //调用分页
            // $paginator_articleinfo->setItemCountPerPage($num); //设置每一页显示的学生信息数目
            // $paginator_articleinfo->setCurrentPageNumber($page); //设置第一页显示
            // $paginator_articleinfo->setCurrentPageNumber($this->_getParam('page')); 
            // //从url获取需要显示的页码
            // $this->view->paginator_articleinfo = $paginator_articleinfo;
        }
    }

    //资讯阅读页
    public function articleAction()
    {
    	if ($this->getRequest()->getParam('aid')) {
    		$aid = strip_tags(trim($this->getRequest()->getParam('aid')));
    		if (!empty($aid)) {
    			$zixunMapper = new Application_Model_zixunMapper();
    			$zixunArr = $zixunMapper->getById($aid);
    			if ($zixunArr) {
    				// $moduleMapper = new Application_Model_moduleMapper();
    				// $columnMapper = new Application_Model_columnMapper();
    				// $module = $moduleMapper->getById($zixunArr[0]['module_id']);
    				// $column = $columnMapper->getById($zixunArr[0]['column_id']);
                    $articleArr = array(
                        'status' => 'success',
                        // 'module' => urlencode($module['module_name']),//所属板块
                        // 'column' => urlencode($column['column_name']),//所属子版块
                        'author' => urlencode($zixunArr[0]['author']),//作者
                        'from' => urlencode($zixunArr[0]['source']),//来源
                        'addtime' => $zixunArr[0]['addtime'],//发布时间
                        'pv' => $zixunArr[0]['visited'],//浏览量
                        'title' => urlencode($zixunArr[0]['title']),//标题
                        'content' => urlencode($zixunArr[0]['content'])//正文
                        );
                    $json = json_encode($articleArr);
                    echo urldecode($json);
    				// $visitUpdate = $zixunMapper->visitUpdate($aid);//刷新浏览量
    			}
    		}
    	}
    }
}
   