var csrf = document.querySelector('meta[name="csrf-token"]').content;


imgae();


function profile() {

    $.ajax({
        method: 'get',
        url: '/chat/profile',
        success: function (response) {
            $('#profileAjax').html(response);
        }, error: function (xhr) {
        }
    });
}

function imgae() {
    $.ajax({
        method: 'get',
        url: '/chat/image',
        success: function (response) {
            $('#image').html(response);
        }, error: function (xhr) {
        }
    });
}

function setting() {
    $.ajax({
        method: 'get',
        url: '/chat/setting',
        success: function (response) {
            $('#setting').html(response);
        }, error: function (xhr) {
        }
    });
}

function photoSee(value) {
    $.ajax({
        method: 'post',
        url: '/chat/photo-see',
        data: {
            value: value,
            '_token': csrf
        },
        success: function (response) {
            if (value == 0) {
                successMessage("Profile photo See Everyone");
            } else {
                successMessage("Profile photo See Nobody");
            }
        }, error: function (xhr) {
        }
    });
}

function seenShow(value) {
    let seen = value;
    $.ajax({
        method: 'post',
        url: '/chat/seen-show-hide',
        data: {
            value: value,
            '_token': csrf
        },
        success: function (response) {
            if (seen == 0) {
                successMessage("Last seen Show");
            } else {
                successMessage("Last seen Hide");
            }
        }, error: function (xhr) {
        }
    });
}

function notification() {
    var checkBox = document.getElementById('notify');
    var text = document.getElementById('notifyText');

    if (checkBox.checked === true) {
        text.style.display = "inline";
        checkBox.value = "1";
    } else {
        text.style.display = "none";
        checkBox.value = "0";
    }
    $.ajax({
        method: 'post',
        url: '/chat/subscribed',
        data: {
            value: checkBox.value,
            '_token': csrf
        },
        success: function (response) {
            if (checkBox.checked === true) {
                successMessage("Show security notification Enable");
            } else {
                successMessage("Show security notification Disable");
            }
        }, error: function (xhr) {
        }
    });
}

function changePassword() {
    $.ajax({
        async: false,
        method: 'post',
        url: '/chat/change-password',
        data: {
            old_password: $("input[name='old_password']").val(),
            password: $("input[name='password']").val(),
            password_confirmation: $("input[name='password_confirmation']").val(),
            '_token': csrf
        },
        success: function (response) {
            $("input[name='old_password']").val('');
            $("input[name='password']").val('');
            $("input[name='password_confirmation']").val('');
            successMessage("Password Has Changed");
        }, error: function (xhr) {
            if (xhr.responseJSON.errors && xhr.responseJSON.errors.length != 0) {
                let errors = xhr.responseJSON.errors;
                console.log(errors)
                $('#oldPasswordError').html(errors['old_password'])
                $('#passwordError').html(errors['password'])
                $('#confirmError').html(errors['email'])
            } else {
                errorMessage(xhr.responseJSON.message);
            }

        }
    });
}


function editImage() {
    $('#editProfile').modal("show");
}

$(document).ready(function () {

    function scrollBottom() {
        var ChatDiv = $('.simplebar-content-wrapper');
        var height = ChatDiv[3].scrollHeight;
        ChatDiv.scrollTop(height);
    }

    let new_id = document.getElementById('new_user_id').value;
    var new_authId = document.getElementById('user_id').value;
    var users = [];
    var newUsers = [];
    var userIds = [];
    window.Echo.join(`private.${new_authId}`)
        .listen('MessageSend', (e) => {
            console.log(e);
            let anotherMessage = e.message;
            let right = `<li >
                    <div class="conversation-list">
                        <div class="chat-avatar">
                            <img src="${anotherMessage.sender_image}" alt="">
                        </div>
                        <div class="user-chat-content">
                            <div class="ctext-wrap">
                                <div class="ctext-wrap-content">
                                 ${anotherMessage.chat.message_type == 0 ?
                `<p class="mb-0">
                                       ${anotherMessage.chat.message}
                                    </p>
                                    <p class="chat-time mb-0"><i class="ri-time-line align-middle"></i> <span
                                            class="align-middle">${anotherMessage.date}</span></p>`
                :
                `<ul class="list-inline message-img  mb-0">
                                            <li class="list-inline-item message-img-list me-2 ms-0">
                                                <div>
                                                    <a class="popup-img d-inline-block m-1" href="${anotherMessage.image_message}"
                                                     title="Project 1">
                                                        <img src="${anotherMessage.image_message}" alt="" class="rounded border">
                                                    </a>
                                                </div>
                                                <div class="message-img-link">
                                                    <ul class="list-inline mb-0">
                                                        <li class="list-inline-item">
                                                            <a download="img-1.jpg" href="${anotherMessage.image_message}" class="fw-medium">
                                                                <i class="ri-download-2-line"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </li>
                                    </ul>`}
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

                             <div class="conversation-name">${anotherMessage.own_user.name}</div>
                        </div>
                    </div>
                </li>`;

            let userList =
                `<li id="newFriend${anotherMessage.chat.sender.id}" data-id="${anotherMessage.chat.sender.id}"  class="activeUser singleActive">
                    <a href="#">
                        <div class="d-flex">
                            <div class="chat-user-img online align-self-center me-3 ms-0">
                                <img src="${anotherMessage.sender_image}" class="rounded-circle avatar-xs" alt="">
                                <span class="user-status"></span>
                            </div>

                            <div class="flex-grow-1 overflow-hidden">
                                <h5 class="text-truncate font-size-15 mb-1">${anotherMessage.chat.sender.name}</h5>

                                <p class="chat-user-message text-truncate mb-0">${anotherMessage.chat.message_type == 0 ? `${anotherMessage.chat.message}` : "File Send"}</p>
                            </div>
                            <div class="font-size-11">${anotherMessage.date}</div>
                        </div>
                    </a>
                </li>`;
            $('.message').val();
            $('.emojionearea-editor').html();
            $('#messageError').html();
            console.log(anotherMessage.chat.from_id);
            $(`.senderAppendTo${anotherMessage.chat.from_id}`).append(right);
            $(`#newFriend${anotherMessage.chat.sender.id}`).remove();
            $('#newfriendList').prepend(userList);
            $(`.singleActive`).removeClass('singleActive');
            $(`#newFriend${anotherMessage.chat.sender.id}`).addClass('singleActive');
            scrollBottom();
            console.log("hello");
        });


    window.Echo.join(`chat`)
        .here(function (users) {
            var jsonUsers = JSON.stringify(users)
            console.log(users);
            $.ajax({
                method: 'post',
                url: '/chat/online-user-owner',
                data: {
                    users: users,
                    '_token': csrf
                },
                success: function (response) {
                    console.log(response);
                    if (response != "") {
                        var onlineUserData = '';
                        onlineUserData += `<div class="owl-stage-outer">
                        <div class="owl-stage"
                        style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 87px;display: inline-flex;">`;
                        $.each(response, function (key, onlineUser) {
                            // if(onlineUser.id != new_authId){
                            onlineUserData += `<div class="owl-item active activeUser" id="leaving${onlineUser.id}" style="width: 71px; margin-right: 16px;" data-id="${onlineUser.id}" >
                            <div class="item">
                                <a href="#" class="user-status-box">
                                    <div class="avatar-xs mx-auto d-block chat-user-img online">
                                        <img src="${onlineUser.photo_url}" alt="user-img" class="img-fluid rounded-circle">
                                        <span class="user-status"></span>
                                    </div>
                                    <h5 class="font-size-13 text-truncate mt-3 mb-1">${onlineUser.name}</h5>
                                </a>
                            </div></div>`;
                            $(`#onlineCheck${onlineUser.id}`).removeClass('away');
                            $(`#onlineCheck${onlineUser.id}`).addClass('online');
                            $(`#onlineChatCheck${onlineUser.id}`).removeClass('text-warning');
                            $(`#onlineChatCheck${onlineUser.id}`).addClass('text-success');
                            $(`#onlineCheckContact${onlineUser.id}`).removeClass('away');
                            $(`#onlineCheckContact${onlineUser.id}`).addClass('online');

                            $(`#newUserOnline${onlineUser.id}`).removeClass('away');
                            $(`#newUserOnline${onlineUser.id}`).addClass('online');
                            // }
                        });
                        onlineUserData += `</div></div>`;
                        $('#user-status-carousel').html(onlineUserData);
                    }
                }
            });

        })
        .joining((user) => {
            console.log(user);
            // axios.put('/api/user/'+ user.id +'/offline?api_token=' + user.api_token, {});
            $.ajax({
                method: 'post',
                url: '/chat/online-user',
                data: {
                    id: user.id,
                    '_token': csrf
                },
                success: function (response) {
                    if (response != "") {
                        console.log(response);
                        users.push(response);
                        userIds.push(response.id);
                        var onlineUserData = '';
                        onlineUserData += `<div class="owl-stage-outer">
                        <div class="owl-stage"
                        style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 87px;display: inline-flex;">`;
                        $.each(users, function (key, onlineUser) {
                            // if(onlineUser.id != new_authId){
                            // $(`#leaving${onlineUser.id}`).remove();
                            onlineUserData += `<div class="owl-item active activeUser" id="leaving${onlineUser.id}" style="width: 71px; margin-right: 16px;" data-id="${onlineUser.id}" >
                            <div class="item">
                                <a href="#" class="user-status-box">
                                    <div class="avatar-xs mx-auto d-block chat-user-img online">
                                        <img src="${onlineUser.photo_url}" alt="user-img" class="img-fluid rounded-circle">
                                        <span class="user-status"></span>
                                    </div>
                                    <h5 class="font-size-13 text-truncate mt-3 mb-1">${onlineUser.name}</h5>
                                </a>
                            </div></div>`;
                            $(`#onlineCheck${onlineUser.id}`).removeClass('away');
                            $(`#onlineCheck${onlineUser.id}`).addClass('online');
                            $(`#onlineChatCheck${onlineUser.id}`).removeClass('text-warning');
                            $(`#onlineChatCheck${onlineUser.id}`).addClass('text-success');
                            $(`#onlineCheckContact${onlineUser.id}`).removeClass('away');
                            $(`#onlineCheckContact${onlineUser.id}`).addClass('online');
                            // }
                        });
                        onlineUserData += `</div></div>`;
                        $('#user-status-carousel').html(onlineUserData);
                    }
                }
            });
            $.each(users, function (key, onlineUser) {
                $(`#newUserOnline${onlineUser.id}`).removeClass('away');
                $(`#newUserOnline${onlineUser.id}`).addClass('online');
            });
        })
        .leaving(user => {
            users = users.filter(u => u.id != user.id);
            $(`#leaving${user.id}`).remove();

        })
        .listen('Demo', (e) => {
            console.log(e);
        });

    window.Echo.join(`new-user`)
        .joining((user) => {
            console.log("hi", user)
            newUsers.push(user)
            $.each(newUsers, function (key, onlineUser) {
                $(`#newUserOnline${onlineUser.id}`).removeClass('away');
                $(`#newUserOnline${onlineUser.id}`).addClass('online');
            });
        })
        .leaving(user => {
            newUsers = newUsers.filter(u => u.id != user.id);
        })
        .listen('NewUser', (e) => {
            console.log(e);
        });
    $(document).delegate(".activeUser", "click", function (event) {
        var id = $(this).data().id;
        var ownerId = new_authId;
        activeUser(id, ownerId);
    });
    emoji();

    function emoji() {
        $('#emoji').emojioneArea({
            emojiPlaceholder: ":smile_cat:",
            search: false,
            inline: true
        });
    }

    activeUser(new_id, new_authId);

    function activeUser(new_id, new_authId) {
        // console.log("ello");
        // var echo = window.Echo;
        $.ajax({
            method: 'post',
            url: '/chat/message-user-find',
            data: {
                id: new_id,
                authId: new_authId,
                '_token': csrf
            },
            dataType: "html",
            success: function (response) {
                // console.log("new echo ", echo);
                $(`.singleActive`).removeClass('singleActive');
                $(`#newFriend${new_id}`).addClass('singleActive');
                $('#messageList').html(response)
                $('#addNewChat').modal('hide');
                $.each(users, function (key, onlineUser) {
                    $(`#onlineChatCheck${onlineUser.id}`).removeClass('text-warning');
                    $(`#onlineChatCheck${onlineUser.id}`).addClass('text-success');
                });
                hideUserProfile();

            }, error: function (xhr) {
            }
        });
    }

    $(document).delegate(".addFriend", "click", function (event) {
        var id = new_authId;
        var ownerId = $(this).data().id;
        addFriend(id, ownerId);
    });

    function addFriend(id, ownerId) {
        $.ajax({
            url: "/chat/add-friend",
            data: {
                "_token": csrf,
                id: id,
                ownerId: ownerId,
            },
            type: "POST",
            dataType: "json",
            success: function (response) {
                console.log(response.user);
                if (response.message == true) {
                    let newFriend =
                        `<li id="newFriend${response.user.id}">
                                <a href="#">
                                    <div class="d-flex">
                                        <div class="chat-user-img away align-self-center me-3 ms-0" id="#newUserOnline${response.user.id}">
                                            <img src="${response.image}" class="rounded-circle avatar-xs" alt="">
                                            <span class="user-status"></span>
                                        </div>

                                        <div class="flex-grow-1 overflow-hidden">
                                            <h5 class="text-truncate font-size-15 mb-1">${response.user.name}</h5>
                                            <p class="chat-user-message text-truncate mb-0">${response.last_message}</p>
                                        </div>
                                        <div class="font-size-11">${response.last_date_message}</div>
                                    </div>
                                </a>
                            </li>`;
                    $(`#friend${ownerId}`).remove();
                    $(`#newfriendList`).prepend(newFriend);
                    $('#addNewChat').modal('hide');
                    activeUser(ownerId, id);
                    hideUserProfile();
                }
            }
        });
    }


    $(document).delegate("#messageSubmit", "click", function (event) {
        var id = $(this).data().id;
        var userId = new_authId;
        messageSubmit(id, userId);
    })

    $(document).delegate(".message", "keyup", function (event) {
        event.preventDefault();

        var messsage = $('#emoji1').data("emojioneArea").getText();
        if (event.key === "Enter") {
            var id = $('#emoji1ToId').val();
            var userId = new_authId;
            messageSubmit(id, userId, messsage);
        }
    })

    function messageSubmit(id, authId, messageValue) {

        if (messageValue == undefined) {
            var message = $('.message').val();
        } else {
            var message = messageValue;
        }
        console.log(id, authId, message);

        if (message.length === 0) {
            $('#messageError').html('Please Must Be Data Set');
        } else {
            $.ajax({

                method: 'post',
                url: '/chat/message-user-send',
                data: {
                    id: id,
                    authId: authId,
                    message: message,
                    '_token': csrf
                },
                success: function (response) {
                    console.log(response);
                    let right = `<li class="right"  >
                    <div class="conversation-list">
                        <div class="chat-avatar">
                            <img src="${response.own_user_image}" alt="">
                        </div>
                        <div class="user-chat-content">
                            <div class="ctext-wrap">
                                <div class="ctext-wrap-content">
                                    <p class="mb-0">
                                       ${response.chat.message}
                                    </p>
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
                                                            <p class="chat-user-message text-truncate mb-0">${response.chat.message}</p>
                                                        </div>
                                                        <div class="font-size-11">${response.date}</div>
                                                    </div>
                                                </a>
                                        </li>`;
                    $('.message').val();
                    $('.emojionearea-editor').html('');
                    $('#messageError').html();
                    $('#senderAppend').append(right)
                    $(`#newFriend${response.chat.receiver.id}`).remove();
                    $('#newfriendList').prepend(userList);
                    scrollBottom();
                }, error: function (xhr) {
                }
            });
        }

    }

    // $('#user-status-carousel').html("<p>hello</p>");

    $(document).delegate(".user-profile-show", "click", function (event) {

        var id = $(this).data().id;
        $.ajax({
            method: 'post',
            url: '/chat/another-user-profile',
            data: {
                id: id,
                '_token': csrf
            },
            dataType: "html",
            success: function (response) {
                $("#sideBarUser").toggle();
                $('#sideBarUser').html(response)
            }, error: function (xhr) {
            }
        });
    })
    $(document).delegate("#user-profile-hide", "click", function (event) {
        hideUserProfile();
    })
    $(document).delegate(".search_users_data", "keyup", function (event) {
        var searchUser = $(this).val();
        var activeUser = users;
        $.ajax({
            method: 'post',
            url: '/chat/user-search',
            data: {
                id: id,
                '_token': csrf,
                'searchUser': searchUser,
                // 'activeUser': activeUser,
            },
            dataType: "json",
            success: function (response) {
                var searchUserList = '';
                console.log(userIds);
                $.each(response.userSearch, function (key, user) {
                    console.log(userIds.includes(user.user_id));
                    if (userIds.includes(user.user_id) != true) {
                        var onlineUser = 'away';
                    } else {
                        var onlineUser = 'online';
                    }
                    searchUserList +=
                        ` <li id="newFriend${user.user_id}" data-id="${user.user_id}"  class="activeUser">
                            <a href="#">
                                <div class="d-flex">
                                    <div class="chat-user-img align-self-center me-3 ms-0 ${onlineUser}" >
                                        <img src="${user.photo_url}" class="rounded-circle avatar-xs" alt="">
                                        <span class="user-status"></span>
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden">
                                        <h5 class="text-truncate font-size-15 mb-1"> ${user.name}</h5>
                                                <p class="chat-user-message text-truncate mb-0"> ${user.message}</p>
                                    </div>
                                    <div class="font-size-11">${user.date}</div>
                                </div>
                            </a>
                        </li>`
                });
                $('#newfriendList').html(searchUserList)
            }, error: function (xhr) {
            }
        });
    })


    $(document).delegate("#search_user_contact", "keyup", function (event) {
        var userContactSearch = $(this).val();
        var activeUser = users;
        $.ajax({
            method: 'post',
            url: '/chat/user-search-contact',
            data: {
                id: id,
                '_token': csrf,
                'userContactSearch': userContactSearch,
                // 'activeUser': activeUser,
            },
            dataType: "json",
            success: function (response) {
                var searchContactUserList = '';
                console.log(userIds);
                $.each(response.contactListUser, function (key, user) {
                    console.log(userIds.includes(user.user_id));
                    if (userIds.includes(user.user_id) != true) {
                        var onlineUserContact = 'away';
                    } else {
                        var onlineUserContact = 'online';
                    }
                    searchContactUserList +=
                        `  <li id="contact${user.id}" class="activeUser" data-id="${user.id}">
                            <a href="#" >
                                <div class="d-flex">
                                    <div class="chat-user-img  ${onlineUserContact} align-self-center me-3 ms-0"  id="onlineCheckContact${user.id}">
                                        <img src="${user.photo_url}" class="rounded-circle avatar-xs" alt="">
                                        <span class="user-status"></span>
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden">
                                        <h5 class="text-truncate font-size-15 mb-1"> ${user.name}</h5>
                                        <p class="chat-user-message text-truncate mb-0">
                                            <i class="ri-image-fill align-middle me-1 ms-0"></i> ${user.email}</p>
                                    </div>
                                </div>
                            </a>
                        </li>`
                });
                $('#contactList').html(searchContactUserList)
            }, error: function (xhr) {
            }
        });
    })

    $(document).delegate("#search_user_contact_new", "keyup", function (event) {
        var userNewContactSearch = $(this).val();
        var activeUser = users;
        $.ajax({
            method: 'post',
            url: '/chat/user-search-contact-new',
            data: {
                id: id,
                '_token': csrf,
                'userNewContactSearch': userNewContactSearch,
                // 'activeUser': activeUser,
            },
            dataType: "json",
            success: function (response) {
                var searchNewContactUserList = '';
                console.log(userIds);
                $.each(response.contactListUserNew, function (key, user) {
                    console.log(userIds.includes(user.user_id));
                    if (userIds.includes(user.user_id) != true) {
                        var onlineNewUserContact = 'away';
                    } else {
                        var onlineNewUserContact = 'online';
                    }
                    searchNewContactUserList +=
                        `  <li id="contact${user.id}" class="activeUser" data-id="${user.id}">
                            <a href="#" >
                                <div class="d-flex">
                                    <div class="chat-user-img  ${onlineNewUserContact} align-self-center me-3 ms-0"  id="newUserOnline${user.id}">
                                        <img src="${user.photo_url}" class="rounded-circle avatar-xs" alt="">
                                        <span class="user-status"></span>
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden">
                                        <h5 class="text-truncate font-size-15 mb-1"> ${user.name}</h5>
                                        <p class="chat-user-message text-truncate mb-0">
                                            <i class="ri-image-fill align-middle me-1 ms-0"></i> ${user.email}</p>
                                    </div>
                                     <button type="button"  class="btn btn-primary addFriend" data-id="${user.id}">Chat</button>
                                </div>
                            </a>
                        </li>`
                });
                $('#new_contact_user_list').html(searchNewContactUserList)
            }, error: function (xhr) {
            }
        });
    })


    function hideUserProfile() {
        $(".user-profile-sidebar").css('display', 'none');
    }

// Group

    function activeGroup() {
        console.log("hello");
    }

    $('#createGroupForm').submit(function (e) {
        e.preventDefault();
        var formDataGroup = new FormData(this);
        $.ajax({
            method: 'post',
            url: '/chat/group-create',
            data: formDataGroup,
            cache: false,
            contentType: false,
            processData: false,
            success: function (response) {

                $('#createNewGroup').modal('hide');
                $('#pills-chat-tab').removeClass('active show');
                $('#pills-chat').removeClass('active');
                $('#pills-groups-tab').addClass('active');
                $('#pills-groups').addClass('active show');
            }, error: function (xhr) {
            }
        });

    });
});














