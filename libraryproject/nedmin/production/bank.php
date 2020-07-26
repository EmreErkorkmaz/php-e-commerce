<?php 

include 'header.php'; 

//Belirli veriyi seçme işlemi
$findbank=$db->prepare("SELECT * FROM bank");
$findbank->execute();


?>


<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Bank List <small>

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
              <a href="addbank.php"><button class="btn btn-success btn-xs">Add Bank</button></a>
            </div>
          </div>
          <div class="x_content">


            <!-- Div İçerik Başlangıç -->

            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th width="20">Order Number</th>
                  <th>Bank Name</th>
                  <th>Bank IBAN</th>
                  <th>Account Owner</th>
                  <th width="20">Bank Status</th>
                  <th>Settings</th>
                </tr>
              </thead>

              <tbody>

                <?php 
                $number=0; 
                while($getbank=$findbank->fetch(PDO::FETCH_ASSOC)) { $number++?>


                  <tr>
                    <td align="center"><?php echo $number ?></td>
                    <td><?php echo $getbank['bank_name'] ?></td>
                    <td><?php echo $getbank['bank_iban'] ?></td>
                    <td><?php echo $getbank['bank_accountname'] ?></td>
                    <td>
                      <center>
                        <?php 
                        if ($getbank['bank_status']==1) {?>

                          <button style="width: 100%" class="btn btn-success btn-xs">Active</button>

                        <?php }else {?>

                          <button style="width: 100%" class="btn btn-danger btn-xs">Passive</button>

                        <?php }
                        ?>
                      </center>
                    </td>

                    <td>
                      <center>
                        <a href="updatebank.php?bank_id=<?php echo $getbank['bank_id']; ?>"><button style="width: 50%" class="btn btn-primary btn-xs">Update</button></a>
                        <a href="../netting/operation.php?bank_id=<?php echo $getbank['bank_id']; ?>&deletebank=true"><button style="width: 50%" class="btn btn-danger btn-xs">Delete</button></a>
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
