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
</head>
<body>
<article class="cl pd-20">
	<div class="form form-horizontal" id="form-change-password">
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">添加分表:</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" autocomplete="off" placeholder="输入分表名" name="item_name" id="item_name">
			</div>
		</div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">投资监理单位:</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" autocomplete="off" placeholder="输入项目监理单位" name="su_company" id="su_company">
            </div>
        </div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">项目监理:</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" autocomplete="off" placeholder="输入项目监理名" name="item_supervisor" id="item_supervisor">
			</div>
		</div>
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
				<button id="quxiao" class="btn btn-default radius f-r" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
				<button class="submit btn btn-primary radius f-r" type="button" style="margin-right: 10px;">&nbsp;&nbsp;保存&nbsp;&nbsp;</button>
			</div>
		</div>
	</div>
</article>
<script type="text/javascript" src="/audit/Public/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/audit/Public/lib/layer/2.4/layer.js"></script> 
<script type="text/javascript" src="/audit/Public/static/h-ui/js/H-ui.js"></script> 
<script type="text/javascript" src="/audit/Public/static/h-ui.admin/js/H-ui.admin.page.js"></script>
<script type="text/javascript" src="/audit/Public/lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="/audit/Public/lib/laypage/1.2/laypage.js"></script>

<script type="text/javascript">
    var index = parent.layer.getFrameIndex(window.name); //获取当前窗体索引
    $('#quxiao').on('click', function(){
        parent.layer.close(index); //执行关闭
    });
    $(".submit").on('click',function(){
    	var item_name = $("input[name='item_name']").val();
    	var item_supervisor = $("input[name='item_supervisor']").val();
        var su_company = $("input[name='su_company']").val();
    	$.ajax({
            type: "POST",
            url: "/audit/index.php/Home/Index/item_add",
            data: "item_name=" + item_name + "&item_supervisor=" + item_supervisor + "&su_company=" + su_company,  
            success: function(data) {
            	var obj = eval('(' + data+ ')');
            	if(obj.result == '400'){
            		alert("分表名重复！");
            	}else if(obj.result == '200'){
                    window.parent.location.reload();
                    parent.layer.close(index);
            	}
            }
        });
    })
</script>
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>