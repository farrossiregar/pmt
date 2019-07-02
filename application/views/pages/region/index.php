<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
      <h2>Region</h2> &nbsp;
      <div class="btn-group pull-right">
          <button type="button" class="btn btn-info dropdown-toggle btn-sm" data-toggle="dropdown" aria-expanded="false">
            <i class="fa fa-bars"></i>
          </button>
          <ul class="dropdown-menu">
            <li><a href="<?=site_url('region/insert')?>"><i class="fa fa-plus"></i> Create </a></li>
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
              <th class="column-title">No</th>
              <th class="column-title">Region Code </th>
              <th class="column-title">Region </th>
              <th class="column-title">Create Time  </th>
              <th class="column-title">Update Time </th>
              <th class="column-title no-link last"></th>
            </tr>
          </thead>

          <tbody>
            <?php foreach($data as $key => $item): ?>
              <tr class="even pointer">
                  <td class="a-center "><?=$key+1?></td>
                  <td><?=$item['region_code']?></td>
                  <td><?=$item['region']?></td>
                  <td><?=$item['created_at']?></td>
                  <td><?=$item['updated_at']?></td>
                  <td>
                    <a href="<?=site_url("region/edit/{$item['id']}")?>" title="Edit"><i class="fa fa-edit"></i></a>
                  </td>
              </tr>
          <?php 
              endforeach;
          ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>