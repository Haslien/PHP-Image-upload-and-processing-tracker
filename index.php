<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Image Upload</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
$(document).ready(function() {
    var checkStatusInterval;

    function checkStatus() {
        $.ajax({
            url: 'processStatus.php',
            type: 'GET',
            success: function(response) {
                var status = JSON.parse(response);
                $('#progress').text(status.message);
                if (status.stage >= 4) { // Assuming 4 is your last stage
                    clearInterval(checkStatusInterval);
                    if (status.data) {
                        $('#progress').html(`<a href="${status.data}">${status.message}</a>`);
                    }
                }
            }
        });
    }

    $('#uploadForm').on('submit', function(e) {
        e.preventDefault();
        var formData = new FormData(this);

        // Start checking the status of the processing
        checkStatusInterval = setInterval(checkStatus, 1000);

        // Create a new XMLHttpRequest.
        var xhr = new XMLHttpRequest();

        // Handle progress events...
        xhr.upload.onprogress = function(event) {
            if (event.lengthComputable) {
                var percentComplete = (event.loaded / event.total) * 100;
                $('#progress').text('Uploading image... ' + percentComplete.toFixed(2) + '%');
            }
        };

        // Set up a handler for when the request finishes.
        xhr.onload = function() {
            if (xhr.status === 200) {
                $('#progress').text('Upload complete!');
                // At this point, the checkStatusInterval is already running and doesn't need to be started again.
            } else {
                clearInterval(checkStatusInterval);
                $('#progress').text('An error occurred while uploading the file.');
            }
        };

        // Set up the request.
        xhr.open('POST', 'uploadHandler.php', true);

        // Send the Data.
        xhr.send(formData);
    });
});
</script>



</head>
<body>
    <form id="uploadForm" method="post" enctype="multipart/form-data">
        <input type="file" name="file" required>
        <button type="submit">Upload Image</button>
    </form>
    <div id="progress"></div>
</body>
</html>
