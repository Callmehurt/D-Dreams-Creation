<div class="modal fade" id="video-edit-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Edit Video</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="video-gallery-edit-form" class="form-horizontal m-t-5" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="video_id" value="" id="video_id">
                    <div class="form-group">
                        <div class="col-12">
                            <label>Title</label>
                            <input id="video_title" class="form-control" type="text" required="" placeholder="Eg: Someone's pre-wedding shoot.." name="title">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-12">
                            <label>Tag</label>
                            <input id="video_tag" class="form-control" type="text" required="" placeholder="Eg: pre-wedding" name="tag">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-12">
                            @php
                                $types = \App\Models\AlbumType::all();
                            @endphp
                            <label>Album Type</label>
                            <select name="type" class="form-control" id="video_type">
                                <option value="" selected disabled="disabled">--choose--</option>
                                @foreach($types as $type)
                                    <option value="{{$type->id}}">{{$type->type}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-12">
                            <label>Video Link</label>
                            <input id="video_link" class="form-control" type="text" required="" placeholder="Your youtube video link" name="video_link">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-12">
                            <label>Thumbnail Preview</label>
                            <div style="position: relative;width: 100%;height: 200px;">
                                <img id="thumbnail_preview_edit" src="{{asset('images/no-img.jpg')}}" alt="" style="height: 100%;width: 100%;object-fit: cover">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-12">
                            <label>Picture</label>
                            <input class="form-control-file" type="file" name="photo" onchange="document.getElementById('thumbnail_preview_edit').src = window.URL.createObjectURL(this.files[0])">
                        </div>
                    </div>
                    <div class="form-group text-center m-t-20">
                        <div class="col-12">
                            <button class="btn btn-primary btn-block btn-lg waves-effect waves-light" type="submit">Add</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>


<script>
    setTimeout(function () {
        $('#video-gallery-edit-form').on('submit', function (e) {
            e.preventDefault();
            let formData = new FormData(this);
            $.ajax({
                url: "{{route('video_gallery.update')}}",
                type: "POST",
                data: formData,
                error: function (error) {
                    console.log(error);
                    error.responseJSON.errors.photo.map(function (err) {
                        alertify.error(err);
                    })
                },
                beforeSend: function () {
                    alertify.success('Processing...')
                },
                success: function (response) {
                    if (response.status == true) {
                        alertify.success('Updated successfully!')
                    } else if (response.status == false) {
                        alertify.error('Operation failed!')
                    }
                    document.getElementById('video-gallery-edit-form').reset();
                    $('#video-edit-modal').modal('toggle');
                    $('#video-gallery-datatable').DataTable().ajax.reload(null, false);
                },
                cache: false,
                contentType: false,
                processData: false
            })
        })
    },100)
</script>