<?php
namespace Home\Controller;
use Think\Controller;
class CommonController extends Controller{
        public function _initialize(){
           //验证用户是否登录的代码
         $true=session('random');
         $state=session('state');
         $power=session('power');
		 if (!isset($true)||$true='') {
		 $this->redirect('Login/login');
        }else if($power=='1'){
       //  $this->assign('state',$power);	
       //  $this->redirect('Index/index');
        }else{
         if($state=='0'){
			$end_time=session('end_time');
			$now_time=date('Y-m-d H:i:s',time());
			if($now_time>=$end_time){
				  session(null); // 清空当前的session
				// $this->redirect('Login/login');
				 $this->error('登录过去，请重新登录');
			}
        }
        }
        //调用自定义方法包
		vendor('myClass.Functions','','.class.php');
		$_REQUEST = \Functions::RemoveXSS($_REQUEST);
		$_GET = \Functions::RemoveXSS($_GET);
		$_POST = \Functions::RemoveXSS($_POST);
         $this->assign('state',$power);	
    }
	}