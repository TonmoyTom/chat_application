@extends('layouts.app')
@section('content')
    <div class="layout-wrapper d-lg-flex">
        <!-- Start left sidebar-menu -->
        <div class="side-menu flex-lg-column me-lg-1 ms-lg-0">
            <!-- Start side-menu nav -->
            @include('layouts.navigation')
            <!-- end side-menu nav -->
            <!-- Side menu user -->
        </div>
        <!-- end left sidebar-menu -->

        <!-- start chat-leftsidebar -->
        <div class="chat-leftsidebar me-lg-1 ms-lg-0" id="profileLoad">
            <div class="tab-content">
                <!-- Start Profile tab-pane -->
                @include('layouts.profile')
                <!-- End Profile tab-pane -->
                <!-- Start chats tab-pane -->
                @include('layouts.chat')
                <!-- End chats tab-pane -->
                <!-- Start groups tab-pane -->
               @include('layouts.group')
                <!-- End groups tab-pane -->
                <!-- Start contacts tab-pane -->
                @include('layouts.contact')
                <!-- End contacts tab-pane -->
                <!-- Start settings tab-pane -->
                 @include('layouts.setting')
                <!-- End settings tab-pane -->
            </div>
            <!-- end tab content -->
        </div>

        <!-- end chat-leftsidebar -->

        <!-- Start User chat -->
        <div class="user-chat w-100 overflow-hidden">
            <div class="d-lg-flex">
                <!-- start chat conversation section -->
                <div class="w-100 overflow-hidden position-relative">
                    @include('layouts.user-bar')
                    <!-- end chat user head -->

                    <!-- start chat conversation -->
                    @include('layouts.chat-list')
                    <!-- end chat input section -->
                </div>

                <!-- end chat conversation section -->
                <!-- start User profile detail sidebar -->
                @include('layouts.user-profile')
            </div>
            <!-- End User chat -->
        </div>
        <!-- end  layout wrapper -->
    </div>
@endsection
@push('script')
    <script>
        activeUser('{{ @$firstUser->id }}' , '{{ auth()->id() }}')
    </script>
@endpush

