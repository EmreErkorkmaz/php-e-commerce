<?php 
include 'header.php'; 

$findmenu=$db->prepare("SELECT * FROM menu WHERE menu_id=:id");
$findmenu->execute(array(
  'id'=>$_GET['menu_id']
));


$getmenu=$findmenu->fetch(PDO::FETCH_ASSOC);

?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Menu Updates <small>


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

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Menu Name <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="menu_name" name="menu_name" value="<?php echo $getmenu['menu_name'] ?>" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Menu URL <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="menu_url" name="menu_url" value="<?php echo $getmenu['menu_url'] ?>" class="form-control col-md-7 col-xs-12">
                </div>
              </div>


              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Menu Order <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="menu_index" name="menu_index" value="<?php echo $getmenu['menu_index'] ?>"  class="form-control col-md-7 col-xs-12">
                </div>
              </div>


              <!-- CK Editor Start -->

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Menu Details <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">

                  <textarea id="menu_detail" name="menu_detail"  class="form-control ckeditor col-md-7 col-xs-12"><?php echo $getmenu['menu_detail'] ?></textarea>

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
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Menu Status <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <select type="number" id="menu_status" name="menu_status" value="<?php echo $getmenu['menu_status'] ?>" class="form-control col-md-7 col-xs-12">
                    <option value="1" <?php $getmenu['menu_status']=='1' ? 'selected""':''; ?>>Active</option>

                    <option value="0" <?php if($getmenu['menu_status']==0){echo 'selected""';} ?>>Passive</option>

                  </select>
                </div>
              </div>


              <input type="hidden" name="menu_id" value="<?php echo $getmenu['menu_id'] ?>">


              <div class="ln_solid"></div>
              <div class="form-group">
                <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                  <button type="submit" name="savemenuupdates" id="savemenuupdates" class="btn btn-primary">Update</button>
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
