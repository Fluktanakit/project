<?php
      if(isset($_GET['c_id'])){
      include 'condb.php';
      $stmt = $conn->prepare("SELECT* FROM tbl_calendar WHERE c_id=?");
      $stmt->execute([$_GET['c_id']]);
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      //ถ้าคิวรี่ผิดพลาดให้กลับไปหน้า index
        if($stmt->rowCount() < 1){
            header('Location: index.php');
            exit();
         }
      }//isset
      ?>
       <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">แก้ไขข้อมูลปฏิทินการศึกษา</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <form action="calendar_edit_db.php" method="POST" enctype="multipart/form-data">
              <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>ลำดับการดำเนินงาน</label>
                        <input type="text" name="c_id" value="<?= $row['c_id'];?>" class="form-control" >
                      </div>
                      <div class="form-group">
                        <label>การดำเนินงาน</label>
                        <input type="text" name="c_name" value="<?= $row['c_name'];?>" class="form-control" placeholder="กรอกข้อมูลการดำเนินงาน">
                      </div>
                      <div class="form-group">
                        <label>สรุปข้อปฏิบัติ</label>
                        <textarea type="text" value="<?= $row['c_work'];?>" name="c_work" class="form-control" placeholder="กรอกข้อมูลสรุปข้อปฏิบัติ"></textarea>
                      </div>
                      <div class="form-group">
                        <label>กำหนดวันเริ่มส่งเอกสาร</label>
                        <input type="date" name="c_start" class="form-control" placeholder="กรอกข้อมูลกำหนดส่งเอกสาร">
                    </div>
                      <div class="form-group">
                        <label>กำหนดวันสุดท้ายที่ส่งเอกสาร</label>
                        <input type="date"  name="c_complete" class="form-control" placeholder="กรอกข้อมูลกำหนดส่งเอกสาร">
                    </div>
                    </div>
                  </div>
                  <div class="row" align="left">
                    <div class="col-sm-6">
                         <input type="hidden" name="c_id" value="<?= $row['c_id'];?>">
                         <button type="submit" class="btn btn-success">บันทึกข้อมูล</button>
                         <a href="calendar.php" class="btn btn-danger" data-dismiss="modal">ยกเลิก</a>              
                    </div>         
                  </div>              
                </form>
              </div>
              <!-- /.card-body -->
            </div>
             