<?php 

function checkstr($str,$needle){  //$needle :要筛选是否含有的字符串
 
 $tmparray = explode($needle,$str);
 if(count($tmparray)>1){
 return true;
 } else{
 return false;
 }
}
function year_trans($time){
    if(checkstr($time,'年')!=false){
       return $time;  
    }elseif (checkstr($time,'月')!=false) {
        $time=date("Y")."年".$time;
        return $time;
    }else{
    $timev=explode('.', $time);
    $mf=substr($timev[1] ,0,1);
    $df=substr($timev[2] ,0,1);
    $ml=$mf==0?substr($timev[1] ,1,1):$timev[1];
    $dl=$df==0?substr($timev[2] ,1,1):$timev[2];
    $finish_time=$timev[0]."年".$ml."月".$dl."日";
    return $finish_time;
    }
}

    /**
 *
 * @param string $title 模型名（如Member），用于导出生成文件名的前缀
 * @param array $cellName 表头及字段名
 * @param array $data 导出的表数据
 *
 * 特殊处理：合并单元格需要先对数据进行处理
 */
function exportOrderExcel($title,$cellName,$data)
{    
    //引入核心文件
    import("Org.Util.PHPExcel");
    $objPHPExcel = new \PHPExcel();
    //定义配置
    $topNumber = 3;//表头有几行占用
    $xlsTitle = iconv('utf-8', 'gb2312', $title);//文件名称
    $fileName = $title;//文件名称
    $cellKey = array(
            'A','B','C','D','E','F','G','H','I','J','K','L','M',
            'N','O','P','Q','R','S','T','U','V','W','X','Y','Z',
            'AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM',
            'AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ'
    );
    
    //写在处理的前面（了解表格基本知识，已测试）
  //   $objPHPExcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(20);//所有单元格（行）默认高度
     $objPHPExcel->getDefaultStyle()->getFont()->setName('宋体');//字体
//     $objPHPExcel->getActiveSheet()->getDefaultColumnDimension()->setWidth(20);//所有单元格（列）默认宽度
//     $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(30);//设置行高度
//     $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);//设置列宽度
//     $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(18);//设置文字大小
//     $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);//设置是否加粗
//     $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);// 设置文字颜色
//     $objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);//设置文字居左（HORIZONTAL_LEFT，默认值）中（HORIZONTAL_CENTER）右（HORIZONTAL_RIGHT）
//     $objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);//垂直居中
//     $objPHPExcel->getActiveSheet()->getStyle('A1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);//设置填充颜色
//     $objPHPExcel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setARGB('FF7F24');//设置填充颜色
    
    //处理表头标题
    $objPHPExcel->getActiveSheet()->mergeCells('A1:'.$cellKey[count($cellName)-1].'1');//合并单元格（如果要拆分单元格是需要先合并再拆分的，否则程序会报错）
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1',$title);
  //  $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true); //设置是否加粗
    
    $objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $objPHPExcel->getActiveSheet()->freezePane('C4');//冻结窗口
    //处理表头
     $objPHPExcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(20); //设置默认行高
     $objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(17.3);    //第一行行高
     $objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(17.3);    //第二行行高
     $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(28.5);    //第三行行高
     $objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setSize(10);  //设置默认字体大小
     $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(18);
     $objPHPExcel->getActiveSheet()->getStyle('2')->getFont()->setSize(11);//设置A2文字大小
     $objPHPExcel->getActiveSheet()->getStyle('3')->getFont()->setSize(11);//设置A3文字大小
     //$objPHPExcel->getActiveSheet()->getDefaultRowDimension()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);  
     
        $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    //'style' => PHPExcel_Style_Border::BORDER_THICK,//边框是粗的
                    'style' => PHPExcel_Style_Border::BORDER_THIN,//细边框
                    //'color' => array('argb' => 'FFFF0000'),
                ),
            ),
        );

    foreach ($cellName as $k=>$v)
    {   
         $objPHPExcel->getActiveSheet()->mergeCells($cellKey[$k].'2'.':'.$cellKey[$k].'3');//合并单元格（如果要拆分单元格是需要先合并再拆分的，否则程序会报错）


        if($v[5] == 1){

            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellKey[$k].'2', $v[1]);//设置表头数据
        }
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellKey[$k].'2', $v[1]);//设置表头数据
     //   $objPHPExcel->getActiveSheet()->freezePane($cellKey[$k].($topNumber+1));//冻结窗口 换了上面那种方法C3
     //   $objPHPExcel->getActiveSheet()->getStyle($cellKey[$k].$topNumber)->getFont()->setBold(true);//设置是否加粗
        $objPHPExcel->getActiveSheet()->getStyle($cellKey[$k].'2')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);//垂直居中
          $objPHPExcel->getActiveSheet()->getStyle($cellKey[$k].'2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  // 设置水平居中
        if($v[3] > 0)//大于0表示需要设置宽度
        {
            $objPHPExcel->getActiveSheet()->getColumnDimension($cellKey[$k])->setWidth($v[3]);//设置列宽度
        }
    }
    //处理数据
    foreach ($data as $k=>$v)
    {
        foreach ($cellName as $k1=>$v1)
        {

             if($v1[5] ==1){           
            $objPHPExcel->getActiveSheet()->setCellValue($cellKey[$k1].($k+1+$topNumber), $v[$v1[0]]['item_name']);
        }
        // elseif($v1[5] ==2){
        //     $objPHPExcel->getActiveSheet()->setCellValue($cellKey[$k1].($k+1+$topNumber), $v[$v1[0]]['item_supervisor']);
        // }
        else{
            $objPHPExcel->getActiveSheet()->setCellValue($cellKey[$k1].($k+1+$topNumber), $v[$v1[0]]);
        }


        
            $objPHPExcel->getActiveSheet()->getStyle('A2:'.$cellKey[$k1].($k+1+$topNumber))->applyFromArray($styleArray);
           
            if($v1[4] != "" && in_array($v1[4], array("LEFT","CENTER","RIGHT")))
            {
                $v1[4] = eval('return PHPExcel_Style_Alignment::HORIZONTAL_'.$v1[4].';');
                //这里也可以直接传常量定义的值，即left,center,right；小写的strtolower
                $objPHPExcel->getActiveSheet()->getStyle($cellKey[$k1].($k+1+$topNumber))->getAlignment()->setHorizontal($v1[4]);
            }
        }
    }
    //导出execl
    header('pragma:public');
    header('Content-type:application/vnd.ms-excel;charset=utf-8;name="'.$xlsTitle.'.xls"');
    header("Content-Disposition:attachment;filename=$fileName.xls");//attachment新窗口打印inline本窗口打印
    $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
    $objWriter->save('php://output');
    exit;
}




function exportOrderExcel2($title,$cellName,$data)
{    
    //引入核心文件
    import("Org.Util.PHPExcel");
    $objPHPExcel = new \PHPExcel();
    //定义配置
    $topNumber = 6;//表头有几行占用
    $xlsTitle = iconv('utf-8', 'gb2312', $title);//文件名称
    $fileName = $title;//文件名称
    $item_name= $data['0']['item']['item_name'];//项目名称
    $item_supervisor=$data['0']['item']['item_supervisor'];//
    $su_company=$data['0']['item']['su_company'];    
    
    $cellKey = array(
            'A','B','C','D','E','F','G','H','I','J','K','L','M',
            'N','O','P','Q','R','S','T','U','V','W','X','Y','Z',
            'AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM',
            'AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ'
    );
    
    //写在处理的前面（了解表格基本知识，已测试）
  //   $objPHPExcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(20);//所有单元格（行）默认高度
     $objPHPExcel->getDefaultStyle()->getFont()->setName('宋体');//字体
    
    //处理表头标题
    $objPHPExcel->getActiveSheet()->mergeCells('A1:'.$cellKey[count($cellName)+1].'1');//合并单元格（如果要拆分单元格是需要先合并再拆分的，否则程序会报错）
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1',$title);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A2','项目名称:');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B2',$item_name);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A3','投资监理:');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B3',$item_supervisor);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A4','投资监理单位:');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B4',$su_company);
    $objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true); //设置是否加粗
    $objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setBold(true); //设置是否加粗
    $objPHPExcel->getActiveSheet()->getStyle('A4')->getFont()->setBold(true); //设置是否加粗
    $objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
//    $objPHPExcel->getActiveSheet()->freezePane('C4');//冻结窗口
    //处理表头
     $objPHPExcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(20); //设置默认行高
     $objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(17.3);    //第一行行高
     $objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(17.3);    //第二行行高
     $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(28.5);    //第三行行高
     $objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setSize(10);  //设置默认字体大小
     $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(18);
     $objPHPExcel->getActiveSheet()->getStyle('2')->getFont()->setSize(11);//设置A2文字大小
     $objPHPExcel->getActiveSheet()->getStyle('3')->getFont()->setSize(11);//设置A3文字大小
     //$objPHPExcel->getActiveSheet()->getDefaultRowDimension()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);  
     
        $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    //'style' => PHPExcel_Style_Border::BORDER_THICK,//边框是粗的
                    'style' => PHPExcel_Style_Border::BORDER_THIN,//细边框
                    //'color' => array('argb' => 'FFFF0000'),
                ),
            ),
        );
    $begin=7;
    foreach ($cellName as $k=>$v)
    {   

            $objPHPExcel->getActiveSheet()->mergeCells('G5:I6');//付款情况三栏
            $objPHPExcel->getActiveSheet()->mergeCells('K5:L6');//备注情况二栏
            if($v[5] ==2){
                $kmc=2;
            }elseif ($v[5] ==3) {
                 $kmc=2;
            }
            else{
                $kmc=0;
            }
            $objPHPExcel->getActiveSheet()->mergeCells($cellKey[$k+$kmc].'5'.':'.$cellKey[$k+$kmc].'6');//合并单元格（如果要拆分单元格是需要先合并再拆分的，否则程序会报错）

        
          

        

        $objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellKey[$k+$kmc].'5', $v[1]);//设置表头数据
     //   $objPHPExcel->getActiveSheet()->freezePane($cellKey[$k].($topNumber+1));//冻结窗口 换了上面那种方法C3
     //   $objPHPExcel->getActiveSheet()->getStyle($cellKey[$k].$topNumber)->getFont()->setBold(true);//设置是否加粗

        $objPHPExcel->getActiveSheet()->getStyle($cellKey[$k+$kmc].'5')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);//垂直居中
        $objPHPExcel->getActiveSheet()->getStyle($cellKey[$k+$kmc].'5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  // 设置水平居中
        if($v[3] > 0)//大于0表示需要设置宽度
        {
           
            if($v[5] ==1){
                for($i=$v[6];$i--;$i<1){
                  $objPHPExcel->getActiveSheet()->getColumnDimension($cellKey[$k+$i])->setWidth($v[3]);//设置列宽度 
                }
               
            }elseif ($v[5] ==3) {
                $objPHPExcel->getActiveSheet()->getColumnDimension($cellKey[$k+2])->setWidth($v[3]);
                $objPHPExcel->getActiveSheet()->getColumnDimension($cellKey[$k+3])->setWidth($v[3]);
                
            }
            elseif ($v[5] ==2) {
                $objPHPExcel->getActiveSheet()->getColumnDimension($cellKey[$k+2])->setWidth($v[3]);
                
            }else{
                 $objPHPExcel->getActiveSheet()->getColumnDimension($cellKey[$k])->setWidth($v[3]);//设置列宽度

            }
        }
    }

    //处理数据
    foreach ($data as $k=>$v)
    {   

        $contract_add_money=$v['contract_add_money'];//累计预付款
        $contract_balance=$v['contract_balance'];//余额
        $contract_nature=$v['contract_nature'];
        $contract_remarks_extra=$v['contract_remarks_extra'];
        $ratio=$v['ratio'];
         if($contract_nature=='招标代理'){
         $type_remark='1';
         }else{
          $type_remark='0';
         }
        $py_long=count($v['paylist']);
        if($type_remark=='1'){
        $total_invest=$v['total_invest']; 
        $jian_fee=$v['jian_fee'];
        $budget_amount=$v['budget_amount'];
        $limit_price=$v['limit_price'];
        
       
      
      }
        //获取pylist的长度
        $ss[]='0';//定义数组//定义数组
        $py_long_py=$py_long;//付款次数如果小于3，使用py_long会重复，所以这个应该不受下面的应用
        if($type_remark=='1'){
           $py_long=$py_long>3?$py_long:2;//判断pylist的长度是否大于3，因为会有四个金额和一个备注，至于取二是因为下面加了1
        }
        $ss[$k+1]=$py_long+1; //正常加一行 ，是为了有累计预付款和余额    
        $begin+=$ss[$k]*2;//自加 然后加上上一个项目的占用的行数



        //下面是进行每列数据的输入
        foreach ($cellName as $k1=>$v1)
        { 


          
            if($v1[5] == 1){   //这里判断是否是付款栏  
            
            for($i=1;$i<2*$py_long_py;$i+=2){
             
            $b=intval(floor($i/2));  //b为次数
            $a=$b+1;  //a为那个数组从0开始
            $name_fu_1=['预付时间','预付金额','预付比例'];   
            $name_fu_2=['pay_time','pay_amount','ratio'];
             for($m=0;$m<3;$m++){
                $objPHPExcel->getActiveSheet()->setCellValue($cellKey[$k1+$m].($begin+$i-1), $name_fu_1[$m].$a);                                   
                $objPHPExcel->getActiveSheet()->setCellValue($cellKey[$k1+$m].($begin+$i), $v[$v1[0]][$b][$name_fu_2[$m]]);                                    
                     }

                    }
            $name_fu_3=['累计预付款','余额','余额占比'];
            $name_fu_4=['contract_add_money','contract_balance','ratio'];
            for($m=0;$m<3;$m++){
                $objPHPExcel->getActiveSheet()->setCellValue($cellKey[$k1+$m].($begin+2*$py_long), $name_fu_3[$m]);                                   
                $objPHPExcel->getActiveSheet()->setCellValue($cellKey[$k1+$m].($begin+2*$py_long+1),$$name_fu_4[$m]);                                    
                     }
                // $name_fu_3=['累计预付款','余额','contract_add_money','contract_balance'];
                //  for($m=0;$m<2;$m++){
                //     $objPHPExcel->getActiveSheet()->setCellValue($cellKey[$k1].($begin+2*$py_long+$m),$name_fu_3[$m] );
                //     $objPHPExcel->getActiveSheet()->setCellValue($cellKey[$k1+1].($begin+2*$py_long+$m),$$name_fu_3[$m+2]);
                                              
                //      } 


           $objPHPExcel->getActiveSheet()->getStyle($cellKey[$k1].$begin.':'.$cellKey[$k1+2].($begin+2*$py_long+1))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

                }elseif ($v1[5]==3) {

                     $kk1=$k1+2;
                     if($type_remark=='1'){
                     $name_re=['总投资额','建安费','预算金额','招标限价'];
                     $name_rp=['total_invest','jian_fee','budget_amount','limit_price'];
                     for($i=0;$i<4;$i++){
                        $objPHPExcel->getActiveSheet()->setCellValue($cellKey[$kk1].($begin+$i),$name_re[$i]);
                        $objPHPExcel->getActiveSheet()->setCellValue($cellKey[$kk1+1].($begin+$i),$$name_rp[$i]);                      
                     }
                     $objPHPExcel->getActiveSheet()->mergeCells($cellKey[$kk1].($begin+4).':'.$cellKey[$kk1+1].($begin+$py_long*2+1));//合并单元格
                     $objPHPExcel->getActiveSheet()->setCellValue($cellKey[$kk1].($begin+4),$contract_remarks_extra);
                   }else{
                     $objPHPExcel->getActiveSheet()->mergeCells($cellKey[$kk1].($begin).':'.$cellKey[$kk1+1].($begin+$py_long*2+1));//合并单元格
                      $objPHPExcel->getActiveSheet()->setCellValue($cellKey[$kk1].($begin),$contract_remarks_extra);
                   }
                     $objPHPExcel->getActiveSheet()->getStyle($cellKey[$kk1].$begin.':'.$cellKey[$kk1+1].($begin+2*$py_long+1))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                   }
 
                elseif ($v1[5] == 2) {
                     $kk1=$k1+3;
                     $objPHPExcel->getActiveSheet()->setCellValue($cellKey[$kk1-1].($begin), $v[$v1[0]]);
               // $objPHPExcel->getActiveSheet()->mergeCells($cellKey[$k1].'4:'.$cellKey[$k1].'7');
                $objPHPExcel->getActiveSheet()->mergeCells($cellKey[$kk1-1].($begin).':'.$cellKey[$kk1-1].($begin+$py_long*2+1));//合并单元格
                $objPHPExcel->getActiveSheet()->getStyle($cellKey[$kk1-1].($begin))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);//设置水平居中
                    
                }
                else{
                $objPHPExcel->getActiveSheet()->setCellValue($cellKey[$k1].($begin), $v[$v1[0]]);
               // $objPHPExcel->getActiveSheet()->mergeCells($cellKey[$k1].'4:'.$cellKey[$k1].'7');
                $objPHPExcel->getActiveSheet()->mergeCells($cellKey[$k1].($begin).':'.$cellKey[$k1].($begin+$py_long*2+1));//合并单元格
                $objPHPExcel->getActiveSheet()->getStyle($cellKey[$k1].($begin))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);//设置水平居中
            }



            if($v1[4] != "" && in_array($v1[4], array("LEFT","CENTER","RIGHT")))
            {
                $v1[4] = eval('return PHPExcel_Style_Alignment::HORIZONTAL_'.$v1[4].';');
                //这里也可以直接传常量定义的值，即left,center,right；小写的strtolower
                $objPHPExcel->getActiveSheet()->getStyle($cellKey[$k1].($begin))->getAlignment()->setHorizontal($v1[4]);
                if($v1[5] == 1){
                for($i=0;$i<3;$i++){
                    for($j=1;$j<$begin+$py_long*2+1;$j++){
                $objPHPExcel->getActiveSheet()->getStyle($cellKey[$k1+$i].($k+$j+$topNumber))->getAlignment()->setHorizontal($v1[4]);//设置左右居中
                }               
                }
                }elseif($v1[5] == 2) {
                  $objPHPExcel->getActiveSheet()->getStyle($cellKey[$k1+3].($begin))->getAlignment()->setHorizontal($v1[4]);  
                    
                }
                elseif($v1[5] == 3) {
                   for($i=0;$i<2;$i++){
                    for($j=1;$j<5;$j++){
                $objPHPExcel->getActiveSheet()->getStyle($cellKey[$k1+$i+2].($k+$j+$topNumber))->getAlignment()->setHorizontal($v1[4]);//设置左右居中
                }               
                }
                    
                }   
            }
             $objPHPExcel->getActiveSheet()->getStyle('A5:'.$cellKey[$k1+3].($begin+$py_long*2+1))->applyFromArray($styleArray);//加框
        }
    }
    //导出execl
    header('pragma:public');
    header('Content-type:application/vnd.ms-excel;charset=utf-8;name="'.$xlsTitle.'.xls"');
    header("Content-Disposition:attachment;filename=$fileName.xls");//attachment新窗口打印inline本窗口打印
    $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
    $objWriter->save('php://output');
    exit;
}

function exportOrderExcel3($title,$cellName,$data)
{    
    //引入核心文件
    import("Org.Util.PHPExcel");
    $objPHPExcel = new \PHPExcel();
    //定义配置
    $topNumber = 3;//表头有几行占用
    $xlsTitle = iconv('utf-8', 'gb2312', $title);//文件名称
    $fileName = $title;//文件名称
    $cellKey = array(
            'A','B','C','D','E','F','G','H','I','J','K','L','M',
            'N','O','P','Q','R','S','T','U','V','W','X','Y','Z',
            'AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM',
            'AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ'
    );
    
    //写在处理的前面（了解表格基本知识，已测试）
  //   $objPHPExcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(20);//所有单元格（行）默认高度
     $objPHPExcel->getDefaultStyle()->getFont()->setName('宋体');//字体
//     $objPHPExcel->getActiveSheet()->getDefaultColumnDimension()->setWidth(20);//所有单元格（列）默认宽度
//     $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(30);//设置行高度
//     $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);//设置列宽度
//     $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(18);//设置文字大小
//     $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);//设置是否加粗
//     $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);// 设置文字颜色
//     $objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);//设置文字居左（HORIZONTAL_LEFT，默认值）中（HORIZONTAL_CENTER）右（HORIZONTAL_RIGHT）
//     $objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);//垂直居中
//     $objPHPExcel->getActiveSheet()->getStyle('A1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);//设置填充颜色
//     $objPHPExcel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setARGB('FF7F24');//设置填充颜色
    
    //处理表头标题
    $objPHPExcel->getActiveSheet()->mergeCells('A1:'.$cellKey[count($cellName)-1].'1');//合并单元格（如果要拆分单元格是需要先合并再拆分的，否则程序会报错）
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1',$title);
  //  $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true); //设置是否加粗
    
    $objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
   // $objPHPExcel->getActiveSheet()->freezePane('C4');//冻结窗口
    //处理表头
     $objPHPExcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(20); //设置默认行高
     $objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(17.3);    //第一行行高
     $objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(17.3);    //第二行行高
     $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(28.5);    //第三行行高
     $objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setSize(10);  //设置默认字体大小
     $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(18);
     $objPHPExcel->getActiveSheet()->getStyle('2')->getFont()->setSize(11);//设置A2文字大小
     $objPHPExcel->getActiveSheet()->getStyle('3')->getFont()->setSize(11);//设置A3文字大小
     //$objPHPExcel->getActiveSheet()->getDefaultRowDimension()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);  
     
        $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    //'style' => PHPExcel_Style_Border::BORDER_THICK,//边框是粗的
                    'style' => PHPExcel_Style_Border::BORDER_THIN,//细边框
                    //'color' => array('argb' => 'FFFF0000'),
                ),
            ),
        );

    foreach ($cellName as $k=>$v)
    {   
         $objPHPExcel->getActiveSheet()->mergeCells($cellKey[$k].'2'.':'.$cellKey[$k].'3');//合并单元格（如果要拆分单元格是需要先合并再拆分的，否则程序会报错）


        if($v[5] == 1){

            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellKey[$k].'2', $v[1]);//设置表头数据
        }
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellKey[$k].'2', $v[1]);//设置表头数据
     //   $objPHPExcel->getActiveSheet()->freezePane($cellKey[$k].($topNumber+1));//冻结窗口 换了上面那种方法C3
     //   $objPHPExcel->getActiveSheet()->getStyle($cellKey[$k].$topNumber)->getFont()->setBold(true);//设置是否加粗
        $objPHPExcel->getActiveSheet()->getStyle($cellKey[$k].'2')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);//垂直居中
          $objPHPExcel->getActiveSheet()->getStyle($cellKey[$k].'2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  // 设置水平居中
        if($v[3] > 0)//大于0表示需要设置宽度
        {
            $objPHPExcel->getActiveSheet()->getColumnDimension($cellKey[$k])->setWidth($v[3]);//设置列宽度
        }
    }
    //处理数据
    $i=-1;
    $s=date("m")."月".date("d")."日";
    foreach ($data as $k=>$v)
    {  
       $i=$i+2;
       $k=$k+$i;//用来隔一行
        foreach ($cellName as $k1=>$v1)
        {

  			if($v1[5]==3){
  			 $objPHPExcel->getActiveSheet()->setCellValue($cellKey[$k1].($k+$topNumber),$s);	
  			}else{
            $objPHPExcel->getActiveSheet()->setCellValue($cellKey[$k1].($k+$topNumber), $v[$v1[0]]);
            }
            if ($v1[5]==1) {
                $objPHPExcel->getActiveSheet()->setCellValue($cellKey[$k1].($k+$topNumber+1), '财务处');   
                
            }elseif ($v1[5]==2) {
                $objPHPExcel->getActiveSheet()->setCellValue($cellKey[$k1].($k+$topNumber+1), '1');  
                 $objPHPExcel->getActiveSheet()->setCellValue($cellKey[$k1].($k+$topNumber), '1');
                
            }
       


        
            $objPHPExcel->getActiveSheet()->getStyle('A2:'.$cellKey[$k1].($k+2+$topNumber))->applyFromArray($styleArray);
           
            if($v1[4] != "" && in_array($v1[4], array("LEFT","CENTER","RIGHT")))
            {
                $v1[4] = eval('return PHPExcel_Style_Alignment::HORIZONTAL_'.$v1[4].';');
                //这里也可以直接传常量定义的值，即left,center,right；小写的strtolower
                $objPHPExcel->getActiveSheet()->getStyle($cellKey[$k1].($k+1+$topNumber))->getAlignment()->setHorizontal($v1[4]);
                $objPHPExcel->getActiveSheet()->getStyle($cellKey[$k1].($k+$topNumber))->getAlignment()->setHorizontal($v1[4]);
            }

             $objPHPExcel->getActiveSheet()->getStyle($cellKey[$k1].(3))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);//设置水平居中
        }
    }
    //导出execl
    header('pragma:public');
    header('Content-type:application/vnd.ms-excel;charset=utf-8;name="'.$xlsTitle.'.xls"');
    header("Content-Disposition:attachment;filename=$fileName.xls");//attachment新窗口打印inline本窗口打印
    $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
    $objWriter->save('php://output');
    exit;
}

function exportOrderExcel4($title,$cellName,$data)
{    
    //引入核心文件
    import("Org.Util.PHPExcel");
    $objPHPExcel = new \PHPExcel();
    ini_set("memory_limit", "1024M"); // 设置php可使用内存
    set_time_limit(0);
    $cacheMethod = PHPExcel_CachedObjectStorageFactory::cache_in_memory_gzip;
    if (!PHPExcel_Settings::setCacheStorageMethod($cacheMethod)) {
        die($cacheMethod . " 缓存方法不可用" . EOL);
    }
    //定义配置
    $topNumber = 3;//表头有几行占用
    $xlsTitle = iconv('utf-8', 'gb2312', $title);//文件名称
    $fileName = $title;//文件名称
    $cellKey = array(
            'A','B','C','D','E','F','G','H','I','J','K','L','M',
            'N','O','P','Q','R','S','T','U','V','W','X','Y','Z',
            'AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM',
            'AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ'
    );
    
    //写在处理的前面（了解表格基本知识，已测试）
  //   $objPHPExcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(20);//所有单元格（行）默认高度
     $objPHPExcel->getDefaultStyle()->getFont()->setName('宋体');//字体
//     $objPHPExcel->getActiveSheet()->getDefaultColumnDimension()->setWidth(20);//所有单元格（列）默认宽度
//     $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(30);//设置行高度
//     $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);//设置列宽度
//     $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(18);//设置文字大小
//     $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);//设置是否加粗
//     $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);// 设置文字颜色
//     $objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);//设置文字居左（HORIZONTAL_LEFT，默认值）中（HORIZONTAL_CENTER）右（HORIZONTAL_RIGHT）
//     $objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);//垂直居中
//     $objPHPExcel->getActiveSheet()->getStyle('A1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);//设置填充颜色
//     $objPHPExcel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setARGB('FF7F24');//设置填充颜色
    
    //处理表头标题
    $objPHPExcel->getActiveSheet()->mergeCells('A1:'.$cellKey[count($cellName)-1].'1');//合并单元格（如果要拆分单元格是需要先合并再拆分的，否则程序会报错）
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1',$title);
  //  $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true); //设置是否加粗
    
    $objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
   // $objPHPExcel->getActiveSheet()->freezePane('C4');//冻结窗口
    //处理表头
     $objPHPExcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(20); //设置默认行高
     $objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(17.3);    //第一行行高
     $objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(17.3);    //第二行行高
     $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(28.5);    //第三行行高
     $objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setSize(10);  //设置默认字体大小
     $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(18);
     $objPHPExcel->getActiveSheet()->getStyle('2')->getFont()->setSize(11);//设置A2文字大小
     $objPHPExcel->getActiveSheet()->getStyle('3')->getFont()->setSize(11);//设置A3文字大小
     //$objPHPExcel->getActiveSheet()->getDefaultRowDimension()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);  
     
        $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    //'style' => PHPExcel_Style_Border::BORDER_THICK,//边框是粗的
                    'style' => PHPExcel_Style_Border::BORDER_THIN,//细边框
                    //'color' => array('argb' => 'FFFF0000'),
                ),
            ),
        );

    foreach ($cellName as $k=>$v)
    {   
         $objPHPExcel->getActiveSheet()->mergeCells($cellKey[$k].'2'.':'.$cellKey[$k].'3');//合并单元格（如果要拆分单元格是需要先合并再拆分的，否则程序会报错）


        if($v[5] == 1){

            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellKey[$k].'2', $v[1]);//设置表头数据
        }
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellKey[$k].'2', $v[1]);//设置表头数据
        $objPHPExcel->getActiveSheet()->getStyle($cellKey[$k].'2')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);//垂直居中
        $objPHPExcel->getActiveSheet()->getStyle($cellKey[$k].'2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  // 设置水平居中
        if($v[3] > 0)//大于0表示需要设置宽度
        {
            $objPHPExcel->getActiveSheet()->getColumnDimension($cellKey[$k])->setWidth($v[3]);//设置列宽度
        }
    }
    //处理数据
   
    foreach ($data as $k=>$v)
    {      
      foreach ($cellName as $k1=>$v1)
      {

            if($v1[5]==2){
            	 $objPHPExcel->getActiveSheet()->setCellValue($cellKey[$k1].($k+$topNumber+1), $k);
            }else{
                 $objPHPExcel->getActiveSheet()->setCellValue($cellKey[$k1].($k+$topNumber+1), $v[$v1[0]]);
            }      
            $objPHPExcel->getActiveSheet()->getStyle('A2:'.$cellKey[$k1].($k+1+$topNumber))->applyFromArray($styleArray);          
            if($v1[4] != "" && in_array($v1[4], array("LEFT","CENTER","RIGHT")))
            {
              $v1[4] = eval('return PHPExcel_Style_Alignment::HORIZONTAL_'.$v1[4].';');
                //这里也可以直接传常量定义的值，即left,center,right；小写的strtolower
              $objPHPExcel->getActiveSheet()->getStyle($cellKey[$k1].($k+1+$topNumber))->getAlignment()->setHorizontal($v1[4]);           
            }
             $objPHPExcel->getActiveSheet()->getStyle($cellKey[$k1].(3))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);//设置水平居中
        }
    }
    //导出execl
    header('pragma:public');
    header('Content-type:application/vnd.ms-excel;charset=utf-8;name="'.$xlsTitle.'.xls"');
    header("Content-Disposition:attachment;filename=$fileName.xls");//attachment新窗口打印inline本窗口打印
    $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
    $objWriter->save('php://output');
    exit;
}

/**
 * 随机字符
 * @param number $length 长度
 * @param string $type 类型
 * @param number $convert 转换大小写
 * @return string
 */
function random_create($length=6, $type='all', $convert=0){
    $config = array(
        'number'=>'1234567890',
        'letter'=>'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
        'string'=>'abcdefghjkmnpqrstuvwxyzABCDEFGHJKMNPQRSTUVWXYZ23456789',
        'all'=>'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890'
    );
    
    if(!isset($config[$type])) $type = 'string';
    $string = $config[$type];
    
    $code = '';
    $strlen = strlen($string) -1;
    for($i = 0; $i < $length; $i++){
        $code .= $string{mt_rand(0, $strlen)};
    }
    if(!empty($convert)){
        $code = ($convert > 0)? strtoupper($code) : strtolower($code);
    }
    return $code;
}























 ?>