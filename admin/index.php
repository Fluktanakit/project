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
                <!-- /.content-header -->
                <?php
                include("condb.php");
                $admin = $conn->query("select count(m_id) from  tbl_member where m_level = 'admin'")->fetchColumn();
                $nume = $conn->query("select count(m_id) from  tbl_member where m_level = 'student'")->fetchColumn();
                $file = $conn->query("select count(fileID) from  tbl_doc_file")->fetchColumn();
                $sumdoc = $conn->query("select sum(qty) from  tbl_doc_file")->fetchColumn();
                $c_id = $conn->query("select count(c_id) from  tbl_calendar where c_id = 'c_id'")->fetchColumn();
                ?>
                <!-- Main content -->
                <section class="content">
                  <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                      <!-- ./col -->
                      <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                          <div class="inner">
                            <h3><?php echo $c_id;?> คน</h3>
                            <p>จำนวนแอดมินทั้งหมด</p>
                          </div>
                          <div class="icon">
                            <i class="ion ion-person-add"></i>
                          </div>
                          <a href="member.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                      </div>
                      <!-- ./col -->
                      <!-- ./col -->
                      <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                          <div class="inner">
                            <h3><?php echo $nume;?> คน</h3>
                            <p>จำนวนสมาชิกทั้งหมด</p>
                          </div>
                          <div class="icon">
                            <i class="ion ion-person-add"></i>
                          </div>
                          <a href="member.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                      </div>
                      <!-- ./col -->
                      <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                          <div class="inner">
                            <h3><?php echo $file;?> ไฟล์</sup></h3>
                            <p>จำนวนเอกสารทั้งหมด</p>
                          </div>
                          <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                          </div>
                          <a href="doc.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                      </div>
                      <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                          <div class="inner">
                            <h3><?php echo number_format($sumdoc);?> ครั้ง</h3>
                            <p>จำนวนการดาวน์โหลดเอกสาร</p>
                          </div>
                          <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                          </div>
                          <a href="doc.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                      </div>
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
        <th  tabindex="0" rowspan="1" colspan="1" style="width: 35%;">การดำเนินงาน</th>
        <th  tabindex="0" rowspan="1" colspan="1" style="width: 40%;">สรุปข้อปฏิบัติ</th>
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
         <?php echo $row_cal['c_date']; ?>
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