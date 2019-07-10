
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Project Code</h2> &nbsp;
        <div class="btn-group pull-right">
          <button type="button" class="btn btn-default dropdown-toggle btn-sm" data-toggle="dropdown" aria-expanded="false">
            <span class="caret"></span>
          </button>
          <ul class="dropdown-menu">
            <li><a href="<?=site_url('projectcode/insert')?>"><i class="fa fa-plus"></i> Create </a></li>
            <li><a href=""><i class="fa fa-upload"></i> Import</a></li>
            <li><a href=""><i class="fa fa-download"></i> Export</a></li>
          </ul>
        </div>
        <div class="clearfix"></div>
      </div>

      <div class="x_content">
        <div class="table-responsive">
          <table class="table table-striped table-bordered data_table">
            <thead>
              <tr class="headings">
                <th>No</th>
                <th class="column-title">Project Code </th>
                <th class="column-title">Description </th>
                <th class="column-title">Created </th>
                <th class="column-title">Updated </th>
                <th>#</th>
              </tr>
            </thead>
            <tbody>
            <?php foreach($data as $key => $item): ?>   
              <tr>
                <td><?=$key+1?></td>
                <td><?=$item['code']?></td>
                <td><?=$item['description']?></td>
                <td><?=$item['created_at']?></td>
                <td><?=$item['updated_at']?></td>
                <td>
                  <a href="<?=site_url("projectcode/edit/{$item['id']}")?>" class="text-danger" title="Edit"><i class="fa fa-edit"></i></a> 
                  <a href="<?=site_url("projectcode/delete/{$item['id']}")?>" onclick="return (confirm('Hapus data ini?') ? true : false);" title="Delete"><i class="fa fa-trash-o"></i></a>
                </td>
              </tr>
            <?php  endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
</div>