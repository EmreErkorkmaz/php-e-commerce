<?php 

include 'header.php'; 


$findabout=$db->prepare("SELECT * FROM about WHERE about_id=:id");
$findabout->execute(array(
  'id'=>0
));

$getabout=$findabout->fetch(PDO::FETCH_ASSOC);



?>



<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>About Settings <small>


              <?php 

              if (isset($_GET['status'])) {
                if ($_GET['status']=="confirmed") {?>

                  <b style="color:green;">Operation Successful</b>

                <?php } elseif ($_GET['status']=="error") {?>

                  <b style="color:red;">Operation Unsuccessful</b>

                <?php }

                
              }?>

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

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">About Title <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="about_title" name="about_title" value="<?php echo $getabout['about_title'] ?>" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <!-- CK Editor Start -->

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">About Content <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">

                  <textarea id="about_content" name="about_content"  class="form-control ckeditor col-md-7 col-xs-12"><?php echo $getabout['about_content'] ?></textarea>

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
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">About Video <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="about_video" name="about_video" value="<?php echo $getabout['about_video'] ?>" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">About Vision <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="about_vision" name="about_vision" value="<?php echo $getabout['about_vision'] ?>" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">About Mission <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="about_mission" name="about_mission" value="<?php echo $getabout['about_mission'] ?>" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>



              <div class="ln_solid"></div>
              <div class="form-group">
                <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                  <button type="submit" name="saveabout" id="saveabout" class="btn btn-primary">Update</button>
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
