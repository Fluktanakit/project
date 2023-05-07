<?php 
	 if(isset($_GET['id'])){
	 	$id = $_GET['id'];
	 	  include '../condb.php';
	 	  $stmtDoc = $conn->prepare("
			SELECT * #ตารางเอามาทุกคอลัมภ์
			FROM tbl_sdoc_file AS f
			INNER JOIN tbl_department AS d ON f.d_id=d.d_id
			WHERE f.sfileID = '$id'
			ORDER BY f.sfileID ASC #เรียงลำดับข้อมูลจากน้อยไปมาก
			");
	 	 	$stmtDoc->execute();
         	$result = $stmtDoc->fetchAll();

			foreach ($result as $row_doc) {
				if ($result) {
					$qty = $row_doc['qty']+1;
					   $stmt = $conn->prepare("UPDATE tbl_sdoc_file SET qty=$qty WHERE sfileID='$id'");
					      $stmt->bindParam(':sfileID', $sfileID , PDO::PARAM_STR);
					      $stmt->execute();
				
					echo "<script type='text/javascript'>";
			        echo "window.location = 's_doc/".$row_doc['s_doc']."';"; //หน้าที่ต้องการให้กระโดดไป      
			        echo "</script>";
			}else{}
		}

			}
		




?>