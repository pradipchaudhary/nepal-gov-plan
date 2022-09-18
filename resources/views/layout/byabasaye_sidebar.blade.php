
 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
     <!-- Brand Logo -->
     <a href="index3.html" class="brand-link">
         <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
         <span class="brand-text font-weight-light">AdminLTE 3</span>
     </a>

     <!-- Sidebar -->
     <div class="sidebar">
         <!-- Sidebar user panel (optional) -->
         <div class="user-panel mt-3 pb-3 mb-3 d-flex">
             <div class="image">
                 <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
             </div>
             <div class="info">
                 <a href="#" class="d-block">Alexander Pierce</a>
             </div>
         </div>

         <!-- Sidebar Menu -->
         <nav class="mt-2">
             <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                 data-accordion="false">
                 <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                 <li class="nav-item">
                     <a href="pages/widgets.html" class="nav-link">
                         <i class="nav-icon fas fa-tachometer-alt"></i>
                         <p>
                             डास्बोर्ड
                         </p>
                     </a>
                 </li>
                 <li class="nav-item {{ (request()->is('setting*')) ? 'menu-open' : '' }}">
                     <a href="#" class="nav-link">
                         <i class="nav-icon fas fa-cogs"></i>
                         <p>
                             सेट्टिङ्स
                             <i class="fas fa-angle-left right"></i>
                         </p>
                     </a>
                     <ul class="nav nav-treeview">
                         @foreach ($data as $setting)
                             <li class="nav-item">
                                 <a href="{{ route('setting',[$setting->slug]) }}" class="nav-link {{ (request()->is('setting/'. $setting->slug)) ? 'active' : '' }}">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>{{$setting->name}}</p>
                                 </a>
                             </li>
                         @endforeach
                     </ul>
                 </li>

                 <li class="nav-item">
                    <a href="{{ route('permission-letter')}}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            इजाजत पत्र
                        </p>
                    </a>
                </li>
                 <li class="nav-item">
                    <a href="pages/widgets.html" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            व्यवसाय दर्ता
                        </p>
                    </a>
                </li>
                 <li class="nav-item">
                    <a href="pages/widgets.html" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            कृषि समुह दर्ता
                        </p>
                    </a>
                </li>
                 <li class="nav-item">
                    <a href="pages/widgets.html" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            सहकारी संस्था दर्ता
                        </p>
                    </a>
                </li>
                 <li class="nav-item">
                    <a href="pages/widgets.html" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            खानेपानी/सरसफाई
                        </p>
                    </a>
                </li>
                 <li class="nav-item">
                     <a href="pages/layout/fixed-sidebar.html" class="nav-link">
                         <i class="far fa-file nav-icon"></i>
                         <p>रिपोर्ट</p>
                     </a>
                 </li>
             </ul>
         </nav>
         <!-- /.sidebar-menu -->
     </div>
     <!-- /.sidebar -->
 </aside>
