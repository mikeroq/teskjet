@extends('layouts.backend')

@section('content')
    <x-page-header title="{{ $user->full_name }}" subtitle="Edit Profile">
        <img class="img-avatar img-avatar96 img-avatar-thumb" src="/uploads/avatars/{{ $user->avatar }}" alt="">
    </x-page-header>
    <div class="content">
                    <h2 class="content-heading">Profile Information</h2>
                    <div class="row push">
                        <div class="col-lg-4">
                            <p class="text-muted">
                                Update your profile information, like your name and avatar.
                            </p>
                        </div>
                        <div class="col-lg-7">
                        <div class="block block-rounded">
                            <div class="block-content">


                            <div class="form-group">
                                <label for="first-name">First Name</label>
                                <input type="text" class="form-control" id="first-name" name="first-name" value="{{ $user->first_name }}" placeholder="Your First Name...">
                            </div>
                            <div class="form-group">
                                <label for="last-name">Last Name</label>
                                <input type="text" class="form-control" id="last-name" name="last-name" value="{{ $user->last_name }}" placeholder="Your Last Name...">
                            </div>
                            <div class="form-group">
                                <label for="profile_email">Email Address</label>
                                <input type="email" class="form-control" id="email" name="profile-email" value="{{ $user->email }}" placeholder="Your Email Address...">
                            </div>
                            <div class="form-group">
                                <label for="timezone">Timezone</label>
                                <select name="timezone" id="timezone" class="form-control">
                                    @if (empty($user->timezone))
                                    <option selected disabled value>-- Select Timezone --</option>
                                    @endif
                                    @foreach (timezone_identifiers_list() as $timezone)
                                    <option value="{{ $timezone }}"{{ $timezone == $user->timezone ? ' selected' : '' }}>{{ $timezone }}</option>
                                    @endforeach
                                </select>
                            </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Save Profile</button>
                                </div>
                            <div class="form-group">
                                <form enctype="multipart/form-data" action="{{ route('user.profile.avatar.update') }}" method="POST" id="avatar_form">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <label>Avatar</label>
                                    <div class="options-container mb-2" id="user_avatar" style="width: 128px;">
                                        <img class="img-fluid options-item" src="/uploads/avatars/{{ $user->avatar }}" id="avatar_image" alt="Your Avatar">
                                        <div class="options-overlay bg-black-75">
                                            <div class="options-overlay-content">
                                                <button class="btn btn-sm btn-danger" id="delete_avatar" {{ $user->avatar == "default.jpg" ? 'disabled' : ''}}>
                                                    <i class="fa fa-times mr-1"></i> Delete
                                                </button>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="custom-file mb-2">
                                        <input type="file" class="custom-file-input" data-toggle="custom-file-input" id="avatar" name="avatar">
                                        <label class="custom-file-label" id="avatar_label" for="avatar">Choose file</label>
                                    </div>
                                    <button name="avatar_upload" type="submit" id="avatar_upload" class="btn btn-primary">Update Avatar</button>

                                </form>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <h2 class="content-heading pt-0">Password</h2>
                    <div class="row push">
                        <div class="col-lg-4">
                            <p class="text-muted">
                                Update your password here
                            </p>
                        </div>
                        <div class="col-lg-7">
                            <div class="block block-rounded">
                                <div class="block-content">

                            <div class="form-group">
                                <label for="current-password">Current Password</label>
                                <input type="password" class="form-control" id="current-password" name="current-password" placeholder="Your Old Password...">
                            </div>
                            <div class="form-group">
                                <label for="new-password">New Password</label>
                                <input type="password" class="form-control" id="new-password" name="new-password" placeholder="Your New Password...">
                            </div>
                            <div class="form-group">
                                <label for="confirm-password">Confirm New Password</label>
                                <input type="password" class="form-control" id="confirm-password" name="confirm-password" placeholder="Confirm your New Password...">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Update Password</button>
                            </div>
                                </div>
                            </div>
                        </div>
                    </div>

        </div>
    </div>

@endsection
@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $("#avatar_upload").prop('disabled', true);
        });
        $(function() {
            $("#avatar").change(function (){
                $("#avatar_upload").prop('disabled', false);
            });
        });

        $(document).ready(function() {
            $(document).on('click','#delete_avatar',function(){
                swal.fire({
                    title: 'Warning',
                    text: "Are you sure you want to delete your avatar?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes!',
                    cancelButtonText: 'No, cancel!'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            type:'POST',
                            url:'{{ route('user.profile.avatar.delete') }}',
                            data:{'id':'1'},
                            success: function(data){
                                if(data.success){
                                    Swal.fire({
                                        title: 'Avatar Deleted!',
                                        icon: 'success',
                                        toast: true,
                                        position: 'top-end',
                                        timer: '1500',
                                        showConfirmButton: false,
                                        timerProgressBar: true
                                    })
                                    // Dashmix.helpers('notify', {type: 'success', align: 'center', icon: 'fa fa-check mr-1', message: 'Avatar deleted successfully!'});
                                    $("#avatar_image").prop("src","/uploads/avatars/default.jpg");
                                    $("#user_avatar_top").prop("src","/uploads/avatars/default.jpg");
                                    $('#delete_avatar').prop('disabled', true);

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
                            'Avatar was not deleted. :)',
                            'error'
                        )
                    }
                })
            });
        });
        $(document).ready(function() {
            $('#avatar_form').submit(function(event) {
                event.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    type        : 'POST',
                    url         : '{{ route('user.profile.avatar.update') }}',
                    data        : formData,
                    contentType : false,
                    processData : false,
                    async       : false,
                    cache       : false
                }).done(function(data) {
                    console.log(data);
                    if (data.success) {
                        // Dashmix.helpers('notify', {type: 'success', align: 'center', icon: 'fa fa-check mr-1', message: 'Avatar uploaded successfully!'});
                        Swal.fire({
                            title: 'Avatar Updated!',
                            icon: 'success',
                            toast: true,
                            position: 'top-end',
                            timer: '1500',
                            showConfirmButton: false,
                            timerProgressBar: true
                        })
                        $('#avatar_error').hide().empty();
                        $('#default_avatar').hide();
                        $('#avatar').val(null);
                        $('#avatar_image').prop("src", "/uploads/avatars/" + data.avatar);
                        $("#user_avatar_top").prop("src", "/uploads/avatars/" + data.avatar);
                        $('#user_avatar').show();
                        $('#avatar_label').empty().prepend("Choose file");
                        $('#delete_avatar').prop('disabled', false);

                    }
                    else {
                        $('#avatar_error').empty().show().prepend(data.error);
                    }
                });

            });
        });
    </script>
@endpush
