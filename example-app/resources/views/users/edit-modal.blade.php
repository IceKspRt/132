<script>
    $(function() {
        // เช็คว่ามีรูปภาพอัปโหลดมาแล้วหรือไม่
        const profileImage =
        "{{ asset('uploads/users/'.$item->user_id.'/' . $item->user_img) }}"; // เปลี่ยนเป็นชื่อฟิลด์ของรูปภาพในตารางฐานข้อมูลของคุณ

        if (profileImage !== null && profileImage !== "") { 
            // แสดงรูปภาพที่อัปโหลดแล้ว
            const imagePreviewElement = document.querySelector('#preview-selected-image-1');
            imagePreviewElement.src = profileImage;
            imagePreviewElement.style.display = "block";

            // ซ่อนปุ่มลบรูปภาพ
            const resetBtn = document.getElementById('resetbtn');
            resetBtn.style.display = 'none';
        }
    });
</script>

<!-- Modal -->
<div class="modal fade" id="edituser{{ $item->user_id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">แก้ไขป้ายกำกับ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('users.update', $item->user_id) }}" method="POST">
                @csrf
                @method('PATCH')
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
                            <input type="text" name="fname" value="{{ $item->user_fname }}" class="form-control"
                                required>
                        </div>
                        <div class="col-md-6">
                            <label for="">นามสกุล</label>
                            <input type="text" name="lname" value="{{ $item->user_lname }}" class="form-control"
                                required>
                        </div>
                        <div class="col-md-6" style="padding-top:5px;">
                            <label for="">บทบาท</label>
                            <select class="form-control" name="role">
                                <option>{{ $item->user_role }}</option>
                                {{-- @if ($item['user_role'] == 'Admin')

                                @else

                                @endif --}}

                                <option value="Admin">Admin</option>
                                <option value="Student">Student</option>
                                <option value="Member">Member</option>
                            </select>
                        </div>
                        <div class="col-md-6" style="padding-top:5px;">
                            <label for="">สาขา</label>
                            <input type="text" name="major" value="{{ $item->user_major }}" class="form-control">
                        </div>
                        <div class="col-md-6" style="padding-top:5px;">
                            <label for="">อีเมล</label>
                            <input type="email hidden" name="email" value="{{ $item->user_email }}"
                                class="form-control" readonly>
                        </div>
                        <div class="col-md-6" style="padding-top:5px;">
                            <label for="">รหัสผ่าน</label>
                            <input type="text" name="password" class="form-control">
                        </div>
                    </div>
                    <br>
                    <hr>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                    <button type="submit" class="btn btn-primary">บันทึก</button>
                </div>
            </form>
        </div>
    </div>
</div>
