<div class="card card-info">
  <div class="card-header">
    <h3 class="card-title">เพิ่มข้อมูลไฟล์เอกสาร</h3>
  </div>
  <div class="card-body">
    <form action="sdoc_add_db.php" method="POST" enctype="multipart/form-data">
    <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <label>ชื่อผู้ส่ง</label>
            <input type="text" name="sname" class="form-control is-warning" placeholder="กรอกข้อมูลชื่อเอกสาร">
          </div>
        </div>
      </div>
    <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <label>ชื่อเอกสาร</label>
            <input type="text" name="sfilename" class="form-control is-warning" placeholder="กรอกข้อมูลชื่อเอกสาร">
          </div>
        </div>
      </div>
    
      <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <label>*ไฟล์เอกสาร .pdf *</label>
            <input type="file" name="s_doc" class="form-control" accept="application/pdf">
          </div>
        </div>
    </div>
      <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <label>ส่งให้แผนกงาน</label>
            <select name="d_id" class="custom-select rounded-0" required>
              <option value="">-เลือกแผนกงาน-</option>
              <?php
              include '../condb.php';
              $stmt = $conn->prepare("SELECT* FROM tbl_department");
              $stmt->execute();
              $result = $stmt->fetchAll();
              foreach($result as $row) {
              ?>
              <option value="<?= $row['d_id'];?>"><?= $row['d_name'];?></option>
              <?php } ?>
            </select>
          </div>
        </div>
      </div>
      <div class="row" align="left">
        <div class="col-sm-6">
          <button type="submit" class="btn btn-success">บันทึกข้อมูล</button>
          <a href="sdoc.php" class="btn btn-danger" data-dismiss="modal">ยกเลิก</a>
        </div>
      </div>
    </form>
  </div>
</div>