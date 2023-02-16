<html>
<head>
	<title></title>
</head>
<body>
	<?php 
	include 'koneksi.php';
	?>
 
	<table border="1" style="width: 100%">
		<tr>
			<th>No</th>
			<th>Customer Name</th>
			<th>Project Id</th>
			<th>Customer Id</th>
            <th>Project Date</th>
            <th>Deadline</th>
		</tr>
		<?php 
		$no = 1;
		$sql = mysqli_query($koneksi,"select * from tr_project");
		while($data = mysqli_fetch_array($sql)){
		?>
		<tr>
			<td><?php echo $no++; ?></td>
			<td><?php echo $data['customer name']; ?></td>
			<td><?php echo $data['project id']; ?></td>
			<td><?php echo $data['customer id']; ?></td>
            <td><?php echo $data['project date']; ?></td>
            <td><?php echo $data['deadline']; ?></td>
		</tr>
		<?php 
		}
		?>
	</table>
 
	<script>
		window.print();
	</script>
 
</body>
</html>