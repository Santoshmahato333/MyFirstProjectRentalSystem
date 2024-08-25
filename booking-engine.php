<?php 
 if(!isset($_SESSION)) 
 { 
     session_start(); 
 } 
 if (isset($_SESSION['tid'])) {

include("config/config.php");

if(isset($_POST['book_property'])){
	

if(isset($_SESSION["email"])){

	global $db,$property_id;
  $u_email=$_SESSION["email"];

$property_id=$_GET['property_id'];
  
$sql="SELECT tenant.email as s, tenant.phone_no as tp, owner.full_name as rn, owner.email as r, tenant.full_name as sn from tenant, add_property 
join owner on owner.owner_id = add_property.owner_id 
where tenant.tenant_id = ".$_SESSION['tid']." and add_property.property_id = ".$_GET['property_id'].";";
// echo $sql; 
$query=mysqli_query($db,$sql);

    if(mysqli_num_rows($query)>0)
    {
      while ($rows=mysqli_fetch_assoc($query)) {
        $tenant_id=$_SESSION['tid'];
        
      	$sql2="INSERT INTO booking(tid,pid) VALUES ($tenant_id, $property_id )";
        // echo $sql2;
        // die;
      	$query2=mysqli_query($db,$sql2);

      	if($query2)
        // { echo 'done'; 

                $msg="Thankyou Mr/Ms ".$rows['sn']." for booking Property. Please visit the property location to view it personally.";
                $mailheaders="From: RentHouse\n";
                $sn= $rows['sn'];
                $rn= $rows['rn'];
                // $message = 

                //mail send

                $s = $rows['s'];
                $r = $rows['r'];
                $sr= 'Tenant';
                  $rr= 'Owner';
                  header("Location: ./lib/mailer.php?s=".urlencode($s)."&r=".urlencode($r)."&sr=".urlencode($sr)."&rr=".$rr."&sn=".$sn."&rn=".$rn."");
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
  <center><strong>Thankyou for booking this property.</strong></center>
</div></div>



		<?php





		}

      }

      
      

} else {
  echo 'not done';
}
}



if(isset($_POST['cancel_booking'])){
	

  if(isset($_SESSION["email"])){
    
    global $db,$property_id;
    $u_email=$_SESSION["email"];
    $sql="SELECT tenant.email as s, tenant.phone_no as tp, owner.full_name as rn, owner.email as r, tenant.full_name as sn from tenant, add_property 
join owner on owner.owner_id = add_property.owner_id 
where tenant.tenant_id = ".$_SESSION['tid']." and add_property.property_id = ".$_GET['property_id'].";";
// echo $sql; 
$query=mysqli_query($db,$sql);

    if(mysqli_num_rows($query)>0)
    {
      $rows=mysqli_fetch_assoc($query);
  $property_id=$_GET['property_id'];
  
          $tenant_id=$_SESSION['tid'];
          $sql2="delete from booking where tid = $tenant_id and pid = $property_id and (current_timestamp - start_date < 86400)";
          echo $sql2;
          // die;
          $query2=mysqli_query($db,$sql2);
  
          if($query2)
      // { echo 'done'; 
  
                  $msg="Mr/Ms ".$rows['sn']." ! This booking has been cancelled by ".$rows['rn'];
                  $mailheaders="From: RentHouse\n";
                  $sn= $rows['sn'];
                  $rn= $rows['rn'];
                  // $message = 
  
                  //mail send
  
                  $s = $rows['s'];
                  $r = $rows['r'];
                  $sr= 'Tenant';
                  $rr= 'Owner';
                  $message = "By : $sn (Tenant)\n Email : $s\n Please visit your Owner Profile to see more details! Or contact the Teanant via email we have provided you with!\n\n Thank you for using RentHouse! \n\n We are Happy to be at your service!";
                  ?>
                  <form style="display: none;" id="cancel-booking" action="<?php echo "./lib/mailer.php?s=".urlencode($s)."&r=".urlencode($r)."&sr=".urlencode($sr)."&rr=".$rr."&sn=".$sn."&rn=".$rn?>" method="POST">
                    <input type="text" name="subject" value="Booking Cancelled!">
                    <input type="text" name="message" value="<?php echo " Please visit your Owner Profile to see more details! Or contact the Teanant via email we have provided you with!<br><br> Thank you for using RentHouse! <br> We are Happy to be at your service!"?>">
                    <button>Submit</button>
                  </form>
                  <?php
                
                  // header("Location: ./lib/mailer.php?s=".urlencode($s)."&r=".urlencode($r)."&sr=".urlencode($sr)."&rr=".$rr."&sn=".$sn."&rn=".$rn);
        }  ?>
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
  
        
  
    
  
  
  } else {
    // echo 'not done';
  }
  
 }
?>