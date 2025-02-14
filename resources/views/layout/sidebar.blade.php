    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-heading">Pages</li>

            <li class="nav-item">
                <a class="nav-link collapsed " href="index.html">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard (İdarə paneli)</span>
                </a>
            </li><!-- End Dashboard Nav -->

            <li class="nav-item">
                <a class="nav-link  {{Route::is("admin.home") ? "" : "collapsed" }}" href="{{route('admin.home')}}">
                    <i class="bi bi-person"></i>
                    <span>Home (Ev)</span>
                </a>
            </li><!-- End Home Page Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="pages-faq.html">
                    <i class="bi bi-question-circle"></i>
                    <span>Resume (CV)</span>
                </a>
            </li><!-- End Resume Page Nav -->

            <li class="nav-item">
                <a class="nav-link  {{Route::is("admin.about") ? "" : "collapsed" }}" href="{{route('admin.about')}}">
                    <i class="bi bi-envelope"></i>
                    <span>About (Haqqında)</span>
                </a>
            </li><!-- End About Page Nav -->


            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-menu-button-wide"></i><span>Portfolio</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="components-alerts.html">
                            <i class="bi bi-circle"></i><span>MainPortfolio</span>
                        </a>
                    </li>
                    <li>
                        <a href="components-alerts.html">
                            <i class="bi bi-circle"></i><span>All</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Portfolio Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="pages-register.html">
                    <i class="bi bi-card-list"></i>
                    <span>References (Referanslar)</span>
                </a>
            </li><!-- End References Page Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="pages-register.html">
                    <i class="bi bi-card-list"></i>
                    <span>Services (Xidmətlər)</span>
                </a>
            </li><!-- End Services Page Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="pages-login.html">
                    <i class="bi bi-box-arrow-in-right"></i>
                    <span>Frequently asked questions (Tez-tez verilən suallar)</span>
                </a>
            </li><!-- End Login Page Nav -->


            <li class="nav-item">
                <a class="nav-link collapsed" href="pages-error-404.html">
                    <i class="bi bi-dash-circle"></i>
                    <span>Contact (Əlaqə)</span>
                </a>
            </li><!-- End Error 404 Page Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="pages-blank.html">
                    <i class="bi bi-file-earmark"></i>
                    <span>Settings</span>
                </a>
            </li><!-- End Blank Page Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="pages-blank.html">
                    <i class="bi bi-link"></i>
                    <span>Links</span>
                </a>
            </li><!-- End Blank Page Nav -->


            <li class="nav-heading">Switch to site (Sayta keçin)</li>
            <a class="nav-link collapsed" href="{{route('home')}}">
                <i class="bi bi-link"></i>
                <span>OrkhanCabrayilzada.site</span>
            </a>













        </ul>

    </aside><!-- End Sidebar-->
