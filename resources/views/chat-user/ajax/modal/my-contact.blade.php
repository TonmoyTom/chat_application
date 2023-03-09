
<div class="search-box chat-search-box">
    <div class="input-group mb-3 rounded-3">
        <span class="input-group-text text-muted bg-light pe-1 ps-3" id="basic-addon1">
            <i class="ri-search-line search-icon font-size-18"></i>
        </span>
        <input type="text" class="form-control bg-light" placeholder="Search messages or users" id="search_user_contact"
               aria-label="Search messages or users" aria-describedby="basic-addon1">
    </div>
</div> <!-- Search Box-->
<ul class="list-unstyled chat-list chat-user-list" id="contactList">
    @forelse($users as $user)
        <li id="contact{{$user->id}}" class="activeUser" data-id="{{$user->id  }}">
            <a href="#" >
                <div class="d-flex">
                    <div class="chat-user-img away align-self-center me-3 ms-0"  id="onlineCheckContact{{$user->id  }}">
                        <img src="{{ setImage($user->photo_url) }}" class="rounded-circle avatar-xs" alt="">
                        <span class="user-status"></span>
                    </div>
                    <div class="flex-grow-1 overflow-hidden">
                        <h5 class="text-truncate font-size-15 mb-1"> {{ $user->name }}</h5>
                        <p class="chat-user-message text-truncate mb-0">
                            <i class="ri-image-fill align-middle me-1 ms-0"></i> {{ $user->email }}</p>
                    </div>
                </div>
            </a>
        </li>
    @empty
        <li>No User Found</li>
    @endforelse
</ul>
