<?php
$d_id =  $_SESSION['d_id'];
include '../condb.php';
$stmtDoc = $conn->prepare("
SELECT * #ตารางเอามาทุกคอลัมภ์
FROM tbl_sdoc_file AS f
INNER JOIN tbl_department AS d ON f.d_id=d.d_id
WHERE f.d_id = $d_id
ORDER BY f.sfileID ASC #เรียงลำดับข้อมูลจากน้อยไปมาก
");
$stmtDoc->execute();
$resultDoc = $stmtDoc->fetchAll();
?>
<table id="example1" class="table table-bordered table-striped dataTable">
  <thead>
    <tr role="row" class="info">
      <th  tabindex="0" rowspan="1" colspan="1" style="width: 10%;">รหัสเอกสาร</th>
      <th  tabindex="0" rowspan="1" colspan="1" style="width: 20%;">ชื่อเอกสาร</th>
      <th  tabindex="0" rowspan="1" colspan="1" style="width: 20%;">ชื่อผู้ส่ง</th>
      <th  tabindex="0" rowspan="1" colspan="1" style="width: 15%;">วันที่อัพโหลด</th>
      <th  tabindex="0" rowspan="1" colspan="1" style="width: 20%;">แผนก</th>
      <th  tabindex="0" rowspan="1" colspan="1" style="width: 10%;">จัดการส่วนข้อมูล</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($resultDoc as $row_Doc) { ?>
    <tr>
      <td>
        <?php echo $row_Doc['sfileID'];?>
      </td>
      <td>
        <?php echo $row_Doc['sfilename']; ?>
        <br>
        ประเภท: <font color="blue"><?php echo $row_Doc['t_name']; ?></font><br>
        <font color="red"><?php echo $row_Doc['s_doc']; ?></font>
      </td>
      <td>
        <?php echo $row_Doc['s_name'];?>
      </td>
      <td>
        อัพเมื่อวัน: <?php echo date('d/m/Y',strtotime($row_Doc['date_up'])); ?>
      </td>
      <td>
        <?php echo $row_Doc['d_name'];?><br>
        จำนวนการดาวน์โหลด: <?php echo number_format($row_Doc['qty']);?> ครั้ง
      </td>
      <td>
        <a class="btn btn-danger btn-block btn-sm" href="doc_open.php?id=<?php echo $row_Doc['fileID']; ?>" target="_blank">
          <i class="fas fa-folder">
          </i>
          download
        </a>
       
      <?php } ?>
    </tr>
  </tbody>
</table>