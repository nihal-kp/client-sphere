@extends("admin.layouts.app")
@section('title', 'Text Boxes')
@section("content")

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="row">
            <!-- Page Heading -->
            <div class="col-6">
            <h1 class="h3 mb-2 text-gray-800">Text Boxes</h1>
            </div>
            <div class="col-6 text-right">
            <a href="{{route('admin.text-boxes.create')}}" class="btn btn-primary" ><i class="fa fa-plus"></i> Add</a>
            </div>
        </div>
        <!--<p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.-->
        <!--    For more information about DataTables, please visit the <a target="_blank"-->
        <!--        href="https://datatables.net">official DataTables documentation</a>.</p>-->

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <!--<div class="card-header py-3">-->
            <!--    <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>-->
            <!--</div>-->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="textBox-table" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Label</th>
                                <th>Value</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection

@push('modal')      

    <!-- Delete Modal-->
    <div class="modal fade" id="delete-textBox-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Are you sure you want to delete this data?</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn_delete_textBox "><i class="fa fa-trash"></i> Delete</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>                
                </div>
            </div>
        </div>
    </div>
  
@endpush

@push('style')
<!-- Toastr CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endpush

@push('script')
<!-- Page level plugins -->
<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('js/demo/datatables-demo.js') }}"></script>
<!--<script src="{{ asset('js/jquery.toast.min.js')}}" type="text/javascript"></script>-->
<!--<script src="{{ asset('js/toastr.js')}}" type="text/javascript"></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<!-- Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    @if(session('success'))
        toastr.success("{{ session('success') }}");
    @endif

    @if(session('error'))
        toastr.error("{{ session('error') }}");
    @endif

    @if(session('warning'))
        toastr.warning("{{ session('warning') }}");
    @endif

    @if(session('info'))
        toastr.info("{{ session('info') }}");
    @endif
</script>

<script type="text/javascript">

   $(function() {

     $textBoxTable= $('#textBox-table').DataTable({

         processing: true,
         serverSide: true,

         ajax: '{{ route("admin.text-boxes.index") }}',

         columns: [

	      	{ data: 'label', name: 'label' },
            { data: 'value', name: 'value' },
			{
                data: 'created_at',
                name: 'created_at',
                render: function (data) {
                    return moment(data).format('YYYY-MM-DD h:mm A');
                }
			},
            { data: 'actions', orderable: false}

         ],
         order: [[ 0, "desc" ]]

     });
 

     $('table').on('click','.textBox-delete', function(e){
        var href=$(this).data('href');
            $('.btn_delete_textBox').off().click(function() {
		      $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, 
                    type: 'DELETE',
                    //data:{},
                    dataType : 'JSON', 
                    url : href,
                    success: function(response){
                        $('#delete-textBox-modal').modal('hide');
                        $('#textBox-table').DataTable().ajax.reload();
                        toastr.success(response.message, response.status);
                    },
                    error: function (xhr) {
                        $('#delete-textBox-modal').modal('hide');
                        toastr.error('Something went wrong.', 'Error');
                    }
              });
   		 });
    });

   });

</script>
  @endpush