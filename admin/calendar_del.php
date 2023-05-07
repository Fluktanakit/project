<?php 
if(isset($_GET['c_id'])){
    include 'condb.php';
//ประกาศตัวแปรรับค่าจาก param method get
$c_id = $_GET['c_id'];
$stmt = $conn->prepare('DELETE FROM tbl_calendar WHERE c_id=:c_id');
$stmt->bindParam(':c_id', $c_id , PDO::PARAM_INT);
$stmt->execute();

  if($stmt->rowCount() > 0){
        echo '<script>       
              window.location = "calendar.php"; //หน้าที่ต้องการให้กระโดดไป
              </script>';
    }else{
       echo '<script>         
              window.location = "calendar.php"; //หน้าที่ต้องการให้กระโดดไป
             </script>';
    }
$conn = null;
} //isset
?>