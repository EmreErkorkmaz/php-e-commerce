<?php 
include 'header.php'; 

$findbank=$db->prepare("SELECT * FROM bank WHERE bank_id=:id");
$findbank->execute(array(
  'id'=>$_GET['bank_id']
));


$getbank=$findbank->fetch(PDO::FETCH_ASSOC);

?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>bank Updates <small>


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

            

            <form action="../netting/operation.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Bank Name <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="bank_name" name="bank_name" value="<?php echo $getbank['bank_name'] ?>" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Bank IBAN <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="bank_top" name="bank_top" value="<?php echo $getbank['bank_iban'] ?>" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Bank Account Name <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="bank_icon" name="bank_icon" value="<?php echo $getbank['bank_accountname'] ?>" class="form-control col-md-7 col-xs-12">
                </div>
              </div>


              
            



              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Bank Status <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <select type="number" id="bank_status" name="bank_status" value="<?php echo $getbank['bank_status'] ?>" class="form-control col-md-7 col-xs-12">
                    <option value="1" <?php $getbank['bank_status']=='1' ? 'selected""':''; ?>>Active</option>

                    <option value="0" <?php if($getbank['bank_status']==0){echo 'selected""';} ?>>Passive</option>

                  </select>
                </div>
              </div>


              <input type="hidden" name="bank_id" value="<?php echo $getbank['bank_id'] ?>">


              <div class="ln_solid"></div>
              <div class="form-group">
                <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                  <button type="submit" name="savebankupdates" id="savebankupdates" class="btn btn-primary">Update</button>
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
