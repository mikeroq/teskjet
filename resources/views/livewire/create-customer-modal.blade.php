<div class="modal-dialog" role="document">
    <div class="modal-content block block-themed">
        <div class="block-header bg-primary-dark">
            <h3 class="block-title"><i class="fas fa-pencil-alt mr-1"></i> Add New Customer</h3>
            <div class="block-options">
                <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                    <i class="fa fa-fw fa-times"></i>
                </button>
            </div>
        </div>
        <div class="modal-body bg-dark text-gray">
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
            <div class="custom-control custom-checkbox custom-control-success custom-control-lg mb-1">
                <input type="checkbox" class="custom-control-input" id="example-cb-custom-light-lg2" name="example-cb-custom-light-lg2" checked>
                <label class="custom-control-label" for="example-cb-custom-light-lg2">Taxable</label>
            </div>
        </div>
        <div class="modal-footer modal-footer-fixed bg-dark bg-black-10">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-pencil-alt fa-fw mr-1"></i>
                <span>Add Customer</span>
            </button>
        </div>
    </div>
</div>

