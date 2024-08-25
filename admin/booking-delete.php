<?php
include("../config/config.php");

if(isset($_GET['bid'])) {
    $bid = $_GET['bid'];
    
    // Prepare SQL statement to prevent SQL injection
    $stmt = $db->prepare("DELETE FROM booking WHERE bid = ?");
    $stmt->bind_param("i", $bid);
    
    if($stmt->execute()) {
        echo "Booking deleted successfully.";
        // Redirect to the main page or booking list page
        header("Location: admin-index.php");
    } else {
        echo "Error deleting record: " . $db->error;
    }
    
    $stmt->close();
}

$db->close();
?>
