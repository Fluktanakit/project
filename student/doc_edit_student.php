
        <?php
        include '../condb.php';
        $stmtDoc = $conn->prepare("
        SELECT * #ตารางเอามาทุกคอลัมภ์
        FROM tbl_pdf as f
        INNER JOIN tbl_chapter as c ON f.cha_id = c.cha_id
        ORDER BY c.cha_id ASC #เรียงลำดับข้อมูลจากน้อยไปมาก
        ");
        $stmtDoc->execute();
        $resultDoc = $stmtDoc->fetchAll();
        ?>
    <div class="card card-info">
  <div class="card-header">
    <h3 class="card-title">แก้ไขข้อมูลไฟล์เอกสาร</h3>
  </div>
  <div class="card-body">
    <form action="doc_edit_student_db.php" method="POST" enctype="multipart/form-data">
    <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <label>ชื่อเอกสาร</label>
            <input type="text" name="doc_name" value="<?= $row['doc_name'];?>"  class="form-control is-warning" placeholder="กรอกข้อมูลชื่อเอกสาร">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <label>ประเภทเอกสาร</label>
            <select name="cha_id" class="custom-select rounded-0" required>
              <option value="">-เลือกประเภทเอกสาร-</option>
              <?php
              include '../condb.php';
              $stmt = $conn->prepare("SELECT* FROM tbl_chapter");
              $stmt->execute();
              $result = $stmt->fetchAll();
              foreach($result as $row) {
              ?>
              <option value="<?= $row['cha_id'];?>"><?= $row['cha_name'];?></option>
              <?php } ?>
            </select>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <label>*ไฟล์เอกสาร .pdf *</label>
            <input type="file" name="doc_file" class="form-control" accept="application/pdf">
        </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <label>จัดทำโดย</label>
            <input type="text" name="s_name" class="form-control is-warning" placeholder="กรอกข้อมูล ID ผู้ใช้">
          </div>
        </div>
      </div>
      <div class="row" align="left">
        <div class="col-sm-6">
          <button type="submit" class="btn btn-success">บันทึกข้อมูล</button>
          <a href="doc.php" class="btn btn-danger" data-dismiss="modal">ยกเลิก</a>
        </div>
      </div>
    </form>
  </div>
</div>
