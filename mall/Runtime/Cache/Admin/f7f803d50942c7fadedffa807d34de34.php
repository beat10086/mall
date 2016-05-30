<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <title>电商后台</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <link rel="shortcut icon" href="favicon.ico">
<link href="/mall/PUBLIC/Admin/css/bootstrap.min.css?v=3.3.5" rel="stylesheet">
<!-- Data Tables -->
<link href="/mall/PUBLIC/Admin/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
<link href="/mall/PUBLIC/Admin/css/animate.min.css" rel="stylesheet">
<link href="/mall/PUBLIC/Admin/css/style.min.css?v=4.0.0" rel="stylesheet">
<link href="/mall/PUBLIC/Admin/css/page.css?v=4.0.0" rel="stylesheet">

</head>  
<body>
	
    <div class="modal fade" id="goodtypemodel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                 <form action="<?php echo U('GoodType/add');?>" method="POST" id="goodTypeForm">
                    <div class="modal-content">
        			      <div class="modal-header">
        			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        			        <h4 class="modal-title" id="myModalLabel">添加类型</h4>
        			      </div>
        			      <div class="modal-body">
                              <form>
                                <div class="form-group">
                                    <label for="type_name">类型名称</label>
                                     <input type="text" class="form-control" id="type_name"  name="type_name"  
                                     autocomplete="off" placeholder="类型名称">
                                </div>
                                <div id="errors" style="color:#c90000;"></div>
                              </form>
        			      </div>
        			      <div class="modal-footer">
        			        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
        			        <button type="submit" class="btn btn-primary" id="add_good_type">确定</button>
        			      </div>
                  </div>
                </form>
            </div>
          </div>

	<script src="/mall/PUBLIC/Admin/js/jquery.min.js?v=2.1.4"></script>
<script src="/mall/PUBLIC/Admin/js/bootstrap.min.js?v=3.3.5"></script>
<script src="/mall/PUBLIC/Admin/js/plugins/layer/layer.min.js"></script>
<script src="/mall/PUBLIC/Admin/js/plugins/jeditable/jquery.jeditable.js"></script>
<script src="/mall/PUBLIC/Admin/js/plugins/dataTables/jquery.dataTables.js"></script>
<script src="/mall/PUBLIC/Admin/js/plugins/dataTables/dataTables.bootstrap.js"></script>
<script src="/mall/PUBLIC/Admin/js/bootstrapValidator.min.js"></script>

</body>
</html>