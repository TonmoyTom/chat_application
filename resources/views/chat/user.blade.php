@foreach($recentUsersWithMessage as $key =>  $user)
    @php
        $lastMessage  = lastMessage($user['user_id'])
    @endphp
<li id="newFriend{{ $user['user_id'] }}" data-id="{{$user['user_id'] }}"  class="activeUser">
    <a href="#">
        <div class="d-flex">
            <div class="chat-user-img away align-self-center me-3 ms-0" id="onlineCheck{{$user['user_id']}}">
                <img src=" {{ setImage(@$user['photo_url']) }}" class="rounded-circle avatar-xs" alt="">
                <span class="user-status"></span>
            </div>

            <div class="flex-grow-1 overflow-hidden">
                <h5 class="text-truncate font-size-15 mb-1">{{ $user['name'] }}</h5>
                @if($lastMessage != null )
                    @if($lastMessage['message_type'] == 0)
                    <p class="chat-user-message text-truncate mb-0">{{ $lastMessage['message']}}</p>
                    @else
                        <p class="chat-user-message text-truncate mb-0"> File Send</p>
                    @endif
                @endif

            </div>
            <div class="font-size-11">{{ $lastMessage['date']}}</div>
        </div>
    </a>
</li>
@endforeach


