<?php
  $page_title = 'My profile';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(3);
?>
  <?php
  $user_id = (int)$_GET['id'];
  if(empty($user_id)):
    redirect('home.php',false);
  else:
    $user_p = find_by_id('users',$user_id);
  endif;
?>
<?php include_once('layouts/header.php'); ?>

<section style="background-color: #eee;">
  <div class="container py-5">


    <div class="row">
      <div class="col-lg-4">
        <div class="card mb-4">
          <div class="card-body text-center">
            <img src="uploads/users/<?php echo $user_p['image'];?>" alt="profile"
              class="rounded-circle img-fluid" style="width: 150px;">
            <h5 class="my-3"><?php echo first_character($user_p['firstname'])." ".first_character($user_p['middlename'])." ".first_character($user_p['lastname']); ?></h5>
            <p class="text-muted mb-1"><?php echo first_character($user_p['email'])?></p>
            <p class="text-muted mb-4"><?php echo first_character($user_p['age'])?></p>
            <a href="edit_account.php" style = "font-size:20px"> <i class="glyphicon glyphicon-edit" style = "font-size:20px"></i> Edit profile</a>
          </div>
        </div>

      </div>
      <div class="col-lg-8">
        <div class="card mb-4">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Full Name</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo first_character($user_p['firstname'])." ".first_character($user_p['middlename'])." ".first_character($user_p['lastname']); ?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Email address</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo first_character($user_p['email'])?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Age</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo first_character($user_p['age'])?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Username:</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo first_character($user_p['username'])?></p>
              </div>
            </div>
            <hr>

          </div>
        </div>

      </div>
    </div>
  </div>
</section>

<?php include_once('layouts/footer.php'); ?>
