<?php if (!defined('THINK_PATH')) exit();?><!--_meta 作为公共模版分离出去-->
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<link rel="Bookmark" href="/audit/Public/image/favicon.ico" >
<link rel="Shortcut Icon" href="/audit/Public/image/favicon.ico" />
<!--[if lt IE 9]>
<script type="text/javascript" src="lib/html5.js"></script>
<script type="text/javascript" src="lib/respond.min.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="/audit/Public/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="/audit/Public/static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="/audit/Public/lib/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" type="text/css" href="/audit/Public/static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="/audit/Public/static/h-ui.admin/css/style.css" />
<title>审计处后台管理系统</title>
</head>
<!--/meta 作为公共模版分离出去-->

<body>
    <article class="cl pd-20 va-m">
        <form action="" method="post" class="form form-horizontal" id="pay">
            <table class="table table-border table-bordered table-hover table-bg">
                <thead>
                    <th width="100">合同金额</th>
                    <th width="100">审定金额</th>
                    <th class="text-c f-20" colspan="2">付 款 情 况</th>
                </thead>
                <tbody>
                	<div class="cooid" contract_id="<?php echo ($data["contract_id"]); ?>" style="display: none;"></div>
                    <tr>
                        <?php if(!empty($data['paylist'][3])): ?><td class="all paymuch" rowspan="<?php echo count($data['paylist'])*2+2;?>"><input type="text" value="<?php echo ($data['contract_amount']); ?>" class="input-text size-S" placeholder="-" name="contract_amount"></td>
                            <td class="all paymuch" rowspan="<?php echo count($data['paylist'])*2+2;?>"><input type="text" value="<?php echo ($data['contract_exact_amount']); ?>" class="input-text size-S" placeholder="-" name="contract_exact_amount"></td>
                            <?php else: ?>
                            <td class="all paymuch" rowspan="8"><input type="text" class="input-text size-S" value="<?php echo ($data['contract_amount']); ?>" placeholder="-" name="contract_amount"></td>
                            <td class="all paymuch" rowspan="8"><input type="text" class="input-text size-S" value="<?php echo ($data['contract_exact_amount']); ?>" placeholder="-" name="contract_exact_amount"></td><?php endif; ?>
                        <td><b>预付时间1</b></td>
                        <td><b>预付金额1</b></td>
                    </tr>
                    <tr class="paylist">
                        <?php if(!empty($data['paylist'][0])): ?><td><input pay_id="<?php echo ($data['paylist'][0]['id']); ?>" type="text" class="input-text size-S" value="<?php echo ($data['paylist'][0]['pay_time']); ?>" placeholder="-" name="pay_time1"></td>
                            <td class="paymuch"><input pay_id="<?php echo ($data['paylist'][0]['id']); ?>" type="text" class="input-text size-S" value="<?php echo ($data['paylist'][0]['pay_amount']); ?>" placeholder="-" name="pay_amount1"></td>
                            <?php else: ?>
                            <td><input pay_id="<?php echo ($data['paylist'][0]['id']); ?>" type="text" class="input-text size-S" value="" placeholder="-" name="pay_time1"></td>
                            <td class="paymuch"><input pay_id="<?php echo ($data['paylist'][0]['id']); ?>" type="text" class="input-text size-S" value="" placeholder="-" name="pay_amount1"></td><?php endif; ?>
                    </tr>
                    <tr>
                        <td><b>预付时间2</b></td>
                        <td><b>预付金额2</b></td>
                    </tr>
                    <tr class="paylist">
                        <?php if(!empty($data['paylist'][1])): ?><td><input pay_id="<?php echo ($data['paylist'][1]['id']); ?>" type="text" class="input-text size-S" value="<?php echo ($data['paylist'][1]['pay_time']); ?>" placeholder="-" name="pay_time2"></td>
                            <td class="paymuch"><input pay_id="<?php echo ($data['paylist'][1]['id']); ?>" type="text" class="input-text size-S" value="<?php echo ($data['paylist'][1]['pay_amount']); ?>" placeholder="-" name="pay_amount2"></td>
                            <?php else: ?>
                            <td><input pay_id="<?php echo ($data['paylist'][1]['id']); ?>" type="text" class="input-text size-S" value="" placeholder="-" name="pay_time2"></td>
                            <td class="paymuch"><input pay_id="<?php echo ($data['paylist'][1]['id']); ?>" type="text" class="input-text size-S" value="" placeholder="-" name="pay_amount2"></td><?php endif; ?>
                    </tr>
                    <tr>
                        <td><b>预付时间3</b></td>
                        <td><b>预付金额3</b></td>
                    </tr>
                    <tr class="paylist">
                        <?php if(!empty($data['paylist'][2])): ?><td><input pay_id="<?php echo ($data['paylist'][2]['id']); ?>" type="text" class="input-text size-S" value="<?php echo ($data['paylist'][2]['pay_time']); ?>" placeholder="-" name="pay_time3"></td>
                            <td class="paymuch"><input pay_id="<?php echo ($data['paylist'][2]['id']); ?>" type="text" class="input-text size-S" value="<?php echo ($data['paylist'][2]['pay_amount']); ?>" placeholder="-" name="pay_amount3"></td>
                            <?php else: ?>
                            <td><input pay_id="<?php echo ($data['paylist'][2]['id']); ?>" type="text" class="input-text size-S" value="" placeholder="-" name="pay_time3"></td>
                            <td class="paymuch"><input pay_id="<?php echo ($data['paylist'][2]['id']); ?>" type="text" class="input-text size-S" value="" placeholder="-" name="pay_amount3"></td><?php endif; ?>
                    </tr>
                    <?php if(is_array($data['paylist'])): $i = 0; $__LIST__ = array_slice($data['paylist'],3,null,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if(!empty($vo)): ?><tr>
                                <td><b>预付时间<?php echo ($key+1); ?></b></td>
                                <td><b>预付金额<?php echo ($key+1); ?></b></td>
                            </tr>
                            <tr class="paylist">
                                <td><input pay_id="<?php echo ($vo["id"]); ?>" type="text" class="input-text size-S" value="<?php echo ($vo["pay_time"]); ?>" placeholder="-" name="pay_time<?php echo ($key+1); ?>"></td>
                                <td class="paymuch"><input pay_id="<?php echo ($vo["id"]); ?>" type="text" class="input-text size-S" value="<?php echo ($vo["pay_amount"]); ?>" placeholder="-" name="pay_amount<?php echo ($key+1); ?>"></td>
                            </tr><?php endif; ?>
                        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                    <tr id="bef">
                        <td>累计预付款</td>
                        <?php if(!empty($data['contract_add_money'])): ?><td class="add"><?php echo ($data['contract_add_money']); ?></td>
                            <?php else: ?>
                            <td class="add">-</td><?php endif; ?>
                    </tr>
                    <tr>
                        <td>余额</td>
                        <?php if(!empty($data['contract_balance'])): ?><td class="lif"><?php echo ($data['contract_balance']); ?></td>
                            <?php else: ?>
                            <td class="lif">-</td><?php endif; ?>
                    </tr>
                </tbody>
            </table>
            <div class="row cl">
                <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
                    <span class="btn btn-danger radius f-r quxiao" style="width: 100px; margin-left: 20px;">取消</span>
                    <span class="btn btn-success radius f-r baochun" style="width: 100px;">提交</span>
                    <span class="btn btn-primary radius f-r addyufu" style="width: 100px; margin-right: 20px;"> 添加预付 </span>
                </div>
            </div>
        </form>
    </article>
    <script type="text/javascript" src="/audit/Public/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/audit/Public/lib/layer/2.4/layer.js"></script> 
<script type="text/javascript" src="/audit/Public/static/h-ui/js/H-ui.js"></script> 
<script type="text/javascript" src="/audit/Public/static/h-ui.admin/js/H-ui.admin.page.js"></script>
<script type="text/javascript" src="/audit/Public/lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="/audit/Public/lib/laypage/1.2/laypage.js"></script>

    <script type="text/javascript">
   	$('input:not([autocomplete]').attr('autocomplete', 'off'); 
    num = $('.paylist').size();
    $(".addyufu").click(function() {
        num++;
        var text = '<tr><td><b>预付时间' + num + '</b></td><td><b>预付金额' + num + '</b></td></tr><tr class="paylist"><td><input autocomplete="off" pay_id="" type="text" class="input-text size-S" placeholder="-" name="pay_time'+num+'"></td> <td class="paymuch" ><input autocomplete="off" pay_id="" type="text" class="input-text size-S" placeholder="-" name="pay_amount'+num+'"></td></tr>';
        $("#bef").before(text);
        var newcol = parseInt($(".all").attr("rowspan")) + 2;
        $(".all").attr("rowspan", newcol);
    });
   function geshi(num){  
        num += '';  
        num = num.replace(/[^0-9|\.]/g, ''); //清除字符串中的非数字非.字符  
        if(/^0+/) //清除字符串开头的0  
            num = num.replace(/^0+/, '');  
        if(!/\./.test(num)) //为整数字符串在末尾添加.00  
            num += '.00';  
        if(/^\./.test(num)) //字符以.开头时,在开头添加0  
            num = '0' + num;  
        num += '00';        //在字符串末尾补零  
        num = num.match(/\d+\.\d{2}/)[0];
        return num;
     };
    $(".quxiao").click(function() {
        var index = parent.layer.getFrameIndex(window.name);
        parent.layer.close(index);
    })
    $(".baochun").click(function() {
    	var id = $(".cooid").attr("contract_id");
        var contract_amount = $("input[name='contract_amount']").val();
        var contract_exact_amount = $("input[name='contract_exact_amount']").val();
        var contract_add_money = $('.add').text();
        var contract_balance = $('.lif').text();
        var length = $('.paylist').size();
        var paylist = [];
        for (var i = 1; i <= length; i++) {
            var string = "pay_amount" + i;
            var string1 = "pay_time" + i;
            var arr = $("input[name='" + string + "']").val();
            var arr1 = $("input[name='" + string1 + "']").val();
            var pay_id = $("input[name='" + string1 + "']").attr('pay_id');
            if (arr1 != '') {
                var string2 = new Object();
                string2.id = pay_id;
                string2.pay_time = arr1;
                string2.pay_amount = arr;
                paylist.push(string2);
            }
        }
        list = JSON.stringify(paylist);
    	$.ajax({
            type: "POST",
            url: "/audit/index.php/Home/Before/list_edit1",
            data: "contract_amount=" + contract_amount + "&id=" + id + "&contract_exact_amount=" + contract_exact_amount + "&contract_add_money=" + contract_add_money + "&contract_balance=" + contract_balance + "&list=" +list,  
            success: function(data) {
                localStorage.setItem('flag', 0);
            	window.parent.location.reload();
            	var index = parent.layer.getFrameIndex(window.name);
        		parent.layer.close(index);
            }
        });
    })
    $(document).on("input",'input', function() {
    	var contract_amount = $("input[name='contract_amount']").val();
    	var contract_exact_amount = $("input[name='contract_exact_amount']").val();
    	var length = $('.paylist').size();
    	var num = 0;
    	for (var i = 1; i <= length; i++){
    		string = "pay_amount"+i;
    		if($("input[name='"+string+"']").val()!=''){
    			num+=parseFloat($("input[name='"+string+"']").val());
    		}
    	}
    	if (contract_exact_amount!='' && contract_exact_amount!='0.00') {
    		var leave = parseFloat(contract_exact_amount) - num;
            if(leave < 0){
                $(".lif").text('-' + geshi(leave));
            }else {
                $(".lif").text(geshi(leave));
            }
    		$(".add").text(geshi(num));
    	}else{
    		var leave = parseFloat(contract_amount) -num;
            if(leave < 0){
                $(".lif").text('-' + geshi(leave));
            }else {
                $(".lif").text(geshi(leave));
            }
            $(".add").text(geshi(num));
    	}
    })
    $(document).on("blur",'.paymuch input', function() {
        var num = $(this).val();
        if(geshi(num)!='0.00'){
            $(this).val(geshi(num));
        }
    })
    </script>
    <!--/请在上方写此页面业务相关的脚本-->
</body>

</html>