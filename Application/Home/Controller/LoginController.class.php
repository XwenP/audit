<?php
namespace Home\Controller;
use Think\Controller;
use Think\Verify;
class LoginController extends Controller {
    public function login(){
        $this->display();
    }
	public function login_val(){
     $name=I('post.name');
     $password=I('post.password');
	 // $password = hash("sha256", $password);
	  $code=I('post.verify');
     $verify = new \Think\Verify();
	  $res = $verify->check($code);
	  if($res){
    $admin=M('admin');
    $map['user_name']=$name;
    $map['password']=$password;
    $arr=$admin->where($map)->find();
    $id=$arr['id'];
	  $power=$arr['power'];
    $state=$arr['state'];
    $end_time=$arr['end_time'];
    if ($id=='') {
         $resultData['data']='400';       
    }else{
      if($power=='1'){
            $random=random_create();
            session('random',$random);
            session('id',$id);
            session('state',$state);
            session('power',$power);
            session('end_time',$end_time);
            session('admin_name',$name);
            $resultData['data']='200';
      }else{

        if($state=='0'){
           $resultData['data']='800';
        } else{
          $now_time=date('Y-m-d H:i:s');
          if($end_time>$now_time){
            $random=random_create();
            session('random',$random);
            session('id',$id);
            session('state',$state);
            session('power',$power);
            session('end_time',$end_time);
            session('admin_name',$name);
            $resultData['data']='200';
          }else{
            $map_1['id']=$id;
            $admin-> where($map_1)->setField('state','0');
            $resultData['data']='800';
          }

      }
     }
    }
	  }else{
		   $resultData['data']='600';
	  }
		 $resultData['test']=$res;
      $this->ajaxReturn($resultData);
   }
	public function verify()
  {
	   ob_clean();
	  $config = [
		    'seKey'     =>  'ThinkPHP.CN',   // 验证码加密密钥
          'codeSet'   =>  '0123456789',  
          'fontSize' => 24, // 验证码字体大小
           'length' => 4, // 验证码位数
           'imageH' => 50,
		  'useCurve'  =>  false,            // 是否画混淆曲线
        'useNoise'  =>  true,            // 是否添加杂点  
		    
        ];
    $Verify = new Verify($config);
    $Verify->entry();
  }

	
}