<!-- ========== Horizontal Menu Start ========== -->
<div class="topnav">
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg">
            <div class="collapse navbar-collapse" id="topnav-menu-content">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link dropdown-toggle arrow-none" href="{{route('admin.home')}}" role="button">
                            <i class="ri-home-4-line"></i>Dashboards
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" id="topnav-apps" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="ri-apps-line"></i>Sales Orders <div class="arrow-down"></div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="topnav-apps">
                            <a href="{{route('admin.transaction')}}" class="dropdown-item">Transaction</a>
                            <!-- <a href="apps-chat.php" class="dropdown-item">Chat</a>
                            <div class="dropdown">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-email" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Email <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-email">
                                    <a href="apps-email-inbox.php" class="dropdown-item">Inbox</a>
                                    <a href="apps-email-read.php" class="dropdown-item">Read Email</a>
                                </div>
                            </div>
                            <div class="dropdown">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-tasks" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Tasks <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-tasks">
                                    <a href="apps-tasks.php" class="dropdown-item">List</a>
                                    <a href="apps-tasks-details.php" class="dropdown-item">Details</a>
                                </div>
                            </div>
                            <a href="apps-kanban.php" class="dropdown-item">Kanban</a>
                            <a href="apps-file-manager.php" class="dropdown-item">File Manager</a> -->
                        </div>
                    </li>
                     <li class="nav-item">
                        <a class="nav-link dropdown-toggle arrow-none" href="{{route('admin.products.index')}}" role="button">
                            <i class="ri-shopping-bag-line"></i>Products
                        </a>
                    </li>
                    <!--<li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-pages" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="ri-instance-line"></i>Products <div class="arrow-down"></div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="topnav-pages">
                             <div class="dropdown">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-auth" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Authenitication <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-auth">
                                    <a href="auth-login.php" class="dropdown-item">Login</a>
                                    <a href="auth-login-2.php" class="dropdown-item">Login 2</a>
                                    <a href="auth-register.php" class="dropdown-item">Register</a>
                                    <a href="auth-register-2.php" class="dropdown-item">Register 2</a>
                                    <a href="auth-logout.php" class="dropdown-item">Logout</a>
                                    <a href="auth-logout-2.php" class="dropdown-item">Logout 2</a>
                                    <a href="auth-recoverpw.php" class="dropdown-item">Recover Password</a>
                                    <a href="auth-recoverpw-2.php" class="dropdown-item">Recover Password 2</a>
                                    <a href="auth-lock-screen.php" class="dropdown-item">Lock Screen</a>
                                    <a href="auth-lock-screen-2.php" class="dropdown-item">Lock Screen 2</a>
                                    <a href="auth-confirm-mail.php" class="dropdown-item">Confirm Mail</a>
                                    <a href="auth-confirm-mail-2.php" class="dropdown-item">Confirm Mail 2</a>
                                </div>
                            </div>
                            <div class="dropdown">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-error" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Error <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-error">
                                    <a href="error-404.php" class="dropdown-item">Error 404</a>
                                    <a href="error-404-alt.php" class="dropdown-item">Error 404-alt</a>
                                    <a href="error-500.php" class="dropdown-item">Error 500</a>
                                </div>
                            </div> -->
                            <!-- <a href="{{route('admin.products.index')}}" class="dropdown-item">List Products</a> -->
                            <!-- <a href="pages-preloader.php" class="dropdown-item">With Preloader</a>
                            <a href="pages-profile.php" class="dropdown-item">Profile</a>
                            <a href="pages-invoice.php" class="dropdown-item">Invoice</a>
                            <a href="pages-faq.php" class="dropdown-item">FAQ</a>
                            <a href="pages-pricing.php" class="dropdown-item">Pricing</a>
                            <a href="pages-maintenance.php" class="dropdown-item">Maintenance</a>
                            <a href="pages-timeline.php" class="dropdown-item">Timeline</a>
                        </div>
                    </li> -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-components" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="ri-user-follow-line"></i>Users <div class="arrow-down"></div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="topnav-components">
                            <a href="{{route('admin.users')}}" class="dropdown-item">Users</a>
                            <a href="{{route('admin.customers.index')}}" class="dropdown-item">Customers</a>
                            <!--<div class="dropdown">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-ui-kit" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Sales <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-ui-kit">
                                    <a href="ui-accordions.php" class="dropdown-item">Accordions</a>
                                    <a href="ui-alerts.php" class="dropdown-item">Alerts</a>
                                </div>
                            </div>
                            <div class="dropdown">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-ui-kit2" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Base UI 2 <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-ui-kit2">
                                    <a href="ui-modals.php" class="dropdown-item">Modals</a>
                                    <a href="ui-notifications.php" class="dropdown-item">Notifications</a>
                                    <a href="ui-offcanvas.php" class="dropdown-item">Offcanvas</a>
                                    <a href="ui-placeholders.php" class="dropdown-item">Placeholders</a>
                                    <a href="ui-pagination.php" class="dropdown-item">Pagination</a>
                                    <a href="ui-popovers.php" class="dropdown-item">Popovers</a>
                                    <a href="ui-progress.php" class="dropdown-item">Progress</a>
                                    <a href="ui-ribbons.php" class="dropdown-item">Ribbons</a>
                                    <a href="ui-spinners.php" class="dropdown-item">Spinners</a>
                                    <a href="ui-tabs.php" class="dropdown-item">Tabs</a>
                                    <a href="ui-tooltips.php" class="dropdown-item">Tooltips</a>
                                    <a href="ui-typography.php" class="dropdown-item">Typography</a>
                                    <a href="ui-utilities.php" class="dropdown-item">Utilities</a>
                                </div>
                            </div>
                            <div class="dropdown">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-extended-ui" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Extended UI <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-extended-ui">
                                    <a href="extended-dragula.php" class="dropdown-item">Dragula</a>
                                    <a href="extended-range-slider.php" class="dropdown-item">Range Slider</a>
                                    <a href="extended-ratings.php" class="dropdown-item">Ratings</a>
                                    <a href="extended-scrollbar.php" class="dropdown-item">Scrollbar</a>
                                    <a href="extended-scrollspy.php" class="dropdown-item">Scrollspy</a>
                                </div>
                            </div>
                            <div class="dropdown">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-forms" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Forms <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-forms">
                                    <a href="form-elements.php" class="dropdown-item">Basic Elements</a>
                                    <a href="form-advanced.php" class="dropdown-item">Form Advanced</a>
                                    <a href="form-validation.php" class="dropdown-item">Validation</a>
                                    <a href="form-wizard.php" class="dropdown-item">Wizard</a>
                                    <a href="form-fileuploads.php" class="dropdown-item">File Uploads</a>
                                    <a href="form-editors.php" class="dropdown-item">Editors</a>
                                </div>
                            </div>
                            <div class="dropdown">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-charts" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Charts <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-charts">
                                    <a href="charts-chartjs-area.php" class="dropdown-item">Chartjs</a>
                                    <a href="charts-apex-line.php" class="dropdown-item">Apex Charts</a>
                                </div>
                            </div>
                            <div class="dropdown">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-tables" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Tables <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-tables">
                                    <a href="tables-basic.php" class="dropdown-item">Basic Tables</a>
                                    <a href="tables-datatable.php" class="dropdown-item">Data Tables</a>
                                </div>
                            </div>
                            <div class="dropdown">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-icons" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Icons <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-icons">
                                    <a href="icons-remixicons.php" class="dropdown-item">Remix Icons</a>
                                    <a href="icons-bootstrap.php" class="dropdown-item">Bootstrap Icons</a>
                                </div>
                            </div>
                            <div class="dropdown">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-maps" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Maps <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-maps">
                                    <a href="maps-google.php" class="dropdown-item">Google Maps</a>
                                    <a href="maps-vector.php" class="dropdown-item">Vector Maps</a>
                                </div>
                            </div> -->
                        </div>
                    </li>
                    <!-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-components" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="ri-shopping-bag-line"></i>Customers <div class="arrow-down"></div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="topnav-components">
                            <a href="{{route('admin.customers.index')}}" class="dropdown-item">List Customers</a>
                        </div>
                    </li> -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-layouts" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="ri-route-line"></i>General <div class="arrow-down"></div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="topnav-layouts">
                            <a href="{{route('admin_structure_general')}}" class="dropdown-item">Structure Organization </a>
                            <a href="{{route('admin_group_general')}}" class="dropdown-item">Group</a>
                            <!-- <a href="layouts-full.php" class="dropdown-item" target="_blank">Full</a>
                            <a href="layouts-fullscreen.php" class="dropdown-item" target="_blank">Fullscreen</a>
                            <a href="layouts-hover.php" class="dropdown-item" target="_blank">Hover Menu</a>
                            <a href="layouts-compact.php" class="dropdown-item" target="_blank">Compact Menu</a>
                            <a href="layouts-icon-view.php" class="dropdown-item" target="_blank">Icon View</a> -->
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
<!-- ========== Horizontal Menu End ========== -->
