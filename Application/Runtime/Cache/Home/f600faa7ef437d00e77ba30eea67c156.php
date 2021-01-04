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
                        <?php if(is_array($time_list)): foreach($time_list as $key=>$v): ?><li><a href="/audit/index.php/Home/Before/index?year=<?php echo ($v); ?>" title="<?php echo ($v); ?>年合同总表"><?php echo ($v); ?>年工程项目合同付款登记表</a></li><?php endforeach; endif; ?>
                    </ul>
                </dd>
            </dl>
            <dl>
                <dt><i class="Hui-iconfont">&#xe623;</i> 分表管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
                <dd style="display: block;">
                    <ul>
                        <?php if(is_array($item_list)): foreach($item_list as $key=>$v): if($v["item_id"] == $data3['item_id']): ?><li class="current"><a href="/audit/index.php/Home/Before/list_show?item_id=<?php echo ($v["item_id"]); ?>" title="<?php echo ($v["item_name"]); ?>"><?php echo ($v["item_name"]); ?></a></li>
                                <?php else: ?>
                                <li><a href="/audit/index.php/Home/Before/list_show?item_id=<?php echo ($v["item_id"]); ?>" title="<?php echo ($v["item_name"]); ?>"><?php echo ($v["item_name"]); ?></a></li><?php endif; endforeach; endif; ?>
                    </ul>
                </dd>
            </dl>
            <dl>
                <dt><i class="Hui-iconfont">&#xe70c;</i> 预付记录管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
                <dd>
                    <ul>
                        <?php if(is_array($time_list)): foreach($time_list as $key=>$v): if($v == $count_year): ?><li class="current"><a href="/audit/index.php/Home/Before/pay_show?year=<?php echo ($v); ?>" title="<?php echo ($v); ?>年付款记录表"><?php echo ($v); ?>年付款记录表</a></li>
                                <?php else: ?>
                                <li><a href="/audit/index.php/Home/Before/pay_show?year=<?php echo ($v); ?>" title="<?php echo ($v); ?>年付款记录表"><?php echo ($v); ?>年付款记录表</a></li><?php endif; endforeach; endif; ?>
                    </ul>
                </dd>
            </dl>
        </div>
    </aside>
    <div class="dislpayArrow hidden-xs"><a class="pngfix" href="javascript:void(0);" onClick="displaynavbar(this)"></a></div>
    <section class="Hui-article-box">
        <nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 分表 <span class="c-gray en">&gt;</span> <?php echo ($data3["item_name"]); ?> <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新"><i class="Hui-iconfont">&#xe68f;</i></a></nav>
        <div class="Hui-article">
            <article class="cl pd-20">
                <div class="cl pd-5 bg-1 bk-gray mt-10">
                    <span class="l">
                        <a href="/audit/index.php/Home/Before/item_out?item_id=<?php echo ($data3["item_id"]); ?>" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe644;</i> 导出分表</a>
                        <a href="javascript:;" item_id="<?php echo ($data3["item_id"]); ?>" class="btn_end btn btn-success radius"><i class="Hui-iconfont">&#xe615;</i> 还原项目</a>
                    </span>
                    <span class="r">共有数据：<strong><?php echo count($data1);?></strong> 条</span>
                </div>
                <div class="mt-20">
                    <table class="table table-border table-bordered table-hover1 table-bg table-sort">
                        <thead>
                            <tr>
                                <th colspan="14">
                                    <h5><strong>项目名称 ：<?php echo ($data3["item_name"]); ?></strong></h5>
                                    <h5><strong>投资监理 ：<?php echo ($data3["item_supervisor"]); ?></strong></h5>
                                    <h5><strong>投资监理单位 ：<?php echo ($data3["su_company"]); ?></strong></h5>
                                </th>
                            </tr>
                            <tr class="text-c">
                                <th width="50">序号</th>
                                <th width="100">项目名称</th>
                                <th width="100">承包单位</th>
                                <th width="60">合同性质</th>
                                <th width="80">合同金额</th>
                                <th width="80">审定金额</th>
                                <th width="210" colspan="3">付款情况</th>
                                <th width="">合同付款方式（备注）</th>
                                <th width="200" colspan="4">备注</th>
                            </tr>
                        </thead>
                        <?php if(is_array($data1)): foreach($data1 as $key=>$v): if($v["contract_nature"] == '招标代理' ): ?><tbody>
                                    <?php if(!empty($v['paylist'][0])): ?><tr>
                                            <td class="co_id" rowspan="<?php echo count($v['paylist'])*2+3;?>"><?php echo ($v["contract_id"]); ?></td>
                                            <td class="edit4" rowspan="<?php echo count($v['paylist'])*2+3;?>"><?php echo ($v["contract_name"]); ?></td>
                                            <td class="edit3" rowspan="<?php echo count($v['paylist'])*2+3;?>"><?php echo ($v["contract_unit"]); ?></td>
                                            <td class="edit2" rowspan="<?php echo count($v['paylist'])*2+3;?>"><?php echo ($v["contract_nature"]); ?></td>
                                            <td class="edit" rowspan="<?php echo count($v['paylist'])*2+3;?>"><?php echo ($v["contract_amount"]); ?></td>
                                            <td class="edit" rowspan="<?php echo count($v['paylist'])*2+3;?>"><?php echo ($v["contract_exact_amount"]); ?></td>
                                            <td width="70"><b>预付时间1</b></td>
                                            <td width="80"><b>预付金额1</b></td>
                                            <td width="60"><b>预付比例1</b></td>
                                            <td rowspan="<?php echo count($v['paylist'])*2+3;?>" class="remarks"><?php echo ($v["contract_remarks"]); ?></td>
                                            <td class="edit1" width="50"><b>总投资</b></td>
                                            <?php if(!empty($v["total_invest"])): ?><td class="edit1" width="50"><?php echo ($v["total_invest"]); ?></td>
                                                <?php else: ?>
                                                <td class="edit1" width="50">-</td><?php endif; ?>
                                            <td class="edit1" width="50"><b>建安费</b></td>
                                            <?php if(!empty($v["jian_fee"])): ?><td class="edit1" width="50"><?php echo ($v["jian_fee"]); ?></td>
                                                <?php else: ?>
                                                <td class="edit1" width="50">-</td><?php endif; ?>
                                        </tr>
                                        <?php else: ?>
                                        <tr>
                                            <td class="co_id" rowspan="5"><?php echo ($v["contract_id"]); ?></td>
                                            <td class="edit4" rowspan="5"><?php echo ($v["contract_name"]); ?></td>
                                            <td class="edit3" rowspan="5"><?php echo ($v["contract_unit"]); ?></td>
                                            <td class="edit2" rowspan="5"><?php echo ($v["contract_nature"]); ?></td>
                                            <td class="edit" rowspan="5"><?php echo ($v["contract_amount"]); ?></td>
                                            <td class="edit" rowspan="5"><?php echo ($v["contract_exact_amount"]); ?></td>
                                            <td width="70"><b>预付时间1</b></td>
                                            <td width="80"><b>预付金额1</b></td>
                                            <td width="60"><b>预付比例1</b></td>
                                            <td rowspan="5" class="remarks"><?php echo ($v["contract_remarks"]); ?></td>
                                            <td class="edit1" width="50"><b>总投资</b></td>
                                            <?php if(!empty($v["total_invest"])): ?><td class="edit1" width="50"><?php echo ($v["total_invest"]); ?></td>
                                                <?php else: ?>
                                                <td class="edit1" width="50">-</td><?php endif; ?>
                                            <td class="edit1" width="50"><b>建安费</b></td>
                                            <?php if(!empty($v["jian_fee"])): ?><td class="edit1" width="50"><?php echo ($v["jian_fee"]); ?></td>
                                                <?php else: ?>
                                                <td class="edit1" width="50">-</td><?php endif; ?>
                                        </tr><?php endif; ?>
                                    <tr>
                                        <?php if(!empty($v['paylist'][0])): ?><td class="edit"><?php echo ($v['paylist'][0]['pay_time']); ?></td>
                                            <td class="edit"><?php echo ($v['paylist'][0]['pay_amount']); ?></td>
                                            <td class="edit"><?php echo ($v['paylist'][0]['ratio']); ?></td>
                                            <?php else: ?>
                                            <td class="edit">-</td>
                                            <td class="edit">-</td>
                                            <td class="edit">-</td><?php endif; ?>
                                        <td class="edit1"><b>预算金额</b></td>
                                        <?php if(!empty($v["budget_amount"])): ?><td class="edit1"><?php echo ($v["budget_amount"]); ?></td>
                                            <?php else: ?>
                                            <td class="edit1">-</td><?php endif; ?>
                                        <td class="edit1"><b>控制价</b></td>
                                        <?php if(!empty($v["limit_price"])): ?><td class="edit1"><?php echo ($v["limit_price"]); ?></td>
                                            <?php else: ?>
                                            <td class="edit1">-</td><?php endif; ?>
                                    </tr>
                                    <?php if(is_array($v['paylist'])): $i = 0; $__LIST__ = array_slice($v['paylist'],1,null,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                                            <td><b>预付时间<?php echo ($key+1); ?></b></td>
                                            <td><b>预付金额<?php echo ($key+1); ?></b></td>
                                            <td><b>预付比例<?php echo ($key+1); ?></b></td>
                                            <?php if($key == 1): if(!empty($v['paylist'][0])): ?><td class="remarks_extra" rowspan=" <?php echo count($v['paylist'])*2+1;?>" colspan="4"> <?php echo ($v["contract_remarks_extra"]); ?></td>
                                                    <?php else: ?>
                                                    <td class="remarks_extra" rowspan="3" colspan="4"> <?php echo ($v["contract_remarks_extra"]); ?></td><?php endif; endif; ?>
                                        </tr>
                                        <tr>
                                            <?php if(!empty($vo)): ?><td class="edit"><?php echo ($vo["pay_time"]); ?></td>
                                                <td class="edit"><?php echo ($vo["pay_amount"]); ?></td>
                                                <td class="edit"><?php echo ($vo["ratio"]); ?></td>
                                                <?php else: ?>
                                                <td class="edit">-</td>
                                                <td class="edit">-</td>
                                                <td class="edit">-</td><?php endif; ?>
                                        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                                    <tr>
                                        <td><b>累计预付</b></td>
                                        <?php if(!empty($v["contract_add_money"])): ?><td class="edit" colspan="2"><?php echo ($v["contract_add_money"]); ?></td>
                                            <?php else: ?>
                                            <td class="edit" colspan="2">-</td><?php endif; ?>
                                        <?php if(empty($v['paylist'][1])): ?><td class="remarks_extra" rowspan="3" colspan="4"> <?php echo ($v["contract_remarks_extra"]); ?></td><?php endif; ?>
                                    </tr>
                                    <tr>
                                        <td><b>余额</b></td>
                                        <?php if(!empty($v["contract_balance"])): ?><td class="edit" colspan="2"><?php echo ($v["contract_balance"]); ?></td>
                                            <?php else: ?>
                                            <td class="edit" colspan="2">-</td><?php endif; ?>
                                    </tr>
                                    <tr>
                                        <td><b>余额占比</b></td>
                                        <?php if(!empty($v["contract_balance"])): ?><td class="edit" colspan="2"><?php echo ($v["ratio"]); ?></td>
                                            <?php else: ?>
                                            <td class="edit" colspan="2">-</td><?php endif; ?>
                                    </tr>
                                </tbody>
                                <?php else: ?>
                                <tbody>
                                    <?php if(!empty($v['paylist'][0])): ?><tr>
                                            <td class="co_id" rowspan="<?php echo count($v['paylist'])*2+3;?>"><?php echo ($v["contract_id"]); ?></td>
                                            <td class="edit4" rowspan="<?php echo count($v['paylist'])*2+3;?>"><?php echo ($v["contract_name"]); ?></td>
                                            <td class="edit3" rowspan="<?php echo count($v['paylist'])*2+3;?>"><?php echo ($v["contract_unit"]); ?></td>
                                            <td class="edit2" rowspan="<?php echo count($v['paylist'])*2+3;?>"><?php echo ($v["contract_nature"]); ?></td>
                                            <td class="edit" rowspan="<?php echo count($v['paylist'])*2+3;?>"><?php echo ($v["contract_amount"]); ?></td>
                                            <td class="edit" rowspan="<?php echo count($v['paylist'])*2+3;?>"><?php echo ($v["contract_exact_amount"]); ?></td>
                                            <td width="70"><b>预付时间1</b></td>
                                            <td width="80"><b>预付金额1</b></td>
                                            <td width="60"><b>预付比例1</b></td>
                                            <td rowspan="<?php echo count($v['paylist'])*2+3;?>" class="remarks"><?php echo ($v["contract_remarks"]); ?></td>
                                            <td class="remarks_extra" rowspan="<?php echo count($v['paylist'])*2+3;?>" colspan="4"><?php echo ($v["contract_remarks_extra"]); ?></td>
                                        </tr>
                                        <?php else: ?>
                                        <tr>
                                            <td class="co_id" rowspan="5"><?php echo ($v["contract_id"]); ?></td>
                                            <td class="edit4" rowspan="5"><?php echo ($v["contract_name"]); ?></td>
                                            <td class="edit3" rowspan="5"><?php echo ($v["contract_unit"]); ?></td>
                                            <td class="edit2" rowspan="5"><?php echo ($v["contract_nature"]); ?></td>
                                            <td class="edit" rowspan="5"><?php echo ($v["contract_amount"]); ?></td>
                                            <td class="edit" rowspan="5"><?php echo ($v["contract_exact_amount"]); ?></td>
                                            <td width="70"><b>预付时间1</b></td>
                                            <td width="80"><b>预付金额1</b></td>
                                            <td width="60"><b>预付比例1</b></td>
                                            <td rowspan="5" class="remarks"><?php echo ($v["contract_remarks"]); ?></td>
                                            <td class="remarks_extra" rowspan="5" colspan="4"><?php echo ($v["contract_remarks_extra"]); ?></td>
                                        </tr><?php endif; ?>
                                    <tr>
                                        <?php if(!empty($v['paylist'][0])): ?><td class="edit"><?php echo ($v['paylist'][0]['pay_time']); ?></td>
                                            <td class="edit"><?php echo ($v['paylist'][0]['pay_amount']); ?></td>
                                            <td class="edit"><?php echo ($v['paylist'][0]['ratio']); ?></td>
                                            <?php else: ?>
                                            <td class="edit">-</td>
                                            <td class="edit">-</td>
                                            <td class="edit">-</td><?php endif; ?>
                                    </tr>
                                    <?php if(is_array($v['paylist'])): $i = 0; $__LIST__ = array_slice($v['paylist'],1,null,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                                            <td><b>预付时间<?php echo ($key+1); ?></b></td>
                                            <td><b>预付金额<?php echo ($key+1); ?></b></td>
                                            <td><b>预付比例<?php echo ($key+1); ?></b></td>
                                        </tr>
                                        <tr>
                                            <?php if(!empty($vo)): ?><td class="edit"><?php echo ($vo["pay_time"]); ?></td>
                                                <td class="edit"><?php echo ($vo["pay_amount"]); ?></td>
                                                <td class="edit"><?php echo ($vo["ratio"]); ?></td>
                                                <?php else: ?>
                                                <td class="edit">-</td>
                                                <td class="edit">-</td>
                                                <td class="edit">-</td><?php endif; ?>
                                        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                                    <tr>
                                        <td><b>累计预付</b></td>
                                        <?php if(!empty($v["contract_add_money"])): ?><td class="edit" colspan="2"><?php echo ($v["contract_add_money"]); ?></td>
                                            <?php else: ?>
                                            <td class="edit" colspan="2">-</td><?php endif; ?>
                                    </tr>
                                    <tr>
                                        <td><b>余额</b></td>
                                        <?php if(!empty($v["contract_balance"])): ?><td class="edit" colspan="2"><?php echo ($v["contract_balance"]); ?></td>
                                            <?php else: ?>
                                            <td class="edit" colspan="2">-</td><?php endif; ?>
                                    </tr>
                                    <tr>
                                        <td><b>余额占比</b></td>
                                        <?php if(!empty($v["contract_balance"])): ?><td class="edit" colspan="2"><?php echo ($v["ratio"]); ?></td>
                                            <?php else: ?>
                                            <td class="edit" colspan="2">-</td><?php endif; ?>
                                    </tr>
                                </tbody><?php endif; endforeach; endif; ?>
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
    function note(){
        var res = $('.Hui-article').scrollTop();
        localStorage.setItem('toppx', res);
    }
    /*付款-编辑*/
    function list_edit(title, url, w, h) {
        note();
        layer_show(title, url, w, h);
    }
    $(".edit").click(function() {
        note();
        var contract_id = $(this).parent().parent().find('.co_id').text();
        var string = '/audit/index.php/Home/Before/list_edit' + '?contract_id=' + contract_id;
        list_edit('付款情况', string, '', '510');
    });
    $(".edit1").click(function() {
        note();
        var contract_id = $(this).parent().parent().find('.co_id').text();
        var string = '/audit/index.php/Home/Before/extra_edit' + '?contract_id=' + contract_id;
        list_edit('招标费用情况', string, '', '420');
    });
    $(".edit2").click(function() {
        note();
        var contract_id = $(this).parent().parent().find('.co_id').text();
        var string = '/audit/index.php/Home/Before/nature_edit' + '?contract_id=' + contract_id;
        list_edit('合同性质', string, '400', '200');
    });
    $(".edit3").click(function() {
        note();
        var contract_id = $(this).parent().parent().find('.co_id').text();
        var string = '/audit/index.php/Home/Before/unit_edit' + '?contract_id=' + contract_id;
        list_edit('承包单位', string, '400', '200');
    });
    $(".edit4").click(function() {
        note();
        var contract_id = $(this).parent().parent().find('.co_id').text();
        var string = '/audit/index.php/Home/Before/name_edit' + '?contract_id=' + contract_id;
        list_edit('项目名称', string, '600', '200');
    });
    $(".remarks").click(function() {
        note();
        var contract_id = $(this).parent().find('.co_id').text();
        var string = '/audit/index.php/Home/Before/list_editremark' + '?contract_id=' + contract_id;
        list_edit('备注', string, '', '300');
    });
    $(".remarks_extra").click(function() {
        note();
        var contract_id = $(this).parent().parent().find('.co_id').text();
        var string = '/audit/index.php/Home/Before/list_editextra' + '?contract_id=' + contract_id;
        list_edit('额外备注', string, '', '300');
    });
    $(".btn_end").click(function() {
        var item_id = $(this).attr('item_id');
        $.ajax({
            type: "POST",
            url: "/audit/index.php/Home/Before/list_end",
            data: "item_id=" + item_id,
            success: function(data) {
                var obj = eval('(' + data + ')');
                if (obj.result == '400') {
                    alert("结束失败！");
                } else if (obj.result == '200') {
                    alert("项目还原！");
                    window.location.reload();
                }
            }
        });
    });
    /*添加总表*/
    function list_add(title, url, id, w, h) {
        layer_show(title, url, w, h);
    }
    </script>
    <!--/请在上方写此页面业务相关的脚本-->
</body>

</html>