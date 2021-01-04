<?php
namespace Home\Controller;
use Think\Controller;
require 'vendor/autoload.php';
use PhpWord;
class SystemController extends CommonController {
    public function index(){
        $m=M('item');
        $arr=$m->order('item_id desc')->select();
        $this->assign('data',$arr);
        $this -> display();
    }
    public function item_edit(){
        $item_id=I('get.item_id');
        $map['item_id']=$item_id;
        $m=M('item');
        $arr=$m->where($map)->find();
        $this->assign('data',$arr);
        $this->display();
    }
    public function item_save(){
        $item_id=I('post.item_id');
        $item_name=I('post.item_name');
        $item_supervisor=I('post.item_supervisor');
        $su_company        =I('post.su_company');
        $data=array(
            'item_name'=>$item_name,
            'item_supervisor'=>$item_supervisor,
            'su_company'=>$su_company
        );
        $m=M('item');
        $map['item_id']=$item_id;
        $arr=$m->where($map)->data($data)->save();
        if($arr!== false){
          $result['result']='200';
         //$result['data']=$ass;
        }else{
          $result['result']='400';
        } 
         $this->ajaxReturn(json_encode($result),'json');
    }
    public function checker_add(){
        $this -> display();
    }
    public function checker(){
        $m=M('check');
        $arr=$m->select();
        $this->assign('data',$arr);
        $this -> display();
    }
    public function checker_del(){
        $id=I('post.id');
        $m=M('check');
        $map['id']=$id;
        $ass=$m->where($map)->delete();
        $result['result']='200'; 
        $result['data']=$ass; 
        $this->ajaxReturn(json_encode($result),'json');
    }
    public function checker_save(){
        $full_name=I('post.full_name');
        $abbreviation=I('post.abbreviation');
        $data=array(
            'full_name'=>$full_name,
            'abbreviation'=>$abbreviation
        );
        $m=M('check');
        $ass=$m->data($data)->add();
        $result['result']='200'; 
        $result['data']=$ass; 
        $this->ajaxReturn(json_encode($result),'json');

    }
    public function typist(){
        $m=M('typist');
        $arr=$m->select();
        $this->assign('data',$arr);
        $this -> display();
    }
    public function typist_del(){
        $id=I('post.id');
        $m=M('typist');
        $map['id']=$id;
        $ass=$m->where($map)->delete();
        $result['result']='200'; 
        $result['data']=$ass; 
        $this->ajaxReturn(json_encode($result),'json');
    }
    public function typist_save(){
        $name=I('post.name');    
        $data=array(
            'name'=>$name,
        );
        $m=M('typist');
        $ass=$m->data($data)->add();
        $result['result']='200'; 
        $result['data']=$ass; 
        $this->ajaxReturn(json_encode($result),'json');

    }
    public function admin(){
        $m=M('admin');
        $arr=$m->select();
        foreach ($arr as $v) {
            if($v['power']=="0"){
            if($v['state']=="1"){
              $now_time=date('Y-m-d H:i:s');
              if($v['end_time']<=$now_time){
                $map_1['id']=$v['id'];
                $m->where($map_1)->setField('state','0');
              }
            }
           // dump($v['state']);
        }
        }
        $this->assign('data',$arr);
        $this -> display();
    }
    public function admin_add(){
        $this -> display();
    }
    public function admin_save(){
        $name=I('post.user_name');
        $password=I('post.password');
        $beg_time=date('Y-m-d H:i:s');
        $end_time=date("Y-m-d H:i:s",strtotime("+5 hour"));
        $data=array(
            'user_name'=>$name,
            'password'=>$password,
            'beg_time'=>$beg_time,
            'end_time'=>$end_time,
            'power'=>'0'
        );
        $m=M('admin');
        $ass=$m->data($data)->add();
        $result['result']='200'; 
        $result['data']=$ass; 
       // dump($data);
        $this->ajaxReturn(json_encode($result),'json');
    }
    public function password_change(){
        $id = I('get.id');
        $this -> assign('id',$id);
        $this -> display();
    }
    public function password_save(){
        $id=I('post.id');
        $password=I('post.password');
        $data=array(
            'password'=>$password
        );
        $m=M('admin');
        $map['id']=$id;
        $ass=$m->where($map)->data($data)->save();
        if($ass!== false){
          $result['result']='200';
         //$result['data']=$ass;
        }else{
          $result['result']='400';
        }
         $this->ajaxReturn(json_encode($result),'json');
    }
    public function admin_state_update(){
        $id=I('post.id');
        $m=M('admin');
        $map['id']=$id;
        $ass=$m->where($map)->field('state')->find();
        $state=$ass['state'];
        if($state=='1'){

            $att=$m->where($map)->setDec('state');
        }else if($state=='0'){
            $beg_time=date('Y-m-d H:i:s');
            $end_time=date("Y-m-d H:i:s",strtotime("+5 hour"));
            $data=array(
            'beg_time'=>$beg_time,
            'end_time'=>$end_time,
            'state'=>'1'
           );
            $att=$m->where($map)->data($data)->save();
        }
        $result['result']='200'; 
        //$result['data']=$att; 
        $this->ajaxReturn(json_encode($result),'json');
    }
    public function admin_del(){
        $id=I('post.id');
        $m=M('admin');
        $map['id']=$id;
        $ass=$m->where($map)->delete();
        $result['result']='200'; 
       // $result['data']=$ass; 
         $this->ajaxReturn(json_encode($result),'json');
    }
}
