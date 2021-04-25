<div class="modal fade" id="photo-add-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Add Photo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="photo-gallery-add-form" class="form-horizontal m-t-5" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <div class="col-12">
                            <label>Title</label>
                            <input class="form-control" type="text" required="" placeholder="Eg: wedding, weaning, etc" name="title">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-12">
                            <label>Tag</label>
                            <input class="form-control" type="text" required="" placeholder="Eg: " name="tag">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-12">
                            @php
                            $types = \App\Models\AlbumType::all();
                            @endphp
                            <label>Album Type</label>
                            <select name="type" class="form-control">
                                <option value="" selected disabled="disabled">--choose--</option>
                                @foreach($types as $type)
                                    <option value="{{$type->id}}">{{$type->type}}</option>
                                    @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-12">
                            <label>Preview</label>
                            <div style="position: relative;width: 100%;height: 200px;">
                                <img id="photo_preview" src="{{asset('images/no-img.jpg')}}" alt="" style="height: 100%;width: 100%;object-fit: cover">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-12">
                            <label>Picture</label>
                            <input class="form-control-file" type="file" required="" name="photo" onchange="document.getElementById('photo_preview').src = window.URL.createObjectURL(this.files[0])">
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
        $('#photo-gallery-add-form').on('submit', function (e) {
            e.preventDefault();
            let formData = new FormData(this);
            $.ajax({
                url: "{{route('photo_gallery.store')}}",
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
                    console.log(response)
                    if(response.status == true){
                        alertify.success('Added successfully!')
                    }else if(response.status == false){
                        alertify.error('Operation failed!')
                    }
                    document.getElementById('photo-gallery-add-form').reset();
                    $('#photo-add-modal').modal('toggle');
                    $('#photo-gallery-datatable').DataTable().ajax.reload(null, false);
                },
                cache: false,
                contentType: false,
                processData: false
            })
        })
    },100)
</script>