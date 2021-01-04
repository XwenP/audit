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
            <dl>
                <dt><a href="/audit/index.php/Home/System/index" style="text-decoration:none;"><i class="Hui-iconfont">&#xe72d;&nbsp;</i> 分表项目管理</a></dt>
            </dl>
            <dl>
                <dt><a href="/audit/index.php/Home/System/checker" style="text-decoration:none;"><i class="Hui-iconfont">&#xe62d;&nbsp;</i> 审核员管理</a></dt>
            </dl>
            <dl>
                <dt><a href="/audit/index.php/Home/System/admin" style="text-decoration:none; color:#148cf1;"><i class="Hui-iconfont">&#xe62b;&nbsp;</i> 管理员账号管理</a></dt>
            </dl>
            <dl>
                <dt><a href="/audit/index.php/Home/System/typist" style="text-decoration:none;"><i class="Hui-iconfont">&#xe70c;&nbsp;</i> 打字员管理</a></dt>
            </dl>
        </div>
    </aside>
    <div class="dislpayArrow hidden-xs"><a class="pngfix" href="javascript:void(0);" onClick="displaynavbar(this)"></a></div>
    <section class="Hui-article-box">
        <nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 系统管理 <span class="c-gray en">&gt;</span> 管理员管理 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新"><i class="Hui-iconfont">&#xe68f;</i></a></nav>
        <div class="Hui-article">
            <article class="cl pd-20">
                <div class="cl pd-5 bg-1 bk-gray mt-10">
                    <span class="l">
                        <a href="javascript:;" onclick="list_add('添加管理员','/audit/index.php/Home/System/admin_add','','400','250')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe644;</i> 添加管理员</a>
                    </span>
                    <span class="r">共有数据：<strong><?php echo count($data);?></strong> 条</span>
                </div>
                <div class="mt-20">
                    <table class="table table-border table-bordered table-hover table-bg table-sort">
                        <thead>
                            <tr class="text-c">
                                <th width="80">管理员账号</th>
                                <th width="80">权限开始时间</th>
                                <th title="权限到时间自动解除" width="80">权限结束时间</th>
                                <th width="80">操作权限</th>
                                <th width="80">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(is_array($data)): foreach($data as $key=>$v): ?><tr class="text-c">
                                    <td><?php echo ($v["user_name"]); ?></td>
                                    <th><?php echo ($v["beg_time"]); ?></th>
                                    <th><?php echo ($v["end_time"]); ?></th>
                                    <?php if($v["state"] == 1): ?><td><span class="label label-defaunt label-success radius">是</span></td>
                                        <?php else: ?>
                                        <td><span class="label label-defaunt radius">否</span></td><?php endif; ?>
                                    <td class="td-manage">
                                        <a title="修改密码" href="javascript:;" onclick="list_add('修改密码','/audit/index.php/Home/System/password_change?id=<?php echo ($v["id"]); ?>','','400','200')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a>
                                        <a title="取消权限" href="javascript:;" onclick="change(this,<?php echo ($v["id"]); ?>);" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6dc;</i></a>
                                        <a title="删除" href="javascript:;" onclick="admin_del(<?php echo ($v["id"]); ?>)" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a>
                                    </td>
                                </tr><?php endforeach; endif; ?>
                        </tbody>
                    </table>
                </div>
            </article>
        </div>
    </section>
    <script type="text/javascript" src="/audit/Public/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/audit/Public/lib/layer/2.4/layer.js"></script> 
<script type="text/javascript" src="/audit/Public/static/h-ui/js/H-ui.js"></script> 
<script type="text/javascript" src="/audit/Public/static/h-ui.admin/js/H-ui.admin.page.js"></script>
<script type="text/javascript" src="/audit/Public/lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="/audit/Public/lib/laypage/1.2/laypage.js"></script>

    <script type="text/javascript">
    var index = parent.layer.getFrameIndex(window.name);
    /*项目-添加*/
    function program_add(title, url) {
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
    /*添加总表*/
    function list_add(title, url, id, w, h) {
        layer_show(title, url, w, h);
    }

    function change(obj, id) {
        var $arr = $(obj).parents("tr").find("td .label");
        if ($arr.hasClass("label-success")) {
            var text = "取消权限";
        } else {
            var text = "升级权限";
        }
        layer.confirm('确定要' + text + '吗？', function(index) {
            if ($arr.hasClass("label-success")) {
                $arr.toggleClass("label-success");
                $arr.text("否");
            } else {
                $arr.toggleClass("label-success");
                $arr.text("是");
            }
            $.ajax({
                type: 'POST',
                url: "/audit/index.php/Home/System/admin_state_update",
                data: "id=" + id,
                cache: false,
                success: function(data) {
                    var obj = eval('(' + data + ')');
                    if (obj.result == '400') {
                        layer.msg('修改失败!', { icon: 1, time: 1000 });
                    } else if (obj.result == '200') {
                        layer.msg('修改成功!', { icon: 0, time: 1000 });
                        window.parent.location.reload();
                        parent.layer.close(index);
                    }
                }
            });
        });
    }

    function admin_del(id) {
        layer.confirm('确定删除?', function(index) {
            $.ajax({
                type: 'POST',
                url: "/audit/index.php/Home/System/admin_del",
                data: "id=" + id,
                cache: false,
                success: function(data) {
                    var obj = eval('(' + data + ')');
                    if (obj.result == '400') {
                        layer.msg('删除失败!', { icon: 1, time: 1000 });
                    } else if (obj.result == '200') {
                        layer.msg('删除成功!', { icon: 0, time: 1000 });
                        window.parent.location.reload();
                        parent.layer.close(index);
                    }
                }
            });
        });
    }
    </script>
    <!--/请在上方写此页面业务相关的脚本-->
</body>

</html>