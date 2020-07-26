<?php 
include 'header.php'; 

$findproduct=$db->prepare("SELECT * FROM product WHERE product_id=:id");
$findproduct->execute(array(
  'id'=>$_GET['product_id']
));


$getproduct=$findproduct->fetch(PDO::FETCH_ASSOC);

?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Product Updates <small>


              <?php 

              if (isset($_GET['status'])) {
                if ($_GET['status']=='confirmed'){ ?>
                  <b class="alert alert-success">Updates Confirmed</b><?php
                }elseif($_GET['status']=='error'){?>
                  <b class="alert alert-danger">Update Error</b><?php
                }
              }

              ?>

            </small></h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="#">Settings 1</a>
                  </li>
                  <li><a href="#">Settings 2</a>
                  </li>
                </ul>
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br />


            <form action="../netting/operation.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">


              <!-- Kategori seçme başlangıç -->


              <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Select Category<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-6">

                  <?php  

                  $product_id=$getproduct['category_id']; 

                  $findcategory=$db->prepare("SELECT * FROM category WHERE category_status=:category_status order by category_index");
                  $findcategory->execute(array(
                    'category_status' => 1
                    ));

                    ?>
                    <select class="select2_multiple form-control" required="" name="category_id" >


                     <?php 

                     while($getcategory=$findcategory->fetch(PDO::FETCH_ASSOC)) {

                       $category_id=$getcategory['category_id'];

                       ?>

                       <option <?php if ($category_id==$product_id) { echo "selected='select'"; } ?> value="<?php echo $getcategory['category_id']; ?>"><?php echo $getcategory['category_name']; ?></option>

                       <?php } ?>

                     </select>
                   </div>
                 </div>


                 <!-- kategori seçme bitiş -->

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Product Name <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="product_name" name="product_name" value="<?php echo $getproduct['product_name'] ?>" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              


              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Product Price <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="product_price" name="product_price" value="<?php echo $getproduct['product_price'] ?>"  class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Product Keywords <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="product_keyword" name="product_keyword" value="<?php echo $getproduct['product_keyword'] ?>"  class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Product Stock <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="product_stock" name="product_stock" value="<?php echo $getproduct['product_stock'] ?>"  class="form-control col-md-7 col-xs-12">
                </div>
              </div>


              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Product in Front<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                 <select id="heard" class="form-control" name="product_front" required>



                  <option value="1" <?php echo $getproduct['product_front'] == '1' ? 'selected=""' : ''; ?>>Yes</option>



                  <option value="0" <?php if ($getproduct['product_front']==0) { echo 'selected=""'; } ?>>No</option>
                 

                 </select>
               </div>
             </div>


              <!-- CK Editor Start -->

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Product Details <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">

                  <textarea id="product_detail" name="product_detail"  class="form-control ckeditor col-md-7 col-xs-12"><?php echo $getproduct['product_detail'] ?></textarea>

                </div>
              </div>


              <script type="text/javascript">
                
                CKEDITOR.replace('about_content',{
                  filebrowserBrowseUrl: 'ckfinder/ckfinder.html',
                  filebrowserImageBrowseUrl: 'ckfinder/ckfinder.html?type=Images',
                  filebrowserFlashBrowseUrl: 'ckfinder/ckfinder.html?type=Flash',
                  filebrowserUploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                  filebrowserImageUploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                  filebrowserFlashUploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
                  forcePasteAsPlainText: true



                });

              </script>

              <!-- CK Editor Endpoint -->



              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Product Status <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <select type="number" id="product_status" name="product_status" value="<?php echo $getproduct['product_status'] ?>" class="form-control col-md-7 col-xs-12">
                    <option value="1" <?php $getproduct['product_status']=='1' ? 'selected""':''; ?>>Active</option>

                    <option value="0" <?php if($getproduct['product_status']==0){echo 'selected""';} ?>>Passive</option>

                  </select>
                </div>
              </div>


              <input type="hidden" name="product_id" value="<?php echo $getproduct['product_id'] ?>">


              <div class="ln_solid"></div>
              <div class="form-group">
                <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                  <button type="submit" name="saveproductupdates" id="saveproductupdates" class="btn btn-primary">Update</button>
                </div>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>

    <?php include 'footer.php'; ?>
    <!-- /Starrr -->
  </body>
  </html>
