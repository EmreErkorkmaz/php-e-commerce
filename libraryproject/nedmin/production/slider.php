<?php 

include 'header.php'; 

//Belirli veriyi seçme işlemi
$findslider=$db->prepare("SELECT * FROM slider");
$findslider->execute();


?>


<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Sliders List <small>

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
              <a href="addslider.php"><button class="btn btn-success btn-xs">Add slider</button></a>
            </div>
          </div>
          <div class="x_content">


            <!-- Div İçerik Başlangıç -->

            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th width="20">Order Number</th>
                  <th width="40">Slider Photo</th>
                  <th>Slider Name</th>
                  <th>Slider Content</th>
                  <th>Slider Link</th>
                  <th>slider Index</th>
                  <th width="20">Slider Status</th>
                  <th>Settings</th>
                </tr>
              </thead>

              <tbody>

                <?php 
                $number=0;
                while($getslider=$findslider->fetch(PDO::FETCH_ASSOC)) { $number++?>


                  <tr>
                    <td align="center"><?php echo $number ?></td>
                    <td>

                      <?php 
                      if (strlen($getslider['slider_imgpath'])>0) { ?>
                        <img width="100" src="../../<?php echo $getslider['slider_imgpath']; ?>">
                      <?php }else{ ?>
                        <img width="100" src="../../dimg/default-logo.png">
                      <?php } ?>

                    </td>
                    <td><?php echo $getslider['slider_name'] ?></td>
                    <td><?php echo $getslider['slider_content'] ?></td>
                    <td><?php echo $getslider['slider_link'] ?></td>
                    <td><?php echo $getslider['slider_index'] ?></td>
                    <td>
                      <center>
                        <?php 
                        if ($getslider['slider_status']==1) {?>

                          <button style="width: 100%" class="btn btn-success btn-xs">Active</button>

                        <?php }else {?>

                          <button style="width: 100%" class="btn btn-danger btn-xs">Passive</button>

                        <?php }
                        ?>
                      </center>
                    </td>

                    <td>
                      <center>
                        <a href="updateslider.php?slider_id=<?php echo $getslider['slider_id']; ?>"><button style="width: 50%" class="btn btn-primary btn-xs">Update</button></a>
                        <a href="../netting/operation.php?slider_id=<?php echo $getslider['slider_id']; ?>&deleteslider=true"><button style="width: 50%" class="btn btn-danger btn-xs">Delete</button></a>
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
