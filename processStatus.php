<?php
session_start(); // Start the session to read

if (isset($_SESSION['upload_status'])) {
    echo json_encode($_SESSION['upload_status']);
    session_write_close(); // Close the session to release the lock
} else {
    echo json_encode(['stage' => 0, 'message' => 'No process started.']);
    session_write_close(); // Close the session to release the lock
}