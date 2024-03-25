@extends('layouts.default')

@section('sidebar')
    <li class="nav-item">
        <a href="{{ url('/users') }}" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>
                จัดการผู้ใช้งาน
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>
                จัดการโปรเจกต์
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ url('/tags') }}" class="nav-link active" >
            <i class="nav-icon fas fa-th"></i>
            <p>
                ป้ายกำกับ
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>
                จัดการบริษัท
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>
                อาจารย์ที่ปรึกษา
            </p>
        </a>
    </li>
@endsection
@section('content')

    <div class="container">
        <div class="row">
            <div class="col align-self-start" style ="text-align:start">
                <div class="h2" style="padding-top: 20px; margin-bottom: 0%">ป้ายกำกับ</div>
            </div>
            <div class="col align-self-end" style ="text-align:right">
                <button type="button" class="btn btn-primary" data-toggle="modal"
                    data-target="#addtag">เพิ่มป้ายกำกับ</button>

            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-3">
                    <div class="card-body">
                        <table id = "example1" class="cell-border table">
                            <thead>
                                <th style="width : 10%; text-align: center">ID</th>
                                <th style="width : 60%; text-align: center">ชื่อ</th>
                                <th style="width : 10%; text-align: center">จัดการ</th>
                            </thead>
                            <tbody >
                                @foreach ($tag as $item)
                                    <tr>
                                        <td  style="padding : 5px;padding-top:10px" >{{ $item->tag_id }}</td>
                                        <td  style="padding : 5px;padding-top:10px">{{ $item->tag_name }}</td>
                                        <td style="display: flex;padding : 5px">
                                            <a class="btn btn-primary edit-tag" data-toggle="modal"
                                                data-target="#edittag{{ $item->tag_id }}" style="width: 40px"><i class="fas fa-edit"></i></a>
                                            <form method="POST">
                                                @method('delete')
                                                <a class ="btn btn-danger" data-toggle="modal"
                                                data-target="#deletetag{{ $item->tag_id }}" style="margin-left: 5px"><i class="fas fa-trash-alt"></i></a>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('tags.add-modal')
    @foreach ($tag as $item)
        @include('tags.edit-modal', ['item' => $item])
        @include('tags.delete-modal', ['item' => $item])
    @endforeach

    <script>
        window.onload = function() {
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
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.edit-tag').click(function() {
                var tagId = $(this).data('tagid');
                var tagName = $(this).closest('tr').find('td:eq(1)').text();
                $('#tag_name' + tagId).val(tagName);
            });
        });
    </script>
    @if(Session::has('success'))
    <script>
        toastr.success("{{ Session::get('success') }}");
    </script>
    @endif
@endsection
