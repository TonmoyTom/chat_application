<div class="p-3 p-lg-4 border-bottom user-chat-topbar"  >
    <div class="row align-items-center">
        <div class="col-sm-4 col-8">
            <div class="d-flex align-items-center">
                <div class="d-block d-lg-none me-2 ms-0">
                    <a href="javascript: void(0);" class="user-chat-remove text-muted font-size-16 p-2"><i
                            class="ri-arrow-left-s-line"></i></a>
                </div>
                <div class="me-3 ms-0">
                    <img src="{{ setImage(@$user->photo_url) }}" class="rounded-circle avatar-xs" alt="">
                </div>
                <div class="flex-grow-1 overflow-hidden">
                    <h5 class="font-size-16 mb-0 text-truncate"><a href="#"
                                                                   class="text-reset user-profile-show" id="nameClick">{{ @$user->name }}</a>
                        <i class="ri-record-circle-fill font-size-10 text-success d-inline-block ms-1"></i></h5>
                </div>
            </div>
        </div>
        <div class="col-sm-8 col-4">
            <ul class="list-inline user-chat-nav text-end mb-0">
                <li class="list-inline-item">
                    <div class="dropdown">
                        <button class="btn nav-btn dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                            <i class="ri-search-line"></i>
                        </button>
                        <div class="dropdown-menu p-0 dropdown-menu-end dropdown-menu-md">
                            <div class="search-box p-2">
                                <input type="text" class="form-control bg-light border-0" placeholder="Search..">
                            </div>
                        </div>
                    </div>
                </li>


                <li class="list-inline-item d-none d-lg-inline-block me-2 ms-0">
                    <button type="button" class="btn nav-btn user-profile-show">
                        <i class="ri-user-2-line"></i>
                    </button>
                </li>

                <li class="list-inline-item">
                    <div class="dropdown">
                        <button class="btn nav-btn dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                            <i class="ri-more-fill"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item d-block d-lg-none user-profile-show" href="#">View profile <i
                                    class="ri-user-2-line float-end text-muted"></i></a>
                            <a class="dropdown-item d-block d-lg-none" href="#" data-bs-toggle="modal"
                               data-bs-target="#audiocallModal">Audio <i class="ri-phone-line float-end text-muted"></i></a>
                            <a class="dropdown-item d-block d-lg-none" href="#" data-bs-toggle="modal"
                               data-bs-target="#videocallModal">Video <i
                                    class="ri-vidicon-line float-end text-muted"></i></a>
                            <a class="dropdown-item" href="#">Archive <i
                                    class="ri-archive-line float-end text-muted"></i></a>
                            <a class="dropdown-item" href="#">Muted <i
                                    class="ri-volume-mute-line float-end text-muted"></i></a>
                            <a class="dropdown-item" href="#">Delete <i
                                    class="ri-delete-bin-line float-end text-muted"></i></a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="chat-conversation p-3 p-lg-4" data-simplebar="init" >
    <ul class="list-unstyled mb-0" id="senderAppend">

        @foreach($messages as $message)
            @if($message->to_id != $id)
                {{--        Reciver        --}}
                <li>
                    <div class="conversation-list">
                        <div class="chat-avatar">
                            <img src="{{ setImage($message->sender->photo_url) }}" alt="">
                        </div>

                        <div class="user-chat-content">
                            <div class="ctext-wrap">
                                <div class="ctext-wrap-content">
                                    @if($message->message_type == 1)
                                        <div>
                                            <a class="popup-img d-inline-block m-1" href="{{ setImage($message->file_name) }}" title="Project 1">
                                                <img src="{{ setImage($message->file_name) }}" alt="" class="rounded border" width="150" height="100">
                                            </a>
                                        </div>
                                        <div class="message-img-link">
                                            <ul class="list-inline mb-0">
                                                <li class="list-inline-item">
                                                    <a download="img-1.jpg" href="{{ setImage($message->file_name) }}" class="fw-medium">
                                                        <i class="ri-download-2-line"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    @else
                                        <p class="mb-0">
                                            {{ $message->message }}
                                        </p>
                                    @endif
                                    <p class="chat-time mb-0"><i class="ri-time-line align-middle"></i> <span
                                            class="align-middle"> {{ \Carbon\Carbon::parse($message->created_at)->format('g:i A') }}</span>
                                    </p>
                                </div>
                                <div class="dropdown align-self-start">
                                    <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                       aria-haspopup="true" aria-expanded="false">
                                        <i class="ri-more-2-fill"></i>
                                    </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">Copy <i
                                                class="ri-file-copy-line float-end text-muted"></i></a>
                                        <a class="dropdown-item" href="#">Save <i
                                                class="ri-save-line float-end text-muted"></i></a>
                                        <a class="dropdown-item" href="#">Forward <i
                                                class="ri-chat-forward-line float-end text-muted"></i></a>
                                        <a class="dropdown-item" href="#">Delete <i
                                                class="ri-delete-bin-line float-end text-muted"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="conversation-name">{{ $message->sender->name }}</div>
                        </div>

                    </div>
                </li>
            @else
                {{--        Sender        --}}
                <li class="right">
                    <div class="conversation-list">
                        <div class="chat-avatar">
                            <img src="{{ setImage(auth()->user()->photo_url) }}" alt="">
                        </div>

                        <div class="user-chat-content">
                            <div class="ctext-wrap">
                                <div class="ctext-wrap-content">

                                    @if($message->message_type == 1)
                                        <div>
                                            <a class="popup-img d-inline-block m-1" href="{{ setImage($message->file_name) }}" title="Project 1">
                                                <img src="{{ setImage($message->file_name) }}" alt="" class="rounded border" width="150" height="100">
                                            </a>
                                        </div>
                                        <div class="message-img-link">
                                            <ul class="list-inline mb-0">
                                                <li class="list-inline-item">
                                                    <a download="img-1.jpg" href="{{ setImage($message->file_name) }}" class="fw-medium">
                                                        <i class="ri-download-2-line"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    @else
                                        <p class="mb-0">
                                            {{ $message->message }}
                                        </p>
                                    @endif
                                        <p class="chat-time mb-0"><i class="ri-time-line align-middle"></i> <span
                                                class="align-middle">{{ \Carbon\Carbon::parse($message->created_at)->format('g:i A') }}</span>
                                        </p>
                                </div>
                                <div class="dropdown align-self-start">
                                    <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                       aria-haspopup="true" aria-expanded="false">
                                        <i class="ri-more-2-fill"></i>
                                    </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">Copy <i
                                                class="ri-file-copy-line float-end text-muted"></i></a>
                                        <a class="dropdown-item" href="#">Save <i
                                                class="ri-save-line float-end text-muted"></i></a>
                                        <a class="dropdown-item" href="#">Forward <i
                                                class="ri-chat-forward-line float-end text-muted"></i></a>
                                        <a class="dropdown-item" href="#">Delete <i
                                                class="ri-delete-bin-line float-end text-muted"></i></a>
                                    </div>
                                </div>
                            </div>

                            <div class="conversation-name">{{ auth()->user()->name }}</div>
                        </div>

                    </div>
                </li>
            @endif
        @endforeach
    </ul>
    <p id="scroll-bottom"></p>
{{--    <a href="#"></a>--}}
</div>
<div class="chat-input-section p-3 p-lg-4 border-top mb-0">
    <div class="row g-0">
        <div class="col">
            <input type="text" class="form-control form-control-lg bg-light border-light message" id="emoji1"
                   placeholder="Enter Message...">
            <p id="messageError" style="color: red"></p>
        </div>
        <div class="col-auto">
            <div class="chat-input-links ms-md-2 me-md-0">
                <ul class="list-inline mb-0">
                    <li class="list-inline-item" title="Attached File">
                        <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                class="btn btn-link text-decoration-none font-size-16 btn-lg waves-effect">
                            <i class="ri-attachment-line"></i>
                        </button>
                    </li>
                    <li class="list-inline-item">
                        <button type="button" id="messageSubmit" data-id="{{ $user->id }}"
                                class="btn btn-primary font-size-16 btn-lg chat-send waves-effect waves-light"
                        >
                            <i class="ri-send-plane-2-fill"></i>
                        </button>

                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Attach File</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="fileUpload" enctype="multipart/form-data" method="POST">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Default file input example</label>
                        <input class="form-control" type="file" name="fromFile" id="formFile">
                        <input type="hidden" name="user_id" id="user_id" value="{{ $user->id }}">
                        <input type="hidden" name="auth_id" id="auth_id" value="{{ auth()->id() }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        var ChatDiv = $('.simplebar-content-wrapper');
        var height = ChatDiv[3].scrollHeight;
        ChatDiv.scrollTop(height);
    });
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#emoji1').emojioneArea({
        emojiPlaceholder: ":smile_cat:",
        search: false,
        inline: true
    });
    $('#fileUpload').submit(function (e) {
        e.preventDefault();
        // var id = $(this).data().id ;
        // var userId =  new_authId;
        var formData = new FormData(this);

        $.ajax({
            method: 'post',
            url: '/file-upload',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (response) {
                let right = `<li class="right"  >
                    <div class="conversation-list">
                        <div class="chat-avatar">
                            <img src="${response.own_user_image}" alt="">
                        </div>
                        <div class="user-chat-content">
                            <div class="ctext-wrap">
                                <div class="ctext-wrap-content">
                                    <ul class="list-inline message-img  mb-0">
                                            <li class="list-inline-item message-img-list me-2 ms-0">
                                                <div>
                                                    <a class="popup-img d-inline-block m-1" href="${response.image_message}" title="Project 1">
                                                        <img src="${response.image_message}"" alt="" class="rounded border">
                                                    </a>
                                                </div>
                                                <div class="message-img-link">
                                                    <ul class="list-inline mb-0">
                                                        <li class="list-inline-item">
                                                            <a download="img-1.jpg" href="${response.image_message}" class="fw-medium">
                                                                <i class="ri-download-2-line"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </li>
                                    </ul>
                                    <p class="chat-time mb-0"><i class="ri-time-line align-middle"></i> <span
                                            class="align-middle">${response.date}</span></p>
                                </div>
                                <div class="dropdown align-self-start">
                                    <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                       aria-haspopup="true" aria-expanded="false">
                                        <i class="ri-more-2-fill"></i>
                                    </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">Copy <i
                                                class="ri-file-copy-line float-end text-muted"></i></a>
                                        <a class="dropdown-item" href="#">Save <i
                                                class="ri-save-line float-end text-muted"></i></a>
                                        <a class="dropdown-item" href="#">Forward <i
                                                class="ri-chat-forward-line float-end text-muted"></i></a>
                                        <a class="dropdown-item" href="#">Delete <i
                                                class="ri-delete-bin-line float-end text-muted"></i></a>
                                    </div>
                                </div>
                            </div>

                            <div class="conversation-name">${response.own_user.name}</div>
                        </div>
                    </div>
                </li>`;
                let userList = `<li id="newFriend${response.chat.receiver.id}" data-id="${response.chat.receiver.id}"  class="activeUser singleActive">
                                    <a href="#">
                                        <div class="d-flex">
                                            <div class="chat-user-img online align-self-center me-3 ms-0">
                                                <img src="${response.receiver_image}" class="rounded-circle avatar-xs" alt="">
                                                <span class="user-status"></span>
                                            </div>

                                            <div class="flex-grow-1 overflow-hidden">
                                                <h5 class="text-truncate font-size-15 mb-1">${response.chat.receiver.name}</h5>
                                                <p class="chat-user-message text-truncate mb-0">File Send</p>
                                            </div>
                                            <div class="font-size-11">${response.date}</div>
                                        </div>
                                    </a>
                            </li>`;

                $('#exampleModal').modal('hide');
                $('#fromFile').html();
                $('.message').val('');
                $('.emojionearea-editor').html();
                $('#messageError').html();
                $('#senderAppend').append(right)
                $(`#newFriend${response.chat.receiver.id}`).remove();
                $('#newfriendList').prepend(userList);
                var ChatDiv = $('.simplebar-content-wrapper');
                var height = ChatDiv[3].scrollHeight;
                ChatDiv.scrollTop(height);
            }, error: function (xhr) {
            }
        });




    });

</script>
