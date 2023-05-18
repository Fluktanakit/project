<?php 
if(isset($_GET['cha_id'])){
    include 'condb.php';
//ประกาศตัวแปรรับค่าจาก param method get
$cha_id = $_GET['cha_id'];
$stmt = $conn->prepare('DELETE FROM tbl_chapter WHERE cha_id=:cha_id');
$stmt->bindParam(':cha_id', $cha_id , PDO::PARAM_INT);
$stmt->execute();

  if($stmt->rowCount() > 0){
        echo '<script>       
              window.location = "p_type.php"; //หน้าที่ต้องการให้กระโดดไป
              </script>';
    }else{
       echo '<script>         
              window.location = "p_type.php"; //หน้าที่ต้องการให้กระโดดไป
             </script>';
    }
$conn = null;
} //isset
?>