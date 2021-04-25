<div class="modal fade" id="album-type-edit-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Add Album Type</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="album-type-edit-form" class="form-horizontal m-t-5" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="album_id" value="" id="album_id_edit">
                    <div class="form-group">
                        <div class="col-12">
                            <label>Title</label>
                            <input class="form-control" type="text" required="" placeholder="Eg: wedding, weaning, etc" name="title" id="album_title_edit">
                        </div>
                    </div>
                    <div class="form-group text-center m-t-20">
                        <div class="col-12">
                            <button class="btn btn-primary btn-block btn-lg waves-effect waves-light" type="submit">Update</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<script>
    setTimeout(function () {
        $('#album-type-edit-form').on('submit', function (e) {
            e.preventDefault();
            let formData = new FormData(this)
            $.ajax({
                url: "{{route('album.update')}}",
                type: "POST",
                data: formData,
                error: function (error) {
                    console.log(error);
                },
                beforeSend: function () {
                    alertify.success('Updating...')
                },
                success: function (response) {
                    if(response.status == true){
                        alertify.success('Updated successfully!')
                    }else if(response.status == false){
                        alertify.error('Operation failed!')
                    }
                    $('#album-datatable').DataTable().ajax.reload(null, false);
                },
                cache: false,
                contentType: false,
                processData: false
            })
        })
    },100)
</script>
