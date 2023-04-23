<?php
  $page_title = 'All User';
  require_once('includes/load.php');
?>
<?php
// Checkin What level user has permission to view this page
 page_require_level(1);
//pull out all user form database
 $all_users = find_all_user();
?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
   <div class="col-md-12">
     <?php echo display_msg($msg); ?>
   </div>
</div>
<div class="row ml-2 mr-2">
  <div class="col-md-12">

  <a href="add_user.php" class="btn btn-info pull-right ml-2 mb-2">Add New User</a>

  <div class="card shadow mb-4">
                  <div class="card-header py-3">
                       <h6 class="m-0 font-weight-bold text-primary">Manage</h6>
                  </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-stripped" id="dataTable" width="100%" cellspacing="0">
                                    <thead class = "table-dark">
                                    <tr>
                                      <th class="text-center" style="width: 50px;">#</th>
                                      <th>Firstname </th>
                                      <th>Middlename </th>
                                      <th>Lastname </th>
                                      <th>Email</th>
                                      <th>age </th>
                                      <th>Username</th>
                                      <th class="text-center" style="width: 15%;">User Role</th>
                                      <th class="text-center" style="width: 10%;">Status</th>
                                      <th style="width: 20%;">Last Login</th>
                                      <th class="text-center" style="width: 100px;">Actions</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                      <th class="text-center" style="width: 50px;">#</th>
                                      <th>Firstname </th>
                                      <th>Middlename </th>
                                      <th>Lastname </th>
                                      <th>Email</th>
                                      <th>age </th>
                                      <th>Username</th>
                                      <th class="text-center" style="width: 15%;">User Role</th>
                                      <th class="text-center" style="width: 10%;">Status</th>
                                      <th style="width: 20%;">Last Login</th>
                                      <th class="text-center" style="width: 100px;">Actions</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php foreach($all_users as $a_user): ?>
                                        <tr style = "font-size:15px">
                                        <td class="text-center"><?php echo count_id();?></td>
                                        <td><?php echo remove_junk(ucwords($a_user['firstname']))?></td>
                                        <td><?php echo remove_junk(ucwords($a_user['middlename']))?></td>
                                        <td><?php echo remove_junk(ucwords($a_user['lastname']))?></td>
                                        <td><?php echo remove_junk(ucwords($a_user['email']))?></td>
                                        <td><?php echo remove_junk(ucwords($a_user['age']))?></td>
                                        <td><?php echo remove_junk(ucwords($a_user['username']))?></td>
                                        <td class="text-center"><?php echo remove_junk(ucwords($a_user['group_name']))?></td>
                                        <td class="text-center">
                                        <?php if($a_user['status'] === '1'): ?>
                                          <span class="label label-success"><?php echo "Active"; ?></span>
                                        <?php else: ?>
                                          <span class="label label-danger"><?php echo "Deactive"; ?></span>
                                        <?php endif;?>
                                        </td>
                                        <td><?php echo read_date($a_user['last_login'])?></td>
                                        <td class="text-center">
                                          <div class="btn-group">
                                              <a href="edit_user.php?id=<?php echo (int)$a_user['id'];?>" class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit">
                                                <i class="glyphicon glyphicon-pencil">Edit</i>
                                            </a>
                                              <a href="delete_user.php?id=<?php echo (int)$a_user['id'];?>" class="btn btn-xs btn-danger" data-toggle="tooltip" title="Remove">
                                                <i class="glyphicon glyphicon-remove">Delete</i>
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
