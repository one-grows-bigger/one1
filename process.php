<?php
	try{
		//데이터 베이스 로그인
		$dbh = new PDO('mysql:host=localhost;dbname=gps', 'root', '111111', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

		//쿼리문 실행
		$stmt = $dbh->prepare("SELECT P.id, P.name, G.g_longitude, G.g_lagitude FROM  person P, gps G WHERE P.id = G.g_id");
		$stmt->execute();
		// 쿼리문의 결과값에서 열 수를 저장한다. 
		$total_record = $stmt->rowCount();

		// 연관 배열을 저장할 배열 변수
		$result_array = array();

		//출력문(fetch 반복 구조)
		while($row=$stmt->fetch()) {

			$row_array = array(
				"id" =>  $row['id'],									// ID 값을 가져온다.
				"name" => $row['name'],								// 이름 값을 가져온다.
				"longitude" => $row['g_longitude'],					// 위도 값을 가져온다.
				"lagitude" => $row['g_lagitude']						// 경도 값을 가져온다.
				);
			array_push($result_array,$row_array);				// 스택 형식으로 데이터 값을 result_array배열에 row_array값을 저장한다.
		}

		// 위에서 얻은 결과를 다시 연관 배열로 변환 왜냐하면 Json형식으로 변경해야하기 때문
		$arr = array(
		  //"status" => "OK",									// 이부분은 그저 상태를 출력
		  //"num_result" => "$total_record",					// 이 부분은 배열의 총 값을 같이 저장하는데 굳이 필요없다. 왜냐하면 안드로이드에서 확인 가능
		  "results" => $result_array							// 디비에 저장되어 있는 값을 불러온다.
		  );

		// JSON형식으로 인코딩을 한다.
		$json_array = json_encode($arr);
		 
		// JSON배열을 페이지에 출력한다.
		print_r($json_array);

		$dbh = null;	//데이터 베이스 종료
	}
	catch(PDOExceprion $e){		// 오류 처리
		echo $e->getMessage();
	}

?>