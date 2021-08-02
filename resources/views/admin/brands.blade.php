@extends('layouts.backend')
@section('content')
    <x-page-header title="Brands Management" subtitle="Admin Panel"></x-page-header>
    <div class="content p-0">
        <div class="block block-themed block-transparent bg-black-25 mb-0">
            <div class="block-content text-gray pb-3">
                {{ $dataTable->table(['class' => 'table table-striped table-vcenter table-dark'], true) }}
            </div>
        </div>
    </div>
@endsection
@push('modal')
<div class="modal right fade" id="brand_create_modal" tabindex="-1" role="dialog" aria-labelledby="brand_create_modal" aria-hidden="true">
    <form action="{{ route('brands.store') }}" method="POST" id="brand_create_form">
        @csrf
        <div class="modal-dialog" role="document">
            <div class="modal-content block block-themed">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title"><i class="far fa-registered mr-1" id="edit_icon"></i> Create Brand</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div id="brand_create_body" class="modal-body bg-dark text-gray">
                    <div class="form-group">
                        <label for="brand_name">Name</label>
                        <input type="text" class="form-control" id="brand_name" name="brand_name" placeholder="Enter Brand Name" required>
                    </div>
                    <div class="form-group">
                        <label for="brand_site">Website</label>
                        <input type="text" class="form-control" id="brand_site" name="brand_site" placeholder="Enter Website URL (optional)">
                    </div>
                    <div class="form-group">
                        <label for="brand_phone">Support Phone</label>
                        <input type="text" class="form-control" id="brand_phone" name="brand_phone" placeholder="Ender Support Phone (optional)">
                    </div>
                </div>
                <div class="modal-footer modal-footer-fixed bg-dark bg-black-10">

                    <button type="submit" class="btn btn-primary" id="brand_create">
                        <i class="fas fa-plus mr-1"></i>&nbsp;
                        <span>Add Brand</span>
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
<div class="modal right fade" id="brand_edit_modal" tabindex="-1" role="dialog" aria-labelledby="brand_edit_modal" aria-hidden="true">
    <form action="" method="POST" id="brand_edit_form">
        @csrf
        @method('patch')
        <div class="modal-dialog" role="document">
            <div class="modal-content block block-themed">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title"><i class="fas fa-pencil-alt mr-1" id="edit_icon"></i> Edit Brand</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div id="brand_edit_body" class="modal-body bg-dark text-gray">
                    <div class="form-group">
                        <label for="edit_name">Name</label>
                        <input type="text" class="form-control" id="edit_name" name="edit_name" placeholder="Enter Brand Name" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_site">Website</label>
                        <input type="text" class="form-control" id="edit_site" name="edit_site" placeholder="Enter Website URL (optional)">
                    </div>
                    <div class="form-group">
                        <label for="edit_phone">Support Phone</label>
                        <input type="text" class="form-control" id="edit_phone" name="edit_phone" placeholder="Ender Support Phone (optional)">
                    </div>
                </div>
                <div class="modal-footer modal-footer-fixed bg-dark bg-black-10">
                    <button type="submit" class="btn btn-primary" id="brand_edit">
                        <i class="fas fa-plus mr-1"></i>&nbsp;
                        <span>Update Brand</span>
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
@endpush
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
                            url:'/admin/brands/'+$(this).data('delete'),
                            data:{'id':$(this).data('delete')},
                            success: function(data){
                                if(data.success){
                                    swal.fire({
                                        icon: 'success',
                                        title: 'Brand Deleted',
                                        showConfirmButton: false,
                                        timer: 1000
                                    })
                                    $('#brands-table').DataTable().rows($(this).parents('tr')).remove().draw(false);
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
                            'Brand was not deleted. :)',
                            'error'
                        )
                    }
                })
            });
        });
        var edit_id = 0;
        $(document).ready(function() {
            $(document).on('click','.edit',function(){
                edit_id = $(this).data('id');
                var row = $('#brands-table').DataTable().row($(this).parents('tr')).data();
                $('#edit_name').val(row.name);
                $('#edit_site').val(row.website);
                $('#edit_phone').val(row.support_number);
                $('#brand_edit_modal').modal('toggle');
            });
            $('#brand_edit_form').submit(function(event) {
                $("#brand_edit").spinbutton();
                event.preventDefault();
                var form = $(this);
                $.ajax({
                    type        : 'PATCH',
                    url         : '/admin/brands/'+edit_id,
                    data        : form.serialize(),
                    encode      : true
                }).done(function(data) {
                    console.log(data);
                    if (data.success)
                    {
                        $("#brand_edit").spinbutton("success","fas fa-plus mr-1","Update Brand");
                        $('#brand_edit_modal').modal('toggle');
                        $("#brand_edit_form").trigger("reset");
                        Swal.fire({
                            icon: 'success',
                            title: 'Brand Edited!',
                            text: 'Successfully edited brand.',
                            showConfirmButton: false,
                            timer: 2000
                        })
                        $('#brands-table').DataTable().ajax.reload();
                        $("#brand_edit").spinbutton("reset","fas fa-plus mr-1","Update Brand");
                    }
                    else
                    {
                        $("#brand_edit").spinbutton("reset","fas fa-plus mr-1","Update Brand");
                        Swal.fire(
                            'Error',
                            data.error,
                            'error'
                        )
                    }
                });
            }).each(function(){
                $(this).data('serialized', $(this).serialize())
            }).on('change input', function(){
                $(this)
                    .find('input:submit, button:submit')
                    .prop('disabled', $(this).serialize() == $(this).data('serialized'))
                ;
            }).find('input:submit, button:submit').prop('disabled', true);
            $('#brand_create_form').submit(function(event) {
                event.preventDefault();
                $("#brand_create").spinbutton();
                const formData = {
                    'brand_name': $('input[name=brand_name]').val(),
                    'brand_site': $('input[name=brand_site]').val(),
                    'brand_phone': $('input[name=brand_phone]').val()
                };
                $.ajax({
                    type: 'POST',
                    url: '{{ route('brands.store') }}',
                    data: formData,
                    dataType: 'json',
                    encode: true
                }).done(function (data) {
                    if (data.success) {
                        $("#brand_create").spinbutton("success");
                        $("#brand_create_form").trigger("reset");
                        Swal.fire({
                            icon: 'success',
                            title: 'Brand Added!',
                            text: 'Successfully added new brand.',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        $('#brand_create_modal').modal('toggle');
                        $('#brands-table').DataTable().ajax.reload();
                        $("#brand_create").spinbutton("reset","fas fa-plus mr-1","Add Brand");
                    } else {
                        $("#brand_create").spinbutton("reset","fas fa-plus mr-1","Add Brand");
                        Swal.fire(
                            'Error',
                            data.error,
                            'error'
                        )
                    }
                }).fail(function(jqXHR, textStatus, errorThrown) {
                    $("#brand_create").spinbutton("reset","fas fa-plus mr-1","Add Brand");
                    Swal.fire(
                        'Error',
                        errorThrown,
                        'error'
                    )
                });
            });
        });
        </script>
    {{$dataTable->scripts()}}
@endpush
