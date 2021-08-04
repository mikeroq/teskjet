@extends('layouts.backend')

@section('title', 'Navigation Admin')
@section('content')
    <x-page-header title="Navigation Management" subtitle="Admin Panel"></x-page-header>
    <div class="content mb-0 p-0">
        <ul class="nav nav-tabs nav-tabs-alt nav-tabs-block" id="tabs">
            @foreach ($navigation_types as $type)
            <li class="nav-item">
                <a class="nav-link @if ($loop->first) active @endif" id="{{ $type->slug }}">{{ $type->name }}</a>
            </li>
            @endforeach
        </ul>
    </div>
    <div class="content tab-content">
        @foreach ($navigation_types as $type)
        <div class="tab-pane @if ($loop->first) active @endif" id="{{ $type->slug }}_tab" role="tabpanel">
            <div class="block block-rounded block-themed block-transparent bg-black-25 ajax-reload" id="{{ $type->slug }}_block">
                <div class="block-header block-header-default bg-black-10">
                    <h3 class="block-title">{{ $type->name }} Navigation</h3>
                    <div class="block-options">
                        <button class="btn-block-option refresh_table" data-type="{{ $type->slug }}" data-type_id="{{ $type->id }}">
                            <i class="fas fa-sync-alt mr-1"></i>
                        </button>
                        <button class="btn-block-option add_nav_modal" data-navtype="{{ $type->id }}">
                            <i class="fas fa-plus mr-1"></i>
                        <span>Add Link</span>
                        </button>
                    </div>
                </div>
                <div class="block-content text-gray p-0">
                    <div class="table-responsive" id="{{ $type->slug }}_table_div" data-navtype="{{ $type->slug }}" data-id="{{ $type->id }}">
                        {!! $type->renderHTML() !!}
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endsection
@push('modal')
<x-form-modal title="Add Page" slug="nav" type="create">
    <div class="form-group">
        <div class="form-material">
            <select name="nav_type" id="nav_type" class="form-control">
                @foreach ($navigation_types as $type)
                <option value="{{ $type->id }}">{{ $type->name }}</option>
                @endforeach
            </select>
            <label for="nav_type">Navigation Type</label>
        </div>
    </div>
    <div class="form-group">
        <div class="form-material floating">
            <input type="text" class="form-control" id="title" name="title" required>
            <label for="title">Title</label>
        </div>
    </div>
    <div class="form-group">
        <div class="form-material floating input-group">
            <input type="text" class="form-control" id="icon" name="icon" onkeyup="$('#preview').removeClass().addClass($('#icon').val());">
            <label for="icon">Nav Icon</label>
            <div class="input-group-append">
                <span class="input-group-text">
                    <i id="preview" class=""></i>
                </span>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="form-material floating">
            <input type="text" class="form-control" id="url" name="url" required>
            <label for="url">URL</label>
        </div>
    </div>
    <div class="form-group">
        <div class="form-material">
            <select class="form-control" name="parent" id="parent" required>
                <option value="0" selected>No Parent</option>
                @foreach ($parent_pages as $page)
                <option value="{{ $page->id }}">{{ $page->title }}</option>
                @endforeach
            </select>
            <label for="parent">Parent</label>
        </div>
    </div>
    <div class="form-group">
        <div class="form-material">
            <select name="user_level" id="user_level" class="form-control">
                <option value="0" selected>All</option>
                <option value="9">Admin</option>
            </select>
            <label for="user_level">User Level</label>
        </div>
    </div>
</x-form-modal>
<x-form-modal title="Edit Page" slug="nav" type="edit">
    <div class="form-group">
        <div class="form-material">
            <input type="text" class="form-control" id="edit_title" name="edit_title" required>
            <label for="edit_title">Title</label>
        </div>
    </div>
    <div class="form-group" id="edit_icon_group">
        <div class="form-material input-group">
            <input type="text" class="form-control" id="edit_icon" name="edit_icon" onkeyup="$('#epreview').removeClass().addClass($('#edit_icon').val());">
            <label for="edit_icon">Nav Icon</label>
            <div class="input-group-append">
                <span class="input-group-text">
                    <i id="epreview" class=""></i>
                </span>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="form-material">
            <input type="text" class="form-control" id="edit_url" name="edit_url" required>
            <label for="edit_url">URL</label>
        </div>
    </div>
    <div class="form-group">
        <div class="form-material">
            <select name="edit_user_level" id="edit_user_level" class="form-control">
                <option value="0" selected>All</option>
                <option value="9">Admin</option>
            </select>
            <label for="edit_user_level">User Level</label>
        </div>
    </div>
</x-form-modal>
@endpush
@push('scripts')
<script type="text/javascript">
$(function() {
    // Tab Logic
    var hash = window.location.hash;
    if (hash) {
        $('#tabs li a').removeClass('active');
        $(hash).addClass('active');
        $('.tab-pane').hide();
        $(hash + '_tab').addClass('active').show();
    }
    $('#tabs li a').click(function(){
        var tab = $(this).attr('id');
        window.location.hash = tab;
        if(!$(this).hasClass('active')){
            $('#tabs li a').removeClass('active');
            $(this).addClass('active');
            $('.tab-pane').hide();
            $('#'+ tab + '_tab').addClass('active').show();
        }
    });
    // Sortable Logic
    $(document).on('click','.sortable', function() {
        $.fn.ajaxOrder({
            url: '/admin/order_nav/'+$(this).data('type')+'/'+$(this).data('direction')+'/'+$(this).data('id'),
        }).done(function(data) {
            $('#' + data.type + '_table_div').load('/admin/navtable/' + data.type_id + '/');
        });
    });
    $(document).on('click', '.refresh_table', function() {
        var type = $(this).data('type');
        $('#' + $(this).data('type') + '_block').addClass('block-mode-loading');
        $('#' + $(this).data('type') + '_table_div').load('/admin/navtable/' + $(this).data('type_id') + '/', null, function() {
            setTimeout(function() {
            $('#' + type + '_block').removeClass('block-mode-loading');
        }, 100);
        });

    })
    // Show Create Modal
    $(document).on('click','.add-child', function() {
        var parent = $(this).data('id');
        var nav_type = $(this).data('navtype');
        $('#nav_type').val(nav_type);
        $('#parent').val(parent);
        $('#nav_create_moddal').modal('show');
    });
    $(document).on('click','.add_nav_modal', function() {
        var nav_type = $(this).data('navtype');
        $.getJSON("/admin/json/navigationtype/"+nav_type, function success(data) {
            $.each( data, function( key, val ) {
                items.push( "<li id='" + key + "'>" + val + "</li>" );
            });
        });
        $('#nav_type').val(nav_type);
        $('#nav_create_modal').modal('show');
    });
    // Delete Handler
    $(document).on('click','.delete',function(){
        var id = $(this).data('delete');
        var type = $(this).data('type');
        if (type == 'parent') {
            var url = '/admin/navigation/'+id;
        }
        else if (type == 'child') {
            var url = '/admin/navigation/child/'+id;
        }
        $.fn.ajaxDelete({
            url: url,
            id: id,
            swal_question: 'Are you sure you want to delete<br />'+$(this).data('name')+'?',
            swal_success: 'Page Deleted',
            swal_cancel: 'Page was not deleted. :)'
        }, function(data) {
            $('#' + data.type + '_table_div').load('/admin/navtable/' + data.type_id + '/');
        });
    });
    // Edit Modal Show
    $(document).on('click','.edit',function(){
        var url = $(this).data('type') == 'child' ? "/admin/json/navigation/child/"+$(this).data('id') : "/admin/json/navigation/"+$(this).data('id');
        $.getJSON(url, function success(data) {
            if (data.type == "child") {
                $('#edit_icon_group').hide();
            }
            var frm = $("#nav_edit_form");
            for (i in data) {
                frm.find('[name="edit_' + i + '"]').val(data[i]);
            }
            $('#epreview').removeClass().addClass(data.icon);
            $('#nav_edit_modal').modal('toggle');
            edit_id = data.id;
        });
    });
    // Create Modal Processing
    $('#nav_create_form').submit(function(event) {
        event.preventDefault();
        $("#nav_create").spinbutton();
        var formData = new FormData(this);
        $.fn.ajaxCreateModal({
            slug: 'nav_create',
            url: '/admin/navigation',
            method: 'POST',
            form: $(this).serialize(),
            btn_icon: 'fas fa-plus',
            btn_text: 'Add Page',
            swal_title: 'Page Added!',
            swal_text: 'Successfully added new page.',
        }).done(function(data) {
            $('#' + data.type + '_table_div').load('/admin/navtable/' + data.type_id + '/');
        });
    });
    // Create Child Nav
    $('#create_child_nav_form').submit(function(event) {
        event.preventDefault();
        $("#create_child_nav").spinbutton();
        var formData = new FormData(this);
        $.fn.ajaxCreateModal({
            slug: 'create_child_nav',
            url: '/admin/navigation/child',
            method: 'POST',
            form: formData,
            btn_icon: 'fas fa-plus',
            btn_text: 'Add Page',
            swal_title: 'Page Added!',
            swal_text: 'Successfully added new page.',
        }).done(function(data) {
            $('#' + data.type + '_table_div').load('/admin/navtable/' + data.type_id + '/');
        });
    });







            $('#nav_edit_form').submit(function(event) {
                $("#nav_edit_btn").spinbutton();
                event.preventDefault();
                var form = $(this);
                $.ajax({
                    type        : 'PATCH',
                    url         : '/admin/navigation/'+edit_id,
                    data        : form.serialize(),
                    encode      : true
                }).done(function(data) {
                    if (data.success) {
                        $("#nav_edit").spinbutton("success","fas fa-pencil-alt mr-1","Update Link");
                        $('#nav_edit_modal').modal('toggle');
                        $("#nav_edit_form").trigger("reset");
                        Swal.fire({
                            icon: 'success',
                            title: 'Navigation Edited!',
                            text: 'Successfully edited link',
                            showConfirmButton: false,
                            timer: 2000
                        })
                        $('#' + data.type + '_table_div').load('/admin/navtable/' + data.type_id + '/');
                        $("#nav_edit_btn").spinbutton("reset","fas fa-pencil-alt mr-1","Update Link");
                    }
                    else {
                        $("#nav_edit_btn").spinbutton("reset","fas fa-pencil-alt mr-1","Update Link");
                        Swal.fire(
                            'Error',
                            data.error,
                            'error'
                        )
                    }
                }).fail(function(jqXHR, textStatus, errorThrown) {
                    $("#nav_edit_btn").spinbutton("reset","fas fa-pencil-alt mr-1","Update Link");
                    Swal.fire(
                        'Error',
                        errorThrown,
                        'error'
                    )
                });
            })
            .each(function() {
                $(this).data('serialized', $(this).serialize())
            })
            .on('change input', function(){
                $(this).find('input:submit, button:submit').prop('disabled', $(this).serialize() == $(this).data('serialized'));
            })
            .find('input:submit, button:submit').prop('disabled', true);


            $('#edit_child_nav_form').submit(function(event) {
                $("#edit_child_nav").spinbutton();
                event.preventDefault();
                var form = $(this);
                $.ajax({
                    type        : 'PATCH',
                    url         : '/admin/navigation/child/'+edit_child_id,
                    data        : form.serialize(),
                    encode      : true
                }).done(function(data) {
                    if (data.success)
                    {
                        $("#edit_child_nav").spinbutton("success","fas fa-pencil-alt mr-1","Update Link");
                        $('#edit_child_nav_modal').modal('toggle');
                        $("#edit_child_nav_form").trigger("reset");
                        Swal.fire({
                            icon: 'success',
                            title: 'Navigation Edited!',
                            text: 'Successfully edited link',
                            showConfirmButton: false,
                            timer: 2000
                        })
                        $('#' + data.type + '_table_div').load('/admin/navtable/' + data.type_id + '/');
                        $("#edit_child_nav").spinbutton("reset","fas fa-pencil-alt mr-1","Update Link");
                    }
                    else
                    {
                        $("#edit_child_nav").spinbutton("reset","fas fa-pencil-alt mr-1","Update Link");
                        Swal.fire(
                            'Error',
                            data.error,
                            'error'
                        )
                    }
                }).fail(function(jqXHR, textStatus, errorThrown) {
                    $("#edit_child_nav").spinbutton("reset","fas fa-pencil-alt mr-1","Update Link");
                    Swal.fire(
                        'Error',
                        errorThrown,
                        'error'
                    )
                });
            }).each(function(){
                $(this).data('serialized', $(this).serialize())
            }).on('change input', function(){
                $(this).find('input:submit, button:submit').prop('disabled', $(this).serialize() == $(this).data('serialized'));
            }).find('input:submit, button:submit').prop('disabled', true);





 });
</script>
@endpush
