<?php
    require_once('../administrator/data/handler.php');

    if (isset($_POST['studentAll'])) {
        $result = null;
		$sql = $handler->query("SELECT student.stud_no, logs.log_str, logs.log_end,logs.log_num,logs.log_img
        FROM student RIGHT JOIN logs ON student.stud_no = logs.stud_no WHERE log_id < (SELECT MAX(log_id) FROM logs) && DATE(logs.log_indate)=CURDATE() ORDER BY logs.log_id DESC");

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
                'str' => $dateStr,
                'end' => $dateEnd,
                'img' => $img
			);
		}
		
		echo json_encode($result);
    }elseif (isset($_POST['student'])) {
        
        
        $result = null;
		$sql = $handler->query("SELECT student.stud_no,logs.log_str, logs.log_end, logs.log_num, logs.log_img
        FROM student RIGHT JOIN logs ON student.stud_no = logs.stud_no WHERE DATE(logs.log_indate)=CURDATE() ORDER BY logs.log_id DESC LIMIT 1");

		while ($row = $sql->fetch(PDO::FETCH_OBJ)) {

			$studnum = $row->stud_no;
			$dateStrVar = date_create($row->log_str);
            $dateStr = date_format($dateStrVar, 'h:i a');
            
            $dateEndVar = date_create($row->log_end);
			$dateEnd = date_format($dateEndVar, 'h:i a');

            $img = '<span class="profileImg">'.$row->log_num.'</span>';

			 $result[] = array(
                'studnum' => $studnum,
                'str' => $dateStr,
                'img' => $img

			);
		}
		
		echo json_encode($result);
    }elseif(isset($_POST['studentNum'])){
        $date = new DateTime("now", new DateTimeZone('Asia/Taipei') );
        $now = $date->format('Y-m-d H:i:s');
        //check the number
        $sql = $handler->query("SELECT log_num FROM logs WHERE DATE(logs.log_indate)=CURDATE() ORDER BY logs.log_id DESC LIMIT 1");
        //check the user
        $sqlUsr = $handler->prepare("SELECT stud_no FROM logs WHERE DATE(logs.log_indate)=CURDATE() AND stud_no=?");
        $sqlUsr->execute(array($_POST['studentNum']));

        if ($sql->rowCount()) {
            //saved the value
            $row = $sql->fetch(PDO::FETCH_OBJ);
            $last_num = $row->log_num;
            $convert = $last_num + 1;
		}else{
            $convert = 1;
        }

        if($sqlUsr->rowCount()){
            //echo 1;
           

            $sql = $handler->prepare("UPDATE logs SET log_end=? WHERE stud_no=? AND DATE(logs.log_indate)=CURDATE()");
            $sql->execute(array($now,$_POST['studentNum']));

            echo 2;
        }else{
            //check the user is valid
            $sql = $handler->prepare("SELECT stud_no FROM student WHERE stud_no=?");
            $sql->execute(array($_POST['studentNum']));

            if ($sql->rowCount()) {
                $sql = $handler->prepare("INSERT INTO logs(`stud_no`,`log_str`,`log_num`,`log_indate`) VALUES(?,?,?,?)");
                $sql->execute(array($_POST['studentNum'],$now,$convert,$now));

                echo 1;
            }else{
               echo 0;
            }


        }
    }

?>