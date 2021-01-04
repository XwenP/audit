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
        $begin=$belong_year_1-2015;
         for($i=0;$i<$begin+1;$i++){
          $ss[$i]=$belong_year_1-$i;
         }
         $this->assign('time_list',$ss);//时间

        $this->assign('list',$arr);//数据
        $this->assign('count_year',$count_year);//当前年份
        $this->display();
       // dump($arr);
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
                   
        }else{
          if($send_seck_money>'1000000'){
            $trial_a= round('1000000'*'0.0036'+($send_seck_money-'100000')*'0.0031',2);
          }else{
            $trial_a= round($send_seck_money*'0.0036',2);
          }
            $trial_b='0';       
        }

        if($send_seck_money>'50000'){        //送审价大于5万                     //甲方实际审价费
             $trial_a_rel=($trial_a>500?$trial_a:500); 
          }else{                           //送审价小于5万  
          $trial_a_rel=($trial_a>300?$trial_a:300);   
        }
        
        $result['trial_a']=$trial_a; 
        $result['trial_b']=$trial_b;
        $result['trial_a_rel']=$trial_a_rel; 
        $result['balance']=$balance;
        $result['nuclear_rate']=$nuclear_rate;
        //dump($result);
        $result['data']='200';
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
        $finish_time=year_trans($finish_time);
        $vote_time=year_trans($vote_time);


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
        if($ass!=false){
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

        $finish_time=year_trans($finish_time);
        $vote_time=year_trans($vote_time);

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
    /**时间转换
    // public function time_trans(){
    // 	$m=M('auditing');
    // 	$map['bel_year']='2015';
    // 	$user_data=$m->where($map)->select();
    // 	$user_long=count($user_data);
    // 	dump($user_long);
    // 	$i='0';
    // 	foreach ($user_data as $k => $v) {
    		
    // 		$finish_time=$v['finish_time'];
    // 		//$nowtime =date( 'm月d日', $finish_time); 
    // 		$nowtime =date("m月d日",strtotime('+'.$finish_time.' day',strtotime("1899-12-30"))); 
    // 		//dump($nowtime);
    // 		$id=$v['id'];
    // 		$map_1['id']=$id;
    // 		$data['finish_time']=$nowtime;
    // 		$result_num=$m->where($map_1)->save($data);
    // 		if ($result_num=='1') {
    // 			$i++;
    // 			//dump($i);
    // 		}
    // 	}
    // }
    **/
    public function test()
    {
    	// $create_time='43480';
    	//  $arr = date_parse_from_format('Y年m月d日H:i:s',$create_time);
     //    $ts = mktime($arr['hour'],$arr['minute'],$arr['second'],$arr['month'],$arr['day'],$arr['year']);
     //    $nowtime = date( 'Y-m-d ',$ts); 
     //    dump(time());
     //    dump(strtotime('2019/01/15'));
     //    $ss=strtotime('2019/01/15')-43480;
     //    $pp=strtotime('2019/02/27')-43523;
     //     dump(date("m月d日",strtotime("+43480 day",strtotime("1899-12-30"))));
     //     
      //   $str="2019.11.15"; 		
     	// $timef=explode('.', $str);
     	// $mf=substr($timef[1] ,0,1);
     	// $df=substr($timef[2] ,0,1);
     	// $ml=$mf==0?substr($timef[1] ,1,1):$timef[1];
     	// $dl=$df==0?substr($timef[2] ,1,1):$timef[1];
     	// $last_vote=$ml." 月 ".$dl." 日";
     	// dump($last_vote);
     	// dump($dl);
     // 	$str='1234555@323';
     // 	$needle=')';	
    	// dump(checkstr($str,'3'));
    	// 
    	// $time='2019.09.03';
    	// $timev=explode('.', $time);
     // 	$mf=substr($timev[1] ,0,1);
     // 	$df=substr($timev[2] ,0,1);
     // 	$ml=$mf==0?substr($timev[1] ,1,1):$timev[1];
     // 	$dl=$df==0?substr($timev[2] ,1,1):$timev[2];
     // 	$app=$timev[0]."年".$ml."月".$dl."日";
     // 	dump($app);
    	// $time='08月03日';
    	// dump(year_trans($time));
      //
       
     /**
      //字符串替换test 
      // $m=M('auditing');
      // $ss=$m->field('id,symbol')->select();
      // foreach ($ss as $k => $v) {
      //  $older_str=array('[','] ');
      //  $new_str=array('〔','〕');
      //  $replace_str=$v['symbol']; 
      //  $new_ss=str_replace($older_str,$new_str,$replace_str); 
      //  $data['symbol']=$new_ss;
      //  $map['id']=$v['id'];
      //  $m->where($map)->save($data);
       dump($new_ss);
       // dump($v['symbol']);
       // dump($v['id']);

  
      }
           **/
      $older_str=array('[','] ');
      $new_str=array('〔','〕');
      $replace_str="东华审内工[2019] 1号"; 
      $new_ss=str_replace($older_str,$new_str,$replace_str); 
      dump($new_ss);
    }
    public function audit_out_3(){
      $list=I('get.idstr');
      $data_1=explode(",",$list);
      $cellName=$data_1;
      $length=count($cellName);
      $ss=M('auditing');
      $m=M('check');
      foreach ($cellName as $k => $v) {
        $where['id']=$v;
        $data=$ss->where($where)->select();
        $data=$data['0'];

        $vtime=$data['vote_time'];
 		    if(checkstr($vtime,'月')!=false){
 		    	$time_v = date_parse_from_format('Y年m月d日',$vtime);			
 		    	$data['vote_time']=$time_v['year']."年".$time_v['month']."月";
 		    }else{
 		    	$timef=explode('.', $data['vote_time']);
         	    $mf=substr($timef[1] ,0,1);
         	    $ml=$mf==0?substr($timef[1] ,1,1):$timef[1];
         	    $data['vote_time']=$timef[0]."年".$ml."月";
        
 		    }





        $time=$data['finish_time'];
        if(checkstr($time,'年')!=false){
            $app = date_parse_from_format('Y年m月d日',$time);
        }elseif(checkstr($time,'月')!=false){
     	    $time_f = date("Y")."年".$time;
            $app = date_parse_from_format('Y年m月d日',$time_f);
        }else{
            $timev=explode('.', $time);
     	    $mf=substr($timev[1] ,0,1);
     	    $df=substr($timev[2] ,0,1);
     	    $ml=$mf==0?substr($timev[1] ,1,1):$timev[1];
     	    $dl=$df==0?substr($timev[2] ,1,1):$timev[2];
     	    $str=$timev[0]."年".$ml."月".$dl."日";
     	    $app = date_parse_from_format('Y年m月d日',$str);
        }
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
        $ptime=$y.'年'.$mm.'月'.$dd.'日';

        $assessor=$data['assessor'];      
        $map_1['abbreviation']=$assessor;
        $result_1=$m->where($map_1)->find();
        $data['assessor']=$result_1['full_name'];

        $data['pu_time']=$time;
        $data['ppu_time']=$ptime; 
        $item_name=$data['symbol'];
        $itme_name_re=$data['item_name'];
        $long=iconv_strlen($itme_name_re,"UTF-8")-9;
        $data['item_name_a'] = mb_substr($itme_name_re,2,$long);
        //生成word
        $PHPWord = new \PhpOffice\PhpWord\PhpWord();
        $rate=$data['rate'];
        if($rate=='0'||$rate=='0%'){
          $tempPlete = $PHPWord->loadTemplate('./Public/word/model2.docx');
        }
        else if($data['build_unit']=='后勤集团') {
          $tempPlete = $PHPWord->loadTemplate('./Public/word/model3.docx');	
        }
        else{
          $tempPlete = $PHPWord->loadTemplate('./Public/word/model.docx');
        }        
        foreach($data as $kk=>$vv){
            $tempPlete->setValue($kk,$vv);
         }
        $tempPlete->saveAs('Uploads/'.$item_name.'.docx');
      }
      
      if($length=='1'){
     // 	 ob_start(); 
      	$file_name=$item_name.".docx";
      	$date=$file_name;
      }else{
      //生成的压缩包位置
      $zipurl = 'Uploads/data.zip';
     //实例化类库
      import("Org.Util.PclZip");
      $zip = new PclZip($zipurl);
      $replace_name='Uploads/';//移除的文件路径
      $rs=$zip->create('Uploads',PCLZIP_OPT_REMOVE_PATH, $replace_name); 
      if ($rs == 0) { 
        die("Error : " . $zip->errorInfo(true)); 
      } 

 //     ob_start(); 
      //下载文件
      $file_name="data.zip";
      $date="批量导出报告".date("Ymd-H:i:m").".zip";
  }   
      $file_dir='Uploads/';
      $file = fopen ( $file_dir . $file_name, "rb" ); 
      header( "Content-type:  application/octet-stream "); 
      header( "Accept-Ranges:  bytes "); 
      Header ( "Accept-Length: " . filesize ( $file_dir . $file_name ) );  
      Header ( "Content-Disposition: attachment; filename=" . $date); 
      // header( "Content-Disposition:  attachment;  filename= {$date}"); 
      // $size=readfile($filename); 
      // header( "Accept-Length: " .$size);
      echo fread ( $file, filesize ($file_dir . $file_name ));    
      fclose ( $file );

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


   public function audit_out_6(){
      $list=I('get.idstr');
      $data_1=explode(",",$list);
      $cellName=$data_1;
      $length=count($cellName);
      $ss=M('auditing');
      $m=M('check');
      foreach ($cellName as $k => $v) {
        $where['id']=$v;
        $data=$ss->where($where)->select();
        dump($data);
        $data=$data['0'];

        $vtime=$data['vote_time'];
        if(checkstr($vtime,'月')!=false){
          $time_v = date_parse_from_format('Y年m月d日',$vtime);      
          $data['vote_time']=$time_v['year']."年".$time_v['month']."月";
        }else{
          $timef=explode('.', $data['vote_time']);
              $mf=substr($timef[1] ,0,1);
              $ml=$mf==0?substr($timef[1] ,1,1):$timef[1];
              $data['vote_time']=$timef[0]."年".$ml."月";
        
        }





        $time=$data['finish_time'];
        if(checkstr($time,'年')!=false){
            $app = date_parse_from_format('Y年m月d日',$time);
        }elseif(checkstr($time,'月')!=false){
          $time_f = date("Y")."年".$time;
            $app = date_parse_from_format('Y年m月d日',$time_f);
        }else{
            $timev=explode('.', $time);
          $mf=substr($timev[1] ,0,1);
          $df=substr($timev[2] ,0,1);
          $ml=$mf==0?substr($timev[1] ,1,1):$timev[1];
          $dl=$df==0?substr($timev[2] ,1,1):$timev[2];
          $str=$timev[0]."年".$ml."月".$dl."日";
          $app = date_parse_from_format('Y年m月d日',$str);
        }
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
        $ptime=$y.'年'.$mm.'月'.$dd.'日';

        $assessor=$data['assessor'];      
        $map_1['abbreviation']=$assessor;
        $result_1=$m->where($map_1)->find();
        $data['assessor']=$result_1['full_name'];

        $data['pu_time']=$time;
        $data['ppu_time']=$ptime; 
        $item_name=$data['symbol'];
        $itme_name_re=$data['item_name'];
        $long=iconv_strlen($itme_name_re,"UTF-8")-9;
        $data['item_name_a'] = mb_substr($itme_name_re,2,$long);
        //生成word
        $PHPWord = new \PhpOffice\PhpWord\PhpWord();
        $rate=$data['rate'];
        dump($rate);
        dump($data);
        if($rate=='0'||$rate=='0%'){
          // $tempPlete = $PHPWord->loadTemplate('./Public/word/model2.docx');
          
        }
        else if($data['build_unit']=='后勤集团') {
          // $tempPlete = $PHPWord->loadTemplate('./Public/word/model3.docx'); 
        }
        else{
          // $tempPlete = $PHPWord->loadTemplate('./Public/word/model.docx');
        }        
        // foreach($data as $kk=>$vv){
        //     $tempPlete->setValue($kk,$vv);
        //  }
        // $tempPlete->saveAs('Uploads/'.$item_name.'.docx');
      }
      
 //      if($length=='1'){
 //     //    ob_start(); 
 //        $file_name=$item_name.".docx";
 //        $date=$file_name;
 //      }else{
 //      //生成的压缩包位置
 //      $zipurl = 'Uploads/data.zip';
 //     //实例化类库
 //      import("Org.Util.PclZip");
 //      $zip = new PclZip($zipurl);
 //      $replace_name='Uploads/';//移除的文件路径
 //      $rs=$zip->create('Uploads',PCLZIP_OPT_REMOVE_PATH, $replace_name); 
 //      if ($rs == 0) { 
 //        die("Error : " . $zip->errorInfo(true)); 
 //      } 

 // //     ob_start(); 
 //      //下载文件
 //      $file_name="data.zip";
 //      $date="批量导出报告".date("Ymd-H:i:m").".zip";
 //  }   
     //  $file_dir='Uploads/';
     //  $file = fopen ( $file_dir . $file_name, "rb" ); 
     //  header( "Content-type:  application/octet-stream "); 
     //  header( "Accept-Ranges:  bytes "); 
     //  Header ( "Accept-Length: " . filesize ( $file_dir . $file_name ) );  
     //  Header ( "Content-Disposition: attachment; filename=" . $date); 
     //  // header( "Content-Disposition:  attachment;  filename= {$date}"); 
     //  // $size=readfile($filename); 
     //  // header( "Accept-Length: " .$size);
     //  echo fread ( $file, filesize ($file_dir . $file_name ));    
     //  fclose ( $file );

     //  //删除生成的文件和压缩包
     //  $path="Uploads/";
     //  $p = scandir($path);
     //  foreach($p as $val){
     //  //排除目录中的.和..
     //  if($val !="." && $val !=".."){
     //   //如果是目录则递归子目录，继续操作
     //  unlink($path.$val);
     //  }
     // }
    }





}
