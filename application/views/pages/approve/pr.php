
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Purchase Request</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?=base_url('assets/vendors/bootstrap/dist/css/bootstrap.min.css')?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=base_url('assets/vendors/font-awesome/css/font-awesome.min.css')?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?=base_url()?>assets/dist/css/AdminLTE.css?v=<?=date('YmdHis')?>">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="/"><img src="<?=base_url('assets/pnl-logo.png')?>" style="width: 180px;" /></a>
  </div>
  <div class="register-box-body">
    <p class="login-box-msg">Purchase Request <strong>#<?=$data['no']?></strong></p>
    <form action="" method="post" id="form_purchase_request">
      <div class="form-group">
        <label class="control-label col-md-12">Company </label>
        <div class="col-sm-12">
           <select class="form-control" name="company_id" disabled>
              <option value="" data-code="">-- Select Company --</option>
              <?php foreach(get_company() as $item) { ?>
              <option value="<?=$item['id']?>" <?=((isset($data['company_id']) and $data['company_id'] == $item['id']) ? ' selected ' : '')?> data-code="<?=$item['code']?>"><?=$item['name']?></option>
              <?php } ?>
           </select>
        </div>
      </div>
      <div class="clearfix"></div><br >
      <div class="form-group">
        <label class="col-md-12">Projects </label>
        <div class="col-sm-12">
          <input type="text" class="form-control" readonly value="<?=$data['project_code']?>">
        </div>
      </div>
      <div class="clearfix"></div><br >
      <div class="form-group">
        <label class="control-label col-md-12 col-sm-3 col-xs-12" for="material_group_id">Region</label>
        <div class="col-md-12 col-sm-12 col-xs-12">
           <input type="text" class="form-control readonly_region" readonly="true" value="<?=(isset($data['region_code']) ? $data['region_code'] : "")?>" >
        </div>
      </div>
      <div class="clearfix"></div><br >
      <div class="form-group">
        <label class="control-label col-md-12 col-sm-12 col-xs-12" for="material_group_id">Project Type</label>
        <div class="col-md-12 col-sm-12 col-xs-12">
           <input type="text" class="form-control readonly_project_type" readonly="true" value="<?=(isset($data['project_type']) ? $data['project_type'] : "")?>">
        </div>
      </div>
      <div class="clearfix"></div><br >
      <div class="form-group">
        <label class="control-label col-md-12 col-sm-12 col-xs-12" for="material_group_id">Project Manager</label>
        <div class="col-md-12 col-sm-12 col-xs-12">
           <input type="text" class="form-control readonly_project_manager" readonly="true" value="<?=(isset($data['project_manager']) ? $data['project_manager'] : "")?>">
        </div>
      </div>
      <div class="clearfix"></div><br >
      <div class="form-group">
        <label class="control-label col-md-12 col-sm-12 col-xs-12" for="material_id">PR Number <span class="required">*</span>
        </label>
        <div class="col-md-12 col-sm-12 col-xs-12">
           <input type="text" name="purchase_number_hidden" class="form-control" readonly="true" value="<?=(isset($data['no']) ? $data['no'] : '' )?>" />
        </div>
      </div>
      <div class="clearfix"></div><br >
      <div class="form-group">
        <label class="control-label col-md-12 col-sm-12 col-xs-12" for="require_date">Required Date <span class="required">*</span>
        </label>
        <div class="col-md-12 col-sm-12 col-xs-12">
          <input type="text" readonly value="<?=(isset($data['require_date']) ? $data['require_date'] : "")?>"  name="require_date" class="form-control tanggal" id="require_date">
        </div>
      </div>
     <div class="clearfix"></div>
     <br />
      <div class="clearfix"></div><br >
      <div class="form-group">
        <table class="table table-hover" >
          <thead>
            <tr>
              <th>No</th>
              <th>Material Group</th>
              <th>Material</th>
              <th>Required Qty.</th>
              <th>Urgency Level</th>
              <th></th>
            </tr>
          </thead>
          <tbody class="add-table-purcashing-request" id="table_detail">
          <?php foreach($material as $key => $value):?>
            <tr>
               <td class="column-title"><?php echo $key+1; ?></td>
               <td class="column-title"><?php echo $value['group_material']; ?></td>
               <td class="column-title">
                  <?php 
                    $name = $value["name_material"];
                    if($value["material_id"] == "0")
                      $name = $value["new_material"];

                    echo $name;
                  ?>
               </td>
               <td class="column-title"><?php echo $value['qty']; ?></td>
               <td class="column-title"><?php
                $urgency = URGENCY___LEVEL;
                $urgency_val = isset($urgency[$value['urgency']]) ? $urgency[$value['urgency']] : "";
                echo $urgency_val;
                ?></td>
            </tr>
          <?php endforeach;?>
          </tbody>                  
       </table>
       <hr />
      </div>
      <div class="form-group">
        <div class="col-md-12">
          <textarea name="note" class="form-control" placeholder="Note"></textarea>
        </div>
      </div>
      <div class="clearfix"></div><br />
      <div class="form-group">
        <div class="col-xs-8">
          <button type="button" class="btn btn-danger btn-sm" onclick="reject()"><i class="fa fa-close"></i> Reject</button>
        </div>
        <!-- /.col -->
        <div class="col-xs-4" style="text-align: right;">
          <button type="button" class="btn btn-success btn-sm" onclick="approve()"><i class="fa fa-check"></i>Approve</button>
        </div>
        <!-- /.col -->
      </div>
      <div class="clearfix"></div><br >
      <input type="hidden" name="status" value="1">
    </form>
  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->

<!-- jQuery 3 -->
<script src="<?=base_url('assets/vendors/jquery/dist/jquery.min.js')?>"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?=base_url('assets/vendors/bootstrap/dist/js/bootstrap.min.js')?>"></script>
<script type="text/javascript">
  function approve()
  {
    if(confirm('Approve Purchase Request #<?=$data['no']?> ?'))
    {
      $("#form_purchase_request").trigger('submit');
    }
  }

  function reject()
  {
    if($("textarea[name='note']").val() == "")
    {
      alert("Note required.");
    }
    else if(confirm('Reject Purchase Request #<?=$data['no']?> ?'))
    {
      $("input[name='status']").val(0);
      $("#form_purchase_request").trigger('submit');
    }
  }
</script>
</body>
</html>
