<header class="header-main">
    <section class="sidebar-header bg-gray">
        <section class="d-flex justify-content-between flex-md-row-reverse px-2">
            <span id="sidebar-toggle-show" class="d-inline d-md-none pointer"><i class="fas fa-toggle-off"></i></span>
            <span id="sidebar-toggle-hide" class="d-none d-md-inline pointer"><i class="fas fa-toggle-on"></i></span>
            <span><img class="logo" src="{{asset('admin-assets/images/logo.png')}}" alt=""></span>
            <span class="d-md-none" id="menu-toggle"><i class="fas fa-ellipsis-h"></i></span>
        </section>
    </section>
    <section class="body-header" id="body-header">
        <section class="d-flex justify-content-between">
            <section>
                <span class="mr-5">
                    <span id="search-area" class="search-area d-none">
                        <i id="search-area-hide" class="fas fa-times pointer"></i>
                        <input id="search-input" type="text" class="search-input">
                        <i class="fas fa-search pointer"></i>
                    </span>
                    <i id="search-toggle" class="fas fa-search p-1 d-none d-md-inline pointer"></i>
                </span>

                <span id="full-screen" class="pointer p-1 d-none d-md-inline mr-5">
                    <i id="screen-compress" class="fas fa-compress d-none"></i>
                    <i id="screen-expand" class="fas fa-expand "></i>
                </span>
            </section>
            <section>
                <span class="ml-2 ml-md-4 position-relative">
                    <span id="header-notification-toggle" class="pointer" id="notification" onclick="readAll()">
                        <i class="far fa-bell"></i>

                        @if($notifications->count() != 0)

                        <sup class="badge badge-danger" id="notification-badge">

                             {{ $notifications->count() }}
                        
                        </sup> 

                        @endif
                    </span>
                    <section id="header-notification" class="header-notifictation rounded">
                        <section class="d-flex justify-content-between">
                            <span class="px-2">
                                نوتیفیکیشن ها
                            </span>
                            <span class="px-2">
                                <span class="badge badge-danger">جدید</span>
                            </span>
                        </section>

                        <ul class="list-group rounded px-0">

                        @foreach($notifications as $notification)
                            <li class="list-group-item list-group-item-action">
                                <section class="media">
                                    <section class="media-body pr-1">

                                        <h5 class="notification-user">{{ $notification->data['message'] }}</h5>

                                    </section>
                                </section>
                            </li>
                        @endforeach

                        </ul>
                    </section>
                </span>
                <section id="header-comment" class="header-comment">


                    <section class="header-comment-wrapper">
                        <ul class="list-group rounded px-0">

                            @foreach($unSeenComments as $unSeenComment)
                            <li class="list-group-item list-groupt-item-action">
                                <section class="media">
                                    <img src="{{asset('admin-assets/images/avatar-2.jpg')}}" alt="avatar" class="notification-img">
                                    <section class="media-body pr-1">

                                        <section class="d-flex justify-content-between">
                                            <h5 class="comment-user mb-0">{{$unSeenComment->user->full_name}}</h5>
                                            <span><i class="fas fa-circle text-success comment-user-status"></i></span>
                                        </section>

                                        <section>
                                            <h5 class="comment-user mt-0">{{$unSeenComment->body}}</h5>
                                        </section>

                                    </section>
                                </section>
                            </li>
                            @endforeach

                    </section>

                </section>
                <span class="ml-2 ml-md-4 position-relative">
                    <span id="header-comment-toggle" class="pointer">
                        <i class="far fa-comment-alt"></i>

                            <sup class="badge badge-danger">{{$unSeenComments->count() != 0 ? $unSeenComments->count() : ''}}</sup>

                    </span>


                </span>
                <span class="ml-3 ml-md-5 position-relative">
                    <span id="header-profile-toggle" class="pointer">
                        <img class="header-avatar" src="{{asset('admin-assets/images/avatar-2.jpg')}}" alt="">
                        <span class="header-username">کامران محمدی</span>
                        <i class="fas fa-angle-down"></i>
                    </span>
                    <section id="header-profile" class="header-profile rounded">
                        <section class="list-group rounded">
                            <a href="#" class="list-group-item list-group-item-action header-profile-link">
                                <i class="fas fa-cog"></i>تنظیمات
                            </a>
                            <a href="#" class="list-group-item list-group-item-action header-profile-link">
                                <i class="fas fa-user"></i>کاربر
                            </a>
                            <a href="#" class="list-group-item list-group-item-action header-profile-link">
                                <i class="far fa-envelope"></i>پیام ها
                            </a>
                            <a href="#" class="list-group-item list-group-item-action header-profile-link">
                                <i class="fas fa-lock"></i>قفل صفحه
                            </a>
                            <a href="#" class="list-group-item list-group-item-action header-profile-link">
                                <i class="fas fa-sign-out-alt"></i>خروج
                            </a>
                        </section>
                    </section>
                </span>
            </section>
        </section>
    </section>
</header>