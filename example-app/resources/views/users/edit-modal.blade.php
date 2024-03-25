<script>
    $(function() {
        $(".edit-users").on("click", function() {
            const profileImage =
                "{{ asset('uploads/users/' . $item->user_id . '/' . $item->user_img) }}"; // เปลี่ยนเป็นชื่อฟิลด์ของรูปภาพในตารางฐานข้อมูลของคุณ

            if (profileImage !== null && profileImage !== "") {
                // แสดงรูปภาพที่อัปโหลดแล้ว
                const imagePreviewElement = document.querySelector('#preview-selected-image-1');
                imagePreviewElement.src = profileImage;
                imagePreviewElement.style.display = "block";

                // ซ่อนปุ่มลบรูปภาพ
                const resetBtn = document.getElementById('resetbtn');
                resetBtn.style.display = 'none';
            }
        })
    });
</script>

<!-- Modal -->
<div class="modal fade" id="edituser{{ $item->user_id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">แก้ไขป้ายกำกับ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('users.update', $item->user_id) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="modal-body">
                    <div class="image-preview-container">
                        <div class="preview">
                            <img id="preview-selected-image-{{ $item->user_id }}" style="border-radius: 50%" />
                        </div>
                        <label id="upload{{ $item->user_id }}" for="profile_image">อัพโหลดรูปภาพ</label>
                        <input type="file" class="form-control select-require" id="profile_image{{ $item->user_id }}"
                            name="profile_image" accept=".png, .jpeg, .jpg"
                            onchange="previewImage(event,{{ $item->user_id }},'upload{{ $item->user_id }}','resetbtn{{ $item->user_id }}');" />
                        <button id="resetbtn{{ $item->user_id }}"
                            onclick="resetFile('profile_image{{ $item->user_id }}', 'preview-selected-image-{{ $item->user_id }}','upload{{ $item->user_id }}','resetbtn{{ $item->user_id }}')"
                            class="btn btn-danger btn-sm">ลบรูปภาพ</button>
                        <p style="text-align: center; font-size: 9px;color:black"><span
                                style="color:red;font-size:13px">*</span>ขนาดรูปภาพที่แนะนำ : 400x500 pixels<span
                                style="color:red;font-size:13px">*</span></p>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="fname" class="form-label">ชื่อ</label>
                            <input type="text" name="fname" id="fname{{ $item->user_id }}" value="{{ $item->user_fname }}"
                                class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="lname" class="form-label">นามสกุล</label>
                            <input type="text" name="lname" id="lname{{ $item->user_id }}" value="{{ $item->user_lname }}"
                                class="form-control" required>
                        </div>
                        <div class="col-md-6" style="padding-top:5px;">
                            <label for="role" class="form-label">บทบาท</label>
                            <select class="form-select" id="role{{ $item->user_id }}" name="role">
                                <option value="Admin" {{ $item->user_role == 'Admin' ? 'selected' : '' }}>Admin
                                </option>
                                <option value="Student" {{ $item->user_role == 'Student' ? 'selected' : '' }}>Student
                                </option>
                                <option value="Member" {{ $item->user_role == 'Member' ? 'selected' : '' }}>Member
                                </option>
                            </select>
                        </div>
                        <div class="col-md-6" style="padding-top:5px;">
                            <label for="major" class="form-label">สาขา</label>
                            <input type="text" name="major" id="major{{ $item->user_id }}" value="{{ $item->user_major }}"
                                class="form-control">
                        </div>
                        <div class="col-md-6" style="padding-top:5px;">
                            <label for="email" class="form-label">อีเมล</label>
                            <input type="email" name="email" id="email{{ $item->user_id }}" value="{{ $item->user_email }}"
                                class="form-control" readonly>
                        </div>
                        <div class="col-md-6" style="padding-top:5px;">
                            <label for="password" class="form-label">รหัสผ่าน</label>
                            <input type="password" name="password" id="password{{ $item->user_id }}" class="form-control">
                        </div>
                    </div>
                    <br>
                    <hr>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                    <button type="submit" class="btn btn-primary">บันทึก</button>
                </div>
            </form>
        </div>
    </div>
</div>
