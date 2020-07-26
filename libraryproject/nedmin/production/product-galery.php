<?php 

include 'header.php';


?>
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">


    </div>

    <div class="col-md-12">
      <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">

          <form action="" method="POST" >
            <div class="input-group">
              <input type="text" class="form-control" name="searching" placeholder="Enter Key Words...">
              <span class="input-group-btn">
                <button class="btn btn-default" type="submit" name="search">Search!</button>
              </span>
            </div>
          </form>
        </div>
      </div>
    </div>


    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
             <div align="left" class="col-md-6">
              <h2 >Product Image Setups <small>
               <?php 

               if (isset($_GET['status'])) {
                if ($_GET['status']=="confirmed") {?>

                  <b style="color:green;">Operation Successful</b>

                <?php } elseif ($_GET['status']=="error") {?>

                  <b style="color:red;">Operation Unsuccessful</b>

                <?php }

                
              }?>
            </div>
            <form  action="../netting/operation.php" method="POST" enctype="multipart/form-data">

              <input type="hidden" name="product_id" value="<?php echo $_GET['product_id']; ?>">

              <div align="right" class="col-md-6">
                <button type="submit" name="productdeleteimage"  class="btn btn-danger "><i class="fa fa-trash" aria-hidden="true"></i> Delete Selected</button>
                <a class="btn btn-success" href="product-image-upload.php?product_id=<?php echo $_GET['product_id'];?>"><i class="fa fa-plus" aria-hidden="true"></i> Upload Product Image</a>
              </div>
              <div class="clearfix"></div>
            </div>


            <div class="x_content">


              <?php

                $sayfada = 25; // sayfada gösterilecek içerik miktarını belirtiyoruz.


                $findimg=$db->prepare("SELECT * FROM product_img");
                $findimg->execute();
                $product_img_total=$findimg->rowCount();

                $toplam_sayfa = ceil($product_img_total / $sayfada);

                  // eğer sayfa girilmemişse 1 varsayalım.
                $sayfa = isset($_GET['sayfa']) ? (int) $_GET['sayfa'] : 1;

          // eğer 1'den küçük bir sayfa sayısı girildiyse 1 yapalım.
                if($sayfa < 1) $sayfa = 1; 

        // toplam sayfa sayımızdan fazla yazılırsa en son sayfayı varsayalım.
                if($sayfa > $toplam_sayfa) $sayfa = $toplam_sayfa; 

                $limit = ($sayfa - 1) * $sayfada;

                $findimage=$db->prepare("SELECT * FROM product_img where product_id=:product_id order by product_img_id DESC limit $limit,$sayfada");
                $findimage->execute(array(
                  'product_id' => @$_GET['product_id']
                ));

                while($getimage=$findimage->fetch(PDO::FETCH_ASSOC)) { ?>



                  <div class="col-md-55">
                   <label>
                    <div class="image view view-first">
                      <img style="width: 250px; height: auto; display: block;" src="../../<?php echo $getimage['product_img_path']; ?>" alt="image" />
                      <div class="mask">
                        <p><?php //echo $getimage['urunfoto_ad']; ?> <?php echo $getimage['product_img_id']; ?></p>
                        <div class="tools tools-bottom">

                          <!--<a href="#"><i class="fa fa-times"></i></a>-->

                        </div>

                      </div>

                    </div>

                    <?php  
                    // array("$productimageselect");
                    ?>


                    <input type="checkbox" name="productimageselect[]"  value="<?php echo $getimage['product_img_id']; ?>" > Select
                  </label>


                </div>

              <?php } ?>

              <div align="right" class="col-md-12">
                <ul class="pagination">

                  <?php

                  $s=0;

                  while ($s < $toplam_sayfa) {

                    $s++; ?>

                    <?php 

                    if ($s==$sayfa) {?>

                      <li class="active">

                        <a href="urunfoto.php?sayfa=<?php echo $s; ?>"><?php echo $s; ?></a>

                      </li>

                    <?php } else {?>


                      <li>

                        <a href="urunfoto.php?sayfa=<?php echo $s; ?>"><?php echo $s; ?></a>

                      </li>

                    <?php   }

                  }

                  ?>

                </ul>
              </div>
            </form>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
</div>
<!-- /page content -->



<?php include 'footer.php'; ?>
