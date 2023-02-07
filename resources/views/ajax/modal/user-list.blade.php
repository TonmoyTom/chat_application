<ul class="list-unstyled chat-list chat-user-list">
    @forelse($users as $user)
        <li id="friend{{$user->id}}">
            <a href="#" >
                <div class="d-flex">
                    <div class="chat-user-img away align-self-center me-3 ms-0">
                            <img src="{{ setImage($user->photo_url) }}" class="rounded-circle avatar-xs" alt="">
                        <span class="user-status"></span>
                    </div>
                    <div class="flex-grow-1 overflow-hidden">
                        <h5 class="text-truncate font-size-15 mb-1"> {{ $user->name }}</h5>
                        <p class="chat-user-message text-truncate mb-0">
                            <i class="ri-image-fill align-middle me-1 ms-0"></i> {{ $user->email }}</p>
                    </div>
                    <button type="button"  class="btn btn-primary"  onclick="addFriend('{{ auth()->id() }}' , '{{ $user->id }}')">Chat</button>
                </div>
            </a>
        </li>
    @empty
        <li>No User Found</li>
    @endforelse
</ul>
