@extends('layouts.backend')
@section('content')
    <x-page-header title="Device Type Management" subtitle="Admin Panel"></x-page-header>
    <div class="content p-0">
        <div class="block block-themed block-transparent bg-black-25 mb-0">
            <div class="block-content text-gray pb-3">
                {{ $dataTable->table(['class' => 'table table-striped table-vcenter table-dark'], true) }}
            </div>
        </div>
    </div>
@endsection
@push('modal')
<x-form-modal type="create" slug="devicetype" title="Create Device Type" icon="far fa-registered" btn="Add Device Type">
    <div class="form-group">
        <label for="devicetype_name">Name</label>
        <input type="text" class="form-control" id="devicetype_name" name="devicetype_name" placeholder="Enter Device Type" required>
    </div>
</x-form-modal>
<x-form-modal type="edit" slug="devicetype" title="Edit Device Type" icon="fas fa-pencil-alt" btn="Edit Customer">
    <div class="form-group">
        <label for="devicetype_name">Name</label>
        <input type="text" class="form-control" id="edit_devicetype_name" name="edit_devicetype_name" placeholder="Enter Device Type" required>
    </div>
</x-form-modal>
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
                            url:'/admin/devicetypes/'+$(this).data('delete'),
                            data:{'id':$(this).data('delete')},
                            success: function(data){
                                if(data.success){
                                    swal.fire({
                                        icon: 'success',
                                        title: 'Device Type Deleted',
                                        showConfirmButton: false,
                                        timer: 1000
                                    })
                                    $('#devicetypes-table').DataTable().rows($(this).parents('tr')).remove().draw(false);
                                } else {
                                    swal.fire(
                                        'Error',
                                        data.error,
                                        'danger'
                                    )
                                }
                            }
                        });
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        swal.fire(
                            'Cancelled',
                            'Device type was not deleted. :)',
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
                var row = $('#devicetypes-table').DataTable().row($(this).parents('tr')).data();
                $('#edit_devicetype_name').val(row.name);
                $('#devicetype_edit_modal').modal('toggle');
            });

            $('#devicetype_edit_form').submit(function(event) {
                $("#devicetype_edit").spinbutton();
                event.preventDefault();
                var form = $(this);
                $.ajax({
                    type        : 'PATCH',
                    url         : '/admin/devicetypes/'+edit_id,
                    data        : form.serialize(),
                    encode      : true
                }).done(function(data) {
                    console.log(data);
                    if (data.success)
                    {
                        $("#devicetype_edit").spinbutton("success","fas fa-plus mr-1","Update Brand");
                        $('#devicetype_edit_modal').modal('toggle');
                        $("#devicetype_edit_form").trigger("reset");
                        Swal.fire({
                            icon: 'success',
                            title: 'Device Type Edited!',
                            text: 'Successfully edited device type.',
                            showConfirmButton: false,
                            timer: 2000
                        })
                        $('#devicetypes-table').DataTable().ajax.reload();
                        $("#devicetype_edit").spinbutton("reset","fas fa-plus mr-1","Update Brand");
                    }
                    else
                    {
                        $("#devicetype_edit").spinbutton("reset","fas fa-plus mr-1","Update Brand");
                        Swal.fire(
                            'Error',
                            data.error,
                            'error'
                        )
                    }
                });

            }).each(function(){
                $(this).data('serialized', $(this).serialize())
            })
                .on('change input', function(){
                    $(this)
                        .find('input:submit, button:submit')
                        .prop('disabled', $(this).serialize() == $(this).data('serialized'))
                    ;
                })
                .find('input:submit, button:submit')
                .prop('disabled', true);



            $('#devicetype_create_form').submit(function(event) {
                event.preventDefault();
                $("#devicetype_create").spinbutton();
                const formData = {
                    'devicetype_name': $('input[name=devicetype_name]').val(),
                    'devicetype_site': $('input[name=devicetype_site]').val(),
                    'devicetype_phone': $('input[name=devicetype_phone]').val()
                };
                $.ajax({
                    type: 'POST',
                    url: '{{ route('devicetypes.store') }}',
                    data: formData,
                    dataType: 'json',
                    encode: true
                }).done(function (data) {
                    if (data.success) {
                        $("#devicetype_create").spinbutton("success");
                        $("#devicetype_create_form").trigger("reset");
                        Swal.fire({
                            icon: 'success',
                            title: 'Device Type Added!',
                            text: 'Successfully added new device type.',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        $('#devicetype_create_modal').modal('toggle');
                        $('#devicetypes-table').DataTable().ajax.reload();
                        $("#devicetype_create").spinbutton("reset","fas fa-plus mr-1","Add Brand");
                    } else {
                        $("#devicetype_create").spinbutton("reset","fas fa-plus mr-1","Add Brand");
                        Swal.fire(
                            'Error',
                            data.error,
                            'error'
                        )
                    }
                }).fail(function(jqXHR, textStatus, errorThrown) {
                    $("#devicetype_create").spinbutton("reset","fas fa-plus mr-1","Add Brand");
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
