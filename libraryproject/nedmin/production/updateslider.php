<?php 
include 'header.php'; 

$findslider=$db->prepare("SELECT * FROM slider WHERE slider_id=:id");
$findslider->execute(array(
  'id'=>$_GET['slider_id']
));


$getslider=$findslider->fetch(PDO::FETCH_ASSOC);

?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Slider Updates <small>


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
                <ul class="dropdown-menu" role="slider">
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

            <!-- SLIDER PHOTO UPLOAD FORM START -->

            <form action="../netting/operation.php" method="POST" enctype="multipart/form-data" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">


              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Uploaded Logo <br><span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <?php 
                  if (strlen($getslider['slider_imgpath'])>0) { ?>
                    <img width="200" src="../../<?php echo $getslider['slider_imgpath']; ?>">
                  <?php }else{ ?>
                    <img width="200" src="../../dimg/default-logo.png">
                  <?php } ?>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Choose Slider Photo <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="file" id="slider_imgpath" name="slider_imgpath" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <input type="hidden" name="last_logo" value="<?php echo $getslider['slider_imgpath']; ?>">
              <input type="hidden" name="slider_id" value="<?php echo $getslider['slider_id']; ?>">


              
              <div class="form-group">
                <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                  <button type="submit" name="updatesliderimage" id="updatesliderimage" class="btn btn-primary">Update Photo</button>
                </div>
              </div>
              <div class="ln_solid"></div>
              
            </form>

            <!-- SLIDER PHOTO UPLOAD FORM ENDPOINT -->


            <form action="../netting/operation.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Slider Name <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="slider_name" name="slider_name" value="<?php echo $getslider['slider_name'] ?>" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Slider Content <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="slider_content" name="slider_content" value="<?php echo $getslider['slider_content'] ?>" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Slider Link <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="slider_link" name="slider_link" value="<?php echo $getslider['slider_link'] ?>" class="form-control col-md-7 col-xs-12">
                </div>
              </div>


              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Slider Order <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="slider_index" name="slider_index" value="<?php echo $getslider['slider_index'] ?>"  class="form-control col-md-7 col-xs-12">
                </div>
              </div>



              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Slider Status <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <select type="number" id="slider_status" name="slider_status" value="<?php echo $getslider['slider_status'] ?>" class="form-control col-md-7 col-xs-12">
                    <option value="1" <?php $getslider['slider_status']=='1' ? 'selected""':''; ?>>Active</option>

                    <option value="0" <?php if($getslider['slider_status']==0){echo 'selected""';} ?>>Passive</option>

                  </select>
                </div>
              </div>


              <input type="hidden" name="slider_id" value="<?php echo $getslider['slider_id'] ?>">


              <div class="ln_solid"></div>
              <div class="form-group">
                <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                  <button type="submit" name="savesliderupdates" id="savesliderupdates" class="btn btn-primary">Update</button>
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
