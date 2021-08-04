@extends('layouts.backend')
@section('content')
	<x-page-header title="User Management" subtitle="Admin Panel"></x-page-header>
	<div class="content p-0">
        <div class="block block-themed block-transparent bg-black-25 mb-0">
            <div class="block-content text-gray pb-3">
                <livewire:admin.user-table />
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
				<div id="brand_create_body" class="modal-body">
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
				<div class="modal-footer modal-footer-fixed">

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
				<div id="brand_edit_body" class="modal-body">
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
				<div class="modal-footer modal-footer-fixed">

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