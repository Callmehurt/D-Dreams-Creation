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
                <h4 class="page-title">Video List</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">D Dreams Creation</a></li>
                    <li class="breadcrumb-item active">Video List</li>
                </ol>
            </div>
        </div>
    </div>

    @include('admin.videoGallery.add')
    @include('admin.videoGallery.edit')
    <div class="row">
        <div class="col-lg-3 col-md-12">
            <div style="position: relative;margin-top: 26px">
                <button class="btn btn-primary" data-toggle="modal" data-target="#video-add-modal"><i class="fas fa-plus mr-2"></i>Add New</button>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card mt-2">
                <div class="card-body">
                    <table id="video-gallery-datatable" class="table table-bordered table-striped table-responsive-lg table-responsive-xl table-responsive-md nowrap" style="border-collapse: collapse;border-spacing: 0;width: 100%!important;">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Tag</th>
                            <th>Type</th>
                            <th>Thumbnail</th>
                            <th>Video Link</th>
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
            $('#video-gallery-datatable').DataTable({
                "processing": true,
                "severside": true,
                "ajax": "{{route('video_gallery.getVideos')}}",
                "columns": [
                    {"data": "title"},
                    {"data": "tag"},
                    {"data": "album"},
                    {"data": null, "render": function (data) {
                            return '<img src="{{asset('')}}'+''+data.image+'" height="80px" width="80px" />'
                        }},
                    {"data": "video_link"},
                    {"data": null, "render": function (data) {
                            if (data.status == true){
                                return '<label class="switch">\n' +
                                    '  <input type="checkbox" onclick="changeStatus('+data.id+')" checked>' +
                                    '  <span class="slider round"></span>' +
                                    '</label>'
                            }else {
                                return '<label class="switch">\n' +
                                    '  <input type="checkbox" onclick="changeStatus('+data.id+')">' +
                                    '  <span class="slider round"></span>' +
                                    '</label>'
                            }
                        }},
                    {"data": null, "render": function (data) {
                            return '<div style="width: 100px;position: relative"><button type="submit" class="btn btn-danger waves-effect waves-light delBtn" onclick="destroyVideo('+data.id+')"><i class="fas fa-trash-alt"></i></button><button class="btn btn-primary waves-effect waves-light ml-1" onclick="videoEditModal('+data.id+')"><i class="fa fa-edit"></i></button></div>'
                        }},
                ],
            });
        }, 500);

        function changeStatus(id) {
            let _token   = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: "{{route('video_gallery.status')}}",
                type: "POST",
                data: {
                    video_id: id,
                    _token: _token
                },
                error: function(error){
                    console.log(error)
                },
                beforeSend: function(){
                    alertify.success('Changing...')
                },
                success: function (response) {
                    console.log(response)
                    if(response.status == true){
                        $('#video-gallery-datatable').DataTable().ajax.reload(null, false);
                        alertify.success('Status changed successfully!')
                    }else {
                        $('#video-gallery-datatable').DataTable().ajax.reload(null, false);
                        alertify.error('Error while processing')
                    }
                }
            })
        }


        function destroyVideo(id) {
            event.preventDefault();
            let url = '{{route('video_gallery.destroy', ':id')}}'
            url = url.replace(':id', id)
            alertify.confirm('Are you sure to continue?',
                function(){
                    $.ajax({
                        url: url,
                        type: "GET",
                        error: function (error) {
                            console.log(error)
                        },
                        success: function(response){
                            if(response.status == true){
                                $('#video-gallery-datatable').DataTable().ajax.reload(null, false);
                                alertify.success('Deleted successfully!')
                            }else {
                                $('#video-gallery-datatable').DataTable().ajax.reload(null, false);
                                alertify.error('Error while processing')
                            }
                        }
                    })
                }, function(){
                    alertify.error('Cancelled')
                });
        }

        function videoEditModal(id) {
            let url = '{{route('video_gallery.edit', ':id')}}'
            url = url.replace(':id', id)
            $.ajax({
                url: url,
                type: "GET",
                error: function (error) {
                    console.log(error)
                },
                success: function (response) {
                    let img_path = "{{URL::asset('')}}";
                    $('#video_id').val(id);
                    $('#video_title').val(response.data.title);
                    $('#video_tag').val(response.data.tag);
                    $('#video_type').val(response.data.type);
                    $('#video_link').val(response.data.video_link);
                    document.getElementById('thumbnail_preview_edit').src = img_path+response.data.image
                }
            })
            $('#video-edit-modal').modal('toggle');

        }
    </script>
@endsection

