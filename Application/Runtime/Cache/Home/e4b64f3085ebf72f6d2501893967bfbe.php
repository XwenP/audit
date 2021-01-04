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
        <div class="form form-horizontal" id="pay">
            <table class="table table-border table-bordered table-hover table-bg">
                <div class="cooid" contract_id="<?php echo ($data["contract_id"]); ?>" style="display: none;"></div>
                <thead>
                    <th width="">额外备注</th>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <textarea name="contract_remarks_extra" cols="" rows="" class="remarks2 textarea" placeholder="备注" datatype="*10-100" dragonfly="true" nullmsg="备注不能为空！" onKeyUp="textarealength(this,500)"><?php echo ($data["contract_remarks_extra"]); ?></textarea>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="row cl">
                <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
                    <span class="btn btn-danger radius f-r quxiao" style="width: 100px; margin-left: 20px;">取消</span>
                    <span class="btn btn-success radius f-r baochun" style="width: 100px;">&nbsp;&nbsp;提交&nbsp;&nbsp;</span>
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
   	$('input:not([autocomplete]').attr('autocomplete', 'off'); 
    $(".quxiao").click(function() {
        var index = parent.layer.getFrameIndex(window.name);
        parent.layer.close(index);
    })
    $(".baochun").click(function() {
        var contract_id = $(".cooid").attr("contract_id");
        var contract_remarks_extra = $(".remarks2").val();
    	$.ajax({
            type: "POST",
            url: "/audit/index.php/Home/Before/list_edit3",
            data: "contract_id=" + contract_id + "&contract_remarks_extra=" + contract_remarks_extra,  
            success: function(data) {
                var obj = eval('(' + data+ ')');
                if(obj.result == '400'){
                    alert("保存出错！");
                }else if(obj.result == '200'){
                    localStorage.setItem('flag', 0);
                    window.parent.location.reload();
                    var index = parent.layer.getFrameIndex(window.name);
                    parent.layer.close(index);
                }
            }
        });
    })
    
    // //传item_id 打印该分表
    // //
    // //传item_id 到控制器list_end 结束该项项目
    // $.ajax({
    //         type: "POST",
    //         url: "/audit/index.php/Home/Before/list_end", //list_edit3将传进去的contract_remarks 保存
    //         data: "item_id=" + item_id, 
    //         success: function(data) {

    //         }
    // });
    // //传contract_id 到控制器list_edit2 取contract_remarks 存到data里面 显示
    // $.ajax({
    //         type: "POST",
    //         url: "/audit/index.php/Home/Before/list_edit3", //list_edit3将传进去的contract_remarks 保存
    //         data: "contract_id=" + contract_id + "&contract_remarks=" + contract_remarks, 
    //         success: function(data) {

    //         }
    // });
    // //传contract_id 到控制器list_edit4 取contract_remarks_extra 存到data里面 显示
    // $.ajax({
    //         type: "POST",
    //         url: "/audit/index.php/Home/Before/list_edit5", //list_edit4将传进去的contract_remarks_extra 保存
    //         data: "contract_id=" + contract_id + "&contract_remarks_extra=" + contract_remarks_extra,  
    //         success: function(data) {

    //         }
    //     });
    </script>
    <!--/请在上方写此页面业务相关的脚本-->
</body>

</html>