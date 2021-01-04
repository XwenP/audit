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
    <div id="year" year="<?php echo ($year); ?>" style="display: none"></div>
    <div class="page-container">
        <div class="form form-horizontal" id="form-article-add">
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"><strong>序号：</strong></label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" class="input-text" value="<?php echo ($num); ?>" placeholder="" id="" name="num">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"><strong>工程名称：</strong></label>
                <div class="formControls col-xs-6 col-sm-9">
                    <input type="text" class="input-text" value="" placeholder="" id="" name="item_name">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"><strong>送审日期：</strong></label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" class="input-text" value="" placeholder="" id="" name="vote_time">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"><strong>完成日期：</strong></label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" class="input-text" value="<?php echo ($time); ?>" placeholder="" id="" name="finish_time">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"><strong>文号：</strong></label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" class="input-text" value="东华审内工〔<?php echo ($year); ?>〕<?php echo ($num); ?>号" placeholder="" id="" name="symbol">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"><strong>建设单位：</strong></label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" class="input-text" value="" placeholder="" id="" name="build_unit">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"><strong>施工单位：</strong></label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" class="input-text" value="" placeholder="" id="" name="constroct_unit">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"><strong>原决算额：</strong></label>
                <div class="formControls col-xs-8 col-sm-4">
                    <input type="text" class="input-text" value="" placeholder="" id="" name="inital_money">
                </div>
                <label class="form-label col-xs-4 col-sm-1"><strong>审定金额：</strong></label>
                <div class="formControls col-xs-8 col-sm-3">
                    <input type="text" class="input-text" value="" placeholder="" id="" name="audit_money">
                </div>
                <div class="btn btn-success radius col-sm-1 calcu">计算审价费</div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"><strong>核减额：</strong></label>
                <div class="formControls col-xs-8 col-sm-4">
                    <input type="text" class="input-text" value="" placeholder="" id="" name="assess_money">
                </div>
                <label class="form-label col-xs-4 col-sm-1"><strong>核减率：</strong></label>
                <div class="formControls col-xs-8 col-sm-4">
                    <input type="text" class="input-text" value="" placeholder="" id="" name="rate">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"><strong>甲方审价费：</strong></label>
                <div class="formControls col-xs-8 col-sm-4">
                    <input type="text" class="input-text" value="" placeholder="" id="" name="trial_a">
                </div>
                <label class="form-label col-xs-4 col-sm-1"><strong>乙方审价费：</strong></label>
                <div class="formControls col-xs-8 col-sm-4">
                    <input type="text" class="input-text" value="" placeholder="" id="" name="trial_b">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"><strong>实际收用甲方：</strong></label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" class="input-text" value="" placeholder="" id="" name="trial_a_rel">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"><strong>审核员：</strong></label>
                <div class="formControls col-xs-8 col-sm-9">
                    <span class="select-box">
                        <select name="assessor" class="select" id="select_class">
                            <?php if(is_array($list)): foreach($list as $key=>$v): ?><option value="<?php echo ($v["abbreviation"]); ?>"><?php echo ($v["abbreviation"]); ?></option><?php endforeach; endif; ?>
                        </select>
                    </span>
                </div>
            </div>
            <div class="row cl">
                <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
                    <button class="btn btn-primary radius submit" type="button"><i class="Hui-iconfont">&#xe632;</i> 提交</button>
                    <button id="quxiao" class="btn btn-default radius" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
                </div>
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
    $('input:not([autocomplete]').attr('autocomplete', 'off'); 
    var index = parent.layer.getFrameIndex(window.name); //获取当前窗体索引
    $('#quxiao').on('click', function() {
        parent.layer.close(index); //执行关闭
    });
    $(".submit").on('click', function() {
        var year = $('#year').attr('year');
        var num = $("input[name='num']").val();
        var vote_time = $("input[name='vote_time']").val();
        var item_name = $("input[name='item_name']").val();
        var finish_time = $("input[name='finish_time']").val();
        var symbol = $("input[name='symbol']").val();
        var build_unit = $("input[name='build_unit']").val();
        var constroct_unit = $("input[name='constroct_unit']").val();
        var inital_money = $("input[name='inital_money']").val();
        var audit_money = $("input[name='audit_money']").val();
        var assess_money = $("input[name='assess_money']").val();
        var trial_a = $("input[name='trial_a']").val();
        var trial_b = $("input[name='trial_b']").val();
        var trial_a_rel = $("input[name='trial_a_rel']").val();
        var assessor = $("select[name='assessor']").val();
        var rate = $("input[name='rate']").val();
        $.ajax({
            type: "POST",
            url: "/audit/index.php/Home/Program/program_add_1",
            data: "year=" + year + "&num=" + num + "&vote_time=" + vote_time + "&item_name=" + item_name + "&finish_time=" + finish_time + "&symbol=" + symbol + "&build_unit=" + build_unit + "&constroct_unit=" + constroct_unit + "&inital_money=" + inital_money + "&audit_money=" + audit_money + "&assess_money=" + assess_money + "&trial_a=" + trial_a + "&trial_b=" + trial_b + "&trial_a_rel=" + trial_a_rel + "&assessor=" + assessor + "&rate=" + rate,
            cache: false, //不缓存此页面   
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
    $('.calcu').click(function(){
        var inital_money = $("input[name='inital_money']").val();
        var audit_money = $("input[name='audit_money']").val();
        $.ajax({
            type: "POST",
            url: "/audit/index.php/Home/Program/program_calculate",
            data: "inital_money=" + inital_money + "&audit_money=" + audit_money,
            cache: false, //不缓存此页面   
            success: function(data) {
                var obj = eval('(' + data+ ')');
                if(obj.data == '400'){
                    alert("计算出现未知错误，请重新再试");
                }else if(obj.data == '200'){
                    $("input[name='trial_a']").val(obj.trial_a);
                    $("input[name='trial_b']").val(obj.trial_b);
                    $("input[name='trial_a_rel']").val(obj.trial_a_rel);
                    $("input[name='assess_money']").val(obj.balance);
                    $("input[name='rate']").val(obj.nuclear_rate);
                }
            }
        });
    })
    </script>
</body>

</html>