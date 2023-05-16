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
                
                
                ?>
                <!-- Main content -->
                
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