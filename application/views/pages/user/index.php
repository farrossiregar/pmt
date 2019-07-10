<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>User List</h2> &nbsp;
        <a href="<?=site_url('user/insert')?>" class="btn btn-success btn-sm pull-right"><i class="fa fa-plus"></i> Add User</a>
        <div class="clearfix"></div>
      </div>

      <div class="x_content">
        <div class="table-responsive">
          <table class="table table-striped table-bordered">
            <thead>
              <tr class="headings">
                <th class="column-title">No</th>
                <th class="column-title">Username </th>
                <th class="column-title">Name </th>
                <th class="column-title">User Group </th>
                <th class="column-title">Email </th>
                <th class="column-title">Phone </th>
                <th class="column-title">Status </th>
                <th class="column-title">Region </th>
                <th class="column-title">Position </th>
                <th class="column-title">Create Time  </th>
                <th class="column-title">Update Time </th>
                <th class="column-title no-link last"></th>
              </tr>
            </thead>
            <tbody>
              <?php 
                $no = 0;
                foreach($data as $key => $item):?>
                <?php if($item['user_group_id'] == 7) continue; ?>
                <?php $no++; ?>
                <tr class="even pointer">
                    <td class="a-center "><?=($no)?></td>
                    <td><?=$item['username']?></td>
                    <td><?=$item['name']?></td>
                    <td><?=$item['user_group']?></td>
                    <td><?=$item['email']?></td>
                    <td><?=$item['phone']?></td>
                    <td><a href="#" class="edit-active" data-type="select" data-url="<?=site_url()?>/ajax/saveuser" data-pk="<?=$item['id']?>" ><?=($item['active'] == 1 ? 'Active' : 'Inactive')?></a></td>
                    <td><?=get_branch_name($item['branch_id'])?></td>
                    <td>
                        <?php 
                            if($item['position_id']==1)
                            {
                                echo 'Requester';
                            }
                            if($item['position_id']==2)
                            {
                                echo 'Manager Regional';
                            }
                            if($item['position_id']==3)
                            {
                                echo 'Procurement HO';
                            }
                        ?>
                    </td>
                    <td><?=$item['create_time']?></td>
                    <td><?=$item['update_time']?></td>
                    <td>
                        <a href="<?=site_url("user/edit/{$item['id']}")?>" title="Edit"><i class="fa fa-edit"></i></a>
                        <a href="<?=site_url("user/delete/{$item['id']}")?>" title="Delete" class="text-danger" onclick="return _confirm('Delete this data ?')"><i class="fa fa-trash"></i></a>
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