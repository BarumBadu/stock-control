<?php
  $page_title = 'All categories';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
  
  $all_categories = find_all('categories')
?>
<?php
 if(isset($_POST['add_cat'])){
   $req_field = array('categorie-name');
   validate_fields($req_field);
   $cat_name = remove_junk($db->escape($_POST['categorie-name']));
   if(empty($errors)){
      $sql  = "INSERT INTO categories (name)";
      $sql .= " VALUES ('{$cat_name}')";
      if($db->query($sql)){
        $session->msg("s", "Successfully Added New Category");
        redirect('categorie.php',false);
      } else {
        $session->msg("d", "Sorry Failed to insert.");
        redirect('categorie.php',false);
      }
   } else {
     $session->msg("d", $errors);
     redirect('categorie.php',false);
   }
 }
?>
<?php include_once('layouts/header.php'); ?>

  <div class="row">
     <div class="col-md-12">
       <?php echo display_msg($msg); ?>
     </div>
  </div>
   <div class="row ml-2 mr-2">
    <div class="col-md-12">

    <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">
                                       Add New Category
                                    </h6>
                                </div>
                                <div class="card-body">
                                <form method="post" action="categorie.php">
                                  <div class="form-group">
                                  <input type="text" class="form-control" name="categorie-name" placeholder="Category Name">
                              </div>
                              <button type="submit" name="add_cat" class="btn btn-primary">Add Category</button>
                          </form>
                                    </div>
                            </div>


    <div class="col-md-12">

    <div class="card shadow mb-4">
                  <div class="card-header py-3">
                       <h6 class="m-0 font-weight-bold text-primary">List of Sales</h6>
                  </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-stripped" id= "dataTable" width="100%" cellspacing="0">
                                    <thead class = "table-dark">
                                        <tr>
                                          <th class="text-center" style="width: 50px;">#</th>
                                          <th>Categories</th>
                                          <th class="text-center" style="width: 100px;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th class="text-center" style="width: 50px;">#</th>
                                        <th>Categories</th>
                                        <th class="text-center" style="width: 100px;">Actions</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php foreach ($all_categories as $cat):?>
                                        <tr>
                                            <td class="text-center"><?php echo count_id();?></td>
                                            <td><?php echo remove_junk(ucfirst($cat['name'])); ?></td>
                                            <td class="text-center">
                                              <div class="btn-group">
                                                <a href="edit_categorie.php?id=<?php echo (int)$cat['id'];?>"  class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit">
                                                  <span class="">Edit</span>
                                                </a>
                                                <a href="delete_categorie.php?id=<?php echo (int)$cat['id'];?>"  class="btn btn-xs btn-danger" data-toggle="tooltip" title="Remove">
                                                  <span class="">Table</span>
                                                </a>
                                              </div>
                                            </td>

                                        </tr>
                                      <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                  </div>
    
    
  <?php include_once('layouts/footer.php'); ?>
