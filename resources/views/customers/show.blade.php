@extends('layouts.backend')

@section('content')
    <x-page-header :title="$customer->name" subtitle="Viewing Customer">
        <nav class="flex-sm-00-auto ml-sm-3">
            <div class="dropdown">
                <button type="button" class="btn btn-primary dropdown-toggle" id="dropdown-align-primary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-bars"></i>
                    <span class="d-none d-sm-inline-block">Actions</span>
                </button>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-align-primary" style="">
                    <a class="dropdown-item" data-toggle="modal" data-target="#edit_modal">
                        <i class="fas fa-edit mr-1 fa-fw"></i>
                        Edit Customer
                    </a>
                    <a class="dropdown-item" data-toggle="modal" data-target="#add_location_modal">
                        <i class="fas fa-location-arrow mr-1 fa-fw"></i>
                        Add Location
                    </a>
                    <a class="dropdown-item" id="del">
                        <i class="fas fa-times mr-1 fa-fw"></i>
                        Delete Customer
                    </a>
                </div>
            </div>
        </nav>
    </x-page-header>
    <div class="content">
        <!-- Your Block -->
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title">Customer Information</h3>
            </div>
            <div class="block-content">
                <p>
                    {{ $customer->name }}<br />
                    {{ phone($customer->phone, 'US') }}<br />
                    {{ $customer->type }}<br />
                    {{ $customer->displayable_taxable }}<br />
                    {{ $customer->created_at->format("Y-m-d h:i a") }}
                </p>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Action</th>
                            <th>User</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($customer->revisionHistory()->orderBy('created_at','desc')->get() as $history )
                        <tr>
                            <td>{{ $history->created_at->setTimezone(auth()->user()->timezone)->format("Y-m-d h:i a") }}</td>
                            @if($history->key == 'created_at' && !$history->old_value)
                            <td>Created Customer</td>
                            @else
                            <td>{{ $history->fieldName() }} was changed from {{ $history->oldValue() }} to {{ $history->newValue() }}</td>
                            @endif
                            <td>{{ $history->userResponsible()->full_name }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@push('modal')
    <div class="modal right fade" id="edit_modal" tabindex="-1" role="dialog" aria-labelledby="edit_modal" aria-hidden="true">
        <form id="edit_form" method="POST">
            @method('patch')
            <div class="modal-dialog" role="document">
                <div class="modal-content block block-themed">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title"><i class="fas fa-pencil-alt mr-1" id="edit_icon"></i> Edit Customer</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div id="edit_body" class="modal-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $customer->name }}" autofocus />
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="{{ $customer->phone }}"/>
                        </div>
                        <div class="form-group">
                            <label for="type">Type</label>
                            <select class="form-control" name="type" id="type">
                                @foreach (__('types/customer.type') as $value => $label)
                                    <option value="{{ $value }}"{{ $value == $customer->getAttributes()['type'] ? ' selected' : ''}}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-switch mb-1">
                                <input type="checkbox" class="custom-control-input" id="taxable" name="taxable"{{$customer->taxable ? ' checked' : ''}}>
                                <label class="custom-control-label" for="taxable">Taxable</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer modal-footer-fixed">
                        <button type="submit" class="btn btn-primary" id="edit_submit">
                            <i class="fas fa-pencil-alt mr-1"></i>&nbsp;
                            Update
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="modal right fade" id="add_location_modal" tabindex="-1" role="dialog" aria-labelledby="add_location_modal" aria-hidden="true">
        <form action="{{ route('customers.update', $customer->id) }}" method="POST" id="add_location_form">
            @csrf
            @method('patch')
        <div class="modal-dialog" role="document">
            <div class="modal-content block block-themed">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title"><i class="fas fa-plus mr-1"></i> Add Customer Location</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div id="add_location_body" class="modal-body">
                    <div class="form-group">
                        <label for="location_name">Name</label>
                        <input type="text" class="form-control form-control-alt" id="location_name" name="location_name" autofocus />
                    </div>
                    <div class="form-group">
                        <label for="location_address">Address</label>
                        <input type="text" class="form-control form-control-alt" id="location_address" name="location_address" required />
                    </div>
                    <div class="form-group">
                        <label for="location_address2">Address 2</label>
                        <input type="text" class="form-control form-control-alt" id="location_address2" name="location_address2" />
                    </div>
                    <div class="form-group row">
                        <div class="col-6">
                            <label for="city">City</label>
                        <input type="text" class="form-control form-control-alt" id="city" name="city" required />
                        </div>
                        <div class="col-3">
                            <label for="address2">State</label>
                            <select name="state" id="state" class="form-control form-control-alt">
                                <option>Select</option>
                                <option value="AL">AL</option>
                                <option value="AK">AK</option>
                                <option value="AR">AR</option>
                                <option value="AZ">AZ</option>
                                <option value="CA">CA</option>
                                <option value="CO">CO</option>
                                <option value="CT">CT</option>
                                <option value="DC">DC</option>
                                <option value="DE">DE</option>
                                <option value="FL">FL</option>
                                <option value="GA">GA</option>
                                <option value="HI">HI</option>
                                <option value="IA">IA</option>
                                <option value="ID">ID</option>
                                <option value="IL">IL</option>
                                <option value="IN">IN</option>
                                <option value="KS">KS</option>
                                <option value="KY">KY</option>
                                <option value="LA">LA</option>
                                <option value="MA">MA</option>
                                <option value="MD">MD</option>
                                <option value="ME">ME</option>
                                <option value="MI">MI</option>
                                <option value="MN">MN</option>
                                <option value="MO">MO</option>
                                <option value="MS">MS</option>
                                <option value="MT">MT</option>
                                <option value="NC">NC</option>
                                <option value="NE">NE</option>
                                <option value="NH">NH</option>
                                <option value="NJ">NJ</option>
                                <option value="NM">NM</option>
                                <option value="NV">NV</option>
                                <option value="NY">NY</option>
                                <option value="ND">ND</option>
                                <option value="OH">OH</option>
                                <option value="OK">OK</option>
                                <option value="OR">OR</option>
                                <option value="PA">PA</option>
                                <option value="RI">RI</option>
                                <option value="SC">SC</option>
                                <option value="SD">SD</option>
                                <option value="TN">TN</option>
                                <option value="TX">TX</option>
                                <option value="UT">UT</option>
                                <option value="VT">VT</option>
                                <option value="VA">VA</option>
                                <option value="WA">WA</option>
                                <option value="WI">WI</option>
                                <option value="WV">WV</option>
                                <option value="WY">WY</option>
                            </select>
                        </div>
                        <div class="col-3">
                            <label for="zip">Zip</label>
                            <input type="text" class="form-control form-control-alt" id="zip" name="zip" required />
                        </div>
                    </div>
                </div>
                <div class="modal-footer modal-footer-fixed">
                    <button type="button" class="btn btn-secondary" onclick="$('#add_location_form').trigger('reset');"><i class="fas fa-redo-alt fa-fw mr-1"></i>Reset</button>
                    <button type="submit" id="add_location_submit" class="btn btn-primary">
                        <i class="fas fa-plus mr-1 fa-fw"></i>
                        Add Location
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
            $('#edit_form').submit(function(event) {
                $("#edit_submit").spinbutton();
                event.preventDefault();
                var form = $(this);
                $.ajax({
                    type        : 'PATCH',
                    url         : '{{ route('customers.update', $customer->id) }}',
                    data        : form.serialize(),
                    encode      : true
                }).done(function(data) {
                    if (data.success)
                    {
                        $("#edit_submit").spinbutton("success");
                        $('#edit_modal').modal('toggle');
                        Swal.fire({
                            icon: 'success',
                            title: 'Customer Edited!',
                            text: 'Successfully edited customer. Redirecting...',
                            showConfirmButton: false,
                            timer: 2000
                        })
                        setTimeout(function() {
                            window.location = "/customers/{{ $customer->id }}";
                        }, 1500);
                    }
                    else
                    {
                        $("#edit_submit").spinbutton("reset","fas fa-pencil-alt mr-1","Update");
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
                    $("#edit_submit").spinbutton("reset","fas fa-pencil-alt mr-1","Update");
                    Swal.fire(
                        'Error',
                        '<div style=\'text-align: left;\'>' + errors + '</div>',
                        'error'
                    )
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
        });
        $(function(){
            $(document).on('click','#del',function(){
                swal.fire({
                    title: 'Warning',
                    text: "Are you sure you want to delete this customer?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete!',
                    cancelButtonText: 'No, cancel!'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            type:'DELETE',
                            url:'{{ route('customers.destroy', $customer->id) }}',
                            data:{'id':'{{$customer->id}}'},
                            success: function(data){
                                if(data.success){
                                    swal.fire({
                                        icon: 'success',
                                        title: 'Customer Deleted',
                                        showConfirmButton: false,
                                        timer: 2000
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
@endpush
