<?php 
if (isset($_POST['doc_name'])) {
    require_once '../condb.php';
    echo '
      <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';
     //สร้างตัวแปรวันที่เพื่อเอาไปตั้งชื่อไฟล์ใหม่
    $date1 = date("Ymd_His");
    //สร้างตัวแปรสุ่มตัวเลขเพื่อเอาไปตั้งชื่อไฟล์ที่อัพโหลดไม่ให้ชื่อไฟล์ซ้ำกัน
    $numrand = (mt_rand());
    $doc_file = (isset($_POST['doc_file']) ? $_POST['doc_file'] : '');
    $upload=$_FILES['doc_file']['name'];

    //มีการอัพโหลดไฟล์
    if($upload !='') {
    //ตัดขื่อเอาเฉพาะนามสกุล
    $typefile = strrchr($_FILES['doc_file']['name'],".");

    //สร้างเงื่อนไขตรวจสอบนามสกุลของไฟล์ที่อัพโหลดเข้ามา
    if($typefile =='.pdf'){

    //โฟลเดอร์ที่เก็บไฟล์ **สร้างไฟล์ index.php หรือ index.html (ไม่ต้องมี code) ไว้ในโฟลเดอร์ด้วยนะครับจะได้ป้องกันการเข้าถึงทุกไฟล์ในโฟลเดอร์
    $path="docs/";
    //ตั้งชื่อไฟล์ใหม่เป็น สุ่มตัวเลข+วันที่
    $newname = 'doc_'.$numrand.$date1.$typefile;
    $path_copy=$path.$newname;
    //คัดลอกไฟล์ไปยังโฟลเดอร์
    move_uploaded_file($_FILES['doc_file']['tmp_name'],$path_copy); 
   
     //ประกาศตัวแปรรับค่าจากฟอร์ม
    $doc_name = $_POST['doc_name'];
    $s_name = $_POST['s_name'];
    $cha_id = $_POST['cha_id'];
    
    //sql insert
    $stmt = $conn->prepare("UPDATE tbl_pdf SET 
    doc_name=:doc_name,
    doc_file='$newname',
    s_name=:s_name ,
    cha_id=:cha_id
    WHERE  no=:no");
    $stmt->bindParam(':doc_name', $doc_name, PDO::PARAM_STR);
    $stmt->bindParam(':s_name', $s_name, PDO::PARAM_STR);
    $stmt->bindParam(':cha_id', $cha_id, PDO::PARAM_STR);
    $result = $stmt->execute();
    $conn = null; //close connect db
    //เงื่อนไขตรวจสอบการเพิ่มข้อมูล
    $sToken = "eF1B4pkzcrS3pW6D9FgE1Ym5PfaNVMGD7OUecf6T2Gb";
	$sMessage = "รายละเอียดผู้ส่งเอกสาร\n";
    $sMessage .= "ชื่อผู้ส่ง: " . $s_name . "  \n";
    $sMessage .= "ชื่อโครงงาน: " . $doc_name . "  \n"; 
    $sMessage .= "บทที่: " .  $cha_id . "  \n"; 

	
	$chOne = curl_init(); 
	curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
	curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
	curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
	curl_setopt( $chOne, CURLOPT_POST, 1); 
	curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=".$sMessage); 
	$headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$sToken.'', );
	curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers); 
	curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
	$result = curl_exec( $chOne ); 

	//Result error 
	if(curl_error($chOne)) 
	{ 
		echo 'error:' . curl_error($chOne); 
	} 
	else { 
		$result_ = json_decode($result, true); 
		echo "status : ".$result_['status']; echo "message : ". $result_['message'];
	} 
	curl_close( $chOne );  
    if($result){
        echo '<script>
         setTimeout(function() {
          swal({
              title: "อัพโหลดไฟล์เอกสารสำเร็จ",
              text: "Redirecting in 1 seconds.",
              type: "success",
              timer: 1000,
              showConfirmButton: false
          }, function() {
              window.location = "doc_student.php"; //หน้าที่ต้องการให้กระโดดไป
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
              window.location = "doc_student.php"; //หน้าที่ต้องการให้กระโดดไป
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
                  window.location = "doc_student.php"; //หน้าที่ต้องการให้กระโดดไป
              });
            }, 1000);
        </script>';
} //else ของเช็คนามสกุลไฟล์  
} // if($upload !='') {
$conn = null; //close connect db
} //isset
?>