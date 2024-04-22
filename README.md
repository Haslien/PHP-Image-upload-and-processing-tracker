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
