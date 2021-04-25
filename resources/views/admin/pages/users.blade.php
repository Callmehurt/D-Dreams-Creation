@extends('.admin/layouts/index')

@section('content')
    <div class="page-title-box">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <h4 class="page-title">User List</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">D Dreams Creation</a></li>
                    <li class="breadcrumb-item active">User List</li>
                </ol>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card mt-2">
                <div class="card-body">
                    <table id="users-datatable" class="table table-bordered table-striped table-responsive-lg nowrap" style="border-collapse: collapse;border-spacing: 0;width: 100%">
                        <thead>
                        <tr>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Profile</th>
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
           $('#users-datatable').DataTable({
               "processing": true,
               "severside": true,
               "ajax": "{{route('getUsers')}}",
               "columns": [
                   {"data": "name"},
                   {"data": "email"},
                   {"data": null, "render": function (data) {
                           return '<img src="{{asset('uploads/profile_pics')}}/'+data.profile_pic+'" height="50px" width="50px" />'
                       }},
                   {"data": null, "render": function (data) {
                           return '<div style="width: 100px;position: relative"><button type="submit" class="btn btn-danger waves-effect waves-light delBtn" onclick="deleteUser('+data.id+')"><i class="fas fa-trash-alt"></i></button></div>'
                       }},
               ],
           });
       }, 500);

       function deleteUser(id) {
           event.preventDefault();
           $.ajax({
               url: "{{route('user.destroy')}}",
               type: "GET",
               data: {
                   user_id: id,
                   {{--_token: "{{csrf_token()}}"--}}
               },
               error: function (error) {
                   console.log(error)
                   alertify.error('Error deleting..')
               },
               beforeSend: function(){
                   alertify.success('Processing..')
               },
               success: function (response) {
                   $('#users-datatable').DataTable().ajax.reload(null, false);
                   if(response.status == true){
                       alertify.success('Deleted successfully!')
                   }else {
                       alertify.error('Error deleting..')
                   }
               }
           })
       }
    </script>
@endsection