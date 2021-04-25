@extends('.admin/layouts/index')

@section('content')
    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked + .slider {
            background-color: #02C58D;
        }

        input:focus + .slider {
            box-shadow: 0 0 1px #02C58D;
        }

        input:checked + .slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }
    </style>
    <div class="page-title-box">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <h4 class="page-title">Album List</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">D Dreams Creation</a></li>
                    <li class="breadcrumb-item active">Album List</li>
                </ol>
            </div>
        </div>
    </div>

    @include('admin.albumType.add')
    @include('admin.albumType.edit')
    <div class="row">
        <div class="col-lg-3 col-md-12">
            <div style="position: relative;margin-top: 26px">
                <button class="btn btn-primary" data-toggle="modal" data-target="#album-type-add-modal"><i class="fas fa-plus mr-2"></i>Create New</button>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card mt-2">
                <div class="card-body">
                    <table id="album-datatable" class="table table-bordered table-striped table-responsive-lg table-responsive-xl table-responsive-md nowrap" style="border-collapse: collapse;border-spacing: 0;width: 100%!important;">
                        <thead>
                        <tr>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        setTimeout(function () {
            $('#album-datatable').DataTable({
                "processing": true,
                "severside": true,
                "ajax": "{{route('album.getList')}}",
                "columns": [
                    {"data": "type"},
                    {"data": null, "render": function (data) {
                            if (data.status == true){
                                return '<label class="switch">\n' +
                                    '  <input type="checkbox" onclick="changeStatus('+data.id+')" checked>' +
                                    '  <span class="slider round"></span>\n' +
                                    '</label>'
                            }else {
                                return '<label class="switch">\n' +
                                    '  <input type="checkbox" onclick="changeStatus('+data.id+')">' +
                                    '  <span class="slider round"></span>' +
                                    '</label>'
                            }
                        }},
                    {"data": null, "render": function (data) {
                            return '<div style="width: 100px;position: relative"><button type="submit" class="btn btn-danger waves-effect waves-light delBtn" onclick="destroyAlbum('+data.id+')"><i class="fas fa-trash-alt mr-1"></i>Delete</button><button class="btn btn-primary waves-effect waves-light ml-1" onclick="editModal('+data.id+')"><i class="far fa-edit mr-1"></i>Edit</button></div>'
                        }
                        },
                ],
            });
        }, 500);

        function changeStatus(id) {
            let _token   = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: "{{route('album.status')}}",
                type: "POST",
                data: {
                    album_id: id,
                    _token: _token
                },
                error: function(error){
                  console.log(error)
                },
                beforeSend: function(){
                    alertify.success('Changing...')
                },
                success: function () {
                    $('#album-datatable').DataTable().ajax.reload(null, false);
                    alertify.success('Status changed successfully!')
                }
            })
        }


        function destroyAlbum(id) {
            $.ajax({
                url: "{{route('album.destroy')}}",
                type: "GET",
                data: {
                    album_id: id
                },
                error: function (error) {
                    console.log(error)
                },
                beforeSend: function () {
                    alertify.success('Deleting...')
                },
                success: function (response) {
                    if(response.status == true){
                        alertify.success('Deleted successfully!')
                    }else if(response.status == false){
                        alertify.error('Operation failed!')
                    }
                    $('#album-datatable').DataTable().ajax.reload(null, false);
                }
            })
        }

        function editModal(id) {
            $('#album-type-edit-modal').modal('toggle');
            $('#album_id_edit').val(id);
            $.ajax({
                url: "{{route('album.getAlbumDetail')}}",
                type: "GET",
                data: {
                  album_id: id
                },
                error: function (error) {
                    console.log(error)
                },
                success: function (response) {
                    $('#album_title_edit').val(response.type);
                }

            })
        }
    </script>
@endsection

