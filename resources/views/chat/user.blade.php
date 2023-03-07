@foreach($recentUsersWithMessage as $key =>  $user)
<li id="newFriend{{ $user['user_id'] }}" data-id="{{$user['user_id'] }}"  class="activeUser">
    <a href="#">
        <div class="d-flex">
            <div class="chat-user-img online align-self-center me-3 ms-0">
                <img src=" {{ setImage(@$user['photo_url']) }}" class="rounded-circle avatar-xs" alt="">
                <span class="user-status"></span>
            </div>

            <div class="flex-grow-1 overflow-hidden">
                <h5 class="text-truncate font-size-15 mb-1">{{ $user['name'] }}</h5>
                @if(lastMessage($user['user_id']) != null )
                    @if(lastMessage($user['user_id'])->message_type == 0)
                    <p class="chat-user-message text-truncate mb-0">{{ lastMessage($user['user_id'])->message}}</p>
                    @else
                        <p class="chat-user-message text-truncate mb-0"> File Send</p>
                    @endif
                @endif

            </div>
            <div class="font-size-11">{{ lastMessageDate($user['user_id']) }}</div>
        </div>
    </a>
</li>
@endforeach


