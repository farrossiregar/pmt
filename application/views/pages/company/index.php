<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Company</h2> &nbsp;
        <div class="btn-group pull-right">
          <a href="<?=site_url('region/insert')?>" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Create </a>
        </div>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div class="table-responsive">
          <table class="table table-striped table-bordered">
            <thead>
              <tr class="headings">
                <th>No</th>
                <th class="column-title">Company </th>
                <th class="column-title">Telepon </th>
                <th class="column-title">Address</th>
                <th style="width: 40px"></th>
              </tr>
            </thead>
            <tbody>
            <?php foreach($data as $key => $item): ?>  
            <tr>
              <td><?=$key+1?></td>
              <td><?=$item['name']?></td>
              <td><?=$item['telepon']?></td>
              <td><?=$item['address']?></td>
              <td>
                <div class="btn-group pull-right">
                  <button type="button" class="btn btn-default dropdown-toggle btn-xs" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-bars"></i>
                  </button>
                  <ul class="dropdown-menu">
                    <li><a href="<?=site_url('company/edit/'. $item['id'])?>"><i class="fa fa-edit"></i> Edit </a></li>
                    <li><a href="<?=site_url('company/delete/'. $item['id'])?>" onclick="return confirm('Delete this data ?')"><i class="fa fa-trash"></i> Delete</a></li>
                  </ul>
                </div>
              </td>
            </tr> 
            <?php  endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
</div>