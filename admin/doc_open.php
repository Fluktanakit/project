<?php 
	 if(isset($_GET['id'])){
	 	$id = $_GET['id'];
	 	  include 'condb.php';
	 	  $stmtDoc = $conn->prepare("
			SELECT * #ตารางเอามาทุกคอลัมภ์
			FROM tbl_doc_file AS f
			INNER JOIN tbl_type AS t ON f.t_id=t.t_id
			WHERE f.fileID = '$id'
			ORDER BY f.fileID ASC #เรียงลำดับข้อมูลจากน้อยไปมาก
			");
	 	 	$stmtDoc->execute();
         	$result = $stmtDoc->fetchAll();
			foreach ($result as $row_doc) {
				if ($result) {
			
					echo "<script type='text/javascript'>";
			        echo "window.location = 'doc_file/".$row_doc['doc_file']."';"; //หน้าที่ต้องการให้กระโดดไป      
			        echo "</script>";
			}else{}
		}

			}
		




?>