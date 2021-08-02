@push('modal')
    <x-form-modal type="create" slug="customer" title="Add New Customer" icon="fas fa-user" btn="Add Customer">
        <div class="form-group">
            <label for="customer_name">Name</label>
            <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="Enter Customer Name (required)" required>
        </div>
        <div class="form-group">
            <label for="customer_phone">Phone</label>
            <input type="text" class="form-control" id="customer_phone" name="customer_phone" placeholder="Enter Customer Phone (required)" required>
        </div>
        <div class="form-group">
            <label for="customer_type">Type</label>
            <select class="form-control" name="customer_type" id="customer_type" required>
                <option selected disabled>--- Select Type ---</option>
                @foreach (__('types/customer.type') as $value => $label)
                    <option value="{{ $value }}">{{ $label }}</option>
                @endforeach
            </select>
        </div>
        {{-- <div class="form-group">
            <div class="custom-control custom-switch mb-1">
                <input type="checkbox" class="custom-control-input" id="customer_taxable"
                    name="customer_taxable" value="1">
                <label class="custom-control-label" for="customer_taxable">Taxable</label>
            </div>
        </div> --}}
        <div class="custom-control custom-checkbox custom-control-success custom-control-lg mb-1">
            <input type="checkbox" class="custom-control-input" id="example-cb-custom-light-lg2" name="example-cb-custom-light-lg2" checked>
            <label class="custom-control-label" for="example-cb-custom-light-lg2">Taxable</label>
        </div>
    </x-form-modal>
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
                }).done(function(data) {
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
                        setTimeout(function() {
                            window.location = "/customers/" + data.insert;
                        }, 1500);
                    } else {
                        $("#customer_create").spinbutton("reset", "fas fa-plus mr-1",
                            "Add Customer");
                        Swal.fire(
                            'Error',
                            data.error,
                            'error'
                        )
                    }
                }).fail(function(data) {
                    var errors = '';
                    $.each(data.responseJSON.errors, function(key, value) {
                        errors += '<li>' + value[0] +
                        '</li>'; //showing only the first error.
                    });
                    $("#customer_create").spinbutton("reset", "fas fa-plus mr-1", "Add Customer");
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
