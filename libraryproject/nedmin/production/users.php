<?php 

include 'header.php'; 

//Belirli veriyi seçme işlemi
$finduser=$db->prepare("SELECT * FROM user");
$finduser->execute();


?>


<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Users List <small>,

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


            <!-- Div İçerik Başlangıç -->

            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Sign-Up Date</th>
                  <th>Fullname</th>
                  <th>E-Mail Address</th>
                  <th>Phone Number</th>
                  <th>Settings</th>
                </tr>
              </thead>

              <tbody>

                <?php 

                while($getuser=$finduser->fetch(PDO::FETCH_ASSOC)) {?>


                  <tr>
                    <td><?php echo $getuser['user_date'] ?></td>
                    <td><?php echo $getuser['user_fullname'] ?></td>
                    <td><?php echo $getuser['user_email'] ?></td>
                    <td><?php echo $getuser['user_phone'] ?></td>
                    <td>
                      <center>
                        <a href="updateuser.php?user_id=<?php echo $getuser['user_id']; ?>"><button style="width: 50%" class="btn btn-primary btn-xs">Update</button></a>
                        <a href="../netting/operation.php?user_id=<?php echo $getuser['user_id']; ?>&deleteuser=true"><button style="width: 50%" class="btn btn-danger btn-xs">Delete</button></a>
                      </center>
                    </td>
                  </tr>



                <?php  }

                ?>


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
