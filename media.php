<?php
  $page_title = 'All Image';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(2);
?>
<?php $media_files = find_all('media');?>
<?php
  if(isset($_POST['submit'])) {
  $photo = new Media();
  $photo->upload($_FILES['file_upload']);
    if($photo->process_media()){
        $session->msg('s','photo has been uploaded.');
        redirect('media.php');
    } else{
      $session->msg('d',join($photo->errors));
      redirect('media.php');
    }

  }

?>
<?php include_once('layouts/header.php'); ?>
     <div class="row">
        <div class="col-md-6">
          <?php echo display_msg($msg); ?>
        </div>

      <div class="col-md-12 ml-2 mr-2">
      
      <h1 class = "ml-2 text-primary bold">Add Photo</h1>
      <form class="form-inline ml-2 mb-2" action="media.php" method="POST" enctype="multipart/form-data">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-btn">
                    <input type="file" name="file_upload" multiple="multiple" class="btn btn-primary btn-file"/>
                 </span>

                 <button type="submit" name="submit" class="btn btn-default">Upload</button>
               </div>
              </div>
             </form> 

      <div class="card shadow mb-4">
                  <div class="card-header py-3">
                       <h6 class="m-0 font-weight-bold text-primary">Highest Selling Products</h6>
                  </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-stripped" id="dataTable" width="100%" cellspacing="0">
                                    <thead class = "table-dark">
                                        <tr>
                                        <th class="text-center" style="width: 50px;">#</th>
                                        <th class="text-center">Photo</th>
                                        <th class="text-center">Photo Name</th>
                                        <th class="text-center" style="width: 20%;">Photo Type</th>
                                        <th class="text-center" style="width: 50px;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                        <th class="text-center" style="width: 50px;">#</th>
                                        <th class="text-center">Photo</th>
                                        <th class="text-center">Photo Name</th>
                                        <th class="text-center" style="width: 20%;">Photo Type</th>
                                        <th class="text-center" style="width: 50px;">Actions</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php foreach ($media_files as $media_file): ?>
                                      <tr class="list-inline">
                                      <td class="text-center" style = "font-size:20px"><?php echo count_id();?></td>
                                        <td class="text-center">
                                            <img src="uploads/products/<?php echo $media_file['file_name'];?>" class="img-fluid" width = "100px" height = "100px" />
                                        </td>
                                      <td class="text-center" style = "font-size:20px">
                                        <?php echo $media_file['file_name'];?>
                                      </td>
                                      <td class="text-center" style = "font-size:20px">
                                        <?php echo $media_file['file_type'];?>
                                      </td>
                                      <td class="text-center" style = "font-size:20px">
                                        <a href="delete_media.php?id=<?php echo (int) $media_file['id'];?>" class="btn btn-danger btn-xs"  title="Edit">
                                          <span class="">Delete</span>
                                        </a>
                                      </td>
                                    </tr>
                                    <?php endforeach;?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
          </div> 




     



<?php include_once('layouts/footer.php'); ?>
