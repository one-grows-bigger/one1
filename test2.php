<!--?php           

        $conn = mysqli_connect("127.0.0.1","root","apmsetup","kopoa");

        if (mysqli_connect_errno())

{

            echo "연결실패<br-->이유 : " . mysqli_connect_error();

}

        $result = mysqli_query($conn,"SELECT * FROM dblogin

                WHERE CreateDate >= DATE_ADD(NOW(), INTERVAL -3 day) 

                ORDER BY CreateDate DESC;");

        echo "";

        $n = 1;

        while($row = mysqli_fetch_array($result))

{

            echo "<tr>";

            echo "<td>" . $row['gldx'] . "</td>";

            echo "<td>" . $row['uldx'] . "</td>";

            echo "<td>" . $row['gps_lat'] . "</td>";

            echo "<td>" . $row['gps_lon'] . "</td>";

            echo "<td>" . $row['CreateDate'] . "</td>";

            echo "</tr>";

            $n++;

}

?>