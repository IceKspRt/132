<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Upload Card</title>
    <style>
        .card {
            border: 1px solid #ddd;
            padding: 10px;
            margin: 10px;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <button onclick="createTemplate()">เพิ่มเทมเพลต</button>

    <div class="card">
        <div class="row" id="rowOne">
            <div class="col-md-12" id="rowOneColOne">

            </div>
        </div>
        <div class="row">
            <div class="col" id="colOne">
                <div class="row" id="colOneRowOne">

                </div>
                <div class="row" id="colOneRowTwo">

                </div>
            </div>
            <div class="col" id="colTwo">
                <div class="row" id="colTwoRowOne">

                </div>
                <div class="row" id="colTwoRowTwo">

                </div>
            </div>
        </div>
    </div>

    <script>
        function createTemplate() {
            var rowOne = document.getElementById('rowOneColOne');

            // Create a new file input element
            var fileInput = document.createElement('input');
            fileInput.type = 'file';
            fileInput.accept = 'image/*';
            fileInput.style.display = 'none'; // Hide the file input
            fileInput.addEventListener('change', handleFileUpload);

            // Create a new upload button
            var uploadButton = document.createElement('button');
            uploadButton.textContent = 'อัพโหลดรูปภาพ';
            uploadButton.addEventListener('click', function () {
                fileInput.click(); // Trigger the file input click event
            });

            // Append the upload button to the rowOne
            rowOne.appendChild(uploadButton);
            rowOne.appendChild(fileInput);
        }

        function handleFileUpload(event) {
            var file = event.target.files[0];

            if (file) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    var img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.width = '100px';
                    img.style.height = '100px';
                    img.style.objectFit = 'cover';

                    // Create a new delete button with the trash icon
                    var deleteButton = document.createElement('button');
                    deleteButton.innerHTML = '&#128465;'; // Trash icon (🗑)
                    deleteButton.addEventListener('click', function () {
                        // Remove the image and the delete button when clicked
                        img.remove();
                        deleteButton.remove();
                        event.target.value = ''; // Clear the file input value
                    });

                    // Create a new div to contain the image and the delete button
                    var previewDiv = document.createElement('div');
                    previewDiv.appendChild(img);
                    previewDiv.appendChild(deleteButton);

                    // Append the image preview to the document body or wherever you want
                    document.body.appendChild(previewDiv);
                }

                reader.readAsDataURL(file);
            }
        }
    </script>
</body>

</html>
