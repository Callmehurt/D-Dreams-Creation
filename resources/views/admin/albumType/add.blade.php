<div class="modal fade" id="album-type-add-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Add Album Type</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="album-type-add-form" class="form-horizontal m-t-5" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <div class="col-12">
                            <label>Title</label>
                            <input class="form-control" type="text" required="" placeholder="Eg: wedding, weaning, etc" name="title">
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
        $('#album-type-add-form').on('submit', function (e) {
            e.preventDefault();
            let formData = new FormData(this);
            $.ajax({
                url: "{{route('album.store')}}",
                type: "POST",
                data: formData,
                error: function (error) {
                    console.log(error);
                },
                beforeSend: function () {
                    alertify.success('Processing...')
                },
                success: function (response) {
                    if(response.status == true){
                        alertify.success('Added successfully!')
                    }else if(response.status == false){
                        alertify.error('Operation failed!')
                    }
                    document.getElementById('album-type-add-form').reset();
                    $('#album-datatable').DataTable().ajax.reload(null, false);
                },
                cache: false,
                contentType: false,
                processData: false
            })
        })
    },100)
</script>