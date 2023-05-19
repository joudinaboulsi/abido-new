<!-- partial:partia/__sidenav.html -->
<aside class="sigma_aside sigma_aside-right sigma_aside-right-panel sigma_aside-bg">
    <div class="sidebar">
        @if ($language == 'ENG')
            <div class="sidebar-widget widget-logo">
                <img src="{{ app('sidebar')->components->logo->sm_img }}" class="mb-30" alt="img" />
                <p>{!! app('sidebar')->components->content->value !!}</p>
            </div>
        @else
            <div class="sidebar-widget widget-logo" style="text-align: right">
                <img src="{{ app('sidebar')->components->logo->sm_img }}" class="mb-30" alt="img" />
                <p>{!! app('sidebar')->components->content_ar->value !!}</p>
            </div>
        @endif
        <!-- Instagram Start -->
        <div class="sidebar-widget widget-ig">
            {{-- @if ($language == 'ENG')
                <h5 class="widget-title">Instagram</h5>
            @else
                <h5 class="widget-title" style="text-align: right">الانستغرام</h5>
            @endif --}}
            <div class="row">
                @foreach (app('sidebar')->components->galleray->value as $v)
                    <div class="col-lg-3 col-md-4 col-sm-4 col-6">
                        {{-- <a href="#" > --}}
                        <img class="sigma_ig-item" src="{{ $v->components->images->md_img }}" alt="ig" />
                        {{-- </a> --}}
                    </div>
                @endforeach


            </div>
        </div>
        <!-- Instagram End -->
        <!-- Social Media Start -->
        <div class="sidebar-widget">
            @if ($language == 'ENG')
                <h5 class="widget-title">Follow Us</h5>
            @else
                <h5 class="widget-title" style="text-align: right">تابعنا</h5>
            @endif
            <div class="sigma_post-share">
                <ul class="sigma_sm square light">
                    @if (app('settings')->store_address->fb_link)
                        <li>
                            <a href="{{ app('settings')->store_address->fb_link }}">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                        </li>
                    @endif
                    @if (app('settings')->store_address->linkedin_link)
                        <li>
                            <a href="{{ app('settings')->store_address->linkedin_link }}">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        </li>
                    @endif
                    @if (app('settings')->store_address->twitter_link)
                        <li>
                            <a href="{{ app('settings')->store_address->twitter_link }}">
                                <i class="fab fa-twitter"></i>
                            </a>
                        </li>
                    @endif
                    @if (app('settings')->store_address->youtube_link)
                        <li>
                            <a href="{{ app('settings')->store_address->youtube_link }}">
                                <i class="fab fa-youtube"></i>
                            </a>
                        </li>
                    @endif
                    @if (app('settings')->store_address->insta_link)
                        <li>
                            <a href="{{ app('settings')->store_address->insta_link }}">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
        <!-- Social Media End -->
    </div>
</aside>
<div class="sigma_aside-overlay aside-trigger-right"></div>
<!-- partial -->
