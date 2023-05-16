<?php
include '../condb.php';
$stmtDoc = $conn->prepare("SELECT * #ตารางเอามาทุกคอลัมภ์
FROM tbl_pdf as f
INNER JOIN tbl_chapter as c ON f.cha_id = c.cha_id
ORDER BY c.cha_id ASC #เรียงลำดับข้อมูลจากน้อยไปมาก
");
$stmtDoc->execute();
$resultDoc = $stmtDoc->fetchAll();
?>
<table id="example1" class="table table-bordered table-striped dataTable">
  <thead>
    <tr role="row" class="info">
    
      <th  tabindex="0" rowspan="1" colspan="1" style="width: 20%;">ชื่อหนังสือ/ประเภท</th>
      <th  tabindex="0" rowspan="1" colspan="1" style="width: 15%;">วันที่อัพโหลด</th>
      <th  tabindex="0" rowspan="1" colspan="1" style="width: 20%;">แผนก/ผู้ใช้</th>
      <th  tabindex="0" rowspan="1" colspan="1" style="width: 10%;">จัดการส่วนข้อมูล</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($resultDoc as $row_Doc) { ?>
    <tr>
      <td>
        <?php echo $row_Doc['doc_file']; ?>
        <br>
        ประเภท: <font color="blue"><?php echo $row_Doc['cha_name']; ?></font><br>
        <font color="red"><?php echo $row_Doc['doc_file']; ?></font>
      </td>
      <td>
        อัพเมื่อวัน: <?php echo date('d/m/Y',strtotime($row_Doc['dateCreate'])); ?>
      </td>      <td>
      <?php echo $row_Doc['s_name'];?><br>
    </td>
      <td>
      <a href="docs/<?php echo $row_Doc['doc_file'];?>" target="_blank" 
      class="btn btn-info btn-sm"> view </a>
        <a class="btn btn-warning btn-sm" href="doc_student.php?act=edit&no=<?php echo $row_Doc['no']; ?>">
          <i class="fas fa-pencil-alt">
          </i>
          Edit
        </a>
        <a class="btn btn-danger btn-sm" href="doc_del.php?no=<?= $row_Doc['no'];?>"  onclick="return confirm('ยืนยันการลบข้อมูล !!');">
          <i class="fas fa-trash">
          </i>
          Delete
        </a>
      </td>
       
      <?php } ?>
    </tr>
  </tbody>
</table>