<div class="tab-pane fade show active" id="pills-chat" role="tabpanel" aria-labelledby="pills-chat-tab">
    <!-- Start chats content -->
    <div>
        <div class="px-4 pt-4">
            <div class="row">
                <div class="col-lg-6">
                    <h4 class="mb-4">Chats</h4>
                </div>
                <div class="col-lg-6">
                    <div class="m-auto " style="float: right">
                        <div class="d-flex chat__people-wrapper-btn-group ms-1">
                            <i class="nav-icon fa fa-bars align-top chat__people-wrapper-bar"></i>
                            <div class="chat__people-wrapper-button btn-create-group me-2 d-flex align-items-center"  data-bs-toggle="modal"
                                 data-bs-target="#createNewGroup" style="cursor: pointer">
                                <i class="nav-icon group-icon color-green remove-tooltip" data-bs-toggle="tooltip"
                                   data-bs-placement="bottom" title="" data-bs-original-title="New Group"
                                   aria-label="New Group">
                                    <img src="https://chat.infyom.com/assets/icons/group.png"
                                         width="33" height="33"></i>
                            </div>
                            <div class="chat__people-wrapper-button d-flex align-items-center" data-bs-toggle="modal"
                                 data-bs-target="#addNewChat" style="cursor: pointer">
                                <i class="nav-icon remove-tooltip" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                   title="" data-bs-original-title="New Conversation" aria-label="New Conversation">
                                    <img
                                        src="https://chat.infyom.com/assets/icons/bubble-chat.png" width="30"
                                        height="30"></i>
                            </div>
                            <i class="nav-icon fa fa-times align-top chat__people-close-bar d-sm-none d-block align-self-center ms-2"></i>
                        </div>
                    </div>
                </div>
            </div>


            <div class="search-box chat-search-box">
                <div class="input-group mb-3 rounded-3">
                                        <span class="input-group-text text-muted bg-light pe-1 ps-3" id="basic-addon1">
                                            <i class="ri-search-line search-icon font-size-18"></i>
                                        </span>
                    <input type="text" class="form-control bg-light" placeholder="Search messages or users"
                           aria-label="Search messages or users" aria-describedby="basic-addon1">
                </div>
            </div> <!-- Search Box-->
        </div> <!-- .p-4 -->

        <!-- Start user status -->
        <div class="px-4 pb-4" dir="ltr">


            <div class="owl-carousel owl-theme" id="user-status-carousel">
                <div class="item">
                    <a href="#" class="user-status-box">
                        <div class="avatar-xs mx-auto d-block chat-user-img online">
                            <img src="assets/images/users/avatar-2.jpg" alt="user-img" class="img-fluid rounded-circle">
                            <span class="user-status"></span>
                        </div>

                        <h5 class="font-size-13 text-truncate mt-3 mb-1">Patrick</h5>
                    </a>
                </div>
            </div>
            <!-- end user status carousel -->
        </div>
        <!-- end user status -->

        <!-- Start chat-message-list -->
        <div>
            <h5 class="mb-3 px-3 font-size-16">Recent</h5>

            <div class="chat-message-list px-2" data-simplebar>

                <ul class="list-unstyled chat-list chat-user-list" id="newfriendList">
                   @include('chat.user')
                </ul>
            </div>
        </div>
        <!-- End chat-message-list -->
    </div>
    <!-- Start chats content -->
</div>

{{-- New Member Add Start --}}
<div id="addNewChat" class="modal fade " tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered conversation-modal  modal-lg">
        <!-- Modal content-->
        <div class="modal-content modal-new-conversation">
            <div class="modal-header border-0">
                <h5 class="modal-title">
                    <i class="ti-user"></i>New Conversations / Groups </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <nav class="nav nav-pills flex-wrap" id="myTab" role="tablist" >
                    <a class="nav-item nav-link active" id="nav-my-contacts-tab" data-bs-toggle="tab"
                       href="#nav-my-contacts" onclick="myContact()"
                       role="tab" aria-controls="nav-my-contacts-tab" aria-expanded="true" aria-selected="false"> <i
                            class="ti-user"></i>My Contacts
                    </a>

                    <a class="nav-item nav-link wrap-text" id="nav-users-tab" data-bs-toggle="tab" href="#nav-users"
                       onclick="newContact()"
                       role="tab" aria-controls="nav-users" aria-expanded="true" aria-selected="false">
                        <i class="ti-user"></i>New Conversation
                    </a>

                    <a class="nav-item nav-link" id="nav-groups-tab" data-bs-toggle="tab" href="#nav-groups" role="tab"
                       onclick="myGroup()"
                       aria-controls="nav-groups" aria-selected="false">Groups</a>

                    <a class="nav-item nav-link " id="nav-blocked-users-tab" data-bs-toggle="tab"
                       onclick="blockUser()"
                       href="#nav-blocked-users" role="tab" aria-controls="nav-blocked-users" aria-selected="true">Blocked
                        Users</a>
                </nav>

                <div class="tab-content search-any-member mt-3" id="nav-tabContent">
                    <div class="tab-pane fade active show" id="nav-my-contacts" role="tabpanel"
                         aria-labelledby="nav-my-contacts-tab">
                        <div>
                            <div id="myContactListForAddPeople">
                                <ul class="list-group user-list-chat-select list-with-filter" id="myContactListForChat">
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-users" role="tabpanel" aria-labelledby="nav-users-tab">
                        <div>
                            <div id="userListForAddPeople">
                                <ul class="list-group user-list-chat-select list-with-filter" id="userListForChat">
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-groups" role="tabpanel" aria-labelledby="nav-groups-tab">
                        <div>
                            <div id="divGroupListForChat">
                                <ul class="list-group user-list-chat-select list-without-filter" id="groupListForChat">

                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade active show" id="nav-blocked-users" role="tabpanel"
                         aria-labelledby="nav-blocked-users-tab">
                        <div>
                            <div id="divOfBlockedUsers">
                                <ul class="list-group user-list-chat-select list-without-filter" id="blockedUsersList">
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- New Member Add End --}}

{{-- Group Add Start --}}
<div id="createNewGroup" class="modal fade " tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
     aria-modal="true" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title group-modal-title">New Group</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="https://chat.infyom.com/conversations" accept-charset="UTF-8"
                  id="createGroupForm">
                <input name="_token" type="hidden"
                       value="jsr124JmIzp0G5ksaC88qFYDrkidmXuqSptDY9pi">
                <input type="hidden" name="_token" value="jsr124JmIzp0G5ksaC88qFYDrkidmXuqSptDY9pi">
                <div class="modal-body">
                    <div class="form-group col-sm-12">
                        <div class="alert alert-danger" style="display: none" id="groupValidationErrorsBox"></div>
                    </div>
                    <input type="hidden" name="id" value="" id="groupId">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label for="name" class="login-group__sub-title">Group Name:</label><span
                                class="red">*</span>
                            <input class="form-control login-group__input" required="" id="groupName"
                                   placeholder="Group Name" name="name" type="text">
                        </div>
                        <div class="col-12 d-flex edit-profile-image mb-3">
                            <div class="ps-0 edit-profile-btn">
                                <label for="photo" class="login-group__sub-title">Group Icon:</label>
                                <label class="edit-profile__file-upload btn-primary mb-0"> Choose your file
                                    <input id="groupImage" class="d-none" accept="image/*" name="photo" type="file">
                                </label>
                            </div>
                            <div class="mt-2 profile__inner mw-unset w-auto m-auto">
                                <div class=" preview-image-video-container text-center chat-profile__img-wrapper mt-0">
                                    <img id="groupPhotoPreview" class=""
                                         src="https://chat.infyom.com/assets/images/group-img.png">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 radio-group-section">
                            <div class="div-group-type d-flex ms-1">
                                <div class="me-3">
                                    <label for="type" class="login-group__sub-title">Group Type</label>:
                                    <span class="red">*</span>
                                </div>
                                <div class="d-flex justify-content-around radio-group-type">
                                    <div class="me-3">
                                        <div class="iradio_square-blue checked" style="position: relative;"><input
                                                class="group-type" id="groupTypeOpen" checked="checked"
                                                name="group_type" type="radio" value="1"
                                                style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;">
                                            <ins class="iCheck-helper"
                                                 style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                                        </div>
                                        Open
                                        <i class="fa fa-question-circle ms-2 question-type-open cursor-pointer"
                                           data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                           data-bs-original-title="All group members can send messages into the group."
                                           aria-label="All group members can send messages into the group."></i>
                                    </div>
                                    <div>
                                        <div class="iradio_square-blue" style="position: relative;"><input
                                                class="group-type" id="groupTypeClose" name="group_type" type="radio"
                                                value="2"
                                                style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;">
                                            <ins class="iCheck-helper"
                                                 style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                                        </div>
                                        Close
                                        <i class="fa fa-question-circle ms-2 question-type-close cursor-pointer"
                                           data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                           data-bs-original-title="The admin only can send messages into the group."
                                           aria-label="The admin only can send messages into the group."></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="div-group-privacy d-flex">
                                <div class="me-3">
                                    <label for="privacy" class="login-group__sub-title">Privacy</label>:
                                    <span class="red">*</span>
                                </div>
                                <div class="d-flex justify-content-around radio-group-type">
                                    <div class="me-3">
                                        <div class="iradio_square-blue checked" style="position: relative;"><input
                                                class="group-privacy" id="groupPublic" checked="checked" name="privacy"
                                                type="radio" value="1"
                                                style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;">
                                            <ins class="iCheck-helper"
                                                 style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                                        </div>
                                        Public
                                        <i class="fa fa-question-circle ms-2 question-type-public cursor-pointer"
                                           data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                           data-bs-original-title="All group members can add or remove members from the group."
                                           aria-label="All group members can add or remove members from the group."></i>
                                    </div>
                                    <div>
                                        <div class="iradio_square-blue" style="position: relative;"><input
                                                class="group-privacy" id="groupPrivate" name="privacy" type="radio"
                                                value="2"
                                                style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;">
                                            <ins class="iCheck-helper"
                                                 style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                                        </div>
                                        Private
                                        <i class="fa fa-question-circle ms-2  question-type-private cursor-pointer"
                                           data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                           data-bs-original-title="The admin only can add or remove members from the group."
                                           aria-label="The admin only can add or remove members from the group."></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-sm-12 text-start">
                            <button type="submit" class="btn btn-primary" id="btnCreateGroup"
                                    data-loading-text="<span class='spinner-border spinner-border-sm'></span> Processing...">
                                Save
                            </button>
                            <button type="button" id="btnCancel" class="btn btn-secondary ms-1 "
                                    data-bs-dismiss="modal">Cancel
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- Group Add End --}}


@push('script')
    <script>
        var id  = '{{ auth()->id() }}';
        myContact(id)
        function myContact( id){
            $.ajax({
                url: "{{route('my.contact')}}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    id: id,
                },
                type: "POST",
                dataType: "html",
                success: function (response) {
                   $('#myContactListForAddPeople').html(response);
                }
            });
        }

        function newContact(){
            $.ajax({
                url: "{{route('user.list')}}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    id: id,
                },
                type: "POST",
                dataType: "html",
                success: function (response) {
                    $("#userListForChat").html(response);
                }
            });
        }

        function myGroup(){
            console.log("new group")
        }
        function blockUser(){
            console.log("block")
        }

        function addFriend(id, ownerId){
            $.ajax({
                url: "{{route('add.friend')}}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    id: id,
                    ownerId: ownerId,
                },
                type: "POST",
                dataType: "json",
                success: function (response) {
                    console.log(response.user);
                    if(response.message == true){
                        let newFriend =
                            `<li id="newFriend${response.user.id}">
                                <a href="#">
                                    <div class="d-flex">
                                        <div class="chat-user-img online align-self-center me-3 ms-0">
                                            <img src="${response.image}" class="rounded-circle avatar-xs" alt="">
                                            <span class="user-status"></span>
                                        </div>

                                        <div class="flex-grow-1 overflow-hidden">
                                            <h5 class="text-truncate font-size-15 mb-1">${response.user.name}</h5>
                                            <p class="chat-user-message text-truncate mb-0">Hey! there I'm available</p>
                                        </div>
                                        <div class="font-size-11">05 min</div>
                                    </div>
                                </a>
                            </li>`;
                        $(`#friend${ownerId}`).remove();
                        $(`#newfriendList`).prepend(newFriend);
                        $('#addNewChat').modal('hide');
                    }
                }
            });
        }
    </script>
@endpush
