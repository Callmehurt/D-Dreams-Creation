<div class="modal fade" id="package-add-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Add Photo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="package-add-form" class="form-horizontal m-t-5" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <div class="col-12">
                            <label>Title</label>
                            <input class="form-control" type="text" required="" placeholder="Eg: wedding, weaning, etc" name="title">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-12">
                            <label>Amount</label>
                            <input class="form-control" type="text" data-parsley-type="number" required="" placeholder="Eg: 10000" name="amount">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-12">
                            <label>Preview</label>
                            <div style="position: relative;width: 100%;height: 200px;">
                                <img id="package_preview" src="{{asset('images/no-img.jpg')}}" alt="" style="height: 100%;width: 100%;object-fit: cover">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-12">
                            <label>Picture</label>
                            <input class="form-control-file" type="file" required="" name="photo" onchange="document.getElementById('package_preview').src = window.URL.createObjectURL(this.files[0])">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-12">
                            <label>Description</label>
                            <textarea class="form-control" type="text" required="" placeholder="Package Description" id="package_description"></textarea>
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

<script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
<script>
    setTimeout(function () {
        CKEDITOR.replace('package_description');
    }, 500)
    setTimeout(function () {
        $('#package-add-form').on('submit', function (e) {
            e.preventDefault();
            let formData = new FormData(this);
            formData.append('package_description', CKEDITOR.instances['package_description'].getData());
        $.ajax({
                url: "{{route('package.store')}}",
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
                    document.getElementById('package-add-form').reset();
                    $('#package-add-modal').modal('toggle');
                    $('#packages-datatable').DataTable().ajax.reload(null, false);
                },
                cache: false,
                contentType: false,
                processData: false
            })
        })
    },100)
</script>