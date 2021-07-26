@extends('layouts.backend')

@section('content')
    <x-page-header title="Ticket List"></x-page-header>
    <div class="content p-0">
        <div class="block p-2">
            <div class="block-content">
                {{-- {{$dataTable->table(['class' => 'table table-striped table-vcenter'],true)}} --}}
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript">
        $(function(){
            $(document).on('click','.delete',function(){
                swal.fire({
                    title: 'Warning',
                    html: "Are you sure you want to delete<br />"+$(this).data('name')+"?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete!',
                    cancelButtonText: 'No, cancel!'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            type:'DELETE',
                            url:'/customers/'+$(this).data('delete'),
                            data:{'id':$(this).data('delete')},
                            success: function(data){
                                if(data.success){
                                    swal.fire({
                                        icon: 'success',
                                        title: 'Customer Deleted',
                                        showConfirmButton: false,
                                        timer: 1000
                                    })
                                    $('#customers-table').DataTable().rows($(this).parents('tr')).remove().draw(false);
                                } else {
                                    swal.fire(
                                        'Error',
                                        'Something went wrong...',
                                        'danger'
                                    )
                                }
                            }
                        });
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        swal.fire(
                            'Cancelled',
                            'Customer was not deleted. :)',
                            'error'
                        )
                    }
                })
            });
        });
    </script>
    {{-- {{$dataTable->scripts()}} --}}
@endpush
