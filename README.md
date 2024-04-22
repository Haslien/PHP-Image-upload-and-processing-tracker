# PHP Image Upload and Processing Tracker

This PHP-based project provides a robust solution for uploading images through a web interface, validating their type and size, and displaying real-time upload progress and processing status. It is designed to enhance user experience by providing immediate feedback during the file upload and processing stages.

## Features

- **Image Validation**: Ensures that only images of specific types (JPEG, PNG, GIF) and sizes (up to 5 MB) are accepted, preventing inappropriate uploads.
- **Asynchronous Upload**: Utilizes `XMLHttpRequest` to upload images asynchronously, allowing the webpage to remain responsive and inform the user of the upload progress in real-time.
- **Real-Time Progress Feedback**: Displays the upload progress in percentage to keep the user informed about the status of their upload.
- **Processing Status Updates**: Simulates image processing in stages, with status updates provided at each stage until completion.
- **Final Output with Link**: Upon completion of the processing, provides a link to the uploaded and processed image, making it easily accessible to the user.

## Technologies Used

- **PHP**: Handles server-side logic including file upload, session management, and processing simulation.
- **JavaScript (with jQuery)**: Manages client-side interactions, asynchronous requests, and UI updates.
- **HTML/CSS**: Provides the structure and style of the web interface.

## How It Works

1. **User Interaction**: The user selects an image file and submits it via a web form.
2. **Server-Side Validation**: The server checks the file type and size. If the file meets the criteria, it proceeds with the upload; otherwise, it returns an error.
3. **File Upload and Storage**: The file is uploaded to the server and stored in a designated directory.
4. **Processing Simulation**: The server simulates processing of the image in predefined stages, updating the session status after each stage.
5. **Client-Side Monitoring**: The client periodically requests the current processing status from the server and updates the UI accordingly.
6. **Completion Notification**: Once processing is complete, the server updates the session with a final message and a link to the processed image, which is then displayed to the user.

This project is ideal for developers looking for a simple yet effective way to implement image uploads with real-time status updates in their web applications.

## Components

### 1. Frontend Interface (`index.php`)

- **HTML Form for Upload:** Users can submit images via an HTML form (`#uploadForm`). This form includes a file input and a submit button.
- **JavaScript for Async Upload and Status Checking:** Prevents the default form submission to use `FormData` for sending the file asynchronously with `XMLHttpRequest`.
- **Progress and Status Display:** Uses `xhr.upload.onprogress` event handler to show upload progress as a percentage. Simultaneously, it begins to periodically check the processing status by calling `processStatus.php`.

### 2. Upload Handler (`uploadHandler.php`)

- **Session Management:** Initiates a session to store the upload status, including stages and messages.
- **File Validation:** Checks if the uploaded file is an allowed type (JPEG, PNG, GIF) and does not exceed the size limit (5 MB).
- **File Storage:** Moves the uploaded file to a designated directory (`uploads/`).
- **Processing Simulation:** Simulates processing steps post-upload. It updates the session variable `upload_status` at various stages (from stage 2 to 4), each followed by a simulated delay of 2 seconds. After processing, it updates the session with the final status and a link to the processed file.

### 3. Processing Status (`processStatus.php`)

- **Session Read:** Retrieves the current status from the session (`upload_status`), which includes the stage and message.
- **Status Response:** Sends the status back as a JSON object to the frontend, allowing UI updates based on processing progress.

## Summary

- **Image Upload:** Users select and submit an image through the form. The upload process is handled asynchronously.
- **Validation and Storage:** The server validates the file type and size, storing it if the criteria are met.
- **Progress Monitoring:** The client continually checks the status of the upload and processing by querying `processStatus.php`.
- **Processing Simulation:** Simulated processing updates are executed on the server, which are then communicated back to the client.
- **Completion and Link:** Once processing is complete, a link to the processed image is presented to the user.
