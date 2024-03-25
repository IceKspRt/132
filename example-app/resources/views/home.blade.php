@extends('layouts.default')

<style>
    .card {
        border: 1px solid #ccc;
        border-radius: 5px;
        margin-bottom: 10px;
        padding: 10px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        /* จัดให้เนื้อหาตรงกลางตามแนวแกนนอน */
    }

    .card-content {
        margin-top: 10px;
        display: flex;
        flex-direction: column;
        align-items: center;
        /* จัดให้เนื้อหาตรงกลางตามแนวแกนนอน */

    }

    #subCard1 {
        width: 1000px;
        height: 640px;
        background-color: rgb(236, 236, 236);
        border: 2px solid black;
    }

    #subCard2,
    #subCard3,
    #subCard4,
    #subCard5 {
        background-color: rgb(236, 236, 236);
        width: 500px;
        height: 300px;
        border: 2px solid black;
    }



    img#preview1{
        width: 995px;
        height: 635px;
        border-radius: 5px;
        margin-bottom: 10px;
    }

    img#preview2,img#preview3,img#preview4,img#preview5{
        width: 495px;
        height: 295px;
        border-radius: 5px;
        margin-bottom: 10px;
    }

    .upload-button {
        background-color: #4CAF50;
        /* สีพื้นหลัง */
        color: white;
        /* สีข้อความ */
        padding: 10px 15px;
        font-size: 15px;
        /* ขนาดของปุ่ม */
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .upload-button:hover {
        background-color: #45a049;
        /* เปลี่ยนสีพื้นหลังเมื่อเมาส์ชี้ไป */
    }

    /* ซ่อนปุ่มอัพโหลด */
    .upload-input {
        display: none;
    }

    .delete-icon {
        position: absolute;
        top: 0;
        right: 0;
        margin: 10px;
        cursor: pointer;
    }


</style>
@section('content')

    <body>
        <button onclick="addTemplate()">เพิ่มเทมเพลต</button>

        <div class="card" id="frameOne">
            <div class="row" id="rowOne">
                <div class="col-12" id="rowOneColOne">

                </div>
            </div>
            <div class="row">
                <div class="col-6" id="rowTwoColOne">

                </div>
                <div class="col-6" id="rowTwoColTwo">

                </div>
            </div>
            <div class="row">
                <div class="col-6" id="rowThreeColOne">

                </div>
                <div class="col-6" id="rowThreeColTwo">

                </div>
            </div>
        </div>

        <script>
            function addTemplate() {
                for (var i = 1; i <= 5; i++) {
                    var subCard = document.createElement("div");
                    subCard.className = "card";
                    subCard.id = "subCard" + i;

                    var uploadBtn = document.createElement("input");
                    uploadBtn.type = "file";
                    uploadBtn.className = "upload-input"; // เปลี่ยนชื่อคลาสเป็น upload-input
                    uploadBtn.id = "uploadBtn" + i;
                    uploadBtn.addEventListener("change", (function(index) {
                        return function(event) {
                            previewImage(index,
                                event); // เรียกใช้งาน previewImage() เมื่อมีการเปลี่ยนแปลงในไฟล์
                        };
                    })(i));

                    var uploadLabel = document.createElement("label");
                    uploadLabel.htmlFor = "uploadBtn" + i;
                    uploadLabel.innerText = "อัพโหลดรูปภาพ";
                    uploadLabel.className = "upload-button"; // เปลี่ยนชื่อคลาสเป็น upload-button

                    var deleteIcon = document.createElement("span");
                    deleteIcon.innerHTML = "&#x274C;"; // สร้างไอคอนลบ
                    deleteIcon.className = "delete-icon";
                    deleteIcon.style.display = "none"; // ซ่อนไอคอนลบเริ่มต้น
                    deleteIcon.addEventListener("click", (function(index) {
                        return function() {
                            removeImage(index); // เรียกใช้งาน removeImage() เมื่อคลิกที่ไอคอนลบ
                        };
                    })(i));

                    var preview = document.createElement("img");
                    preview.id = "preview" + i;
                    preview.style.display = "none"; // ซ่อนรูปภาพเริ่มต้น

                    var cardContent = document.createElement("div");
                    cardContent.className = "card-content";
                    cardContent.appendChild(uploadBtn);
                    cardContent.appendChild(uploadLabel);
                    cardContent.appendChild(deleteIcon); // เพิ่มไอคอนลบลงใน cardContent
                    cardContent.appendChild(preview);

                    subCard.appendChild(cardContent);

                    switch (i) {
                        case 1:
                            document.getElementById("rowOneColOne").appendChild(subCard);
                            break;
                        case 2:
                            document.getElementById("rowTwoColOne").appendChild(subCard);
                            break;
                        case 3:
                            document.getElementById("rowTwoColTwo").appendChild(subCard);
                            break;
                        case 4:
                            document.getElementById("rowThreeColOne").appendChild(subCard);
                            break;
                        case 5:
                            document.getElementById("rowThreeColTwo").appendChild(subCard);
                            break;
                    }
                }
            }

            function hideUploadButton(index) {
                document.querySelector("#subCard" + index + " .upload-button").style.display = "none";
                document.getElementById("preview" + index).style.display = "block";
                document.querySelector("#subCard" + index + " .delete-icon").style.display = "block";
            }

            function showUploadButton(index) {
                document.querySelector("#subCard" + index + " .upload-button").style.display = "block";
                document.getElementById("preview" + index).style.display = "none";
                document.querySelector("#subCard" + index + " .delete-icon").style.display = "none";
            }

            function removeImage(index) {
                document.getElementById("preview" + index).src = "";
                document.getElementById("uploadBtn" + index).value = "";
                showUploadButton(index);
            }

            function previewImage(index, event) {
                var input = event.target;
                var reader = new FileReader();

                reader.onload = function() {
                    var imgElement = document.getElementById("preview" + index);
                    imgElement.src = reader.result;
                    hideUploadButton(index);
                };

                reader.readAsDataURL(input.files[0]);
            }
        </script>
    </body>
@endsection
