<?php
session_start(); // Start the session at the beginning

$_SESSION['upload_status'] = []; // Initialize session variable

$response = [];
$maxSize = 5 * 1024 * 1024; // 5 MB - make sure this variable is defined




if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['file'])) {
        $file = $_FILES['file'];
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];

        if (!in_array($file['type'], $allowedTypes)) {
            echo json_encode(['error' => 'Invalid file type.']);
            exit;
        }

        if ($file['size'] > $maxSize) {
            echo json_encode(['error' => 'File size is too large.']);
            exit;
        }

        $destination = 'uploads/' . $file['name'];
        if (move_uploaded_file($file['tmp_name'], $destination)) {
            // After a successful move_uploaded_file
            $_SESSION['upload_status'] = ['stage' => 1, 'message' => 'Upload complete!'];
            session_write_close();

            // Now, simulate processing, but release the session lock after each update
            for ($i = 2; $i <= 4; $i++) {
                sleep(2); // simulate a delay for processing
                session_start(); // Re-open the session to write
                $_SESSION['upload_status'] = ['stage' => $i, 'message' => "Processing, stage $i of 4"];
                session_write_close(); // Close the session to commit the changes
            }

            // After processing is complete, update the session with the final data
            session_start();
            $_SESSION['upload_status'] = ['stage' => 5, 'data' => $destination, 'message' => 'Processing complete!'];
            session_write_close();


        } else {
            echo json_encode(['error' => 'Upload failed.']);
            exit;
        }
    }
}
