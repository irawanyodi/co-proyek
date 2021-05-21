<?php 
if (isset($_GET['kode'])) {
	$sql_cek="SELECT * FROM store WHERE id='".$_GET['kode']."'";
	$query_cek = mysqli_query($koneksi, $sql_cek);
  $data_cek = mysqli_fetch_array($query_cek, MYSQLI_ASSOC);
  $b=$data_cek['status'];
}
function active_radio_button($value,$input){
	$result=$value==$input?'checked':'';
	return $result;
}
$target='dist/img/store/';
$cek_sql="SELECT * FROM client";
$cek_query=mysqli_query($koneksi, $cek_sql);

 ?>
<div class="head">
	<div class="tittle">
		<p>Edit Store</p>
	</div>
</div>
<div class="cont-add-store">
	<form action="" method="POST" enctype="multipart/form-data">
		<input type="hidden" name="id" readonly value="<?= $data_cek['id']; ?>">
		<div class="input">
			<div class="col">
				<label for="name">Name</label>
				<input type="text" name="name" id="name" placeholder="type name here" value="<?=$data_cek['name']; ?>">
			</div>
			<div class="col">
				<label for="address">Address</label>
				<textarea id="address" name="address" placeholder="type address here"><?=$data_cek['address']; ?></textarea>
			</div>
			<div class="col">
				<label for="contact">Phone Number</label>
				<input type="text" name="phone_number" id="contact" placeholder="type phonenumber here" value="<?=$data_cek['phone_number']; ?>">
			</div>
			<div class="col">
				<label for="id_client">Client Name</label>
				<select name="id_client" id="id_client">
					<option>--pilih client dibawah ini--</option>
					<?php while ($a=mysqli_fetch_array($cek_query)): ?>
						<option value="<?= $a['id']; ?>" <?= $data_cek['id_client']==$a['id']?'selected':''?>>
							<?= $a['name_c']; ?>
						</option>						
					<?php endwhile ?>
				</select>
			</div>
			<div class="col">
				<label for="image">Profile Image</label>
				<input type="file" name="image" id="image">
				<img width="100px" src="<?= $target.$data_cek['image']; ?>">
			</div>
			<div class="col2">
				<div class="tittle">
					<p>choose store status here</p>
				</div>
				<div class="radio">
					<input type="radio" name="status" value="active" id="active" <?= active_radio_button("active", $b) ?>>
					<label for="active">Active</label>
				</div>
				<div class="radio">
					<input type="radio" name="status" value="deactive" id="deactive" <?= active_radio_button("deactive", $b) ?>>
					<label for="deactive">Deactive</label>
				</div>
			</div>
		</div>
		<div class="button">
			<a href="?page=data-store">Cancel</a>
			<input type="submit" name="save" value="Save">
		</div>
	</form>
</div>

<?php 

if (isset ($_POST['save'])){

	$rand=rand();
	$ekstensi=array('png', 'PNG', 'jpg', 'JPG', 'jpeg', 'JPEG');
	$file_name=$_FILES['image']['name'];
	$ukuran=$_FILES['image']['size'];
	$temp=$_FILES['image']['tmp_name'];
	$ext=pathinfo($file_name, PATHINFO_EXTENSION);
	$target='dist/img/store/';

	if (!empty($temp)) {
		if (!in_array($ext, $ekstensi)) {
			header("location:index.php?page=data-store&alert=ext");
		} elseif (in_array($ext, $ekstensi)) {
			if ($ukuran<=5000000) {
				
				$foto=$data_cek['image'];
				if (file_exists($target.$foto)) {
					unlink($target.$foto);
				}

				$image=$rand.'_'.$file_name;
				move_uploaded_file($temp, $target.$image);

				$sql_ubah = "UPDATE store SET
			   name='".$_POST['name']."',
			   address='".$_POST['address']."',
			   phone_number='".$_POST['phone_number']."',
			   status='".$_POST['status']."',
			   id_client='".$_POST['id_client']."',
			   image='$image'   
			   WHERE id='".$_POST['id']."'"
				;
			  $query_ubah = mysqli_query($koneksi, $sql_ubah);
			  mysqli_close($koneksi);
			  if ($query_ubah) {
			  	echo "
			  		<script>
							alert('Edit Data Berhasil!');
							document.location.href = 'index.php?page=data-store';
						</script>
					";
			  } else {
			  	echo "
			  		<script>
							alert('Edit Data Gagal!');
							document.location.href = 'index.php?page=data-store';
						</script>
					";
			  }
			} elseif ($ukuran>5000000) {
				header("location:index.php?page=data-store&alert=size");
			}
		}
	} elseif (empty($temp)){
		$sql_ubah = "UPDATE store SET
	   name='".$_POST['name']."',
	   address='".$_POST['address']."',
	   phone_number='".$_POST['phone_number']."',
	   status='".$_POST['status']."',
	   id_client='".$_POST['id_client']."'   
	   WHERE id='".$_POST['id']."'"
   ;
	  $query_ubah = mysqli_query($koneksi, $sql_ubah);
	  mysqli_close($koneksi);

	  if ($query_ubah) {
	  	echo "
	  		<script>
					alert('Edit Data Berhasil!');
					document.location.href = 'index.php?page=data-store';
				</script>
			";
	  } else {
	  	echo "
	  		<script>
					alert('Edit Data Gagal!');
					document.location.href = 'index.php?page=data-store';
				</script>
			";
	  }
	}
}