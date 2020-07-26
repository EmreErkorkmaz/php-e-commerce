<?php 

include 'header.php'; 

//Belirli veriyi seçme işlemi
$findcomment=$db->prepare("SELECT * FROM comments ORDER BY comment_date DESC");
$findcomment->execute();



$finduser=$db->prepare("SELECT * FROM user ");
$finduser->execute();


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
            <h2>Comments <small>

              <?php 

              if (isset($_GET['status'])) {
                if ($_GET['status']=="confirmed") {?>

                  <b style="color:green;">Operation Successful</b>

                <?php } elseif ($_GET['status']=="error") {?>

                  <b style="color:red;">Operation Unsuccessful</b>

                <?php }

                
              }?>

              
            </small></h2>

            
            
          </div>
          <div class="x_content">


            <!-- Div İçerik Başlangıç -->

            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th width="20">Order Number</th>
                  <th>Product Name</th>
                  <th>Comment Owner</th>
                  <th>Comment Detail</th>

                  >
                  <th style="width: 20px">Delete Comment</th>
                </tr>
              </thead>

              <tbody>

                <?php 
                $number=0;
                while($getcomment=$findcomment->fetch(PDO::FETCH_ASSOC)) { $number++?>

                  <?php 

                  $product_id = $getcomment['product_id'];

                  $findproduct=$db->prepare("SELECT * FROM product WHERE product_id=:id");
                  $findproduct->execute(array(

                    'id'=> $product_id

                  ));

                  $getproduct=$findproduct->fetch(PDO::FETCH_ASSOC);



                  $user_id = $getcomment['user_id'];

                  $finduser=$db->prepare("SELECT * FROM user WHERE user_id=:id");
                  $finduser->execute(array(

                    'id'=> $user_id

                  ));

                  $getuser=$finduser->fetch(PDO::FETCH_ASSOC);


                  ?>

                  <tr>
                    <td><?php echo $number ?></td>
                    <td><?php echo $getproduct['product_name']  ?></td>
                    <td><?php echo $getuser['user_fullname'] ?></td>
                    <td><textarea style="pointer-events: none; resize: none; width: 100%;" disabled="" class="form-control"><?php echo $getcomment['comment_detail'] ?></textarea></td>

                    

                    <td>
                      <center>
                        <a href="../netting/operation.php?comment_id=<?php echo $getcomment['comment_id']; ?>&deletecomment=true"><button style="width: 50%;" class="btn btn-danger btn-xs">Delete</button></a>
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
