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
                 <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="nav-icon fas fa-cog"></i>
                      <p>
                        मालपोत सेटिंग
                        <i class="fas fa-angle-left right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="{{route('haal_sabik_list')}}" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>साबिक र हालको नाम</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{route('land_rate_list')}}" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>मालपोतको रेट</p>
                        </a>
                      </li>
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
                     <a href="{{ route('land_profile_list') }}" class="nav-link">
                         <i class="nav-icon fas fa-edit"></i>
                         <p>
                            जग्गाधनी प्रोफाईल
                         </p>
                     </a>
                 </li>
                 {{-- <li class="nav-item">
                     <a href="#" class="nav-link">
                         <i class="nav-icon fas fa-file"></i>
                         <p>
                             रिपोर्ट
                         </p>
                     </a>
                 </li> --}}
                 <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="nav-icon fas fa-file"></i>
                      <p>
                        रिपोर्ट
                        <i class="fas fa-angle-left right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="{{route('nagadi-rasid-report','dainik_report')}}" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>दैनिक रिपोर्ट </p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{route('nagadi-rasid-report','mashik_report')}}" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>मासिक रिपोर्ट</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="pages/layout/top-nav-sidebar.html" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>तेरिज रिपोर्ट</p>
                        </a>
                      </li>
                    </ul>
                  </li>
             </ul>
         </nav>
         <!-- /.sidebar-menu -->
     </div>
     <!-- /.sidebar -->
 </aside>
