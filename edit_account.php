<?php
  $page_title = 'Edit Account';
  require_once('includes/load.php');
   page_require_level(3);
?>
<?php
//update user image
  if(isset($_POST['submit'])) {
  $photo = new Media();
  $user_id = (int)$_POST['user_id'];
  $photo->upload($_FILES['file_upload']);
  if($photo->process_user($user_id)){
    $session->msg('s','photo has been uploaded.');
    redirect('edit_account.php');
    } else{
      $session->msg('d',join($photo->errors));
      redirect('edit_account.php');
    }
  }
?>
<?php
 //update user other info
  if(isset($_POST['update'])){
    $req_fields = array('firstname','middlename','lastname','username' );
    validate_fields($req_fields);
    if(empty($errors)){
            $id = (int)$_SESSION['user_id'];
           $firstname = remove_junk($db->escape($_POST['firstname']));
           $middlename = remove_junk($db->escape($_POST['middlename']));
           $lastname = remove_junk($db->escape($_POST['lastname']));
       $username = remove_junk($db->escape($_POST['username']));
            $sql = "UPDATE users SET firstname ='{$firstname}', middlename ='{$middlename}', lastname ='{$lastname}', username ='{$username}' WHERE id='{$id}'";
    $result = $db->query($sql);
          if($result && $db->affected_rows() === 1){
            $session->msg('s',"Acount updated ");
            redirect('edit_account.php', false);
          } else {
            $session->msg('d',' Sorry failed to updated!');
            redirect('edit_account.php', false);
          }
    } else {
      $session->msg("d", $errors);
      redirect('edit_account.php',false);
    }
  }
?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
  <div class="col-md-5 ml-2">

                            <!-- Area Chart -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Change my Photo</h6>
                                </div>
                                <div class="card-body">
                                    <div class="chart-area text-center">
                                    <img class="img-circle img-fluid" width="300px" src="uploads/users/<?php echo $user['image'];?>" alt="">
                                    </div>
                                    <hr>
                                    <form class="form" action="edit_account.php" method="POST" enctype="multipart/form-data">
                                    <div class="form-group">
                                      <input type="file" name="file_upload" multiple="multiple" class="btn btn-default btn-file"/>
                                    </div>
                                    <div class="form-group ml-3">
                                      <input type="hidden" name="user_id" value="<?php echo $user['id'];?>">
                                      <button type="submit" name="submit" class="btn btn-warning">Change</button>
                                    </div>
                                  </form>
                                </div>
                            </div>


  </div>
  <div class="col-md-6 ml-2">

  <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">
                                        Edit My Account
                                    </h6>
                                </div>
                                <div class="card-body">
                                <form method="post" action="edit_account.php?id=<?php echo (int)$user['id'];?>" class="clearfix">
                                  <div class="form-group">
                                        <label for="firstname" class="control-label">First Name</label>
                                        <input type="name" class="form-control" name="firstname" value="<?php echo remove_junk(ucwords($user['firstname'])); ?>">
                                  </div>
                                  <div class="form-group">
                                        <label for="middlename" class="control-label">Middle Name</label>
                                        <input type="name" class="form-control" name="middlename" value="<?php echo remove_junk(ucwords($user['middlename'])); ?>">
                                  </div>
                                  <div class="form-group">
                                        <label for="lastname" class="control-label">Last Name</label>
                                        <input type="name" class="form-control" name="lastname" value="<?php echo remove_junk(ucwords($user['lastname'])); ?>">
                                  </div>
                                  <div class="form-group">
                                        <label for="username" class="control-label">Username</label>
                                        <input type="text" class="form-control" name="username" value="<?php echo remove_junk(ucwords($user['username'])); ?>">
                                  </div>

                                </div>
                                <hr>
                                <div class="form-group clearfix col-6 ml-3">
                                          <button type="submit" name="update" class="btn btn-info">Update</button>
                                  </div>
                              </form>
                            </div>
  
  </div>
</div>


<?php include_once('layouts/footer.php'); ?>
