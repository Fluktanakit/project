      <?php
      if(isset($_GET['f_id'])){
      include 'condb.php';
      $stmt = $conn->prepare("
      SELECT * #ตารางเอามาทุกคอลัมภ์
      FROM tbl_doc_file AS f
      INNER JOIN tbl_type AS t ON f.t_id=t.t_id
      WHERE f.f_id=?
      ORDER BY f.f_id ASC #เรียงลำดับข้อมูลจากน้อยไปมาก
      ");
      $stmt->execute([$_GET['f_id']]);
      $row_doc = $stmt->fetch(PDO::FETCH_ASSOC);
      //ถ้าคิวรี่ผิดพลาดให้กลับไปหน้า index
        if($stmt->rowCount() < 1){
            header('Location: index.php');
            exit();
         }
      }//isset
      ?>
<div class="card card-info">
  <div class="card-header">
    <h3 class="card-title">แก้ไขข้อมูลไฟล์เอกสาร</h3>
  </div>
  <div class="card-body">
    <form action="doc_edit_db.php" method="POST" enctype="multipart/form-data">
      <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <label>รหัสเอกสาร</label> 
            <input type="text" name="fileID" value="<?= $row_doc['fileID'];?>"  class="form-control is-warning" placeholder="กรอกข้อมูลเอกสาร">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <label>ชื่อเอกสาร</label>
            <input type="text" name="filename" value="<?= $row_doc['filename'];?>"  class="form-control is-warning" placeholder="กรอกข้อมูลชื่อเอกสาร">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <label>ประเภทเอกสาร</label>
            <select name="t_id" class="custom-select rounded-0" required>
              <option value="<?= $row_doc['t_id'];?>"><?= $row_doc['t_name'];?></option>
              <option disabled>-เลือกประเภทเอกสาร-</option>
              <?php
              include 'condb.php';
              $stmt = $conn->prepare("SELECT* FROM tbl_type");
              $stmt->execute();
              $result_t = $stmt->fetchAll();
              foreach($result_t as $row_t) {
              ?>
              <option value="<?= $row_t['t_id'];?>"><?= $row_t['t_name'];?></option>
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
            <font color="red">ไฟล์เดิม: <?php echo $row_doc['doc_file']; ?></font>
          </div>
        </div>
      </div>
      
      
      <div class="row" align="left">
        <div class="col-sm-6">
          <input type="hidden" name="doc_file2" value="<?php echo $row_doc['doc_file'];?>">
          <input type="hidden" name="f_id" value="<?= $row_doc['f_id'];?>">
          <button type="submit" class="btn btn-success">บันทึกข้อมูล</button>
          <a href="doc.php" class="btn btn-danger" data-dismiss="modal">ยกเลิก</a>
        </div>
      </div>
    </form>
  </div>
</div>