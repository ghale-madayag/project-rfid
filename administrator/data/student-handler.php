<?php
    require_once("handler.php");
	
	if (isset($_POST['recent'])) {
        $result = null;
		$sql = $handler->query("SELECT student.stud_no, logs.log_str, logs.log_end,logs.log_num,logs.log_img
        FROM student RIGHT JOIN logs ON student.stud_no = logs.stud_no ORDER BY logs.log_id DESC LIMIT 5");

		while ($row = $sql->fetch(PDO::FETCH_OBJ)) {

			$studnum = $row->stud_no;
			$dateStrVar = date_create($row->log_str);
            $dateStr = date_format($dateStrVar, 'h:i a');
            
            if($row->log_end==NULL){
                $dateEnd = "IN PROCESS...";
            }else{
                $dateEndVar = date_create($row->log_end);
			    $dateEnd = date_format($dateEndVar, 'h:i a');
            }
            
            $img = '<div class="nameImg"><span>'.$row->log_num.'</span></div>';

			 $result[] = array(
                'studnum' => $studnum,
                'desc' => $dateStr ." | ". $dateEnd,
                'img' => $img
			);
		}
		
		echo json_encode($result);
    }else{
		$result = "";
		$sql = $handler->query("SELECT student.stud_no,logs.log_id, logs.log_str, logs.log_end, logs.log_indate
        FROM student RIGHT JOIN logs ON student.stud_no = logs.stud_no ORDER BY logs.log_str DESC");

		while ($row = $sql->fetch(PDO::FETCH_OBJ)) {

			$dateIn = date_create($row->log_indate);
			$indate = date_format($dateIn, 'M d, Y');
			$dateStrVar = date_create($row->log_str);
            $dateStr = date_format($dateStrVar, 'h:i a');
            
           

			if($row->log_end==NULL){
                $dateEnd = "In Process...";
            }else{
                $dateEndVar = date_create($row->log_end);
				$dateEnd = date_format($dateEndVar, 'h:i a');
            }
            

			 $result[] = array(
                'log_id' => $row->log_id,
                'stud_no' => $row->stud_no,
                'str' => $dateStr,
				'end' => $dateEnd,
				'date' => $indate,
			);
		}
		
		echo json_encode($result);
	}
?>