<!DOCTYPE html>
<html lang="en">
  <?php $menu = "index";?>
  <?php include("head.php"); ?>
  <body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
      <!-- Navbar -->
      <?php include("navbar.php"); ?>
      <!-- /.navbar -->
      <?php include("menu.php"); ?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
       
                  </div><!-- /.container-fluid -->
</div>
                     <h1> ปฎิทินการศึกษา</h1>
                     <?php 
                      //คิวรี่ข้อมูลมาแสดงในตาราง โดยเทียบข้อมูลระหว่างตารางตำแหน่งงานกับตารางพนักงานที่มีคอลัมภ์สัมพันธ์กัน ก็คือ p_id กับ ref_p_id
                      include 'condb.php';
                      $stmt = $conn->prepare("SELECT* FROM tbl_calendar");
                      $stmt->execute();
                      $result = $stmt->fetchAll();                                 
                      ?>
                      <table id="example1" class="table table-bordered table-striped dataTable">
    <thead>
      <tr role="row" class="info">
        <th  tabindex="0" rowspan="1" colspan="1" style="width: 5%;">ขั้นตอนที่</th>
        <th  tabindex="0" rowspan="1" colspan="1" style="width: 20%;">การดำเนินงาน</th>
        <th  tabindex="0" rowspan="1" colspan="1" style="width: 40%;">สรุปข้อปฏิบัติ</th>
        <th  tabindex="0" rowspan="1" colspan="1" style="width: 15%;">วันที่กำหนดส่ง</th>
        <th  tabindex="0" rowspan="1" colspan="1" style="width: 20%;">วันที่กำหนดส่ง</th>

      </tr>
    </thead>
    <tbody>
       <?php foreach ($result as $row_cal) { ?>  
      <tr>
        <td>
         <?php echo $row_cal['c_id']; ?>
        </td>
         <td>
         <?php echo $row_cal['c_name']; ?>
        </td>
         <td>
         <?php echo $row_cal['c_work']; ?>
        </td>
         <td>
         <?php echo $row_cal['c_start']; ?>
        </td>
        <td>
         <?php echo $row_cal['c_complete']; ?>
        </td>
         <?php } ?>  
      </tr>
    </tbody>
  </table>
                     
                      </div><!-- /.container-fluid -->
                    </section>
                    <!-- /.content -->
                  </div>
                  <!-- /.content-wrapper -->
                  <?php include("footer.php"); ?>
                  <!-- Control Sidebar -->
                  <aside class="control-sidebar control-sidebar-dark">
                    <!-- Control sidebar content goes here -->
                  </aside>
                  <!-- /.control-sidebar -->
                </div>
                <!-- ./wrapper -->
                <?php include("script.php"); ?>
              </body>
            </html>