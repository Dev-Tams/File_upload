<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex justify-center items-center min-h-screen">
    <div class="bg-white p-8 rounded shadow-lg w-full max-w-md">
        <h2 class="text-2xl font-semibold mb-6 text-center">Upload a File</h2>
        <form action="/upload" method="POST" enctype="multipart/form-data" class="space-y-4">
            <div>
                <label for="image" class="block text-gray-700 font-medium">Upload an Image:</label>
                <input type="file" name="image" id="image" class="mt-2 block w-full text-gray-900 border border-gray-300 rounded-lg p-2">
            </div>

            <div>
                <label for="audio" class="block text-gray-700 font-medium">Upload an Audio File:</label>
                <input type="file" name="audio" id="audio" class="mt-2 block w-full text-gray-900 border border-gray-300 rounded-lg p-2">
            </div>

            <div>
                <label for="video" class="block text-gray-700 font-medium">Upload a Video File:</label>
                <input type="file" name="video" id="video" class="mt-2 block w-full text-gray-900 border border-gray-300 rounded-lg p-2">
            </div>

            <div>
                <label for="document" class="block text-gray-700 font-medium">Upload a Document:</label>
                <input type="file" name="document" id="document" class="mt-2 block w-full text-gray-900 border border-gray-300 rounded-lg p-2">
            </div>

            <div class="text-center">
                <input type="submit" value="Upload File" class="bg-red-500 text-white font-semibold py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-300 cursor-pointer">
            </div>
        </form>
    </div>
</body>

</html>
