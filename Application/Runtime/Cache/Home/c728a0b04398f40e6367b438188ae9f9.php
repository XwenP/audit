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
    <div class="page-container">
        <div class="form form-horizontal" id="form-article-add">
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"><strong>序号：</strong></label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" class="input-text" value="<?php echo ($data2); ?>" placeholder="" id="" name="contract_id">
                </div>
            </div>
        <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"><strong>所属年份：</strong></label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" class="input-text" value="<?php echo ($data3); ?>" placeholder="" id="" name="contract_id">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"><strong>合同名称：</strong></label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" class="input-text" value="" placeholder="" id="" name="contract_name">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"><strong>承包单位：</strong></label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" class="input-text" value="" placeholder="" id="" name="contract_unit">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"><strong>项目名称：</strong></label>
                <div class="formControls col-xs-8 col-sm-9">
                    <span class="select-box">
                        <select id="select_class1" name="item_id" class="select">
                            <?php if(is_array($data1)): foreach($data1 as $key=>$v): ?><option value="<?php echo ($v["item_id"]); ?>" item_supervisor="<?php echo ($v["item_supervisor"]); ?>"><?php echo ($v["item_name"]); ?></option><?php endforeach; endif; ?>
                        </select>
                    </span>
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"><strong>投资监理：</strong></label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" class="input-text" value="<?php echo ($data1[0]["item_supervisor"]); ?>" placeholder="" id="" name="item_supervisor">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"><strong>合同性质：</strong></label>
                <div class="formControls col-xs-8 col-sm-9">
                    <span class="select-box">
                        <select name="contract_nature" class="select" id="select_class">
                            <option value="施工类">施工类</option>
                            <option value="投资监理">投资监理</option>
                            <option value="招标代理">招标代理</option>
                            <option value="其他服务类">其他服务类</option>
                            <option value="其他">其他</option>
                        </select>
                    </span>
                </div>
            </div>
            <div class="extra" style="display: none" ison="0">
                <div class="row cl">
                    <label class="form-label col-xs-4 col-sm-2"><strong class="c-red">总投资金额：</strong></label>
                    <div class="formControls col-xs-8 col-sm-9">
                        <input type="text" class="input-text" value="" placeholder="" id="" name="total_invest">
                    </div>
                </div>
                <div class="row cl">
                    <label class="form-label col-xs-4 col-sm-2"><strong class="c-red">建安费：</strong></label>
                    <div class="formControls col-xs-8 col-sm-9">
                        <input type="text" class="input-text" value="" placeholder="" id="" name="jian_fee">
                    </div>
                </div>
                <div class="row cl">
                    <label class="form-label col-xs-4 col-sm-2"><strong class="c-red">预算金额：</strong></label>
                    <div class="formControls col-xs-8 col-sm-9">
                        <input type="text" class="input-text" value="" placeholder="" id="" name="budget_amount">
                    </div>
                </div>
                <div class="row cl">
                    <label class="form-label col-xs-4 col-sm-2"><strong class="c-red">控制价：</strong></label>
                    <div class="formControls col-xs-8 col-sm-9">
                        <input type="text" class="input-text" value="" placeholder="" id="" name="limit_price">
                    </div>
                </div>
                <div class="row cl">
                    <label class="form-label col-xs-4 col-sm-2"><strong class="c-red">招标项目类别：</strong></label>
                    <div class="formControls col-xs-8 col-sm-9">
                        <input type="text" class="input-text" value="" placeholder="" id="" name="item_type">
                    </div>
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"><strong>合同金额：</strong></label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" class="input-text" value="" placeholder="" id="" name="contract_amount">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"><strong>合同流转日期：</strong></label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" class="input-text" value="" placeholder="" id="" name="contract_date">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"><strong>合同付款方式：</strong></label>
                <div class="formControls col-xs-8 col-sm-9">
                    <textarea name="contract_remarks" cols="" rows="" class="remarks1 textarea" placeholder="备注" datatype="*10-100" dragonfly="true" nullmsg="备注不能为空！" onKeyUp="textarealength(this,500)"></textarea>
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"><strong>额外备注：</strong></label>
                <div class="formControls col-xs-8 col-sm-9">
                    <textarea name="contract_remarks_extra" cols="" rows="" class="remarks2 textarea"  placeholder="备注" datatype="*10-100" dragonfly="true" nullmsg="备注不能为空！" onKeyUp="textarealength(this,500)"></textarea>
                </div>
            </div>
            <div class="row cl">
                <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
                    <div class="btn btn-primary radius submit"><i class="Hui-iconfont">&#xe632;</i> 提交</div>
                    <button id="quxiao" class="btn btn-default radius" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="/audit/Public/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/audit/Public/lib/layer/2.4/layer.js"></script> 
<script type="text/javascript" src="/audit/Public/static/h-ui/js/H-ui.js"></script> 
<script type="text/javascript" src="/audit/Public/static/h-ui.admin/js/H-ui.admin.page.js"></script>
<script type="text/javascript" src="/audit/Public/lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="/audit/Public/lib/laypage/1.2/laypage.js"></script>

    <script type="text/javascript">
    var index = parent.layer.getFrameIndex(window.name); //获取当前窗体索引
    $('#quxiao').on('click', function() {
        parent.layer.close(index); //执行关闭
    });
    $("#select_class").change(function() {
        var checkValue = $("#select_class").val();
        if (checkValue == '招标代理') {
            $(".extra").css("display", "block");
            $(".extra").attr("ison", '1');
        } else {
            $(".extra").css("display", "none");
            $(".extra").attr("ison", '0');
        }
    });
    $("#select_class1").change(function() {
    	var checkValue = $('#select_class1 option:selected').attr('item_supervisor');
    	$("input[name='item_supervisor']").attr('value',checkValue);
    });
    $(".submit").on('click', function() {
        var id = $("#id111").text();
        var item_id = $("select[name='item_id']").val();
        var item_supervisor = $("input[name='item_supervisor']").val();
        var contract_id = $("input[name='contract_id']").val();
        var contract_name = $("input[name='contract_name']").val();
        var contract_unit = $("input[name='contract_unit']").val();
        var contract_nature = $("select[name='contract_nature']").val();
        var contract_amount = $("input[name='contract_amount']").val();
        var contract_date = $("input[name='contract_date']").val();
        var contract_remarks = $(".remarks1").val();
        var contract_remarks_extra = $(".remarks2").val();
        if ($(".extra").attr('ison') == 1) {
            var total_invest = $("input[name='total_invest']").val();
            var jian_fee = $("input[name='jian_fee']").val();
            var budget_amount = $("input[name='budget_amount']").val();
            var limit_price = $("input[name='limit_price']").val();
            var item_type = $("input[name='item_type']").val();
        }
        $.ajax({
            type: "POST",
            url: "/audit/index.php/Home/Index/contract_add",
            data: "id=" + id + "&item_id=" + item_id + "&item_supervisor=" + item_supervisor + "&contract_id=" + contract_id + "&contract_name=" + contract_name + "&contract_unit=" + contract_unit + "&contract_nature=" + contract_nature + "&contract_amount=" + contract_amount + "&item_type=" + item_type + "&contract_date=" + contract_date + "&contract_remarks=" + contract_remarks + "&contract_remarks_extra=" + contract_remarks_extra + "&total_invest=" + total_invest + "&jian_fee=" + jian_fee + "&budget_amount=" + budget_amount + "&limit_price=" + limit_price,   
            success: function(data) {
                var obj = eval('(' + data+ ')');
                if(obj.result == '400'){
                    alert("保存出错！");
                }else if(obj.result == '200'){
                    localStorage.setItem('flag', 1);
                    window.parent.location.reload();
                    parent.layer.close(index);
                }
            }
        });
    });
    </script>
</body>

</html>