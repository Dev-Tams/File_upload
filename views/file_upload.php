<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload</title>
</head>

<body>
    <h2>Upload a File</h2>
    <form action="/upload" method="POST" enctype="multipart/form-data">
        <label for="image">Upload an Image:</label>
        <input type="file" name="image" id="image"><br><br>

        <label for="audio">Upload an Audio File:</label>
        <input type="file" name="audio" id="audio"><br><br>

        <label for="video">Upload a Video File:</label>
        <input type="file" name="video" id="video"><br><br>

        <label for="document">Upload a Document:</label>
        <input type="file" name="document" id="document"><br><br>

        <input type="submit" value="Upload File">
    </form>
</body>

</html>