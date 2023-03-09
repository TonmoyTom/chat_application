<div class="px-3 px-lg-4 pt-3 pt-lg-4">
    <div class="user-chat-nav text-end">
        <button type="button" class="btn nav-btn" id="user-profile-hide">
            <i class="ri-close-line"></i>
        </button>
    </div>
</div>

<div class="text-center p-4 border-bottom">
    <div class="mb-4">
        <img src="{{ setImage(@$userFind->photo_url) }}" class="rounded-circle avatar-lg img-thumbnail" alt="">
    </div>

    <h5 class="font-size-16 mb-1 text-truncate">{{ @$userFind->name }}</h5>
</div>
<!-- End profile user -->

<!-- Start user-profile-desc -->
<div class="p-4 user-profile-desc" data-simplebar>
    <div class="text-muted">
        <p class="mb-4">{{ @$user->about }}</p>
    </div>

    <div class="accordion" id="myprofile">
        <div class="accordion-item card border mb-2">
            <div class="accordion-header" id="about3">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#aboutprofile" aria-expanded="true" aria-controls="aboutprofile">
                    <h5 class="font-size-14 m-0">
                        <i class="ri-user-2-line me-2 ms-0 align-middle d-inline-block"></i> About
                    </h5>
                </button>
            </div>
            <div id="aboutprofile" class="accordion-collapse collapse show" aria-labelledby="about3" data-bs-parent="#myprofile">
                <div class="accordion-body">
                    <div>
                        <p class="text-muted mb-1">Name</p>
                        <h5 class="font-size-14">{{ @$userFind->name }}</h5>
                    </div>

                    <div class="mt-4">
                        <p class="text-muted mb-1">Email</p>
                        <h5 class="font-size-14">{{ @$userFind->email }}</h5>
                    </div>

                    <div class="mt-4">
                        <p class="text-muted mb-1">Location</p>
                        <h5 class="font-size-14 mb-0">{{ @$userFind->address }}</h5>
                    </div>
                </div>
            </div>
        </div>

        <div class="accordion-item card border">
            <div class="accordion-header" id="attachfile3">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#attachprofile" aria-expanded="false" aria-controls="attachprofile">
                    <h5 class="font-size-14 m-0">
                        <i class="ri-attachment-line me-2 ms-0 align-middle d-inline-block"></i> Attached Files
                    </h5>
                </button>
            </div>
            <div id="attachprofile" class="accordion-collapse collapse" aria-labelledby="attachfile3" data-bs-parent="#myprofile">
                <div class="accordion-body">
                    @foreach($imgaes as $image)
                    <div class="card p-2 border mb-2">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <div class="text-start">
                                   <img src="{{ setImage($image->file_name) }}" width="100" height="50">
                                </div>
                            </div>
                            <div class="ms-4 me-0">
                                <ul class="list-inline mb-0 font-size-18">
                                    <li class="list-inline-item">
                                        <a href="#" class="text-muted px-1">
                                            <i class="ri-download-2-line"></i>
                                        </a>
                                    </li>
                                    <li class="list-inline-item dropdown">
                                        <a class="dropdown-toggle text-muted px-1" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="ri-more-fill"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Delete</a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- end profile-user-accordion -->
    </div>
    <!-- end user-profile-desc -->
</div>
