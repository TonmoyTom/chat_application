@foreach($users as $user)
<li>
    <a href="#">
        <div class="d-flex">
            <div class="chat-user-img online align-self-center me-3 ms-0">
                <img src=" {{ setImage($user['photo_url']) }}" class="rounded-circle avatar-xs" alt="">
                <span class="user-status"></span>
            </div>

            <div class="flex-grow-1 overflow-hidden">
                <h5 class="text-truncate font-size-15 mb-1">{{ $user['name'] }}</h5>
                <p class="chat-user-message text-truncate mb-0">Hey! there I'm available</p>
            </div>
            <div class="font-size-11">05 min</div>
        </div>
    </a>
</li>
@endforeach
