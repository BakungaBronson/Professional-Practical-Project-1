<?php 

	$host = "127.0.0.1";
	$dbname = "Recess2";
	$pass = "";
	$user = "root";
	$total = 0;
	$string = [];
	$dist_id = "";
	$find = [];

	$conn = mysqli_connect($host,$user,$pass,$dbname);

	if($conn){
		echo "Connection Established<br>";
	}
	else{
		die(mysqli_error($conn));
	}

	$list = [];

	$myfile1 = fopen("/home/bronson/District.txt", "r") or die("Unable to open file!");

		$district = fgets($myfile1);

		$district1 = strtok($district, "\n");
		echo "District: ".$district1."<br>";

	$file = "/home/bronson/".$district1.".txt";

	fclose($myfile1);

	$query3 = "SELECT Name,Signature FROM _agents";

	$result3 = mysqli_query($conn, $query3);

	if(!$result3){
		echo mysqli_error($conn);
	}

	$myfile = fopen($file, "r") or die("Unable to open file!");

	while(!feof($myfile)) {
		$lines = fgets($myfile);

		$total += substr_count($lines, "Signature");

		$newfile = fopen("/home/bronson/Result.txt", "w");

		if($new = strstr($lines, "Signature")){

			$sign = strtok($lines, "-");
			while ($sign !== false)
			{
			array_push($string, $sign);
			$sign = strtok("-");
			} 

			print_r($string);
			echo "<br>";

			while($row = mysqli_fetch_assoc($result3)){
				$name = "{$row['Name']}";
				$password = "{$row['Signature']}";

				if( strcmp($name, $string[1]) == 0 && strncmp($password, $string[2], 1) ==  0){
					echo $name."-Signature match";
					echo "<br>";
					$correct = "All Match";
				}
				else if( strcmp($name, $string[1]) == 0 && strncmp($password, $string[2], 1) !=  0){
					echo $name."-Signature Mismatch";
					echo "<br>";
					$correct = "Not All Match";
				}


			}

			$result3 = mysqli_query($conn, $query3);
			
			if(!$result3){
				echo mysqli_error($conn);
			}

			$string = array();
		}

		fclose($newfile);

	}

	if(isset($correct)){
		echo "Signature Status: ".$correct."<br>";
	}

	echo "Total signatures: ".$total."<br>";

	fclose($myfile);

	$query1 = "SELECT District_Code FROM _districts WHERE District_Name = '{$district1}'";

	$result1 = mysqli_query($conn, $query1);

	if(!$result1){
		echo mysqli_error($conn);
	}

	while($row = mysqli_fetch_assoc($result1)){
		$dist_id = "{$row['District_Code']}";
	}

	$query2 = "SELECT COUNT(id) AS NUM FROM `_agents` WHERE District_Assigned = '{$district1}'";

	$result2 = mysqli_query($conn, $query2);

	if(!$result2){
		echo mysqli_error($conn);
	}

	while($row = mysqli_fetch_assoc($result2)){
		$number = "{$row['NUM']}";
	}

	echo "Number of district Agents: ".$number."<br>";

	$myfile = fopen($file, "r") or die("Unable to open file!");

	while(!feof($myfile)) {
		$lines = fgets($myfile);

		if($total == $number){
			$status = "Complete";
		}
		else{
			$status = "Incomplete";
		}

	  
		if($result = strstr($lines, "Check_status") || $result = strstr($lines, "check_status")){

			if($total == $number){
				echo "File ".$status."<br>";
			}
			else{
				echo "File ".$status."<br>";
			}
		}
		else if($result = strstr($lines, "Search") || $result = strstr($lines, "search")){

			// $myfile6 = fopen("/home/bronson/Result.txt", "a") or die("Unable to open file");

			// $find1 = strtok($lines, " ");
			// while ($find1 !== false)
			// {
			// array_push($find, $find1);
			// $find1 = strtok(" ");
			// } 

			// print_r($find);
			// echo "<br>";

			// if($find[1] == "Name" || $find[1] == "name"){
			// 	echo "Searching Name";
			// 	echo "<br>";

			// 	$firsname = $find[2];
			// 	$lastname = $find[3];

			// 	$query5 = "SELECT * FROM _members";

			// 	$result5 = mysqli_query($conn, $query5);

			// 	if(!$result5){
			// 		echo mysqli_error($conn);
			// 	}

			// 	while($row = mysqli_fetch_assoc($result5)){

			// 		if($final = strstr($firsname, "{$row["Name"]}") && $final = strstr($lastname, "{$row["LNAME"]}")){
			// 			$answer = "Entry Found";
			// 			echo "First Name:{$row['FNAME']} Last Name:{$row['LNAME']} Username:{$row['USERNAME']} Date Added:{$row['DATE']} Gender:{$row['GENDER']} Recommender:{$row['RECOMMENDER']} District Initials:{$row['DISTRICT_ID']}<br>";
			// 			fprintf($myfile6, "Name Search Result\n");
			// 			fprintf($myfile6, "First Name:{$row['FNAME']} ". "Last Name:{$row['LNAME']} ". "Username:{$row['USERNAME']} ". "Date Added:{$row['DATE']} ". "Gender:{$row['GENDER']} ". "District Initials:{$row['DISTRICT_ID']} "."Recommender:{$row['RECOMMENDER']}");
			// 		}
			// 	}
			// 	if(!isset($answer)){
			// 		echo "No such entry<br>";
			// 	}
			// }
			// else if($find[1] == "Date" || $find[1] == "date"){
			// 	echo "Searching Date";
			// 	echo "<br>";

			// 	$search_date = $find[2];

			// 	$query5 = "SELECT * FROM Users WHERE USER_TYPE= 'MEMBER'";

			// 	$result5 = mysqli_query($conn, $query5);

			// 	if(!$result5){
			// 		echo mysqli_error($conn);
			// 	}

			// 	while($row = mysqli_fetch_assoc($result5)){

			// 		if($final = strstr($search_date, "{$row["DATE"]}")){
			// 			$answer = "Entry Found";
			// 			echo "First Name:{$row['FNAME']} Last Name:{$row['LNAME']} Username:{$row['USERNAME']} Date Added:{$row['DATE']} Gender:{$row['GENDER']} Recommender:{$row['RECOMMENDER']} District Initials:{$row['DISTRICT_ID']}<br>";
			// 			fprintf($myfile6, "Date Search Result\n");
			// 			fprintf($myfile6, "First Name:{$row['FNAME']} ". "Last Name:{$row['LNAME']} ". "Username:{$row['USERNAME']} ". "Date Added:{$row['DATE']} ". "Gender:{$row['GENDER']} ". "District Initials:{$row['DISTRICT_ID']} "."Recommender:{$row['RECOMMENDER']}");
			// 		}
			// 	}
			// 	if(!isset($answer)){
			// 		echo "No such entry<br>";
			// 	}
			// }

			// $find = [];

			// fclose($myfile6);
		}
		else if($result = strstr($lines, "Get_statement") || $result = strstr($lines, "get_statement")){
			echo "Get Get_statement Found";
		}
		else if(strcmp($lines, "\n") == 0) {
			;
		}
		else if(substr_count($lines, " ") > 3){

			if($status == "Complete" && $correct == "All Match"){
					// echo $lines."Sub string";
				$token = strtok($lines, " ");
				while ($token !== false)
				{
				array_push($list, $token);
				$token = strtok(" ");
				} 

				$query4 = "SELECT COUNT(id) AS NUM1 FROM `_members` WHERE District = '{$district1}'";

				$result4 = mysqli_query($conn, $query4);

				if(!$result4){
					echo mysqli_error($conn);
				}

				while($row = mysqli_fetch_assoc($result4)){
					$member_no = "{$row['NUM1']}";
					echo "Members In District: ".$member_no;
					echo "<br>";
					
				}

				$member_no += 1;

				$member_id = $dist_id.$member_no;
				$username = $list[0].$list[1];
				$date = $list[2];
				$gender = $list[3];
				$recommender = $list[4];
				$usert = "MEMBER";
		
				$query = "INSERT INTO `_members` (`MemberID`, `Name`,`Sex`, `Recommended_By`,`District`,`Contact`,`Agent`) VALUES ('{$member_id}', '{$username}', '{$gender}', '{$recommender}','{$district1}',0,'Default')";

				$result = mysqli_query($conn, $query);

				if(!$result){
					echo mysqli_error($conn);
				}

				echo "<br>";
				echo "Information Successfully added<br>";
				$clean = "Yes";
				}
				else{
					echo "Information Not Added<br>";
					$clean = "No";
				}

				$list = [];
		}


	}
	fclose($myfile);

	if(isset($clean)){
		if($clean == "Yes"){
		$wipe = fopen($file, "w");
		fclose($wipe);
		}
	}
	

 ?>