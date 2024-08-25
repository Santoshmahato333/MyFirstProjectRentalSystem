<?php
include("../config/config.php");

if(isset($_GET['bid'])) {
    $bid = $_GET['bid'];
    
    // Fetch the current booking details
    $stmt = $db->prepare("SELECT * FROM booking WHERE bid = ?");
    $stmt->bind_param("i", $bid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $booking = $result->fetch_assoc();
    } else {
        echo "No booking found.";
        exit;
    }
    
    $stmt->close();
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get updated details from the form
    $tid = $_POST['tid'];
    $pid = $_POST['pid'];
    
    // Update the booking details
    $stmt = $db->prepare("UPDATE booking SET tid = ?, pid = ? WHERE bid = ?");
    $stmt->bind_param("iii", $tid, $pid, $bid);
    
    if($stmt->execute()) {
        echo "Booking updated successfully.";
        // Redirect to the main page or booking list page
        header("Location: booking-list.php");
    } else {
        echo "Error updating record: " . $db->error;
    }
    
    $stmt->close();
}

$db->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Booking</title>
</head>
<body>
    <h2>Update Booking</h2>
    <form method="POST" action="">
        Tenant ID: <input type="text" name="tid" value="<?php echo $booking['tid']; ?>" required><br>
        Property ID: <input type="text" name="pid" value="<?php echo $booking['pid']; ?>" required><br>
        <input type="submit" value="Update Booking">
    </form>
</body>
</html>
