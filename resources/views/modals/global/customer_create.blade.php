@push('modal')
<div class="modal right fade" id="customer_create_modal" tabindex="-1" role="dialog" aria-labelledby="customer_create_modal" aria-hidden="true">
    <form action="{{ route('customers.store') }}" method="POST" id="customer_create_form">
        @csrf
        <div class="modal-dialog" role="document">
            <div class="modal-content block block-themed">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title"><i class="fas fa-user mr-1" id="edit_icon"></i> Add New Customer</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div id="customer_create_body" class="modal-body">
                    <div class="form-group">
                        <div class="form-material floating">
                            <input type="text" class="form-control" id="customer_name" name="customer_name" required>
                            <label for="customer_name">Name</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-material floating">
                            <input type="text" class="form-control" id="customer_phone" name="customer_phone" required>
                            <label for="customer_phone">Phone</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-material floating">
                            <select class="form-control" name="customer_type" id="customer_type" required>
                                <option></option>
                                @foreach (__('types/customer.type') as $value => $label)
                                <option value="{{ $value }}">{{ $label }}</option>
                                @endforeach
                            </select>
                            <label for="customer_type">Type</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-switch mb-1">
                            <input type="checkbox" class="custom-control-input" id="customer_taxable" name="customer_taxable" value="1">
                            <label class="custom-control-label" for="customer_taxable">Taxable</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer modal-footer-fixed">
                    <button type="submit" class="btn btn-primary" id="customer_create">
                        <i class="fas fa-plus mr-1"></i>&nbsp;
                        <span>Add Customer</span>
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
@endpush
@push('scripts')
<script type="text/javascript">
    $(document).ready(function() {

        $('#customer_create_form').submit(function(event) {
            event.preventDefault();
            $("#customer_create").spinbutton();
            const formData = {
                'name': $('input[name=customer_name]').val(),
                'phone': $('input[name=customer_phone]').val(),
                'type': $('select[name=customer_type]').val(),
                'taxable': $('input[name=customer_taxable]').is(":checked")
            };
            $.ajax({
                type: 'POST',
                url: '{{ route('customers.store') }}',
                data: formData,
                dataType: 'json',
                encode: true
            }).done(function (data) {
                if (data.success) {
                    $("#customer_create").spinbutton("success");
                    $("#customer_create_form").trigger("reset");
                    Swal.fire({
                        icon: 'success',
                        title: 'Customer Added!',
                        text: 'Successfully added new customer. Redirecting...',
                        showConfirmButton: false,
                        timer: 2000
                    })
                    setTimeout(function () {
                        window.location = "/customers/" + data.insert;
                    }, 1500);
                } else {
                    $("#customer_create").spinbutton("reset","fas fa-plus mr-1","Add Customer");
                    Swal.fire(
                        'Error',
                        data.error,
                        'error'
                    )
                }
            }).fail(function(data) {
                var errors = '';
                $.each( data.responseJSON.errors, function( key, value ) {
                      errors += '<li>'+ value[0] + '</li>'; //showing only the first error.
                });
                $("#customer_create").spinbutton("reset","fas fa-plus mr-1","Add Customer");
                Swal.fire(
                    'Error',
                    '<div style=\'text-align: left;\'>' + errors + '</div>',
                    'error'
                )
            });
        });
    });
    </script>
@endpush
