<?php
 //ถ้ามีค่าส่งมาจากฟอร์ม
    if(isset($_POST['cha_name'])) {
    //ไฟล์เชื่อมต่อฐานข้อมูล
    include 'condb.php';
    //ประกาศตัวแปรรับค่าจากฟอร์ม
    $cha_name = $_POST['cha_name'];
     //check data
      $stmt = $conn->prepare("SELECT cha_id FROM tbl_chapter WHERE cha_name = :cha_name");
      //$stmt->bindParam(':username', $username , PDO::PARAM_STR);
      $stmt->execute(array(':cha_name' => $cha_name));
      //ถ้า username ซ้ำ ให้เด้งกลับไปหน้าเพิ่มข้อมูลแผนก
      echo '
      <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';

      if($stmt->rowCount() > 0){
          echo '<script>
                       setTimeout(function() {
                        swal({
                            title: "ข้อมูลซ้ำ !! ",  
                            text: "ข้อมูลซ้ำ!! กรุณากรอกข้อมูลใหม่",
                            type: "warning"
                        }, function() {
                            window.location = "p_type.php?act=add"; //หน้าที่ต้องการให้กระโดดไป
                        });
                      }, 1000);
                </script>';
      }else{ //ถ้าข้อมูลไม่ซ้ำ เก็บข้อมูลลงตาราง
    //sql insert
    $stmt = $conn->prepare("INSERT INTO tbl_chapter (cha_name)
    VALUES (:cha_name)");
    $stmt->bindParam(':cha_name', $cha_name, PDO::PARAM_STR);
    $result = $stmt->execute();
    
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
                  window.location = "p_type.php"; //หน้าที่ต้องการให้กระโดดไป
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
                  window.location = "p_type.php"; //หน้าที่ต้องการให้กระโดดไป
              });
            }, 1000);
        </script>';
    }
    $conn = null; //close connect db
    } //else check
  } //isset
    ?>