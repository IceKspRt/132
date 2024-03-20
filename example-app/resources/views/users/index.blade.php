@extends('layouts.default')

@section('title')

    <link rel="stylesheet" type="text/css" href="{{ url('/style/style.css') }}" />

@section('content')

    <!--Javascript-->
    <script>
        window.onload = function() {
            // Hide the reset button
            const ele = document.getElementById("resetbtn");
            ele.style.display = 'none';
            // Hide the reset button 2
            const ele2 = document.getElementById("resetbtn2");
            ele2.style.display = 'none';

            $('#example1').DataTable({
                "language": {
                    "search": "ค้นหา : ",
                    "info": "แสดง _START_ ถึง _END_ จากทั้งหมด _TOTAL_ รายการ",
                    "lengthMenu": "แสดง _MENU_ รายการ",
                    "infoEmpty": "ไม่พบรายการ",
                    "infoFiltered": "(กรองจากทั้งหมด _MAX_ รายการ)",
                    "zeroRecords": "ไม่พบรายการที่ตรงกับคำค้น",
                    "paginate": {
                        "first": "หน้าแรก",
                        "last": "หน้าสุดท้าย",
                        "next": "ถัดไป",
                        "previous": "ก่อนหน้า"
                    }
                }
            });

            $(document).ready(function() {
                $('.js-example-basic-single').select2();
                $(".js-example-basic-hide-search").select2({
                    minimumResultsForSearch: Infinity
                });
                $(".js-example-tags").select2({
                    tags: true
                });

            });

        }

        const previewImage = (event, imageNumber, uploadLabelId, resetBtnId) => {
            const imageFiles = event.target.files;
            const imageFilesLength = imageFiles.length;

            if (imageFilesLength > 0) {
                const imageSrc = URL.createObjectURL(imageFiles[0]);
                const imagePreviewElement = document.querySelector(`#preview-selected-image-${imageNumber}`);

                imagePreviewElement.src = imageSrc;
                imagePreviewElement.style.display = "block";
                if (imageNumber == 1) {
                    imagePreviewElement.style.width = "170px";
                    imagePreviewElement.style.height = "170px";
                } else if (imageNumber == 2) {
                    imagePreviewElement.style.width = "700px";
                    imagePreviewElement.style.height = "150px";
                }

                const uploadLabel = document.getElementById(uploadLabelId);
                uploadLabel.style.display = 'none';

                const reBtn = document.getElementById(resetBtnId);
                reBtn.style.display = 'block';
            }
        };


        function resetFile(fileInputId, previewImageId, uploadLabelId, resetBtnId) {
            // ล้างค่า input file โดยการเปลี่ยนค่าในไฟล์ input
            document.getElementById(fileInputId).value = null;

            // ล้างค่าตัวอย่างรูปภาพ
            var previewImage = document.getElementById(previewImageId);
            previewImage.src = null;
            previewImage.style.display = 'none';

            // Show the upload label and hide the reset button
            const uploadLabel = document.getElementById(uploadLabelId);
            uploadLabel.style.display = 'flex';

            // Hide the reset button
            const resetBtn = document.getElementById(resetBtnId);
            resetBtn.style.display = 'none';
        }
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('confirmAdd').addEventListener('click', function() {
                // เก็บค่าข้อมูลที่ต้องการส่งไปยังเซิร์ฟเวอร์
                let formData = new FormData(document.querySelector('form'));

                // ส่งข้อมูลผ่าน AJAX
                fetch('{{ route('users.store') }}', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(response => {
                        if (response.ok) {
                            return response.json();
                        }
                        throw new Error('Network response was not ok.');
                    })
                    .then(data => {
                        // ดำเนินการหลังจากที่รับข้อมูล response จากเซิร์ฟเวอร์
                        console.log(data);
                        // เปิดใช้งานเพื่อปิด modal
                        $('#adduser').modal('hide');
                        // รีเฟรชหน้าเพื่อดึงข้อมูลใหม่
                        location.reload();
                    })
                    .catch(error => {
                        console.error('There has been a problem with your fetch operation:', error);
                    });
            });
        });
    </script>
    <script>
        $(function() {
            $('.toggle-class').change(function() {
                var user_permission = $(this).prop('checked') == true ? 1 : 0;
                var user_id = $(this).data('user_id');


                // แสดงค่า user_id ใน console
                console.log('User ID:', user_id);
                // ตรวจสอบว่าคุณกำหนด URL ของ route ให้ถูกต้อง
                var url = "{{ route('changeStatus') }}"; // ให้แก้ชื่อ route ตามที่คุณตั้งไว้ในไฟล์ web.php

                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: url, // ใช้ตัวแปร url ที่เรากำหนดไว้
                    data: {
                        'user_permission': user_permission,
                        'user_id': user_id,
                        '_token': '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        console.log(data.success);
                        // ดำเนินการเพิ่มเติมหากต้องการ
                    },
                    error: function(error) {
                        console.log(error);
                        console.log('User ID:', user_id);
                        // แสดงข้อความผิดพลาดหรือดำเนินการเพิ่มเติมตามที่เหมาะสม
                    }
                });
            });

        });
    </script>

    <!--Javascript-->

    <!--DataTable-->
    <br>
    <div class="container">
        <!-- /.card -->
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col align-self-start" style ="text-align:start">
                        <div class="h2" style="padding-top: 0px; margin-bottom: 0%">ผู้ใช้งาน</div>
                    </div>
                    <div class="col align-self-end" style ="text-align:right">
                        <button type="button" class="btn btn-primary" data-toggle="modal"
                            data-target="#adduser">เพิ่มผู้ใช้งาน</button>

                    </div>
                </div>
                <hr>
                <table id="example1" class="table">
                    <thead>
                        <tr>
                            <th style="text-align: center;width:5%">#</th>
                            <th style="text-align: center;width: 51%">ชื่อ-นามสกุล</th>
                            <th style="text-align: center;width:15%">จำนวนผลงาน</th>
                            <th style="text-align: center;width:5%">สาขา</th>
                            <th style="text-align: center;width:7%">บทบาท</th>
                            <th style="text-align: center;width:5%">สถานะ</th>
                            <th style="text-align: center;width:7%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user as $item)
                            <tr>
                                <td style="text-align: center;padding:0px;padding-top:10px">{{ $item->user_id }}</td>
                                <td style="text-align: left;padding:0px;padding-top:10px;padding-left:10px">
                                    {{ $item->user_fname }}
                                    {{ $item->user_lname }}</td>
                                <td style="text-align: center;padding:0px;padding-top:10px;padding-left:0px">
                                    {{ $item->user_insert_proj }}
                                </td>

                                <td style="text-align: center;padding:0px;padding-top:10px">{{ $item->user_major }}</td>
                                <td style="text-align: center;padding:0px;padding-top:10px">{{ $item->user_role }}</td>
                                <td style="text-align: center;padding:0px;padding-top:4px;padding-bottom:4px">
                                    <input data-user_id="{{ $item->user_id }}" class="toggle-class" data-onstyle="success"
                                        data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="Inactive"
                                        type="checkbox" {{ $item->user_permission ? 'checked' : '' }}>
                                </td>

                                <td style="padding:0%;padding-top:5px;display:flex;justify-content:center">
                                    <a class="btn btn-primary edit-tag" data-toggle="modal"
                                        data-target="#edituser{{ $item->user_id }}" style="width: 30px;height:30px;"><i
                                            class="fas fa-edit" style="margin-left:-5px"></i></a>
                                    <form method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button action="{{ url('delete-users/' . $item->user_id) }}" type="submit"
                                            class="btn btn-danger btn-sm" style="height:30px;width:30px;margin-left:5px">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    @include('users.add-modal')
    @foreach ($user as $item)
        @include('users.edit-modal', ['item' => $item])
    @endforeach

    <!--Add Project-->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4>
                            เพิ่มโปรเจ็กต์
                        </h4>
                        <hr><br>
                        <!--Form-->
                        <div class="form-body">
                            <!--Row-->
                            <div class="row">
                                <!--Column-->
                                <div class="col-sm-6 col-md-3">
                                    <div class="image-preview-container">
                                        <div class="preview">
                                            <img id="preview-selected-image-1" />
                                        </div>
                                        <label id="upload" for="file-upload-1">อัพโหลดรูปภาพ</label>
                                        <input type="file" class="form-control select-require" id="file-upload-1"
                                            accept="image/*" onchange="previewImage(event,1,'upload','resetbtn');" />
                                        <button id="resetbtn"
                                            onclick="resetFile('file-upload-1', 'preview-selected-image-1','upload','resetbtn')"
                                            class="btn btn-danger btn-sm">ลบรูปภาพ</button>

                                        <p style="text-align: center; font-size: 9px;color:black"><span
                                                style="color:red;font-size:13px">*</span>ขนาดรูปภาพที่แนะนำ :
                                            400x500 pixels<span style="color:red;font-size:13px">*</span></p>

                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-9">
                                    <div class="image-preview-container-second">
                                        <div class="preview">
                                            <img id="preview-selected-image-2" />
                                        </div>
                                        <label id="upload2" for="file-upload-2">อัพโหลดรูปภาพ</label>
                                        <input type="file" class="form-control select-require" id="file-upload-2"
                                            accept="image/*" onchange="previewImage(event,2,'upload2','resetbtn2');" />
                                        <button id="resetbtn2"
                                            onclick="resetFile('file-upload-2', 'preview-selected-image-2','upload2','resetbtn2')"
                                            class="btn btn-danger btn-sm">ลบรูปภาพ</button>
                                        <p style="text-align: center; font-size: 12px;color:black"><span
                                                style="color:red;font-size:17px">*</span>ขนาดรูปภาพที่แนะนำ :
                                            400x500 pixels<span style="color:red;font-size:17px">*</span></p>
                                    </div>
                                </div>
                                <!--Column-->
                            </div>
                            <!--Row-->
                            <hr><br>
                            <!--Row-->
                            <div class="row">

                                <div class="col-sm-6">
                                    <div class="box form-group" name="boxproject">
                                        <input type="text" name="pro_th" id="pro_th">
                                        <p id="ProThai">ชื่อโปรเจกต์(ภาษาไทย)</p>
                                    </div>

                                </div>
                                <div class="col-sm-6">
                                    <div class="box" name="boxproject">
                                        <input type="text" class="form-control select-require" name="pro_th"
                                            id="pro_en">
                                        <p id="ProEng">ชื่อโปรเจกต์(ภาษาอังกฤษ)</p>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="box">
                                        <select class="js-example-basic-single" name="company" id="pro_company">
                                            <option value="" disabled selected>-</option>
                                            <option value="1">TTT Brother</option>
                                            <option value="2">ClickNext</option>
                                            <option value="3">อสมท.</option>
                                            <option value="4">บริษัท กรีนฮับ จำกัด</option>
                                            <option value="5">สำนักงานกองทุนสนับสนุนการสร้างเสริมสุขภาพ (สสส.)
                                            </option>
                                            <option value="6">Soft Square International Co,Ltd</option>
                                            <option value="7">บริษัท สยาม เด็นโซ่ แมนูแฟคเจอริ่ง จำกัด</option>
                                        </select>
                                        <p id="CompanyF">บริษัท</p>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="box">
                                        <select class="js-example-basic-hide-search" name="advisor" id="pro_advisor">
                                            <option value="" disabled selected>-</option>
                                            <option value="1">อาจารย์จิรายุส อาบกิ่ง</option>
                                            <option value="2">อาจารย์อภิสิทธิ์ แสงใส</option>
                                            <option value="3">อาจารย์วันทนา ศรีสมบูรณ์</option>
                                            <option value="4">ดร.อธิตา อ่อนเอื้อน</option>
                                            <option value="5">ดร.ณัฐพร ภักดี</option>
                                            <option value="6">อาจารย์พีระศักดิ์ เพียรประสิทธิ์</option>
                                        </select>
                                        <p id="AdvisorF">อาจารย์ที่ปรึกษา</p>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="box">
                                        <select class="js-example-basic-hide-search custom-select-with-button"
                                            name="major" id="pro_major">
                                            <option value="" disabled selected>-</option>
                                            <option value="1">SE</option>
                                            <option value="2">AI</option>
                                            <option value="3">CS</option>
                                            <option value="4">IT</option>
                                        </select>
                                        <p id="FieldF">สาขา</p>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="box">
                                        <select class="js-example-tags" multiple="multiple" name="tag"
                                            id="pro_type">
                                            <option value="" disabled selected>-</option>
                                            <option value="1">Management</option>
                                            <option value="2">Sale</option>
                                            <option value="3">CS</option>
                                            <option value="4">IT</option>
                                        </select>
                                        <p id="TypeF">ประเภท</p>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="box">
                                        <textarea id="pro_descript" rows="3" maxlength="250"></textarea>
                                        <p id="DescF">คำอธิบายโปรเจกต์</p>
                                    </div>

                                </div>

                            </div>
                            <!--Row-->
                            <hr><br>
                        </div>
                        <!--Form-->

                        <div class="row">

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
