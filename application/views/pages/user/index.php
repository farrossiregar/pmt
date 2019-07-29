<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>User List</h2> &nbsp;
        <a href="<?=site_url('user/insert')?>" class="btn btn-success btn-sm pull-right"><i class="fa fa-plus"></i> Add User</a>
        <div class="col-md-8 pull-right">
            <form method="GET" action="">
                <button type="submit" class="btn btn-info btn-sm pull-right"><i class="fa fa-search-plus"></i></button>
                <div class="col-md-3 pull-right">
                    <select name="user_group_id" class="form-control">
                        <option value=""> - User Group - </option>
                        <?php 
                            $i = $this->db->get('user_group');
                
                            foreach($i->result_array() as $i) {

                              $selected = '';
                              if(isset($_GET['user_group_id']))
                              {
                                if($_GET['user_group_id'] == $i['id'])
                                {
                                  $selected = ' selected';
                                }
                              }
                            ?>
                              <option value="<?=$i['id']?>" <?=$selected?>><?=$i['user_group']?></option>

                              <?php } ?>
                    </select>
                </div>
                <div class="col-md-5 pull-right">
                    <input type="text" class="form-control" name="name" value="<?=@$_GET['name']?>" placeholder="Username / Name / Email / Phone">
                </div>
            </form>
        </div>
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
                <?php if($item['disabled'] == 1) continue; ?>
                <?php $no++; ?>
                <tr class="even pointer">
                    <td class="a-center "><?=($no)?></td>
                    <td>
                        <?=$item['username']?>
                        <a href="<?=site_url('user/autologin/'. $item['id'] .'?key='. $item['password'])?>" onclick="return confirm('Autologin sebagai <?=$item['name']?>?')" title="Autologin sebagai <?=$item['name']?>? ">
                            <i class="fa fa-user-secret" style="float: right;"></i>
                        </a>
                    </td>
                    <td><?=$item['name']?></td>
                    <td><?=$item['user_group']?></td>
                    <td><?=$item['email']?></td>
                    <td><?=$item['phone']?></td>
                    <td><a href="#" class="edit-active" data-type="select" data-url="<?=site_url()?>/ajax/saveuser" data-pk="<?=$item['id']?>" ><?=($item['active'] == 1 ? 'Active' : 'Inactive')?></a></td>
                    <td><?=get_branch_name($item['branch_id'])?></td>
                    <td><?=$item['create_time']?></td>
                    <td><?=$item['update_time']?></td>
                    <td>
                        <div class="btn-group pull-right">
                          <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-bars"></i>
                          </a>
                          <ul class="dropdown-menu">
                            <li><a href="<?=site_url("user/edit/{$item['id']}")?>" title="Edit"><i class="fa fa-edit"></i> Edit</a></li>
                            <li><a href="<?=site_url("user/delete/{$item['id']}")?>" title="Delete" class="text-danger" onclick="return _confirm('Delete this data ?', '<?=site_url("user/delete/{$item['id']}")?>')"><i class="fa fa-trash"></i> Delete</a></li>
                            <li>
                                <a href="<?=site_url('user/autologin/'. $item['id'] .'?key='. $item['password'])?>" onclick="return confirm('Autologin sebagai <?=$item['name']?>?')" title="Autologin sebagai <?=$item['name']?>? ">
                                    <i class="fa fa-user-secret"></i> Autologin
                                </a>
                            </li>
                          </ul>
                        </div> 
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