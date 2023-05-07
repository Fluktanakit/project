<?php
 //ถ้ามีค่าส่งมาจากฟอร์ม
    if(isset($_POST['c_name'])) {
    //ไฟล์เชื่อมต่อฐานข้อมูล
    include 'condb.php';
    //ประกาศตัวแปรรับค่าจากฟอร์ม
    $c_id = $_POST['c_id'];
    $c_name = $_POST['c_name'];
    $c_date = $_POST['c_date'];
    $c_work = $_POST['c_work'];
    $stmt = $conn->prepare("INSERT INTO tbl_calendar (c_id,c_name, c_date, c_work)
    VALUES (:c_id,:c_name, :c_date, :c_work)");
    $stmt->bindParam(':c_id', $c_id, PDO::PARAM_STR);
    $stmt->bindParam(':c_name', $c_name, PDO::PARAM_STR);
    $stmt->bindParam(':c_date', $c_date, PDO::PARAM_STR);
    $stmt->bindParam(':c_work', $c_work, PDO::PARAM_STR);
    $result = $stmt->execute();
      echo '
      <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';

      if($result){
        echo '<script>
             setTimeout(function() {
              swal({
                  title: "เพิ่มข้อมูลสำเร็จ",
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
                  window.location = "calendar.php"; //หน้าที่ต้องการให้กระโดดไป
              });
            }, 1000);
        </script>';
    } //else ของ if result      
}else{ //ถ้าไฟล์ที่อัพโหลดไม่ตรงตามที่กำหนด
    echo '<script>
                 setTimeout(function() {
                  swal({
                      title: "คุณอัพโหลดไฟล์ไม่ถูกต้อง",
                      type: "error"
                  }, function() {
                      window.location = "calendar.php"; //หน้าที่ต้องการให้กระโดดไป
                  });
                }, 1000);
            </script>';
    }
    $conn = null; //close connect db
     //else check
  //isset
    ?>