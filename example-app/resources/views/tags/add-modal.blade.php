<div class="modal fade" id="addtag" tabindex="-1" role="dialog" aria-labelledby="addLabelModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addLabelModalLabel">เพิ่มป้ายกำกับ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action = "{{route('tags.store')}}">
                @csrf
                @method('post')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="labelName" class="col-form-label">ชื่อป้ายกำกับ</label>
                        <input type="text" class="form-control" id="labelName" name="label_name" required>
                </div>
            </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                    <button type="submit" class="btn btn-primary" id= "confirmAdd">บันทึก</button>
                </div>
        </div>
    </div>
</div>
</form>
