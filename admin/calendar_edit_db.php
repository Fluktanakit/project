<?php
       //ถ้ามีค่าส่งมาจากฟอร์ม
      if(isset($_POST['c_name'])) {
          //ไฟล์เชื่อมต่อฐานข้อมูล
          include 'condb.php';
      //ประกาศตัวแปรรับค่าจากฟอร์ม
        $c_id = $_POST['c_id'];
        $c_name = $_POST['c_name'];
        $c_start = $_POST['c_start'];
        $c_complete = $_POST['c_complete'];
        $c_work = $_POST['c_work'];
      //sql update
        $stmt = $conn->prepare("UPDATE tbl_calendar SET 
        c_id=:c_id,
        c_name=:c_name,
        c_start=:c_start,
        c_complete=:c_complete,
        c_work=:c_work
        WHERE c_id=:c_id");
        $stmt->bindParam(':c_id', $c_id, PDO::PARAM_STR);
        $stmt->bindParam(':c_name', $c_name, PDO::PARAM_STR);
        $stmt->bindParam(':c_complete', $c_complete, PDO::PARAM_STR);
        $stmt->bindParam(':c_start', $c_start, PDO::PARAM_STR);
        $stmt->bindParam(':c_work', $c_work, PDO::PARAM_STR);
        $stmt->execute();

    // sweet alert 
    echo '
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';

    if($stmt->rowCount() > 0){
        echo '<script>
             setTimeout(function() {
              swal({
                    title: "แก้ไขข้อมูลแผนกสำเร็จ",
                    text: "Redirecting in 1 seconds.",
                    type: "success",
                    timer: 1000,
                    showConfirmButton: false
              }, function() {
                  window.location = "calendar.php"; //หน้าที่ต้องการให้กระโดดไป
              });
            }, 1000);
        </script>';
    }else{
       echo '<script>
             setTimeout(function() {
              swal({
                  title: "เกิดข้อผิดพลาด",
                  type: "error"
              }, function() {
                  window.location = "celendar.php"; //หน้าที่ต้องการให้กระโดดไป
              });
            }, 1000);
        </script>';
    }
$conn = null; //close connect db
} //isset
?>