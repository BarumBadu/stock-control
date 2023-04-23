<?php
  $page_title = 'All Group';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(1);
  $all_groups = find_all('user_groups');
?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
   <div class="col-md-12">
     <?php echo display_msg($msg); ?>
   </div>
</div>
<div class="row mr-2 ml-2">
  <div class="col-md-12">
  <a href="add_group.php" class="btn btn-info pull-right btn-sm ml-2 mb-2 "> Add New Group</a>
  <div class="card shadow mb-4">
                  <div class="card-header py-3">
                       <h6 class="m-0 font-weight-bold text-primary">List of Groups</h6>
                  </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-stripped" id="dataTable" width="100%" cellspacing="0">
                                    <thead class = "table-dark">
                                        <tr>
                                        <th class="text-center" style="width: 50px;">#</th>
                                        <th>Group Name</th>
                                        <th class="text-center" style="width: 20%;">Group Level</th>
                                        <th class="text-center" style="width: 15%;">Status</th>
                                        <th class="text-center" style="width: 100px;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                        <th class="text-center" style="width: 50px;">#</th>
                                        <th>Group Name</th>
                                        <th class="text-center" style="width: 20%;">Group Level</th>
                                        <th class="text-center" style="width: 15%;">Status</th>
                                        <th class="text-center" style="width: 100px;">Actions</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php foreach($all_groups as $a_group): ?>
                                        <tr>
                                        <td class="text-center"><?php echo count_id();?></td>
                                        <td><?php echo remove_junk(ucwords($a_group['group_name']))?></td>
                                        <td class="text-center">
                                          <?php echo remove_junk(ucwords($a_group['group_level']))?>
                                        </td>
                                        <td class="text-center">
                                        <?php if($a_group['group_status'] === '1'): ?>
                                          <span class="label label-success"><?php echo "Active"; ?></span>
                                        <?php else: ?>
                                          <span class="label label-danger"><?php echo "Deactive"; ?></span>
                                        <?php endif;?>
                                        </td>
                                        <td class="text-center">
                                          <div class="btn-group">
                                              <a href="edit_group.php?id=<?php echo (int)$a_group['id'];?>" class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit">
                                                <i class="">Edit</i>
                                            </a>
                                              <a href="delete_group.php?id=<?php echo (int)$a_group['id'];?>" class="btn btn-xs btn-danger" data-toggle="tooltip" title="Remove">
                                                <i class="">Delete</i>
                                              </a>
                                              </div>
                                        </td>
                                        </tr>
                                      <?php endforeach;?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
          </div> 




   
  </div>
</div>
  <?php include_once('layouts/footer.php'); ?>
