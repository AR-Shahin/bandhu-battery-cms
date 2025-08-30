<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ asset("admin/dist/img/AdminLTELogo.png") }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Admin Panel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset("admin/dist/img/user2-160x160.jpg") }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ auth()->user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Home
              </p>
            </a>
          </li>

          {{-- @php
              dd($permissions);
          @endphp --}}
          @if (in_array("simple-link",$permissions))
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Simple Link
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>
          @endif
          <li class="nav-item">
            <a href="/" class="nav-link" target="_blank">
                <i class="nav-icon fa fa-globe"></i>
                <p>
                    Website
                </p>
            </a>
        </li>
        <li class="nav-item menu--open">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-solid fa-store"></i>
              <p>
                Product
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{route('admin.category.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Category
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.sub-category.index')}}" class="nav-link">
                        <i class="nav-icon fa fa-solid fa-list"></i>
                        <p>
                            Sub Category
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.brand.index')}}" class="nav-link">
                        <i class="nav-icon fab fa-bandcamp"></i>
                        <p>
                            Brand
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.product.index')}}" class="nav-link">
                        <i class="nav-icon fab fa-product-hunt"></i>
                        <p>
                            Product
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.unit.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-weight-hanging"></i>
                        <p>
                            Unit
                        </p>
                    </a>
                </li>
            </ul>
          </li>
            <li class="nav-item">
                <a href="{{route('admin.services.index')}}" class="nav-link">
                    <i class=" nav-icon fa fa-solid fa-server"></i>
                    <p>
                        Service
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{route('admin.single-content.index')}}" class="nav-link">
                    <i class="nav-icon fas fa-seedling"></i>
                    <p>
                        Single Content
                    </p>
                </a>
            </li>

            <li class="nav-item menu--open">
                <a href="#" class="nav-link ">
                  <i class="nav-icon fas fa-photo-video"></i>
                  <p>
                    Media
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('admin.video-gallery.index')}}" class="nav-link">
                            <i class="nav-icon fab fa-youtube"></i>
                            <p>
                                Videos
                            </p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="{{route('admin.website.index')}}" class="nav-link">
                    <i class="nav-icon fas fa-tools"></i>
                    <p>
                        Settings
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('admin.contacts.index')}}" class="nav-link">
                    <i class="nav-icon fas fa-address-book"></i>

                    <p>
                        Contact
                    </p>
                </a>
            </li>
          @if (in_array("role-create",$permissions))
          <li class="nav-item menu--open">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-solid fa-user-lock"></i>
              <p>
                Security
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.roles.index') }}" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Role</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.permissions.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Permission</p>
                </a>
              </li>
            </ul>
          </li>
          @endif
          @if (in_array("admin-create",$permissions))
          <li class="nav-item menu--open">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Admin
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.admins.index') }}" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Admin</p>
                </a>
              </li>

            </ul>
          </li>
          @endif
          <li class="nav-item">
            <form action="{{ route("admin.logout") }}" method="POST">
                @csrf
                <button class="nav-link btn btn-sm btn-success text-light">Logout</button>
            </form>

          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
