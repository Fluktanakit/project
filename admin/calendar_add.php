<div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">เพิ่มขอมูลปฏิทินการศึกษา</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form action="calendar_add_db.php" method="POST" enctype="multipart/form-data">
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>ลำดับการดำเนินงาน</label>
                        <input type="text" name="c_id" class="form-control" placeholder="กรอกลำดับการดำเนินงาน">
                      </div>
                      <div class="form-group">
                        <label>การดำเนินงาน</label>
                        <input type="text" name="c_name" class="form-control" placeholder="กรอกข้อมูลการดำเนินงาน">
                      </div>
                      <div class="form-group">
                        <label>สรุปข้อปฏิบัติ</label>
                        <textarea type="text" name="c_work" class="form-control" placeholder="กรอกข้อมูลสรุปข้อปฏิบัติ"></textarea>
                      </div>
                      <div class="form-group">
                        <label>กำหนดวันเริ่มส่งเอกสาร</label>
                        <input type="date" name="c_start" class="form-control" placeholder="กรอกข้อมูลกำหนดส่งเอกสาร">
                    </div>
                      <div class="form-group">
                        <label>วันสุดท้ายในการส่งเอกสาร</label>
                        <input type="date" name="c_complete" class="form-control" placeholder="กรอกข้อมูลกำหนดส่งเอกสาร">
                    </div>
                    </div>
                  </div>
                  <div class="row" align="left">
                    <div class="col-sm-6">
                         <button type="submit" class="btn btn-success">บันทึกข้อมูล</button>
                         <a href="calendar.php" class="btn btn-danger" data-dismiss="modal">ยกเลิก</a>              
                    </div>         
                  </div>              
                </form>
              </div>
              <!-- /.card-body -->
            </div>
                       