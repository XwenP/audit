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
                <dt><i class="Hui-iconfont">&#xe636;</i> 总表管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
                <dd>
                    <ul>
                        <?php if(is_array($time_list)): foreach($time_list as $key=>$v): if($v == $count_year): ?><li class="current"><a href="/audit/index.php/Home/Index/index?year=<?php echo ($v); ?>" title="<?php echo ($v); ?>年合同总表"><?php echo ($v); ?>年工程项目合同付款登记表</a></li>
                                <?php else: ?>
                                <li><a href="/audit/index.php/Home/Index/index?year=<?php echo ($v); ?>" title="<?php echo ($v); ?>年合同总表"><?php echo ($v); ?>年工程项目合同付款登记表</a></li><?php endif; endforeach; endif; ?>
                    </ul>
                </dd>
            </dl>
            <dl>
                <dt><i class="Hui-iconfont">&#xe623;</i> 分表管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
                <dd>
                    <ul>
                        <?php if(is_array($item_list)): foreach($item_list as $key=>$v): ?><li><a href="/audit/index.php/Home/Index/list_show?item_id=<?php echo ($v["item_id"]); ?>" title="<?php echo ($v["item_name"]); ?>"><?php echo ($v["item_name"]); ?></a></li><?php endforeach; endif; ?>
                    </ul>
                </dd>
            </dl>
            <dl>
                <dt><i class="Hui-iconfont">&#xe70c;</i> 预付记录管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
                <dd style="display: block;">
                    <ul>
                        <?php if(is_array($time_list)): foreach($time_list as $key=>$v): if($v == $count_year): ?><li class="current"><a href="/audit/index.php/Home/Index/pay_show?year=<?php echo ($v); ?>" title="<?php echo ($v); ?>年付款记录表"><?php echo ($v); ?>年付款记录表</a></li>
                                <?php else: ?>
                                <li><a href="/audit/index.php/Home/Index/pay_show?year=<?php echo ($v); ?>" title="<?php echo ($v); ?>年付款记录表"><?php echo ($v); ?>年付款记录表</a></li><?php endif; endforeach; endif; ?>
                    </ul>
                </dd>
            </dl>
        </div>
    </aside>
    <div class="dislpayArrow hidden-xs"><a class="pngfix" href="javascript:void(0);" onClick="displaynavbar(this)"></a></div>
    <section class="Hui-article-box">
        <nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> <?php echo ($count_year); ?>年付款信息记录表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新"><i class="Hui-iconfont">&#xe68f;</i></a></nav>
        <div class="Hui-article">
            <article class="cl pd-20">
                <div class="cl pd-5 bg-1 bk-gray mt-10">
                    <span class="l">
                        <a href="/audit/index.php/Home/Index/audit_out_4?year=<?php echo ($count_year); ?>" class="btn btn-success radius"><i class="Hui-iconfont">&#xe644;</i> 导出表格</a>
                    </span>
                    <span class="r">共有数据：<strong><?php echo ($count_num); ?></strong> 条</span>
                </div>
                <div class="mt-20">
                    <table class="table table-border table-bordered table-hover table-bg table-sort">
                        <thead>
                            <tr class="text-c">
                                <th width="60">序号</th>
                                <th width="80">付款日期</th>
                                <th width="80">合同编号</th>
                                <th width="100">项目名称</th>
                                <th width="100">承包单位</th>
                                <th width="60">投资监理</th>
                                <th width="80">合同金额</th>
                                <th width="80">付款金额</th>
                                <th width="80">累计预付款</th>
                                <th width="80">余额</th>
                            </tr>
                        </thead>
                        <?php if(!empty($contract)): ?><tbody>
                                <?php if(is_array($contract)): foreach($contract as $key=>$v): ?><tr>
                                        <td class="text-c"><?php echo ($key+1); ?></td>
                                        <td><?php echo ($v["pay_time"]); ?></td>
                                        <td><?php echo ($v["contract_id"]); ?></td>
                                        <td><?php echo ($v["contract_name"]); ?></td>
                                        <td><?php echo ($v["contract_unit"]); ?></td>
                                        <td><?php echo ($v["item_supervisor"]); ?></td>
                                        <td class="text-c"><?php echo ($v["contract_amount"]); ?></td>
                                        <td><?php echo ($v["pay_amount"]); ?></td>
                                        <td class="text-c"><?php echo ($v["contract_add_money"]); ?></td>
                                        <td class="text-c"><?php echo ($v["contract_balance"]); ?></td>
                                    </tr><?php endforeach; endif; ?>
                            </tbody><?php endif; ?>
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
    /*合同-添加*/
    function context_add(title, url) {
        var index = layer.open({
            type: 2,
            title: title,
            content: url
        });
        layer.full(index);
    }
    /*合同-添加*/
    function context_edit(title, url) {
        var index = layer.open({
            type: 2,
            title: title,
            content: url
        });
        layer.full(index);
    }
    /*添加总表*/
    function list_add(title, url, id, w, h) {
        layer_show(title, url, w, h);
    }
    </script>
    <!--/请在上方写此页面业务相关的脚本-->
</body>

</html>