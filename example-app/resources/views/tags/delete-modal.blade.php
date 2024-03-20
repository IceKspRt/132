<form method="POST" action="{{ route('tags.destroy', $item->tag_id) }}">
    @csrf
    @method('DELETE')
    <div class="modal fade" id="deletetag{{ $item->tag_id }}" tabindex="-1" role="dialog"
        aria-labelledby="addLabelModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalDelete">ลบป้ายกำกับ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">ยืนยันการลบป้ายกำกับ <b>{{ $item->tag_name }}</b> ใช่หรือไม่?</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                    <button type="submit" class="btn btn-primary" id="confirmAdd">ยืนยัน</button>
                </div>
            </div>
        </div>
    </div>
</form>


<script>
    function deleteTag(tagId) {
        if (confirm('คุณแน่ใจหรือไม่ที่จะลบป้ายกำกับนี้?')) {
            event.preventDefault();
            document.getElementById('delete-form-' + tagId).submit();
        }
    }
</script>
