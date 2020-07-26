<?php include 'header.php'; ?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>General Settings <small>


              <?php 

              if ($_GET['status']=='confirmed'){ ?>
                <b class="alert alert-success">Updates Confirmed</b><?php
              }elseif($_GET['status']=='error'){?>
                <b class="alert alert-danger">Update Error</b><?php
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
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Smtp Host <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="settings_smtphost" name="settings_smtphost" value="<?php echo $getsetting['settings_smtphost'] ?>" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Smtp User <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="settings_smtpuser" name="settings_smtpuser" value="<?php echo $getsetting['settings_smtpuser'] ?>" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Smtp Password <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="password" id="settings_smtppassword" name="settings_smtppassword" value="<?php echo $getsetting['settings_smtppassword'] ?>" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Smtp Port Number <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="settings_smtpport" name="settings_smtpport" value="<?php echo $getsetting['settings_smtpport'] ?>" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>



              <div class="ln_solid"></div>
              <div class="form-group">
                <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                  <button type="submit" name="savemailsettings" id="savemailsettings" class="btn btn-primary">Update</button>
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
