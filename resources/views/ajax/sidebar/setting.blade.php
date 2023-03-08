<div class="px-4 pt-4">
    <h4 class="mb-0">Settings</h4>
</div>

<div class="text-center border-bottom p-4">
    <div class="mb-4 profile-user">
        <img src=" {{ setImage(auth()->user()->photo_url) }}" class="rounded-circle avatar-lg img-thumbnail" alt="">
        <button type="button" class="btn btn-light bg-light avatar-xs p-0 rounded-circle profile-photo-edit"
                onclick="editImage()">
            <i class="ri-pencil-fill"></i>
        </button>
    </div>

    <h5 class="font-size-16 mb-1 text-truncate">{{ errorCheck( ucwords(auth()->user()->name)) }}</h5>
    {{--    <div class="dropdown d-inline-block mb-1">--}}
    {{--        <a class="text-muted dropdown-toggle pb-1 d-block" href="#" role="button" data-bs-toggle="dropdown"--}}
    {{--           aria-haspopup="true" aria-expanded="false">--}}
    {{--            Available <i class="mdi mdi-chevron-down"></i>--}}
    {{--        </a>--}}

    {{--        <div class="dropdown-menu">--}}
    {{--            <a class="dropdown-item" href="#">Available</a>--}}
    {{--            <a class="dropdown-item" href="#">Busy</a>--}}
    {{--        </div>--}}
    {{--    </div>--}}
</div>
<!-- End profile user -->

<!-- Start User profile description -->
<div class="p-4 user-profile-desc" data-simplebar id="user-profile-desc">
    <div id="settingprofile" class="accordion">
        <div class="accordion-item card border mb-2">
            <div class="accordion-header" id="personalinfo1">
                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#personalinfo" aria-expanded="true" aria-controls="personalinfo">
                    <h5 class="font-size-14 m-0">Personal Info</h5>
                </button>
            </div>
            <div id="personalinfo" class="accordion-collapse collapse show" aria-labelledby="personalinfo1"
                 data-bs-parent="#settingprofile">
                <div class="accordion-body">
                    <div id="oldInformation">
                        <div class="float-end">
                            <button type="button" class="btn btn-light btn-sm"
                                    onclick="personalEditData('{{ auth()->user() }}')">
                                <i class="ri-edit-fill me-1 ms-0 align-middle"></i> Edit
                            </button>
                        </div>
                        <div id="name">
                            <p class="text-muted mb-1">Name</p>
                            <h5 class="font-size-14"> {{ errorCheck(auth()->user()->name)  }}</h5>
                        </div>

                        <div class="mt-4" id="email">
                            <p class="text-muted mb-1">Email</p>
                            <h5 class="font-size-14">{{ errorCheck(auth()->user()->email)  }}</h5>
                        </div>

                        <div class="mt-4" id="about">
                            <p class="text-muted mb-1">Bio</p>
                            <h5 class="font-size-14">{{ errorCheck(auth()->user()->about)  }}</h5>
                        </div>

                        <div class="mt-4 " id="location">
                            <p class="text-muted mb-1">Location</p>
                            <h5 class="font-size-14 mb-0">{{ errorCheck(auth()->user()->address)  }}</h5>
                        </div>
                    </div>
                    <div id="newInformation" style="display: none">
                        <form id="editProfileSubmit">
                            <div id="name">
                                <label class="text-muted mb-1">Name</label>
                                <input class="form-control" value="{{ errorCheck(auth()->user()->name)  }}"
                                       name="name" placeholder="Name">
                                <span id="nameError" class="errorClass"></span>
                            </div>

                            <div class="mt-4" id="email">
                                <label class="text-muted mb-1">Email</label>
                                <input class="form-control" value="{{ errorCheck(auth()->user()->email)  }}"
                                       name="email" placeholder="Email">
                                <span id="emailError" class="errorClass"></span>
                            </div>

                            <div class="mt-4" id="about">
                                <label class="text-muted mb-1">Bio</label>
                                <textarea class="form-control" name="bio"
                                          id="emoji">{{ errorCheck(auth()->user()->about)  }}</textarea>
                            </div>

                            <div class="mt-4 " id="location">
                                <label class="text-muted mb-1">Location</label>
                                <textarea
                                    class="form-control"
                                    name="address">{{ errorCheck(auth()->user()->address)  }}</textarea>
                            </div>
                            <div class="btn-group mt-3">
                                <button type="button" class="btn btn-primary mr-5" onclick="editProfileSubmit()">
                                    Submit
                                </button>
                                <button type="button" class="btn btn-light btn-sm" onclick="closeEdit()">Close</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <!-- end personal info card -->

        <div class="accordion-item card border mb-2">
            <div class="accordion-header" id="privacy1">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#privacy" aria-expanded="false" aria-controls="privacy">
                    <h5 class="font-size-14 m-0">Privacy</h5>
                </button>
            </div>
            <div id="privacy" class="accordion-collapse collapse" aria-labelledby="privacy1"
                 data-bs-parent="#settingprofile">
                <div class="accordion-body">
                    <div class="py-3">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1 overflow-hidden">
                                <h5 class="font-size-13 mb-0 text-truncate">Profile photo</h5>
                            </div>
                            <div class=" ms-2 me-0" id="photo_see">
                                <select class="form-control" id="photo_see" onclick="photoSee(this.value)">
                                    <option class="dropdown-item"
                                            value="0" {{  (auth()->user() && auth()->user()->is_photo_see == 1) ? 'selected' : '' }} >
                                        Everyone
                                    </option>
                                    <option class="dropdown-item"
                                            value="1" {{  (auth()->user() && auth()->user()->is_photo_see == 1) ? 'selected' : '' }} >
                                        Nobody
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="py-3 border-top">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1 overflow-hidden">
                                <h5 class="font-size-13 mb-0 text-truncate">Last seen</h5>

                            </div>
                            <div class="ms-2 me-0" style="display: flex">
                                <div class="form-check form-switch">
                                    <input type="radio" name="status" class="" onclick="seenShow(0)"
                                        {{  (auth()->user() && auth()->user()->is_seen_show == 0) ? 'checked' : '' }}
                                    >
                                    <label class="form-check-label" for="privacy-lastseenSwitch">Show</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input type="radio" name="status" class="" id="privacy-lastseenSwitch"
                                           onclick="seenShow(1)"
                                        {{  (auth()->user() && auth()->user()->is_seen_show == 1) ? 'checked' : '' }}
                                    >
                                    <label class="form-check-label" for="privacy-lastseenSwitch"> Hide</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end privacy card -->

        <div class="accordion-item card border mb-2">
            <div class="accordion-header" id="security1">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#security" aria-expanded="false" aria-controls="security">
                    <h5 class="font-size-14 m-0"></i> Security</h5>
                </button>
            </div>
            <div id="security" class="accordion-collapse collapse" aria-labelledby="security1"
                 data-bs-parent="#settingprofile">
                <div class="accordion-body">
                    <div class="d-flex align-items-center" style="margin-bottom: 20px">
                        <div class="flex-grow-1 overflow-hidden">
                            <h5 class="font-size-13 mb-0 text-truncate">Show security notification</h5>

                        </div>
                        <div class="ms-2 me-0">
                            <div class="form-check">
                                <input type="checkbox" name="cat_status" class="inline checkbox" id="notify" value="1"
                                       {{ (auth()->user()->is_subscribed == 1) ? 'checked' : ''  }} onclick="notification()">
                                <label id="notifyText" style="display:inline"></label>
                                {{--                                <label class="form-check-label" for="security-notificationswitch"></label>--}}
                            </div>

                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="" style="width: 100%">
                            <div id="name">
                                <label class="text-muted mb-1">Old Password</label>
                                <input class="form-control" value="" type="password"
                                       name="old_password" placeholder="Old Password">
                                <span id="oldPasswordError" class="errorClass"></span>
                            </div>
                            <div id="name">
                                <label class="text-muted mb-1">New Password</label>
                                <input class="form-control" value=""
                                       name="password" placeholder="New Password" type="password">
                                <span id="passwordError" class="errorClass"></span>
                            </div>

                            <div class="mt-4" id="email">
                                <label class="text-muted mb-1">Confirm Password</label>
                                <input class="form-control" value=""
                                       name="password_confirmation" placeholder="Password Confirmation" type="password">
                                <span id="confirmError" class="errorClass"></span>
                            </div>

                            <div class="btn-group mt-3">
                                <button type="button" class="btn btn-primary mr-5" onclick="changePassword()">Submit
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end security card -->
    </div>
    <!-- end profile-setting-accordion -->
</div>
<div class="modal fade" id="editProfile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="post" id="upload_form" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Upload Image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <p class="errorClass" id="imgaeError"></p>
                        <div class="profile"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>

    $('.profile').imageUploader({
            maxFiles: 1,
            label: 'Upload Image',
            autoProcessQueue: false,
            imagesInputName: 'profile_image',
            extensions: ['.jpg', '.JPG', '.jpeg', '.JPEG', '.png', '.PNG', '.svg', '.SVG', '.gif', '.GIF'],
        }
    );

    $('#emoji').emojioneArea({
        emojiPlaceholder: ":smile_cat:",
        search: false,
        inline: true
    });

    function personalEditData(value) {
        $('#oldInformation').css('display', 'none');
        $('#newInformation').css('display', 'block');
    }

    function closeEdit() {
        $('#oldInformation').css('display', 'block');
        $('#newInformation').css('display', 'none');
    }

    function editProfileSubmit() {
        $.ajax({
            async: false,
            method: 'post',
            url: '{{route('edit.profile')}}',
            data: {
                name: $("input[name='name']").val(),
                email: $("input[name='email']").val(),
                bio: $("textarea[name='bio']").val(),
                address: $("textarea[name='address']").val(),
                '_token': "{{csrf_token()}}"
            },
            success: function (response) {
                $('#setting').html(response);
                closeEdit();
                successMessage("Profile Has Changed");
            }, error: function (xhr) {
                if (xhr.responseJSON.errors && xhr.responseJSON.errors.length != 0) {
                    let errors = xhr.responseJSON.errors;
                    $('#nameError').html(errors['name'])
                    $('#emailError').html(errors['email'])
                } else {
                    console.log('error');
                }

            }
        });
    }

    $('#upload_form').on('submit', function (event) {
        event.preventDefault();
        $.ajax({
            url: "{{ route('image-upload') }}",
            method: "POST",
            data: new FormData(this),
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                imgae();
                setting();
                successMessage("Profile photo Updated");
                $('#editProfile').modal("hide");
            }, error: function (xhr) {
                $('#imgaeError').html(xhr.responseJSON.message);
                errorMessage(xhr.responseJSON.message);
            }
        })
    });
</script>


