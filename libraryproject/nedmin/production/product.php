<?php 

include 'header.php'; 

//Belirli veriyi seçme işlemi
$findproduct=$db->prepare("SELECT * FROM product ORDER BY product_id DESC");
$findproduct->execute();


// $findcategory=$db->prepare("SELECT * FROM category");
// $findcategory->execute();


?>


<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Product List <small>

              <?php 

              if (isset($_GET['status'])) {
                if ($_GET['status']=="confirmed") {?>

                  <b style="color:green;">Operation Successful</b>

                <?php } elseif ($_GET['status']=="error") {?>

                  <b style="color:red;">Operation Unsuccessful</b>

                <?php }

                
              }?>

              
            </small></h2>

            
            <div class="clearfix"></div>
            <div align="right">
              <a href="addproduct.php"><button class="btn btn-success btn-xs">Add Product</button></a>
            </div>
          </div>
          <div class="x_content">


            <!-- Div İçerik Başlangıç -->

            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th width="20">Order Number</th>
                  <th>Product Image</th>
                  <th>Product Name</th>

                  <th>Product Stock</th>
                  <th>Product Price</th>
                  <th>Set Product Image</th>


                  <th width="20">Product Status</th>
                  <th>Settings</th>
                </tr>
              </thead>

              <tbody>

                <?php 
                $number=0;
                while($getproduct=$findproduct->fetch(PDO::FETCH_ASSOC)) { $number++?>

                  <?php 

                  $findimage=$db->prepare("SELECT * FROM product_img WHERE product_id=:id ORDER BY product_img_id DESC");

                  $findimage->execute(array(
                    'id'=>$getproduct['product_id']
                  ));

                  $getimage=$findimage->fetch(PDO::FETCH_ASSOC);

                  ?>

                  <tr>
                    <td><?php echo $number ?></td>
                    <td><center>

                      <?php if(!empty($getimage['product_img_path'])){ ?>
                      <img style="height: 50px; width: auto;" src="../../<?php echo $getimage['product_img_path']  ?>">
                    <?php }else{ echo "No image uploaded yet"; } ?>

                    </center></td>

                    <td><?php echo $getproduct['product_name'] ?></td>
                    <td><?php echo $getproduct['product_stock'] ?></td>
                    <td><?php echo $getproduct['product_price']." ₺" ?></td>
                    <td><a href="product-galery.php?product_id=<?php echo $getproduct['product_id'] ?>"><button type="button" style="width: 100%;" class="btn btn-outline-dark btn-xs">Add / Update</button></a></td>


                    <td>
                      <center>
                        <?php 
                        if ($getproduct['product_status']==1) {?>

                          <button style="width: 100%" class="btn btn-success btn-xs">Active</button>

                        <?php }else {?>

                          <button style="width: 100%" class="btn btn-danger btn-xs">Passive</button>

                        <?php }
                        ?>
                      </center>
                    </td>

                    <td>
                      <center>
                        <a href="updateproduct.php?product_id=<?php echo $getproduct['product_id']; ?>"><button style="width: 50%" class="btn btn-primary btn-xs">Update</button></a>
                        <a href="../netting/operation.php?product_id=<?php echo $getproduct['product_id']; ?>&deleteproduct=true"><button style="width: 50%" class="btn btn-danger btn-xs">Delete</button></a>
                      </center>
                    </td>
                  </tr>


                <?php  } ?>


              </tbody>
            </table>

            <!-- Div İçerik Bitişi -->


          </div>
        </div>
      </div>
    </div>




  </div>
</div>
<!-- /page content -->

<?php include 'footer.php'; ?>
