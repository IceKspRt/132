<style>
    .image-preview-container {
        width: 100%;
        margin: 0 auto;
        border-radius: 20px;
    }

    .image-preview-container img {
        width: 100%;
        display: none;
        margin-bottom: 15px;
        margin-left: 2%;
        border: 3px double rgb(0, 0, 0);
    }

    .image-preview-container input {
        display: none;
    }

    .image-preview-container label {
        display: block;
        width: 20%;
        height: 45px;
        margin-left: 0%;
        text-align: center;
        background: #E9DAC1;
        color: #fff;
        font-size: 15px;
        text-transform: Uppercase;
        font-weight: 400;
        border-radius: 5px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;

    }

    #resetbtn {
        display: block;
        width: 20%;
        height: 45px;
        text-align: center;
        margin-left: 0%;
        color: #fff;
        font-size: 15px;
        text-transform: Uppercase;
        font-weight: 400;
        border-radius: 5px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>
<!-- Modal -->
<div class="modal fade" id="adduser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">เพิ่มผู้ใช้งาน</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('users.store') }}" method="POST">
                @csrf
                @method('post')
                <div class="modal-body">
                    <div class="image-preview-container">
                        <div class="preview">
                            <img id="preview-selected-image-1" style="border-radius: 50%" />
                        </div>
                        <label id="upload" for="profile_image">อัพโหลดรูปภาพ</label>
                        <input type="file" class="form-control select-require" id="profile_image"
                            name="profile_image" accept=".png, .jpeg, .jpg"
                            onchange="previewImage(event,1,'upload','resetbtn');" />
                        <button id="resetbtn"
                            onclick="resetFile('profile_image', 'preview-selected-image-1','upload','resetbtn')"
                            class="btn btn-danger btn-sm">ลบรูปภาพ</button>

                        <p style="text-align: center; font-size: 9px;color:black"><span
                                style="color:red;font-size:13px">*</span>ขนาดรูปภาพที่แนะนำ :
                            400x500 pixels<span style="color:red;font-size:13px">*</span></p>

                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="">ชื่อ</label>
                            <input type="text" name="fname" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="">นามสกุล</label>
                            <input type="text" name="lname" class="form-control" required>
                        </div>
                        <div class="col-md-6" style="padding-top:5px;">
                            <label for="">บทบาท</label>
                            <select class="form-control" name="role">
                                <option value="Admin">Admin</option>
                                <option value="Student">Student</option>
                                <option value="Member">Member</option>
                            </select>
                        </div>
                        <div class="col-md-6" style="padding-top:5px;">
                            <label for="">สาขา</label>
                            <input type="text" name="major" class="form-control">
                        </div>
                        <div class="col-md-6" style="padding-top:5px;">
                            <label for="">อีเมล</label>
                            <input type="email hidden" name="email" class="form-control" required>
                        </div>
                        <div class="col-md-6" style="padding-top:5px;">
                            <label for="">รหัสผ่าน</label>
                            <input type="text" name="password" class="form-control" required>
                        </div>
                    </div>
                    <br>
                    <hr>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                    <button type="submit" class="btn btn-primary" id= "confirmAdd">บันทึก</button>
                </div>
            </form>


        </div>
    </div>
</div>
