<?php

	$conn = mysqli_connect('localhost', 'root', '', 'webquanlybanhang') or die ('Can not connect to database');
	mysqli_set_charset($conn, 'utf8');
	if(isset($_POST['day1'])){
		$day = $_POST['day'];
		$day1 = $_POST['day1'];
		$d1 =  'AND date(orders.OR_CREATEDDATE) <=' .$day1;
			$sql = "SELECT DISTINCT products.PRO_ID, products.PRO_NAME,products.PRO_PRICE, SUM(orderdetails.OD_QUANTITY) as TOTAL, SUM(products.PRO_PRICE) AS TOTAL_PRICE FROM products,`orderdetails`, orders WHERE orderdetails.`PRO_ID` = products.`PRO_ID` and orders.or_id = orderdetails.or_id and date(orders.OR_CREATEDDATE) BETWEEN '".$day."' AND '".$day1."' GROUP BY products.PRO_ID ";
		// $sql = "SELECT  *  FROM orderdetails INNER JOIN orders ON orderdetails.OR_ID = orders.OR_ID INNER JOIN users ON users.U_ID = orders.U_ID INNER JOIN customers ON customers.CUS_ID = orders.CUS_ID WHERE date(orders.OR_CREATEDDATE) BETWEEN '".$day."' AND '".$day1."'";
		$query = mysqli_query($conn,$sql);
		
		$i = 1;
		while ($row = mysqli_fetch_assoc($query)) {
			echo "<tr>";
			echo "<td>".$row['PRO_ID']."</td>";
			echo "<td>".$row['PRO_NAME']."</td>";
			echo "<td align='right'>".$row['TOTAL']."</td>";
			echo "<td align='right'>".number_format($row['TOTAL_PRICE'])." VNĐ</td>";			
			echo "</tr>";
			
			
		}
				
 
	}
	?>