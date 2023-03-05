var csrf = document.querySelector('meta[name="csrf-token"]').content;

$(document).ready(function () {
    imgae();
    emoji();
});


function emoji() {
    $('#emoji').emojioneArea({
        emojiPlaceholder: ":smile_cat:",
        search: false,
        inline: true
    });
}

function profile() {
    console.log("helo");
    $.ajax({
        method: 'get',
        url: '/profile',
        success: function (response) {
            $('#profileAjax').html(response);
        }, error: function (xhr) {
        }
    });
}
function imgae() {
    $.ajax({
        method: 'get',
        url: '/image',
        success: function (response) {
            $('#image').html(response);
        }, error: function (xhr) {
        }
    });
}

function setting() {
    $.ajax({
        method: 'get',
        url: '/setting',
        success: function (response) {
            $('#setting').html(response);
        }, error: function (xhr) {
        }
    });
}

function photoSee(value) {
    $.ajax({
        method: 'post',
        url: '/photo-see',
        data: {
            value: value,
            '_token': csrf
        },
        success: function (response) {
            if(value == 0){
                successMessage("Profile photo See Everyone");
            }else{
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
        url: '/seen-show-hide',
        data: {
            value: value,
            '_token': csrf
        },
        success: function (response) {
            if(seen == 0){
                successMessage("Last seen Show");
            }else{
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
        url: '/subscribed',
        data: {
            value: checkBox.value,
            '_token': csrf
        },
        success: function (response) {
            if(checkBox.checked === true){
                successMessage("Show security notification Enable");
            }else{
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
        url: 'change-password',
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

function activeUser(id , authId){
    $.ajax({
        method: 'post',
        url: '/message-user-find',
        data: {
            id: id,
            authId: authId,
            '_token': csrf
        },
        dataType: "html",
        success: function (response) {
            $(`.activeUser`).removeClass('activeUser');
            $(`#newFriend${id}`).addClass('activeUser');
            $('#messageList').html(response)
        }, error: function (xhr) {
        }
    });
}

function messageSubmit(id , authId){
    let message = $('.message').val();
    console.log(message);
    if(message.length === 0){
        $('#messageError').html('Please Must Be Data Set');
    }else{
        $.ajax({
            method: 'post',
            url: '/message-user-send',
            data: {
                id: id,
                authId: authId,
                message: message,
                '_token': csrf
            },
            success: function (response) {
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
                                            class="align-middle">${response.chat.created_at}</span></p>
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
                </li>`
                $('.message').val('');
                $('.emojionearea-editor').html('');
                $('#senderAppend').append(right)
            }, error: function (xhr) {
            }
        });
    }

}

function editImage(){
    $('#editProfile').modal("show");
}
