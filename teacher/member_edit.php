<?php 
 // print_r($_SESSION);
      include '../condb.php';
      $stmt_m = $conn->prepare("
        SELECT m.*
        FROM tbl_member AS m  #AS m คือการแทนชื่อตารางให้ชื่อสั้นลงในตอนที่เอาไป inner join โค้ดจะดูไม่รก
        WHERE m.m_id = $m_id
        ORDER BY m.m_id ASC #เรียงลำดับข้อมูลจากน้อยไปมาก
        ");
      $stmt_m->execute();
      $row_em = $stmt_m->fetch(PDO::FETCH_ASSOC);
      ?>
<div class="card card-info">
  <div class="card-header">
    <h3 class="card-title">แก้ไขข้อมูลสมาชิก</h3>
  </div>
  <div class="card-body">
    <form action="member_edit_db.php" method="POST" enctype="multipart/form-data">
      <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <label>username</label>
            <input type="text" name="m_username"  value="<?php echo $row_em['m_username'];?>" class="form-control" placeholder="กรอกข้อมูลusername">
          </div>
        </div>
       
      </div>
      <div class="row">
       <div class="col-sm-6">
          <div class="form-group">
            <label>password</label>
            <input type="text" name="m_password" value="<?= $row_em['m_password'];?>" class="form-control" placeholder="กรอกข้อมูลpassword">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <label>ชื่อ-นามสกุล</label>
            <input type="text" name="m_name" value="<?= $row_em['m_name'];?>" class="form-control" placeholder="กรอกข้อมูลชื่อ-นามสกุล">
          </div>
        </div>
      </div>
      
      <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <label>*รูปภาพ .jpg .png*</label>
            <input type="file" name="m_img" class="form-control">
          </div>
        </div>   
      </div>
       <div class="row">
         <div class="col-sm-6">
          <div class="form-group">
             <img src='../admin/m_img/<?= $row_em['m_img'];?>' width="200px">
          </div>
        </div>
       </div>
      <div class="row" align="left">
        <div class="col-sm-6">
          <input type="hidden" name="m_img2" value="<?php echo $row_em['m_img'];?>">
          <input type="hidden" name="m_id" value="<?= $row_em['m_id'];?>">
          <button type="submit" class="btn btn-success">บันทึกข้อมูล</button>
          <a href="member.php" class="btn btn-danger" data-dismiss="modal">ยกเลิก</a>
        </div>
      </div>
    </form>
  </div>
</div>