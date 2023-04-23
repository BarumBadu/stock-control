<?php
  $page_title = 'Home Page';
  require_once('includes/load.php');
  if (!$session->isUserLoggedIn(true)) { redirect('index.php', false);}
?>

<?php
 $c_categorie     = count_by_id('categories');
 $c_product       = count_by_id('products');
 $c_sale          = count_by_id('sales');
 $c_user          = count_by_id('users');
 $products_sold   = find_higest_saleing_product('10');
 $recent_products = find_recent_product_added('5');
 $recent_sales    = find_recent_sale_added('5')
?>
<?php include_once('layouts/header.php'); ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800 ml-3">Dashboard</h1>
                    </div>

                    <div class="row ml-1 mr-1">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Total Users</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><a href= "users.php"><?php  echo $c_user['total']; ?></a></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="bi bi-person-circle fa-2x text-primary  "></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Annual) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Total Categories</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><a href = "categorie.php"><?php  echo $c_categorie['total']; ?></a></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="bi bi-ui-checks-grid fa-2x text-primary"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>  
                        </div>

                        <!-- Tasks Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                               Total Products</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><a href = "product.php"><?php  echo $c_product['total']; ?></a> </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="bi bi-cart-fill fa-2x text-primary"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Total Sales</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><a href = "sales.php"><?php  echo $c_sale['total']; ?></a></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="bi bi-cash-coin fa-2x text-primary"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
  

   <div class="col-md-12">
       <div class="card shadow mb-4">
                  <div class="card-header py-3">
                       <h6 class="m-0 font-weight-bold text-primary">Highest Selling Products</h6>
                  </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-stripped"  width="100%" cellspacing="0">
                                    <thead class = "table-dark">
                                        <tr>
                                        <th>Title</th>
                                        <th>Total Sold</th>
                                        <th>Total Quantity</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                        <th>Title</th>
                                        <th>Total Sold</th>
                                        <th>Total Quantity</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                      <?php foreach ($products_sold as  $product_sold): ?>
                                        <tr style = "font-size:15px">
                                          <td><?php echo remove_junk(first_character($product_sold['name'])); ?></td>
                                          <td><?php echo (int)$product_sold['totalSold']; ?></td>
                                          <td><?php echo (int)$product_sold['totalQty']; ?></td>
                                        </tr>
                                      <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
          </div> 
    </div>

   <div class="col-md-12">
           <div class="card shadow mb-4">
                  <div class="card-header py-3">
                       <h6 class="m-0 font-weight-bold text-primary">Latest sales</h6>
                  </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-stripped"  width="100%" cellspacing="0">
                                    <thead class = "table-dark">
                                        <tr>
                                        <th class="text-center" style="width: 50px;">#</th>
                                        <th>Product Name</th>
                                        <th>Date</th>
                                        <th>Total Sale</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                        <th class="text-center" style="width: 50px;">#</th>
                                        <th>Product Name</th>
                                        <th>Date</th>
                                        <th>Total Sale</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php foreach ($recent_sales as  $recent_sale): ?>
                                        <tr style = "font-size:15px">
                                          <td class="text-center"><?php echo count_id();?></td>
                                          <td>
                                            <a href="edit_sale.php?id=<?php echo (int)$recent_sale['id']; ?>">
                                            <?php echo remove_junk(first_character($recent_sale['name'])); ?>
                                          </a>
                                          </td>
                                          <td><?php echo remove_junk(ucfirst($recent_sale['date'])); ?></td>
                                          <td>₱<?php echo remove_junk(first_character($recent_sale['price'])); ?></td>
                                        </tr>

                                      <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
          </div> 




  <div class="col-md-12">
  <div class="card shadow mb-4">
                  <div class="card-header py-3">
                       <h6 class="m-0 font-weight-bold text-primary">Newly Added Products</h6>
                  </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-stripped"  width="100%" cellspacing="0">
                                    <thead class = "table-dark">
                                        <tr>
                                        <th class="text-center" style="width: 50px;">#</th>
                                        <th>Image</th>
                                        <th>Produc Name</th>
                                        <th>Price</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                        <th class="text-center" style="width: 50px;">#</th>
                                        <th>Product Name</th>
                                        <th>Date</th>
                                        <th>Total Sale</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php foreach ($recent_products as  $recent_product): ?>
                                        <tr style = "font-size:15px" class = "align-items-center">
                                          <td class="text-center"><?php echo count_id();?></td>
                                          <td>
                                            <a href="href="edit_product.php?id=<?php echo    (int)$recent_product['id'];?>">
                                            <img class="img-fluid" width = "100px" height = "100px" src="uploads/products/<?php echo $recent_product['image'];?>" alt="" />
                                          </a>
                                          </td>
                                          <td><?php echo remove_junk(first_character($recent_product['categorie'])); ?></td>
                                          <td > <span class = "bg-primary text-white p-2"> ₱<?php echo remove_junk(first_character($recent_sale['price'])); ?></span></td>
                                        </tr>

                                      <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
</div>


 



<?php include_once('layouts/footer.php'); ?>

</div>
<?php include_once('layouts/footer.php'); ?>
