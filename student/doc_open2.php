<?php 
	 if(isset($_GET['no'])){
	 	$no = $_GET['no'];
	 	  include '../condb.php';
	 	  $stmtDoc = $conn->prepare("
		   SELECT * #ตารางเอามาทุกคอลัมภ์
		   FROM tbl_pdf as f
		   INNER JOIN tbl_chapter as c ON f.cha_id = c.cha_id
		   ORDER BY c.cha_id ASC #เรียงลำดับข้อมูลจากน้อยไปมาก
		   ");
	 	 	$stmtDoc->execute();
         	$result = $stmtDoc->fetchAll();

			foreach
					      $stmt->bindParam(':doc_file', $doc_file , PDO::PARAM_STR);
					      $stmt->execute();
				
					echo "<script type='text/javascript'>";
			        echo "window.location = '../student/docs".$row_doc['doc_file']."';"; //หน้าที่ต้องการให้กระโดดไป      
			        echo "</script>";
			}else{}
		}

			}
		




?>