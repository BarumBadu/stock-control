<?php
  $page_title = 'Edit User';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(1);
?>
<?php
  $e_user = find_by_id('users',(int)$_GET['id']);
  $groups  = find_all('user_groups');
  if(!$e_user){
    $session->msg("d","Missing user id.");
    redirect('users.php');
  }
?>

<?php
//Update User basic info
  if(isset($_POST['update'])) {
    $req_fields = array('firstname','middlename','lastname','email','age','username','level');
    validate_fields($req_fields);
    if(empty($errors)){
             $id = (int)$e_user['id'];
           $firstname = remove_junk($db->escape($_POST['firstname']));
           $middlename = remove_junk($db->escape($_POST['middlename']));
           $lastname = remove_junk($db->escape($_POST['lastname']));
           $age = remove_junk($db->escape($_POST['age']));
           $email = remove_junk($db->escape($_POST['email']));
       $username = remove_junk($db->escape($_POST['username']));
          $level = (int)$db->escape($_POST['level']);
       $status   = remove_junk($db->escape($_POST['status']));
            $sql = "UPDATE users SET firstname ='{$firstname}', middlename ='{$middlename}', email ='{$email}'  , lastname ='{$lastname}' , age ='{$age}', username ='{$username}',user_level='{$level}',status='{$status}' WHERE id='{$db->escape($id)}'";
         $result = $db->query($sql);
          if($result && $db->affected_rows() === 1){
            $session->msg('s',"Acount Updated ");
            redirect('edit_user.php?id='.(int)$e_user['id'], false);
          } else {
            $session->msg('d',' Sorry failed to updated!');
            redirect('edit_user.php?id='.(int)$e_user['id'], false);
          }
    } else {
      $session->msg("d", $errors);
      redirect('edit_user.php?id='.(int)$e_user['id'],false);
    }
  }
?>
<?php
// Update user password
if(isset($_POST['update-pass'])) {
  $req_fields = array('password');
  validate_fields($req_fields);
  if(empty($errors)){
           $id = (int)$e_user['id'];
     $password = remove_junk($db->escape($_POST['password']));
     $h_pass   = sha1($password);
          $sql = "UPDATE users SET password='{$h_pass}' WHERE id='{$db->escape($id)}'";
       $result = $db->query($sql);
        if($result && $db->affected_rows() === 1){
          $session->msg('s',"User password has been updated ");
          redirect('edit_user.php?id='.(int)$e_user['id'], false);
        } else {
          $session->msg('d',' Sorry failed to updated user password!');
          redirect('edit_user.php?id='.(int)$e_user['id'], false);
        }
  } else {
    $session->msg("d", $errors);
    redirect('edit_user.php?id='.(int)$e_user['id'],false);
  }
}

?>
<?php include_once('layouts/header.php'); ?>
 <div class="row">
   <div class="col-md-12"> <?php echo display_msg($msg); ?> </div>
              <div class="col-md-5 ml-2 mr-2">

                     <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary"> Update <?php echo remove_junk(ucwords($e_user['firstname'] )); ?> Account
                                    </h6>
                                </div>
                                <div class="card-body">
                                <form method="post" action="edit_user.php?id=<?php echo (int)$e_user['id'];?>" class="clearfix">
            <div class="form-group">
                  <label for="firstname" class="control-label">First Name</label>
                  <input type="name" class="form-control" name="firstname" value="<?php echo remove_junk(ucwords($e_user['firstname'])); ?>">
            </div>
            <div class="form-group">
                  <label for="middlename" class="control-label">Middle Name</label>
                  <input type="name" class="form-control" name="middlename" value="<?php echo remove_junk(ucwords($e_user['middlename'])); ?>">
            </div>
            <div class="form-group">
                  <label for="lastname" class="control-label">Last name</label>
                  <input type="name" class="form-control" name="lastname" value="<?php echo remove_junk(ucwords($e_user['lastname'])); ?>">
            </div>
            <div class="form-group">
                  <label for="age" class="control-label">Age</label>
                  <input type="name" class="form-control" name="age" value="<?php echo remove_junk(ucwords($e_user['age'])); ?>">
            </div>
            <div class="form-group">
                  <label for="email" class="control-label">Email</label>
                  <input type="email" class="form-control" name="email" value="<?php echo remove_junk(ucwords($e_user['email'])); ?>">
            </div>
            <div class="form-group">
                  <label for="username" class="control-label">Username</label>
                  <input type="text" class="form-control" name="username" value="<?php echo remove_junk(ucwords($e_user['username'])); ?>">
            </div>
            <div class="form-group">
              <label for="level">User Role</label>
                <select class="form-control" name="level">
                  <?php foreach ($groups as $group ):?>
                   <option <?php if($group['group_level'] === $e_user['user_level']) echo 'selected="selected"';?> value="<?php echo $group['group_level'];?>"><?php echo ucwords($group['group_name']);?></option>
                <?php endforeach;?>
                </select>
            </div>
            <div class="form-group">
              <label for="status">Status</label>
                <select class="form-control" name="status">
                  <option <?php if($e_user['status'] === '1') echo 'selected="selected"';?>value="1">Active</option>
                  <option <?php if($e_user['status'] === '0') echo 'selected="selected"';?> value="0">Deactive</option>
                </select>
            </div>
            <div class="form-group clearfix">
                    <button type="submit" name="update" class="btn btn-info">Update</button>
            </div>
        </form>
                                </div>
                            </div>

  </div>
  <!-- Change password form -->
  <div class="col-md-6">
  <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">
                                    Change <?php echo remove_junk(ucwords($e_user['lastname'])); ?> password
                                    </h6>
                                </div>
                                <div class="card-body">
                                <form action="edit_user.php?id=<?php echo (int)$e_user['id'];?>" method="post" class="clearfix">
                                  <div class="form-group">
                                        <label for="password" class="control-label">Password</label>
                                        <input type="password" class="form-control" name="password" placeholder="Type user new password">
                                  </div>
                                  <div class="form-group clearfix">
                                          <button type="submit" name="update-pass" class="btn btn-danger pull-right">Change</button>
                                  </div>
                                </form>
                                </div>
                            </div>
  </div>

 </div>
<?php include_once('layouts/footer.php'); ?>
