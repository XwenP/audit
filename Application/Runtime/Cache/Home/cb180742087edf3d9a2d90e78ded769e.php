<?php if (!defined('THINK_PATH')) exit();?>﻿<!--_meta 作为公共模版分离出去-->
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
    <!--_header 作为公共模版分离出去-->
<header class="navbar-wrapper">
    <div class="navbar navbar-fixed-top">
        <div class="container-fluid cl"> <a class="logo navbar-logo f-l mr-10 hidden-xs">审计处后台管理系统</a> <a class="logo navbar-logo-m f-l mr-10 visible-xs">H-ui</a>
            <span class="logo navbar-slogan f-l mr-10 hidden-xs"></span>
            <a aria-hidden="false" class="nav-toggle Hui-iconfont visible-xs" href="javascript:;">&#xe667;</a>
            <nav class="nav navbar-nav">
                <ul class="cl">
                    <li class="dropDown dropDown_hover"><a href="javascript:;" class="dropDown_A"><i class="Hui-iconfont">&#xe600;</i> 新增 <i class="Hui-iconfont">&#xe6d5;</i></a>
                        <ul class="dropDown-menu menu radius box-shadow">
                            <li><a href="javascript:;" onclick="list_add('添加分表','/audit/index.php/Home/Index/list_add','','400','280')"><i class="Hui-iconfont">&#xe623;</i> 项目分表</a></li>
                            <li><a href="javascript:;" onclick="list_add('添加审核员','/audit/index.php/Home/System/checker_add','','400','250')"><i class="Hui-iconfont">&#xe62d;</i> 审核员</a></li>
                            <li><a href="javascript:;" onclick="list_add('添加管理员','/audit/index.php/Home/System/admin_add','','400','250')"><i class="Hui-iconfont">&#xe62b;</i> 临时管理员</a></li>
                        </ul>
                    </li>
                    <li class="dropDown dropDown_hover"><a href="/audit/index.php/Home/Index/index" class="dropDown_A"><i class="Hui-iconfont">&#xe636;</i> 台账登记 </a>
                    </li>
                    <li class="dropDown dropDown_hover"><a href="/audit/index.php/Home/Program/index" class="dropDown_A"><i class="Hui-iconfont">&#xe637;</i> 工程审核 </a>
                    </li>
                    <?php if($state == 1): ?><li class="dropDown dropDown_hover"><a href="/audit/index.php/Home/Before/index" class="dropDown_A"><i class="Hui-iconfont">&#xe6c6;</i> 往年合同 </a>
                        </li>
                        <li class="dropDown dropDown_hover"><a href="/audit/index.php/Home/System/index" class="dropDown_A"><i class="Hui-iconfont">&#xe611;</i> 系统管理 </a>
                        </li><?php endif; ?>
                </ul>
            </nav>
            <nav id="Hui-userbar" class="nav navbar-nav navbar-userbar hidden-xs">
                <ul class="cl">
                    <?php if($state == 1): ?><li>超级管理员</li>
                        <?php else: ?>
                        <li>临时管理员</li><?php endif; ?>
                    <li class="dropDown dropDown_hover"> <a href="#" class="dropDown_A"><?php echo session('admin_name');?> <i class="Hui-iconfont">&#xe6d5;</i></a>
                        <ul class="dropDown-menu menu radius box-shadow">
                            <!--                             <li><a href="javascript:;" onClick="myselfinfo()">个人信息</a></li>
                            <li><a href="#">切换账户</a></li> -->
                            <li><a href="/audit/index.php/Home/Index/pp">退出</a></li>
                        </ul>
                    </li>
                    <!-- <li id="Hui-msg"> <a href="#" title="消息"><i class="Hui-iconfont" style="font-size:18px">&#xe68a;</i></a> </li> -->
                    <li id="Hui-skin" class="dropDown right dropDown_hover"> <a href="javascript:;" class="dropDown_A" title="换肤"><i class="Hui-iconfont" style="font-size:18px">&#xe62a;</i></a>
                        <ul class="dropDown-menu menu radius box-shadow">
                            <li><a href="javascript:;" data-val="default" title="默认（黑色）">默认（黑色）</a></li>
                            <li><a href="javascript:;" data-val="blue" title="蓝色">蓝色</a></li>
                            <li><a href="javascript:;" data-val="green" title="绿色">绿色</a></li>
                            <li><a href="javascript:;" data-val="red" title="红色">红色</a></li>
                            <li><a href="javascript:;" data-val="yellow" title="黄色">黄色</a></li>
                            <li><a href="javascript:;" data-val="orange" title="橙色">橙色</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</header>
<!--/_header 作为公共模版分离出去-->
    <!--_menu 作为公共模版分离出去-->
    <aside class="Hui-aside">
        <div class="menu_dropdown bk_2">
            <?php if($state == 0): ?><dl>
                    <a href="/audit/index.php/Home/program/index?year=<?php echo ($time_list[0]); ?>" style="text-decoration:none; color:#148cf1;"><dt><?php echo ($time_list[0]); ?>年工程项目审核情况表</dt></a>
                </dl>
                <?php else: ?>
                <?php if(is_array($time_list)): foreach($time_list as $key=>$v): if($v == $count_year): ?><dl>
                            <a href="/audit/index.php/Home/program/index?year=<?php echo ($v); ?>" style="text-decoration:none; color:#148cf1;"><dt><?php echo ($v); ?>年工程项目审核情况表</dt></a>
                        </dl>
                        <?php else: ?>
                        <dl>
                            <a href="/audit/index.php/Home/program/index?year=<?php echo ($v); ?>" style="text-decoration:none;"><dt><?php echo ($v); ?>年工程项目审核情况表</dt></a>
                        </dl><?php endif; endforeach; endif; endif; ?>
        </div>
    </aside>
    <div class="dislpayArrow hidden-xs"><a class="pngfix" href="javascript:void(0);" onClick="displaynavbar(this)"></a></div>
    <section class="Hui-article-box">
        <nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 工程审核 <span class="c-gray en">&gt;</span> <?php echo ($count_year); ?>年工程项目审核情况表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新"><i class="Hui-iconfont">&#xe68f;</i></a></nav>
        <div class="Hui-article">
            <article class="cl pd-20">
                <div class="cl pd-5 bg-1 bk-gray mt-10">
                    <span class="l">
                        <a title="添加工程项目" href="javascript:;" onclick="program_add('添加项目','/audit/index.php/Home/program/program_add?year=<?php echo ($count_year); ?>')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe604;</i> 添加项目</a>
                        <a title="导出当前表格" href="/audit/index.php/Home/Program/audit_out_1?year=<?php echo ($count_year); ?>" class="btn btn-secondary radius"><i class="Hui-iconfont">&#xe644;</i> 导出当前表格</a>
                        <a title="批量导出报告" href="javascript:;" onclick="outlist1()" class="btn_end btn btn-secondary radius"><i class="Hui-iconfont">&#xe615;</i> 批量导出报告</a>
                        <a title="导出签到簿" href="javascript:;" onclick="outlist()" class="btn_end btn btn-success radius"><i class="Hui-iconfont">&#xe60c;</i> 导出签到簿</a>
                    </span>
                    <span class="r">共有数据：<strong><?php echo count($list);?></strong> 条</span>
                </div>
                <div class="mt-20">
                    <table class="table table-border table-bordered table-hover table-bg table-sort">
                        <thead>
                            <tr class="text-c">
                                <th width="25"><input type="checkbox" name="" value=""></th>
                                <th width="50">序号</th>
                                <th width="120">工程名称</th>
                                <th width="70">送审日期</th>
                                <th width="70">完成日期</th>
                                <th width="80">文号</th>
                                <th width="80">建设单位</th>
                                <th width="80">施工单位</th>
                                <th width="80">原决算额</th>
                                <th width="80">审定金额</th>
                                <th width="80">核减额</th>
                                <th width="80">核减率</th>
                                <th width="80">甲方审价费</th>
                                <th width="80">乙方审价费</th>
                                <th width="100">实际收用甲方</th>
                                <th width="70">审核员</th>
                                <th width="50">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(is_array($list)): foreach($list as $key=>$v): ?><tr class="text-c">
                                    <td><input type="checkbox" value="<?php echo ($v["num"]); ?>" itid="<?php echo ($v["id"]); ?>" name="audit_id"></td>
                                    <td><?php echo ($v["num"]); ?></td>
                                    <td><?php echo ($v["item_name"]); ?></td>
                                    <td><?php echo ($v["vote_time"]); ?></td>
                                    <td><?php echo ($v["finish_time"]); ?></td>
                                    <td><?php echo ($v["symbol"]); ?></td>
                                    <td><?php echo ($v["build_unit"]); ?></td>
                                    <td><?php echo ($v["constroct_unit"]); ?></td>
                                    <td><?php echo (number_format($v["inital_money"],2)); ?></td>
                                    <td><?php echo (number_format($v["audit_money"],2)); ?></td>
                                    <td><?php echo (number_format($v["assess_money"],2)); ?></td>
                                    <td><?php echo ($v["rate"]); ?></td>
                                    <td><?php if(!empty($v["trial_a"])): echo (number_format($v["trial_a"],2)); endif; ?></td>
                                    <td><?php echo (number_format($v["trial_b"],2)); ?></td>
                                    <td><?php if(!empty($v["trial_a_rel"])): echo (number_format($v["trial_a_rel"],2)); endif; ?></td>
                                    <td><?php echo ($v["assessor"]); ?></td>
                                    <td class="td-manage">
                                        <a title="编辑" href="javascript:;" onclick="program_add('修改项目','/audit/index.php/Home/program/program_edit?id=<?php echo ($v["id"]); ?>')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a>
                                        <a title="导出报告" href="/audit/index.php/Home/program/audit_out_3?idstr=<?php echo ($v["id"]); ?>" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe644;</i></a>
                                    </td>
                                </tr><?php endforeach; endif; ?>
                        </tbody>
                    </table>
                </div>
            </article>
        </div>
    </section>
    <div id="abc"></div>
    <div id="modal-demo" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content radius">
                <div class="modal-header">
                    <h3 class="modal-title">生成报告</h3>
                    <a class="close" data-dismiss="modal" aria-hidden="true" href="javascript:void();">×</a>
                </div>
                <div class="modal-body">
                    <p id="modal_content">确认要生成序号为 的报告吗？</p>
                    <div class="row cl mt-20">
                        <label class="form-label col-sm-1" style="padding-right: 0px; margin-top: 3px;"><strong>抄送:</strong></label>
                        <div class="formControls col-sm-5">
                            <span class="select-box radius">
                                <select name="抄送" class="select">
                                    <option value="财务处">财务处</option>
                                    <option value="基建部">基建部</option>
                                </select>
                            </span>
                        </div>
                        <label class="form-label col-sm-1 mt-3" style="padding-right: 0px; margin-top: 3px;"><strong>打字:</strong></label>
                        <div class="formControls col-sm-5">
                            <span class="select-box radius">
                                <select name="contract_nature" class="select">
                                    <option value="李晓">李晓</option>
                                    <option value="其他">其他</option>
                                </select>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="/audit/index.php/Home/program" class="btn btn-primary radius">确定</a>
                    <button class="btn radius" data-dismiss="modal" aria-hidden="true">关闭</button>
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
    window.onload = function() //用window的onload事件，窗体加载完毕的时候
    {
        if (localStorage.getItem("flag") == 0) {
            var toppx = localStorage.getItem('toppx');
            $(".Hui-article").scrollTop(toppx);
            localStorage.removeItem('flag');
        } else if (localStorage.getItem("flag") == 1) {
            var toppx = $('.Hui-article')[0].scrollHeight;
            $(".Hui-article").scrollTop(toppx);
            localStorage.removeItem('flag');
        }
    }
    /*记录滚动条*/
    function note() {
        var res = $('.Hui-article').scrollTop();
        localStorage.setItem('toppx', res);
    }
    $(function() {
        $('.table-sort').dataTable({
            "ordering": false,
            "aaSorting": [
                [1, "asc"]
            ], //默认第几个排序
            "bStateSave": true, //状态保存
            "aoColumnDefs": [
                // {"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
                { "orderable": false, "aTargets": [0, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16] } // 制定列不参与排序
            ]
        });
        $('.table-sort tbody').on('click', 'tr', function() {
            if ($(this).hasClass('selected')) {
                $(this).removeClass('selected');
            } else {
                table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        });
    });

    function outlist1() {
        var chk_value = [];
        var chk_value1 = [];
        $('input[name="audit_id"]:checked').each(function() {
            chk_value.push($(this).val());
            chk_value1.push($(this).attr('itid'));
        });
        if (chk_value.length > 0) {
            layer.confirm('确认要生成序号为 ' + chk_value + ' 的报告吗？', function(index) {
                var string = "/audit/index.php/Home/program/audit_out_3?idstr=" + chk_value1;
                window.location.href = string;
                layer.msg('生成成功!', { icon: 1, time: 1000 });
            });
        } else {
            layer.msg('未选择需要生成的报告', { icon: 2, time: 1000 });
        }
    }
    /*项目-添加*/
    function program_add(title, url) {
        note();
        var index = layer.open({
            type: 2,
            title: title,
            content: url
        });
        layer.full(index);
    }
    /*付款-编辑*/
    function list_edit(title, url, w, h) {
        layer_show(title, url, w, h);
    }
    $(".edit").click(function() {
        var contract_id = $(this).parent().parent().find('.co_id').text();
        var string = '/audit/index.php/Home/Index/list_edit' + '?contract_id=' + contract_id;
        list_edit('付款情况', string, '', '510');
    });
    /*添加总表*/
    function list_add(title, url, id, w, h) {
        layer_show(title, url, w, h);
    }
    //批量删除
    function outlist() {
        var chk_value = [];
        var chk_value1 = [];
        $('input[name="audit_id"]:checked').each(function() {
            chk_value.push($(this).val());
            chk_value1.push($(this).attr('itid'));
        });
        if (chk_value.length > 0) {
            layer.confirm('确认要生成序号为 ' + chk_value + ' 的签到簿吗？', function(index) {
                var string = "/audit/index.php/Home/program/audit_out_2?idstr=" + chk_value1;
                window.location.href = string;
                layer.msg('生成成功!', { icon: 1, time: 1000 });
            });
        } else {
            layer.msg('未选择需要生成的报告', { icon: 2, time: 1000 });
        }
    }
    </script>
    <!--/请在上方写此页面业务相关的脚本-->
</body>

</html>