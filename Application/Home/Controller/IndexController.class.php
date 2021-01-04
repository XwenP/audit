<?php

namespace Home\Controller;
use Think\Controller;
require 'vendor/autoload.php';
use PhpWord;
class IndexController extends CommonController {
 public function pp(){
  $now_time=date('Y-m-d H:i:s',time());
 // dump($now_time);
  session(null); // 清空当前的session
        $this->redirect('Login/login');
  // $end_time=session('end_time');
  // dump($end_time);


  // $now_time=date('Y-m-d H:i:s',time());
  //     if($now_time>=$end_time){
  //        //  session(null); // 清空当前的session
  //        // $this->redirect('Login/login');
  //       dump(1);
  //     }
 }
  public function index(){
        $m=D('contract');
        // $where="item_id=$item_id";
        // $m->addcondition($where);
        // $belong_year=I('get.year');
        // if($belong_year==''){
        //   $belong_year=date('Y',time());
        // }
        $belong_year_1=date('Y',time());
        $map['belong_year']=$belong_year_1;
        $arr=$m->where($map)->relation('item')->select();
        $count_num=count($arr);
        $count_year=$belong_year_1;
        $item=M('item');
        $map_1['item_state']='0';
        $item_list=$item->where($map_1)->field('item_id,item_name')->select();  //获取项目id项目名称 投资监理
        $begin=$belong_year_1-2015;
        for($i=0;$i<$begin+1;$i++){
          $ss[$i]=$belong_year_1-$i;
        }
       // $this->assign('now_year',$belong_year_1);
        $this->assign('time_list',$ss);//时间
        $this->assign('count_num',$count_num);//总编条数
        $this->assign('count_year',$count_year);//当前年份
        $this->assign('contract',$arr); //当年总表数据
        $this->assign('item_list',$item_list);//项目列表
        $this->display();
    }
    public function  cc_test(){
                $m=D('contract');
        // $where="item_id=$item_id";
        // $m->addcondition($where);
        // $belong_year=I('get.year');
        // if($belong_year==''){
        //   $belong_year=date('Y',time());
        // }
        $belong_year_1=date('Y',time());
        $map['belong_year']=$belong_year_1;
        $arr=$m->where($map)->relation('item')->select();
        dump($arr);
    }
    public function pay_show(){
      $belong_year=I('get.year');
       if($belong_year==''){
        $belong_year=date('Y',time());
      }
      $belong_year_1=date('Y',time());
      $item=M('item');
      $item_list=$item->field('item_id,item_name')->select();  //获取项目id项目名称 投资监理
      $begin=$belong_year_1-2015;
      for($i=0;$i<$begin+1;$i++){
        $ss[$i]=$belong_year_1-$i;
      }
      $count_year=$belong_year;
        $ff=$belong_year.'.01.00';
        $pp=$belong_year.'.92.91';
        $map['a.pay_time'] =array('between',array($ff,$pp));
        $data=M()->table('paylist as a')->join(' contract as b on a.contract_id=b.contract_id')->
        join('item as c on b.item_id=c.item_id')->field(array('a.pay_time','a.contract_id','b.contract_name','b.contract_unit','b.item_supervisor','b.contract_amount','a.pay_amount','b.contract_add_money','b.contract_balance'))->where($map)
           ->select();
       $count_num=count($data);
      $this->assign('time_list',$ss);//时间
      $this->assign('count_num',$count_num);//总编条数
      $this->assign('count_year',$count_year);//当前年份
      $this->assign('contract',$data); //当年总表数据
      $this->assign('item_list',$item_list);//项目列表
      $this->display();

    }
    public function context_add(){
      $belong_year=I('get.year');//接收年份值
      $item=M('item');
      $data=$item->field('item_id,item_name,item_supervisor')->select();  //获取项目id项目名称 投资监理
      $contract=M('contract');
      $map['belong_year']=$belong_year;
      $data2=$contract->where($map)->count();
      $data2+=1;
      $data2=$belong_year.'-'.$data2; //生成合同编号
      $this->assign('data1',$data);  //项目信息
      $this->assign('data2',$data2);  //合同编号
      $this->assign('data3',$belong_year);
      $this->display();
      }
public function contract_add(){  //后面看是否
      $item_id                    =I('post.item_id');   
      $contract_id                =I('post.contract_id');
      $contract_name              =I('post.contract_name');
      $contract_unit              =I('post.contract_unit');
      $contract_nature            =I('post.contract_nature');
      $contract_amount            =I('post.contract_amount');
      $contract_date              =I('post.contract_date');
      $contract_remarks           =I('post.contract_remarks');
      $contract_remarks_extra     =I('post.contract_remarks_extra'); 
      $total_invest               =I('post.total_invest');
      $jian_fee                   =I('post.jian_fee');
      $budget_amount              =I('post.budget_amount');
      $limit_price                =I('post.limit_price');
      $item_type                  =I('post.item_type');
      $item_supervisor            =I('post.item_supervisor');
      $contract_creat_time=date('Y-m-d H:i:s',time());
      $belong_year=date('Y',time());
      $contract=M('contract');
      $map_1['contract_id']=$contract_id;
    //  $is_exist=$contract->where($map_1)->field('id')->count();
       $data=array( 'item_id'               =>$item_id ,             
                    'contract_id'          =>$contract_id ,
                    'contract_name'         =>$contract_name ,
                    'contract_unit'         =>$contract_unit ,
                    'contract_nature'       =>$contract_nature ,
                    'contract_amount'       =>$contract_amount ,
                    'contract_date'         =>$contract_date  ,
                    'contract_remarks'      =>$contract_remarks,
                    'contract_remarks_extra' =>$contract_remarks_extra,
                    'contract_creat_time'   =>$contract_creat_time,
                    'belong_year'           =>$belong_year,
                    'total_invest'          =>$total_invest,
                    'item_supervisor'       =>$item_supervisor,
          'jian_fee'              =>$jian_fee,  
          'budget_amount'         =>$budget_amount,
          'limit_price'           =>$limit_price,
          'item_type'             =>$item_type
                  ); 
        $arr=$contract->data($data)->add();
        if($arr){
          $result['result']='200'; 
          $result['data']=$arr; 
        }else{
          $result['result']='400';
        }   
        // $result['data']=$data; 
        $this->ajaxReturn(json_encode($result),'json');
    }
    public function extra_edit(){


      $contract_id=I('get.contract_id');
      $m=M('contract');
      $map['contract_id']=$contract_id;
      $data=$m->where($map)->field('contract_id,total_invest,jian_fee,budget_amount,limit_price,item_type')->find();
      $this->assign('data',$data);
      $this -> display();
    }
     public function extra_save(){
      $contract_id  =I('post.contract_id'); 
      $total_invest =I('post.total_invest');
      $jian_fee     =I('post.jian_fee');
      $budget_amount=I('post.budget_amount');
      $limit_price  =I('post.limit_price');
      $item_type    =I('post.item_type');
      $m=M('contract');
      $data=array(
        'total_invest'=>$total_invest,
        'jian_fee'=>$jian_fee,
        'budget_amount'=>$budget_amount,
        'limit_price'=>$limit_price,
        'item_type'=>$item_type
      );
      $map['contract_id']=$contract_id;
      $ass=$m->where($map)->data($data)->save();
      if($ass!== false){
      	$result['result']='200';
       //$result['data']=$ass;
      }else{
      	$result['result']='400';
      }
      $result['data']=$ass;
      $this->ajaxReturn(json_encode($result),'json');


     }
    public function item_add(){
       $item_name         =I('post.item_name');
       $item_supervisor   =I('post.item_supervisor');
       $su_company        =I('post.su_company');
      
        $creat_user='admin';
      $item_creat_time=date('Y-m-d H:i:s',time());
      $item=M('item');
      $map_1['item_name']=$item_name;
      $insert_item=$item->where($map_1)->count();
      if($insert_item>0){
        $result['result']='400'; 
      }else {
        $data=array(
          'item_name'=>$item_name,
          'item_supervisor'=>$item_supervisor,
          'creat_time'=>$item_creat_time,
          'creat_user'=>$creat_user,
          'su_company'=>$su_company

        );
        $item_num=$item->data($data)->add();
        if($item_num){
          $result['result']='200'; 
        }else{
          $result['result']='400';
        }         

      }
      $this->ajaxReturn(json_encode($result),'json');
    }
    public function context_edit(){
      $id=I('get.id');  
      $m=D('contract');
      $map['id']=$id;
      $arr=$m->where($map)->relation('item')->find();
      if($arr['contract_nature']=='投资监理'){
        $contract_nature='1';
      }else{
        $contract_nature='0';
      }
      $item=M('item');
        $item_list=$item->field('item_id,item_name,item_supervisor')->select();  //获取项目id项目名称 投资监理
        $this->assign('arr',$arr); //当年总表数据
        $this->assign('data1',$item_list);//项目列表
        $this->assign('state',$contract_nature);
      $this->display();
    }
    public function contract_save(){  //后面看是否
      $id                         =I('post.id');
      $item_id                    =I('post.item_id');   
      $contract_id                =I('post.contract_id');
      $contract_name              =I('post.contract_name');
      $contract_unit              =I('post.contract_unit');
      $contract_nature            =I('post.contract_nature');
      $contract_amount            =I('post.contract_amount');
      $contract_date              =I('post.contract_date');
      $contract_remarks           =I('post.contract_remarks');
      $contract_remarks_extra     =I('post.contract_remarks_extra'); 
      $total_invest               =I('post.total_invest');
      $jian_fee                   =I('post.jian_fee');
      $budget_amount              =I('post.budget_amount');
      $limit_price                =I('post.limit_price');//
      $item_type                  =I('post.item_type');
      $item_supervisor            =I('post.item_supervisor');
      $contract_last_time=date('Y-m-d H:i:s',time());//最后一次修改时间

      $contract=M('contract');
      $map_1['id']=$id;
    //  $is_exist=$contract->where($map_1)->field('id')->count();
      $data=array( 
                    'item_id'                 =>$item_id,             
                    'contract_id'             =>$contract_id,
                    'contract_name'           =>$contract_name,
                    'contract_unit'           =>$contract_unit,
                    'contract_nature'         =>$contract_nature,
                    'contract_amount'         =>$contract_amount,
                    'contract_date'           =>$contract_date,
                    'contract_remarks'        =>$contract_remarks,
                    'contract_remarks_extra'    =>$contract_remarks_extra,
                    'contract_last_time'        =>$contract_last_time,
                    'total_invest'            =>$total_invest,
                    'item_supervisor'         =>$item_supervisor,
          'jian_fee'                =>$jian_fee,  
          'budget_amount'           =>$budget_amount,
          'limit_price'             =>$limit_price,
          'item_type'             =>$item_type                     
                  );  
        $map_2['id']=$id;
        $arr=$contract->where($map_2)->data($data)->save();
        if($arr!== false){
        	$result['result']='200';
         //$result['data']=$ass;
        }else{
        	$result['result']='400';
        } 
        $this->ajaxReturn(json_encode($result),'json');
    }
     public function list_show(){
      $item_id=I('get.item_id');
      $m=D('contract');
      $map['item_id']=$item_id;
      $data=$m->where($map)->relation(true)->order('belong_year asc,id')->select();
      $add_all_pay=0;
      $contract_amount_all=0;
      foreach($data as $key => $value){
        // dump($value['contract_add_money']);
        $add_all_pay=$add_all_pay+$value['contract_add_money'];
        // dump($add_all_pay);
        // dump($value['contract_amount']);
        $contract_amount_all=$contract_amount_all+$value['contract_amount'];
        // dump($contract_amount_all);
      }
      $item=M('item');
      $map_1['item_state']='0';
      $item_list=$item->where($map_1)->field('item_id,item_name')->select();  //获取项目id项目名称 投资监理
      $map_2['item_id']=$item_id;
      $top_info=$item->where($map_2)->field('item_id,item_supervisor,item_name,su_company')->find();
      $top_info['add_all_pay']=$add_all_pay;
      $top_info['contract_amount_all']=$contract_amount_all;
      $belong_year=date('Y',time());
      $begin=$belong_year-2015;
      for($i=0;$i<$begin+1;$i++){
        $ss[$i]=$belong_year-$i;
       }
      $this->assign('now_year',$belong_year);   
      $this->assign('time_list',$ss);//时间
      $this->assign('data1',$data);//全部
      $this->assign('item_list',$item_list);
      $this->assign('data3',$top_info);
      $this->display();
    }
    public function ttc(){
      $item_id='7';
      $m=D('contract');
      $map['item_id']=$item_id;
      $data=$m->where($map)->relation(true)->order('belong_year asc,id')->select();
      //dump($data);
      $add_all_pay=0;
      $contract_amount_all=0;
      foreach($data as $key => $value){
        dump($value['contract_add_money']);
        $add_all_pay=$add_all_pay+$value['contract_add_money'];
        dump($add_all_pay);
        dump($value['contract_amount']);
        $contract_amount_all=$contract_amount_all+$value['contract_amount'];
        dump($contract_amount_all);
      }
    }
    public function list_add(){
      $this -> display();
    }

    public function list_edit(){
      $contract_id=I('get.contract_id');
      $m=D('contract');
      $map['contract_id']=$contract_id;     
      $arr=$m->where($map)->relation('paylist')->find();//后面优化field
      $this->assign('data',$arr);
      // dump($arr);
      $this->display();
      }
    public function list_edit1(){
        $contract_id=I('post.id');
        $contract_amount=I('post.contract_amount');
        $contract_exact_amount=I('post.contract_exact_amount');
        $contract_add_money=I('post.contract_add_money');
        $contract_balance=I('post.contract_balance');
        $list=I('post.list');
        $data_m = stripslashes(html_entity_decode($list)); 
        $data_1 = json_decode($data_m,TRUE);
        $contract=M('contract');
        $map_2['contract_id']=$contract_id;
        $ss=$contract->where($map_2)->field('contract_amount,contract_exact_amount')->find();

        if($contract_exact_amount!=null){
          $ratio=(1-round($contract_add_money/$contract_exact_amount,4))*'100'."%";
        }else{
          if($ss['contract_exact_amount']!=null){
          $ratio=(1-round($contract_add_money/$ss['contract_exact_amount'],4))*'100'."%";
          }else{
          $ratio=(1-round($contract_add_money/$ss['contract_amount'],4))*'100'."%"; 
          }
        }
        $data_n=array(
          'contract_amount'=>$contract_amount,
          'contract_exact_amount'=>$contract_exact_amount,
          'contract_add_money'=>$contract_add_money,
          'contract_balance'=>$contract_balance,
          'ratio'=>$ratio
        );
        $ppp=$contract->where($map_2)->data($data_n)->save();
         $array_1=['id','pay_time','pay_amount'];
         $paylist=M('paylist');


        $now_time= date("Y-m-d  H:i:s");
        foreach ($data_1 as $k => $s) {

            // if($ss['contract_exact_amount']==null){
            //     $ratio=round(($s[$array_1[2]]/$ss['contract_amount']),4)*'100'."%";
            //  }else{
            //     $ratio=round(($s[$array_1[2]]/$ss['contract_exact_amount']),4)*'100'."%";
            //   } 

           if($contract_exact_amount!=null){
             $ratio=round($s[$array_1[2]]/$contract_exact_amount,4)*'100'."%";
           }else{
             if($ss['contract_exact_amount']!=null){
             $ratio=round($s[$array_1[2]]/$ss['contract_exact_amount'],4)*'100'."%";
             }else{
             $ratio=round($s[$array_1[2]]/$ss['contract_amount'],4)*'100'."%"; 
             }
           }     
           $pay_time=$s[$array_1[1]];
           $pay_amount=$s[$array_1[2]];

          if($s[$array_1[0]]==''){
            
            $data_p['contract_id']=$contract_id;
            $data_p['pay_amount'] =$pay_amount;
            $data_p['pay_time']= $pay_time;
            $data_p['vote_time']=$now_time;
           // dump($pay_time);
            $data_p['ratio']=$ratio;
           $paylist->data($data_p)->add();

          }else{
           
            $data_s['pay_amount'] =$pay_amount;
            $data_s['pay_time']=$pay_time;
            $data_s['ratio']=$ratio; 
            $data_s['vote_time']=$now_time;
            $map['id']=$s[$array_1[0]];
            $paylist->where($map)->save($data_s);
             //dump($data_s);
          }
   
        }

   
       $result['list']=$data_n; 
     // dump($result);
       $this->ajaxReturn(json_encode($result),'json');
      }
      public function list_end(){
        $item_id=I('post.item_id');
        $item=M('item');
        $map_1['item_id']=$item_id;
        $data_1['item_state']='1';
        $ss=$item->where($map_1)->data($data_1)->save();
        $result['result']='200'; 
        $result['data']=$ss; 
        $this->ajaxReturn(json_encode($result),'json');
      }
public function  list_editremark(){
      $contract_id=I('get.contract_id');
      //$contract_id='2018-2';
      $m=M('contract');
      $map_1['contract_id']=$contract_id;
      $arr=$m->where($map_1)->field('contract_id,contract_remarks')->find();
      $this->assign('data',$arr);
      $this->display();
    }
     public function  list_editextra(){
      $contract_id=I('get.contract_id');
      //$contract_id='2018-2';
      $m=M('contract');
      $map_1['contract_id']=$contract_id;
      $arr=$m->where($map_1)->field('contract_id,contract_remarks_extra')->find();
      $this->assign('data',$arr);
      $this->display();
    }
    public function list_edit3(){
      $contract_id=I('post.contract_id');
      $contract_remarks_extra=I('post.contract_remarks_extra');
      $m=M('contract');
      $map_1['contract_id']=$contract_id;
      $data['contract_remarks_extra']=$contract_remarks_extra;
      $arr=$m->where($map_1)->save($data);
      if($arr!== false){
        $result['result']='200';
       //$result['data']=$ass;
      }else{
        $result['result']='400';
      }
      $this->ajaxReturn(json_encode($result),'json');
    }
    public function list_edit4(){
      $contract_id=I('post.contract_id');
      $contract_remarks=I('post.contract_remarks');
      $m=M('contract');
      $map_1['contract_id']=$contract_id;
      $data['contract_remarks']=$contract_remarks;
      $arr=$m->where($map_1)->save($data);
      if($arr!== false){
        $result['result']='200';
       //$result['data']=$ass;
      }else{
        $result['result']='400';
      }
     // $result['result']=$arr; 
      $this->ajaxReturn(json_encode($result),'json');
    }
        public function nature_edit(){
      $contract_id=I('get.contract_id');
      //$contract_id='2018-2';
      $m=M('contract');
      $map_1['contract_id']=$contract_id;
      $arr=$m->where($map_1)->field('contract_id,contract_nature')->find();
      $this->assign('data',$arr);
      $this->display();
    }
    public function nature_save(){
      $contract_id=I('post.contract_id');
      $contract_nature=I('post.contract_nature');
      $m=M('contract');
      $map_1['contract_id']=$contract_id;
      $data['contract_nature']=$contract_nature;
      $arr=$m->where($map_1)->save($data);
      if($arr!== false){
        $result['result']='200';
       //$result['data']=$ass;
      }else{
        $result['result']='400';
      }
      //$result['result']=200;  
      $this->ajaxReturn(json_encode($result),'json');
    }
    public function name_edit(){
      $contract_id=I('get.contract_id');
      //$contract_id='2018-2';
      $m=M('contract');
      $map_1['contract_id']=$contract_id;
      $arr=$m->where($map_1)->field('contract_id,contract_name')->find();
      $this->assign('data',$arr);
      $this->display();
    }
    public function name_save(){
      $contract_id=I('post.contract_id');
      $contract_name=I('post.contract_name');
      $m=M('contract');
      $map_1['contract_id']=$contract_id;
      $data['contract_name']=$contract_name;
      $arr=$m->where($map_1)->save($data);
      if($arr!== false){
        $result['result']='200';
       //$result['data']=$ass;
      }else{
        $result['result']='400';
      }
      $this->ajaxReturn(json_encode($result),'json');
    }
    public function unit_edit(){
      $contract_id=I('get.contract_id');
      //$contract_id='2018-2';
      $m=M('contract');
      $map_1['contract_id']=$contract_id;
      $arr=$m->where($map_1)->field('contract_id,contract_unit')->find();
      $this->assign('data',$arr);
      $this->display();
    }
    public function unit_save(){
      $contract_id=I('post.contract_id');
      $contract_unit=I('post.contract_unit');
      $m=M('contract');
      $map_1['contract_id']=$contract_id;
      $data['contract_unit']=$contract_unit;
      $arr=$m->where($map_1)->save($data);
      if($arr!== false){
        $result['result']='200';
       //$result['data']=$ass;
      }else{
        $result['result']='400';
      } 
      $this->ajaxReturn(json_encode($result),'json');
    }
    public function item_out(){
        $item_id=I('get.item_id');
        
        $cellName=[
        6=>['paylist','付款情况',0,13,'CENTER',1,3],
        0=>['contract_id','序号',0,11,'CENTER'],
        1=>['contract_name','项目名称',0,44,'CENTER'],
        2=>['contract_unit','承包单位',0,33,'CENTER'],        
        3=>['contract_nature','合同性质',0,12,'CENTER'],       
        4=>['contract_amount','合同金额',0,13,'CENTER'],
        5=>['contract_exact_amount','审定金额',13,13,'CENTER'],
        7=>['contract_remarks','合同付款方式',0,80,'CENTER',2],
        8=>['paylist','备注',0,13,'CENTER',3,2],
        ];
        $m=D('contract');
        $map_1['item_id']=$item_id;
        $data=$m->where($map_1)->relation(true)->select();
        $item_name=$data['0']['item']['item_name'];//
        $title="工程项目合同付款登记表——".$item_name;
     //    $contract_nature=$data['0']['contract_nature'];
       // dump($contract_nature);
       // dump($data);
        exportOrderExcel2($title,$cellName,$data);
    }
        public function audit_out_4(){
        $belong_year=I('get.year');
        if($belong_year==''){
          $belong_year=date("Y");
        }
        $title=$belong_year."年付款记录表";
        $cellName=[
        0=>['num','序号',0,15,'CENTER',2],
        1=>['pay_time','付款日期',0,18,'CENTER'],
        2=>['contract_id','合同编号',0,15,'CENTER'], 
        3=>['contract_name','项目名称',0,30,'CENTER'],        
        4=>['contract_unit','承包单位',0,35,'CENTER'],       
        5=>['item_supervisor','投资监理',0,15,'CENTER'],  
        6=>['contract_amount','合同金额',0,15,'CENTER'], 
        7=>['pay_amount','付款金额',0,15,'CENTER'],        
        8=>['contract_add_money','累计预付款',0,15,'CENTER'],       
        9=>['contract_balance','余额',0,15,'CENTER'],             
        ];

        // $m=M('auditing');
        //$map['b.bel_year']=$belong_year;
        // $map['a.id']='1';
    //    $map['b.belong_year']=$belong_year;
      //  $data=$m->where($map)->order('id')->select();
        $ss=$belong_year.'.01.00';
        $pp=$belong_year.'.12.31';
        $map['a.pay_time'] =array('between',array($ss,$pp));
        $data=M()->table('paylist as a')->join(' contract as b on a.contract_id=b.contract_id')->
        join('item as c on b.item_id=c.item_id')->field(array('a.pay_time','a.contract_id','b.contract_name','b.contract_unit','b.item_supervisor','b.contract_amount','a.pay_amount','b.contract_add_money','b.contract_balance'))->where($map)
           ->select();

        exportOrderExcel4($title,$cellName,$data);

    }
    public function cm(){
       // $pp=date("Y.m.d");
       // $ss="2020.01.01";
       // if($pp>$ss){
       //  dump(1);
       // }

      //  $map['b.belong_year']=$belong_year;
      //  $data=$m->where($map)->order('id')->select();
        $belong_year='2017';
  //      $end_time=date("Y",strtotime("+1 Year"));
        $ss=$belong_year.'.01.00';
        $pp=$belong_year.'.12.31';
        $map['a.pay_time'] =array('between',array($ss,$pp));
        $data=M()->table('paylist as a')->join(' contract as b on a.contract_id=b.contract_id')->
        join('item as c on b.item_id=c.item_id')->field(array('a.pay_time','a.contract_id','b.contract_name','b.contract_unit','b.item_supervisor','b.contract_amount','a.pay_amount','b.contract_add_money','b.contract_balance'))->where($map)
           ->select();
           dump($data);
    }



   public function test2(){
    $out_year=I('get.year');
    $title=$out_year."年工程项目合同付款登记表";
    $cellName=[
    0=>['contract_id','序号',0,9,'CENTER'],
    1=>['contract_name','合同名称',0,44,'CENTER'],
    2=>['contract_unit','承包单位',0,33,'CENTER'],
    3=>['item','项目名称',0,18,'CENTER',1],
    4=>['item_supervisor','投资监理',0,12,'CENTER',2],
    5=>['contract_nature','合同性质',0,12,'CENTER'],
    6=>['contract_amount','合同金额',0,13,'CENTER'],
    7=>['contract_exact_amount','审定金额',13,13,'CENTER'],
    8=>['contract_date','合同流转日期',0,13,'CENTER'],
    9=>['contract_add_money','累计预付款',0,11,'CENTER'],
    10=>['contract_balace','余额',0,14,'CENTER'],
    11=>['contract_remarks','合同付款方式(备注)',0,130,'CENTER'],
    ];
     $m=D('contract');
        // $item_id='2017';
        // $where="item_id=$item_id";
        $map['belong_year']=$out_year;
        $data=$m->where($map)->relation('item')->order('id asc')->select();
        exportOrderExcel($title,$cellName,$data);

    }
	}
