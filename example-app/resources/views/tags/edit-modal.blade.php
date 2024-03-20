<div class="modal fade" id="edittag{{ $item->tag_id }}" tabindex="-1" role="dialog" aria-labelledby="editTagModalLabel" aria-hidden="true" >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">แก้ไขป้ายกำกับ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('tags.update', $item->tag_id)}}">
                @csrf
                @method('PATCH')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="tag_name" class="col-form-label">ชื่อป้ายกำกับ</label>
                        <input type="text" class="form-control" id="tag_name" name="tag_name" value="{{ $item->tag_name }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                    <button type="submit" class="btn btn-primary">บันทึก</button>
                </div>
            </form>
        </div>
    </div>
</div>
