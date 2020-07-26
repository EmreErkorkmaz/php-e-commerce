<?php 

include 'header.php'; 

//Belirli veriyi seçme işlemi
$findmenu=$db->prepare("SELECT * FROM menu");
$findmenu->execute();


?>


<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Menu List <small>

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
              <a href="addmenu.php"><button class="btn btn-success btn-xs">Add Menu</button></a>
            </div>
          </div>
          <div class="x_content">


            <!-- Div İçerik Başlangıç -->

            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th width="20">Order Number</th>
                  <th>Menu Name</th>
                  <th>Menu Url</th>
                  <th>Menu Index</th>
                  <th width="20">Menu Status</th>
                  <th>Settings</th>
                </tr>
              </thead>

              <tbody>

                <?php 
                $number=0;
                while($getmenu=$findmenu->fetch(PDO::FETCH_ASSOC)) { $number++?>


                  <tr>
                    <td><?php echo $number ?></td>
                    <td><?php echo $getmenu['menu_name'] ?></td>
                    <td><?php echo $getmenu['menu_url'] ?></td>
                    <td><?php echo $getmenu['menu_index'] ?></td>
                    <td>
                      <center>
                        <?php 
                        if ($getmenu['menu_status']==1) {?>

                          <button style="width: 100%" class="btn btn-success btn-xs">Active</button>

                        <?php }else {?>

                          <button style="width: 100%" class="btn btn-danger btn-xs">Passive</button>

                        <?php }
                        ?>
                      </center>
                    </td>

                    <td>
                      <center>
                        <a href="updatemenu.php?menu_id=<?php echo $getmenu['menu_id']; ?>"><button style="width: 50%" class="btn btn-primary btn-xs">Update</button></a>
                        <a href="../netting/operation.php?menu_id=<?php echo $getmenu['menu_id']; ?>&deletemenu=true"><button style="width: 50%" class="btn btn-danger btn-xs">Delete</button></a>
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
