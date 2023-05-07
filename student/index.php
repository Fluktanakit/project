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
                include("../condb.php");
                $admin = $conn->query("select count(m_id) from  tbl_member where m_level = 'admin'")->fetchColumn();
                $nume = $conn->query("select count(m_id) from  tbl_member where m_level = 'member'")->fetchColumn();
                $file = $conn->query("select count(fileID) from  tbl_doc_file")->fetchColumn();
                $sumdoc = $conn->query("select sum(qty) from  tbl_doc_file")->fetchColumn();
                $c_id = $conn->query("select count(c_id) from  tbl_calendar where c_id = 'c_id'")->fetchColumn();
                ?>
                <!-- Main content -->
                
                            <?php 
                      //คิวรี่ข้อมูลมาแสดงในตาราง โดยเทียบข้อมูลระหว่างตารางตำแหน่งงานกับตารางพนักงานที่มีคอลัมภ์สัมพันธ์กัน ก็คือ p_id กับ ref_p_id
                      include '../condb.php';
                      $stmt = $conn->prepare("SELECT* FROM tbl_calendar");
                      $stmt->execute();
                      $result = $stmt->fetchAll();                                 
                      ?>
                      <table id="example1" class="table table-bordered table-striped dataTable">
    <thead>
      <tr role="row" class="info">
        <th  tabindex="0" rowspan="1" colspan="1" style="width: 10%;">ขั้นตอนที่</th>
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
  
  <?php
                        $stmt = $conn->prepare("
                        SELECT filename, SUM(qty) as total
                        FROM tbl_doc_file
                        GROUP BY filename");
                        $stmt->execute();
                        $result = $stmt->fetchAll();
                        //นำข้อมูลที่ได้จากคิวรี่มากำหนดรูปแบบข้อมุลให้ถูกโครงสร้างของกราฟที่ใช้ *อ่าน docs เพิ่มเติม
                        $report_data = array();
                        foreach ($result as $rs) {
                        //ทำข้อมูลให้ถูกโครงสร้างก่อนนำไปแสดงในกราฟ ศึกษาเพิ่มเติม https://www.highcharts.com/demo/pie-basic
                        $report_data[]= '{name:'.'"'.$rs['filename'].' '.number_format($rs['total'],).' ครั้ง '.'"'.', '.'y:'.$rs['total'].'}';
                        }
                        //ตัด , ตัวสุดท้ายออก
                        $report_data = implode(",", $report_data);
                        ?>
                        <!DOCTYPE html>
                        <html>
                          <head>
                            <meta charset="utf-8">
                            <meta http-equiv="X-UA-Compatible" content="IE=edge">
                            <title></title>
                            <!--bootstrap5-->
                            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
                            <!-- css chart -->
                            <style>
                            .highcharts-figure,
                            .highcharts-data-table table {
                            min-width: 320px;
                            max-width: 900px;
                            margin: 1em auto;
                            }
                            .highcharts-data-table table {
                            font-family: Verdana, sans-serif;
                            border-collapse: collapse;
                            border: 1px solid #ebebeb;
                            margin: 10px auto;
                            text-align: center;
                            width: 100%;
                            max-width: 500px;
                            }
                            .highcharts-data-table caption {
                            padding: 1em 0;
                            font-size: 1.2em;
                            color: #555;
                            }
                            .highcharts-data-table th {
                            font-weight: 600;
                            padding: 0.5em;
                            }
                            .highcharts-data-table td,
                            .highcharts-data-table th,
                            .highcharts-data-table caption {
                            padding: 0.5em;
                            }
                            .highcharts-data-table thead tr,
                            .highcharts-data-table tr:nth-child(even) {
                            background: #f8f8f8;
                            }
                            .highcharts-data-table tr:hover {
                            background: #f1f7ff;
                            }
                            input[type="number"] {
                            min-width: 50px;
                            }
                            /* devbanban.com */
                            </style>
                            <!-- highcharts -->
                            <script src="https://code.highcharts.com/highcharts.js"></script>
                            <script src="https://code.highcharts.com/modules/exporting.js"></script>
                            <script src="https://code.highcharts.com/modules/export-data.js"></script>
                            <script src="https://code.highcharts.com/modules/accessibility.js"></script>
                          </head>
                          <body>
                            <figure class="highcharts-figure">
                              <div id="containerchart"></div>
                              
                            </figure>
                            <script>
                            Highcharts.chart('containerchart', {
                            chart: {
                            plotBackgroundColor: null,
                            plotBorderWidth: null,
                            plotShadow: false,
                            type: 'pie'
                            },
                            title: {
                            text: 'รายงานการดาวน์โหลดเอกสารทั้งหมด/ครั้ง'
                            },
                            tooltip: {
                            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                            },
                            accessibility: {
                            point: {
                            valueSuffix: '%'
                            }
                            },
                            plotOptions: {
                            pie: {
                            allowPointSelect: true,
                            cursor: 'pointer',
                            dataLabels: {
                            enabled: true,
                            format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                            }
                            }
                            },
                            series: [{
                            name: 'Brands',
                            colorByPoint: true,
                            data: [<?php echo $report_data;?>]
                            }]
                            });
                            </script>
                          </body>
                        </html>
                      </div>
                      <!-- /.row -->
                      
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