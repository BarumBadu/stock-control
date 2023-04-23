<?php
  $page_title = 'Add Sale';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(3);
?>
<?php

  if(isset($_POST['add_sale'])){
    $req_fields = array('s_id','quantity','price','total', 'date' );
    validate_fields($req_fields);
        if(empty($errors)){
          $p_id      = $db->escape((int)$_POST['s_id']);
          $s_qty     = $db->escape((int)$_POST['quantity']);
          $s_total   = $db->escape($_POST['total']);
          $date      = $db->escape($_POST['date']);
          $s_date    = make_date();

          $sql  = "INSERT INTO sales (";
          $sql .= " product_id,qty,price,date";
          $sql .= ") VALUES (";
          $sql .= "'{$p_id}','{$s_qty}','{$s_total}','{$s_date}'";
          $sql .= ")";

                if($db->query($sql)){
                  update_product_qty($s_qty,$p_id);
                  $session->msg('s',"Sale added. ");
                  redirect('add_sale.php', false);
                } else {
                  $session->msg('d',' Sorry failed to add!');
                  redirect('add_sale.php', false);
                }
        } else {
           $session->msg("d", $errors);
           redirect('add_sale.php',false);
        }
  }

?>
<?php include_once('layouts/header.php'); ?>
<div class="row ml-2 mr-2">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
    <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">
                                        Find it
                                    </h6>
                                </div>
                                <div class="card-body">
                               
                                <form method="post" action="ajax.php" autocomplete="off" id="sug-form">
                                    <div class="form-group">            
                    
                                      <div class="input-group ml-2 mb-2">

                                        <input type="text" id="sug_input" class="form-control" name="title"  placeholder="Search for product name">
                                    </div>
                                    <div id="result" class="list-group  ml-2 mb-2"></div>
                                    </div>
                                    <span class="input-group-btn ">
                                          <button type="submit" class="btn btn-primary">Find It</button>
                                        </span> 
                                </form>
                                </div>
                            </div>
<div class="row mr-2 ml-2">
  <div class = "col-md-12">
    <div class="card shadow mb-4">
                  <div class="card-header py-3">
                       <h6 class="m-0 font-weight-bold text-primary">List of Products</h6>
                  </div>
                        <div class="card-body">
                            <div class="table-responsive">
                            <form method="post" action="add_sale.php">
                                <table class="table table-bordered table-hover table-stripped" id= "dataTable" width="100%" cellspacing="0">
                                    <thead class = "table-dark">
                                        <tr>
                                        <th> Item </th>
                                        <th> Price </th>
                                        <th> Qty </th>
                                        <th> Total </th>
                                        <th> Date</th>
                                        <th> Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                        <th> Item </th>
                                        <th> Price </th>
                                        <th> Qty </th>
                                        <th> Total </th>
                                        <th> Date</th>
                                        <th> Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody  id="product_info"> </tbody>
                                </table>
                            </div>
                        </div>
                        </div>

</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>
  <script type="text/javascript" src="libs/js/functions.js"></script>
<?php include_once('layouts/footer.php'); ?>
