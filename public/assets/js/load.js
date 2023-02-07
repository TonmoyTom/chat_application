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

function editImage(){
    $('#editProfile').modal("show");
}
