<?php
namespace Home\Controller;
use Think\Controller;
require 'vendor/autoload.php';
use PhpWord;
use PclZip;
class ProgramController extends CommonController {
    public function index(){
        $belong_year=I('get.year');
        if($belong_year==''){
          $belong_year=date('Y',time());
        }
        $m=M('auditing');
        $map['bel_year']=$belong_year;
        $arr=$m->where($map)->select();
        $count_year=$belong_year;
        $belong_year_1=date('Y',time());
        $begin=$belong_year_1-2018;
         for($i=0;$i<$begin+1;$i++){
          $ss[$i]=$belong_year_1-$i;
         }
         $this->assign('time_list',$ss);//时间

        $this->assign('list',$arr);//数据
        $this->assign('count_year',$count_year);//当前年份
        $this->display();
        // Header("Content-Type:text/html;charset=utf-8");
        // dump($arr);
    }
    public function program_add(){
        $belong_year=I('get.year');
        $m=M('auditing');
        $map['bel_year']=$belong_year;
        $num=$m->where($map)->count();
        $list=$m->where($map)->field('finish_time')->order('id desc')->find();
        $time=$list['finish_time'];
        $num++;
        $n=M('check');
        $ass=$n->field('abbreviation')->select();

        $this->assign('year',$belong_year);
        $this->assign('num',$num);//编号
        $this->assign('time',$time);//时间
        $this->assign('list',$ass);//审核员      
        $this->display();
    }
    public function program_calculate(){
         $inital_money     =I('post.inital_money');
         $audit_money      =I('post.audit_money');
        // $send_seck_money='15909.58';
        // $seck_money='14101.31';
         $send_seck_money= $inital_money; //'15909.58';    //送审价
         $seck_money=$audit_money;//'14101.31';         //审定价
      
        $balance=round($send_seck_money-$seck_money,2);                      //核减金额
        $nuclear=round($balance/$send_seck_money,4);                         //核减率
        $nuclear_rate=round(100*($balance/$send_seck_money),2)."%";          //核减率%
        
        if($nuclear>'0.05'){    
          if($balance<='1000000'){   //核减金额小于100万
          $trial_total= round($balance*'0.073',2);                                 //核减率高于5%
          $trial_a= round($send_seck_money*'0.05'*'0.073',2);   //审价费甲方
          $trial_b= round($trial_total-$trial_a,2); //审价费乙方
          }elseif ($balance<='5000000') { //核减金额小于500万
              $trial_total= '1000000'*'0.073'+($balance-'1000000')*'0.067';
              if($send_seck_money<='5000000'){
                $trial_a= ('1000000'*'0.073'+($send_seck_money-'1000000')*'0.067')*'0.05';     //审价费甲方
              }elseif ($send_seck_money<='10000000') {
                 $trial_a= ('1000000'*'0.073'+'5000000'*'0.067'+($send_seck_money-'5000000')*'0.061')*'0.05';     //审价费甲方
              }elseif ($send_seck_money<='30000000') {
                 $trial_a= ('1000000'*'0.073'+'5000000'*'0.067'+'10000000'*'0.061'+($send_seck_money-'10000000')*'0.05')*'0.05'   ;           //审价费甲方
            }
          $trial_b= $balance*'0.073'-$trial_a; //审价费乙方
          }                 
          if($send_seck_money>'50000'){        //送审价大于5万                     //甲方实际审价费
             $trial_a_rel=($trial_a>500?$trial_a:500); 
          }else{                           //送审价小于5万  
          $trial_a_rel=($trial_a>300?$trial_a:300);   
          }                   
        }else{
          if($send_seck_money>'1000000'){
            $trial_a= round('1000000'*'0.0036'+($send_seck_money-'100000')*'0.0031',2);
          }else{
            $trial_a= round($send_seck_money*'0.0036',2);
          }
            $trial_b='0';

          
        }
        $result['trial_a']=$trial_a; 
        $result['trial_b']=$trial_b;
        $result['trial_a_rel']=$trial_a_rel; 
        $result['balance']=$balance;
        $result['nuclear_rate']=$nuclear_rate;
        //dump($result);
        $this->ajaxReturn(json_encode($result),'json');
    }
    public function program_edit(){
        $id=I('get.id');
        $m=M('auditing');
        $map['id']=$id;
        $arr=$m->where($map)->find();
        $n=M('check');
        $ass=$n->field('abbreviation')->select();
        $this->assign('list',$ass);//审核员  
        $this->assign('data',$arr);   
        $this->display();
    }
    public function program_add_1(){
        $year             =I('post.year');
        $num              =I('post.num');
        $item_name        =I('post.item_name');
        $finish_time      =I('post.finish_time');
        $symbol           =I('post.symbol');
        $build_unit       =I('post.build_unit');
        $constroct_unit   =I('post.constroct_unit');
        $inital_money     =I('post.inital_money');
        $audit_money      =I('post.audit_money');
        $assess_money     =I('post.assess_money');
        $trial_a          =I('post.trial_a');
        $trial_b          =I('post.trial_b');
        $trial_a_rel      =I('post.trial_a_rel');
        $assessor         =I('post.assessor');
        $rate             =I('post.rate');
        $vote_time        =I('vote_time');
        $m=M('auditing');
        $data=array(
            'bel_year'          =>$year,          
            'num'           =>$num,           
            'item_name'     =>$item_name,     
            'finish_time'   =>$finish_time,   
            'symbol'        =>$symbol,        
            'build_unit'    =>$build_unit,    
            'constroct_unit'=>$constroct_unit,
            'inital_money'  =>$inital_money, 
            'audit_money'   =>$audit_money,   
            'assess_money'  =>$assess_money,  
            'trial_a'       =>$trial_a,       
            'trial_b'       =>$trial_b,       
            'trial_a_rel'   =>$trial_a_rel,   
            'assessor'      =>$assessor,      
            'rate'          =>$rate,
            'vote_time'     =>$vote_time         
        );
        $ass=$m->data($data)->add();
        if($arr!=false){
          $result['result']='200'; 
          $result['data']=$ass; 
        } else{
             $result['result']='400'; 
        }
        $result['data']=$data;
        $this->ajaxReturn(json_encode($result),'json');
    }
    public function program_save(){
        $id               =I('post.id');
        $year             =I('post.year');
        $num              =I('post.num');
        $item_name        =I('post.item_name');
        $finish_time      =I('post.finish_time');
        $symbol           =I('post.symbol');
        $build_unit       =I('post.build_unit');
        $constroct_unit   =I('post.constroct_unit');
        $inital_money     =I('post.inital_money');
        $audit_money      =I('post.audit_money');
        $assess_money     =I('post.assess_money');
        $trial_a          =I('post.trial_a');
        $trial_b          =I('post.trial_b');
        $trial_a_rel      =I('post.trial_a_rel');
        $assessor         =I('post.assessor');
        $rate             =I('post.rate');
        $vote_time        =I('vote_time');
        $m=M('auditing');
        $data=array(
            'bel_year'      =>$year,          
            'num'           =>$num,           
            'item_name'     =>$item_name,     
            'finish_time'   =>$finish_time,   
            'symbol'        =>$symbol,        
            'build_unit'    =>$build_unit,    
            'constroct_unit'=>$constroct_unit,
            'inital_money'  =>$inital_money, 
            'audit_money'   =>$audit_money,   
            'assess_money'  =>$assess_money,  
            'trial_a'       =>$trial_a,       
            'trial_b'       =>$trial_b,       
            'trial_a_rel'   =>$trial_a_rel,   
            'assessor'      =>$assessor,      
            'rate'          =>$rate,
            'vote_time'     =>$vote_time            
        );
        $map['id']=$id;
        $ass=$m->where($map)->data($data)->save();
        $result['result']='200'; 
        $result['data']=$ass; 
         $this->ajaxReturn(json_encode($result),'json');
    }
    public function audit_out_1(){
        $belong_year=I('get.year');
        $title=$belong_year."年 工 程 项 目 审 核 情 况 表";
        $cellName=[
        0=>['num','序号',0,8,'CENTER'],
        1=>['item_name','工程名称',0,50,'CENTER'],
        2=>['finish_time','完成日期',0,15,'CENTER'], 
        3=>['symbol','文号',0,22,'CENTER'],        
        4=>['build_unit','建设单位',0,15,'CENTER'],       
        5=>['constroct_unit','施工单位',0,30,'CENTER'],  
        6=>['inital_money','原决算额',0,15,'CENTER'], 
        7=>['audit_money','审定金额',0,15,'CENTER'],        
        8=>['assess_money','核减额',0,15,'CENTER'],       
        9=>['rate','核减率',0,15,'CENTER'],   
        10=>['assessor','审核员',0,15,'CENTER'],  
        11=>['trial_a','甲方审价费',0,15,'CENTER'], 
        12=>['trial_a_rel','甲方实际审价费',0,15,'CENTER'],        
        13=>['trial_b','乙方审价费',0,15,'CENTER'],          
        ];

         $m=M('auditing');
        $map['bel_year']=$belong_year;
        $data=$m->where($map)->order('id')->select();

        exportOrderExcel4($title,$cellName,$data);

    }

    public function audit_out_2(){
        $list=I('get.idstr');
       // $data = stripslashes(html_entity_decode($list)); 
        $data_1=explode(",",$list);
       // dump($data_1);
        $title="东华大学审计处审内工签收登记簿";
        $cellName=[     
        0=>['finish_time','日期',0,11,'CENTER',3],
        1=>['symbol','发文编号',0,33,'CENTER'],
        2=>['build_unit','发往部门',0,33,'CENTER',1], 
        3=>['item_name','内容',0,55,'CENTER'],        
        4=>['num','份数',0,12,'CENTER',2],       
        5=>['write','签收',0,13,'CENTER'],     
    
        ];
         $m=M('auditing');
         $data=[];
        foreach ($data_1 as $k => $v) {
            
            $map['id']=$v;
            $data[$k]=$m->where($map)->order('id')->find();
        }
      //  $data=$m->where($map)->order('id')->select();
      //  dump($data);

        exportOrderExcel3($title,$cellName,$data);
    }
    public function sc(){
    	$str = date("Y").'年6月10号';
	$arr = date_parse_from_format('Y年m月d日',$str);
	$time = mktime(0,0,0,$arr['month'],$arr['day'],$arr['year']);
	$ss=date("w",$time);
	dump($ss);

    }
    public function audit_out_3(){
      $list=I('get.idstr');
      $data_1=explode(",",$list);
      $cellName=$data_1;
      $length=count($cellName);
       $ss=M('auditing');
      // $y=date("Y",time());
      // $m=date("m",time());
      // $d=date("d",time());
      // if(date("w")=='5'){
      //    $dd=date("d",time())+3;
      //  }else if(date("w")=='6'){
      //    $dd=date("d",time())+2;
      //  }else {
      //    $dd=date("d",time())+1;
      //  }     
      // $time=$y.'年'.$m.'月'.$d.'日';
      // $ptime=$y.'年'.$m.'月'.$dd.'日';//有很多问题
      $m=M('check');
      foreach ($cellName as $k => $v) {
        $where['id']=$v;
         $data=$ss->where($where)->select();
         $data=$data['0'];


        $time=$data['finish_time'];
        $str = date("Y")."年".$time;
        $app = date_parse_from_format('Y年m月d日',$str);
        $time = mktime(0,0,0,$app['month'],$app['day'],$app['year']);
        $y=$app['year'];
        $mm=$app['month'];
        $d=$app['day'];
      
         if(date("w",$time)=='5'){
           $dd=date("d",$time)+3;
         }else if(date("w",$time)=='6'){
           $dd=date("d",$time)+2;
         }else {
           $dd=date("d",$time)+1;
         }
         $time=$y.'年'.$mm.'月'.$d.'日';
         $ptime=$y.'年'.$mm.'月'.$dd.'日';//有很多问题

         $assessor=$data['assessor'];      
         $map_1['abbreviation']=$assessor;
         $result_1=$m->where($map_1)->find();
         $data['assessor']=$result_1['full_name'];

        $data['pu_time']=$time;
        $data['ppu_time']=$ptime; 
        $item_name=$data['symbol'];
        $long=iconv_strlen($item_name,"UTF-8")-9;
        $data['item_name_a'] = mb_substr($item_name,2,$long);

        $PHPWord = new \PhpOffice\PhpWord\PhpWord();
        $rate=$data['rate'];
        if($rate=='0'){
          $tempPlete = $PHPWord->loadTemplate('./Public/word/model2.docx');
        }
        // elseif ($data['build_unit']=='基建后勤处') {
        //   $tempPlete = $PHPWord->loadTemplate('./Public/word/model3.docx');	
        // }
        else{
          $tempPlete = $PHPWord->loadTemplate('./Public/word/model.docx');
        }        
        foreach($data as $kk=>$vv){
            $tempPlete->setValue($kk,$vv);
         }
        $tempPlete->saveAs('Uploads/'.$item_name.'.docx');
      }
      
      //生成的压缩包位置
      $zipurl = 'Uploads/data.zip';
     //实例化类库
      import("Org.Util.PclZip");
      $zip = new PclZip($zipurl);
      $zip->create('Uploads'); 
      ob_start(); 
      $filename="Uploads/data.zip";
      $date="批量导出报告".date("Ymd-H:i:m");
      header( "Content-type:  application/octet-stream "); 
      header( "Accept-Ranges:  bytes "); 
      header( "Content-Disposition:  attachment;  filename= {$date}.zip"); 
      $size=readfile($filename); 
      header( "Accept-Length: " .$size);
      //删除生成的文件和压缩包
      $path="Uploads/";
      $p = scandir($path);
      foreach($p as $val){
      //排除目录中的.和..
      if($val !="." && $val !=".."){
       //如果是目录则递归子目录，继续操作
      unlink($path.$val);
      }
     }
    }

    
    // public function cc(){
    //   $ss=date("Y-m-d H:i:s");
    //   $m=date("Y").'-01-01 00:00:00';
    //   if($ss>$m){
    //     dump(1);
    //   }
    // }
}
