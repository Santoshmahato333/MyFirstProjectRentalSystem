<?php 
$property_id='';
$country='';
$province='';
$zone='';
$district='';
$city='';
$vdc_municipality='';
$ward_no='';
$tole='';
$contact_no='';
$property_type='';
$estimated_price='';
$total_rooms='';
$bedroom='';
$living_room='';
$kitchen='';
$bathroom='';
$description='';
$latitude='';
$longitude='';
$booked='';
$owner_id='';



$db = new mysqli('localhost','root','','renthouse');

if($db->connect_error){
	echo "Error connecting database";
}

if(isset($_POST['add_property'])){
	add_property();
}

if(isset($_POST['owner_update'])){
	owner_update();
}
if(isset($_POST['cancel_booking'])){
	cancel_booking($_POST['bid']);
}
if(isset($_POST['delete_property'])){
	delete_property($_POST['pid']);
}
if(isset($_POST['update_property'])){
	update_property();
}
function add_property(){

	global $property_id,$country,$province,$zone,$district,$city,$vdc_municipality,$ward_no,$tole,$contact_no,$property_type,$estimated_price,$total_rooms,$bedroom,$living_room,$kitchen,$bathroom,$description,$latitude,$path,$p_photo,$property_photo_id,$longitude,$owner_id,$booked,$db;



	
	$country=validate($_POST['country']);
	$province=validate($_POST['province']);
	$zone=validate($_POST['zone']);
	$district=validate($_POST['district']);
	$city=validate($_POST['city']);
	$vdc_municipality=validate($_POST['vdc_municipality']);
	$ward_no=validate($_POST['ward_no']);
	$tole=validate($_POST['tole']);
	$contact_no=validate($_POST['contact_no']);
	$property_type=validate($_POST['property_type']);
	$estimated_price=validate($_POST['estimated_price']);
	$total_rooms=validate($_POST['total_rooms']);
	$bedroom=validate($_POST['bedroom']);
	$living_room=validate($_POST['living_room']);
	$kitchen=validate($_POST['kitchen']);
	$bathroom=validate($_POST['bathroom']);
	$description=validate($_POST['description']);
	$latitude=validate($_POST['latitude']);
   	$longitude=validate($_POST['longitude']);
   	$booked='No';
   	$u_email=$_SESSION['email'];
        $sql1="SELECT * from owner where email='$u_email'";
        $result1=mysqli_query($db,$sql1);

        if(mysqli_num_rows($result1)>0)
      {
          while($rowss=mysqli_fetch_assoc($result1)){
            $owner_id=$rowss['owner_id'];

   	$sql = "INSERT INTO add_property(country,province,zone,district,city,vdc_municipality,ward_no,tole,contact_no,property_type,estimated_price,total_rooms,bedroom,living_room,kitchen,bathroom,description,latitude,longitude,owner_id) VALUES('$country','$province','$zone','$district','$city','$vdc_municipality','$ward_no','$tole','$contact_no','$property_type','$estimated_price','$total_rooms','$bedroom','$living_room','$kitchen','$bathroom','$description','$latitude','$longitude','$owner_id')";
	// echo $sql; die;	
	$query=mysqli_query($db,$sql);

		$property_id = mysqli_insert_id($db);

		$countfiles = count($_FILES['p_photo']['name']);
	
	for($i=0;$i<$countfiles;$i++){
	$paths = $_FILES['p_photo']['tmp_name'][$i];
		  if($paths!="")
			{
		    	$path="product-photo/" . $_FILES['p_photo']['name'][$i];
				if(move_uploaded_file($paths, $path)) {
		        $sql2 = "INSERT INTO property_photo(p_photo,property_id) VALUES('$path','$property_id')";
				$query=mysqli_query($db,$sql2);

			}}
 
 }
		if(!empty($query)){
			
?>

<style>
.alert {
  padding: 20px;
  background-color: #DC143C;
  color: white;
}

.closebtn {
  margin-left: 15px;
  color: white;
  font-weight: bold;
  float: right;
  font-size: 22px;
  line-height: 20px;
  cursor: pointer;
  transition: 0.3s;
}

.closebtn:hover {
  color: black;
}
</style>
<script>
	window.setTimeout(function() {
    $(".alert").fadeTo(1000, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 2000);
</script>
<div class="container">
<div class="alert" role='alert'>
  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
  <center><strong>Your Product has been uploaded.</strong></center>
</div></div>


<?php
		}
		else{
			echo "error";
		}

}
}}

function owner_update(){
	global $owner_id,$full_name,$email,$password,$phone_no,$address,$id_type,$id_photo,$errors,$db;
	$owner_id=validate($_POST['owner_id']);
	$full_name=validate($_POST['full_name']);
	$email=validate($_POST['email']);
	$phone_no=validate($_POST['phone_no']);
	$address=validate($_POST['address']);
	$id_type=validate($_POST['id_type']);
	$password = md5($password); // Encrypt password
		$sql = "UPDATE owner SET full_name='$full_name',email='$email',phone_no='$phone_no',address='$address',id_type='$id_type' WHERE owner_id='$owner_id'";
		$query=mysqli_query($db,$sql);
		if(!empty($query)){
			?>

<style>
.alert {
  padding: 20px;
  background-color: #DC143C;
  color: white;
}

.closebtn {
  margin-left: 15px;
  color: white;
  font-weight: bold;
  float: right;
  font-size: 22px;
  line-height: 20px;
  cursor: pointer;
  transition: 0.3s;
}

.closebtn:hover {
  color: black;
}
</style>
<script>
	window.setTimeout(function() {
    $(".alert").fadeTo(1000, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 2000);
</script>
<div class="container">
<div class="alert" role='alert'>
  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
  <center><strong>Your Information has been updated.</strong></center>
</div></div>


<?php
	}
}


function validate($data){
	$data = trim($data);
	$data = stripcslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}


function cancel_booking($bid) {
	if (!empty($bid)) {

		global $db;
		// if ($query) {
			
			$sql2 = "SELECT tenant.email as r, owner.phone_no as op, owner.full_name as sn, owner.email as s, tenant.full_name as rn from tenant, add_property 
      join owner on owner.owner_id = add_property.owner_id 
      where tenant.tenant_id = (SELECT tid from booking where bid = $bid) and add_property.property_id = (SELECT pid from booking where bid = $bid)";
			// echo $sql; die;
			$result = mysqli_query($db, $sql2);
			if($result->num_rows >0)
			{
				$rows=mysqli_fetch_assoc($result);
				
				$msg="Mr/Ms ".$rows['rn']." ! This booking has been cancelled by ".$rows['sn'];
				$mailheaders="From: RentHouse\n";
				$sn= $rows['sn'];
				$rn= $rows['rn'];
				// $message = 
				
				//mail send
				
				$s = $rows['s'];
				$r = $rows['r'];
				$sr= 'Owner';
				$rr= 'Tenant';
				$message = "By : $sn (Owner)\n Email : $s\n Please visit your Owner Profile to see more details! Or contact the Teanant via email we have provided you with!\n\n Thank you for using RentHouse! \n\n We are Happy to be at your service!";
				
				$sql = "DELETE FROM booking where bid = $bid ";
				$query=mysqli_query($db,$sql);
				// echo "../lib/mailer.php?s=".urlencode($s)."&r=".urlencode($r)."&sr=".urlencode($sr)."&rr=".$rr."&sn=".$sn."&rn=".$rn;
			  ?>
			  <form style="display: none;" id="cancel-booking" action="<?php echo "../lib/mailer.php?s=".urlencode($s)."&r=".urlencode($r)."&sr=".urlencode($sr)."&rr=".$rr."&sn=".$sn."&rn=".$rn?>" method="POST">
			  <input type="text" name="subject" value="Booking Cancelled by the Owner!">
			  <input type="text" name="message" value="<?php echo " Please contact the owner for more details via email we have provided you with!<br><br> Thank you for using RentHouse! <br> We are Happy to be at your service!"?>">
			  <button>Submit</button>
			</form>
			<?php
			
			// header("Location: ./lib/mailer.php?s=".urlencode($s)."&r=".urlencode($r)."&sr=".urlencode($sr)."&rr=".$rr."&sn=".$sn."&rn=".$rn);
			// }  ?>
	<script>
		document.getElementById('cancel-booking').submit();
		</script>
			
			<style>
				.alert {
			  padding: 20px;
			  background-color: #DC143C;
			  color: white;
			}
			
			.closebtn {
			  margin-left: 15px;
			  color: white;
			  font-weight: bold;
			  float: right;
			  font-size: 22px;
			  line-height: 20px;
			  cursor: pointer;
			  transition: 0.3s;
			}
			
			.closebtn:hover {
			  color: black;
			}
			</style>
			<script>
				window.setTimeout(function() {
				$(".alert").fadeTo(1000, 0).slideUp(500, function(){
					$(this).remove(); 
				});
			}, 2000);
			</script>
			<div class="container">
			<div class="alert" role='alert'>
			  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
			  <center><strong>Booking has been cancelled successfully!</strong></center>
			</div></div>
			
			
			<?php
			
		}
	}
}

function delete_property($pid) {
	global $db;
	$sql = "DELETE FROM add_property WHERE property_id = $pid";
	if (mysqli_query($db, $sql)) {
		?>
			<script>
		document.getElementById('cancel-booking').submit();
		</script>
			
			<style>
				.alert {
			  padding: 20px;
			  background-color: #DC143C;
			  color: white;
			}
			
			.closebtn {
			  margin-left: 15px;
			  color: white;
			  font-weight: bold;
			  float: right;
			  font-size: 22px;
			  line-height: 20px;
			  cursor: pointer;
			  transition: 0.3s;
			}
			
			.closebtn:hover {
			  color: black;
			}
			</style>
			<script>
				window.setTimeout(function() {
				$(".alert").fadeTo(1000, 0).slideUp(500, function(){
					$(this).remove(); 
				});
			}, 2000);
			</script>
			<div class="container">
			<div class="alert" role='alert'>
			  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
			  <center><strong>Property deleted successfully!</strong></center>
			</div></div>
			
		<?php
	} else {

		
	?>
	<script>
		document.getElementById('cancel-booking').submit();
		</script>
			
			<style>
				.alert {
			  padding: 20px;
			  background-color: #DC143C;
			  color: white;
			}
			
			.closebtn {
			  margin-left: 15px;
			  color: white;
			  font-weight: bold;
			  float: right;
			  font-size: 22px;
			  line-height: 20px;
			  cursor: pointer;
			  transition: 0.3s;
			}
			
			.closebtn:hover {
			  color: black;
			}
			</style>
			<script>
				window.setTimeout(function() {
				$(".alert").fadeTo(1000, 0).slideUp(500, function(){
					$(this).remove(); 
				});
			}, 2000);
			</script>
			<div class="container">
			<div class="alert" role='alert'>
			  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
			  <center><strong>Property couldn't be deleted!</strong></center>
			</div></div>
			
<?php } 
}


function update_property() {
	global $db;
	$sql = "UPDATE add_property
	SET 
		country = '". $_POST['country']."',
		province = '". $_POST['province']."',
		`zone` = '". $_POST['zone']."',
		district = '". $_POST['district']."',
		city = '". $_POST['city']."',
		vdc_municipality = '". $_POST['vdc_municipality']."',
		ward_no = '". $_POST['ward_no']."',
		tole = '". $_POST['tole']."',
		contact_no = '". $_POST['contact_no']."',
		property_type = '". $_POST['property_type']."',
		estimated_price = '". $_POST['estimated_price']."',
		total_rooms = '". $_POST['total_rooms']."',
		bedroom = '". $_POST['bedroom']."',
		living_room = '". $_POST['living_room']."',
		kitchen = '". $_POST['kitchen']."',
		bathroom = '". $_POST['bathroom']."',
		description = '". $_POST['description']."',
		latitude = '". $_POST['latitude']."',
		longitude = '". $_POST['longitude']."'
	WHERE property_id = ". $_POST['property_id'];
	// echo $sql; 
	if (mysqli_query($db, $sql)) {
		?>
			<script>
		document.getElementById('cancel-booking').submit();
		</script>
			
			<style>
				.alert {
			  padding: 20px;
			  background-color: #DC143C;
			  color: white;
			}
			
			.closebtn {
			  margin-left: 15px;
			  color: white;
			  font-weight: bold;
			  float: right;
			  font-size: 22px;
			  line-height: 20px;
			  cursor: pointer;
			  transition: 0.3s;
			}
			
			.closebtn:hover {
			  color: black;
			}
			</style>
			<script>
				window.setTimeout(function() {
				$(".alert").fadeTo(1000, 0).slideUp(500, function(){
					$(this).remove(); 
				});
			}, 2000);
			</script>
			<div class="container">
			<div class="alert" role='alert'>
			  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
			  <center><strong>Property updated successfully!</strong></center>
			</div></div>
			
		<?php
	} else {

		
	?>
	<script>
		document.getElementById('cancel-booking').submit();
		</script>
			
			<style>
				.alert {
			  padding: 20px;
			  background-color: #DC143C;
			  color: white;
			}
			
			.closebtn {
			  margin-left: 15px;
			  color: white;
			  font-weight: bold;
			  float: right;
			  font-size: 22px;
			  line-height: 20px;
			  cursor: pointer;
			  transition: 0.3s;
			}
			
			.closebtn:hover {
			  color: black;
			}
			</style>
			<script>
				window.setTimeout(function() {
				$(".alert").fadeTo(1000, 0).slideUp(500, function(){
					$(this).remove(); 
				});
			}, 2000);
			</script>
			<div class="container">
			<div class="alert" role='alert'>
			  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
			  <center><strong>Property couldn't be deleted!</strong></center>
			</div></div>
			
<?php } 
}

 ?>

