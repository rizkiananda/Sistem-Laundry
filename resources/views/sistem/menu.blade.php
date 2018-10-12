    <!-- Left side column. contains the sidebar -->
    <aside class="main-sidebar" style="font-size: 18px">
      {{-- {!! include_action('App\Http\Controller\MenuController', 'sidebar') !!} --}}
      
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{asset('img/man.png')}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p style="white-space: normal;">{{auth::user()->username}}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div><br>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
          <li class="header">MENU</li>
          @if(\Request::is('/'))
          <li class="treeview active">
            <a href="{{url('/')}}">
              <i class="fas fa-tachometer-alt"></i> Dashboard
            </a>
          </li>
          @else
          <li class="treeview">
            <a href="{{url('/')}}">
              <i class="fas fa-tachometer-alt"></i> Dashboard
            </a>
          </li>
          @endif

          @if(!Request::is('/pelayanan'))
          <li class="treeview">
            <a href="{{url('/pelayanan')}}">
               <i class="fas fa-concierge-bell"></i> Pelayanan
            </a>
          </li>
          @else
          <li class="treeview active">
            <a href="{{url('/pelayanan')}}">
               <i class="fas fa-concierge-bell"></i> Pelayanan
            </a>
          </li>
         
          @endif


          @if(\Request::is('/daftarharga'))
          <li class="treeview active">
            <a href="{{url('/daftarharga')}}">
              <i class="far fa-list-alt"></i> <span> Daftar Harga</span>
            </a>
          </li>
          @else
          <li class="treeview">
            <a href="{{url('/daftarharga')}}">
              <i class="far fa-list-alt"></i> <span> Daftar Harga</span>
            </a>
          </li>
          @endif

          @if(\Request::is('/transaksi'))
          <li class="treeview active">
            <a href="{{url('/transaksi')}}">
             <i class="fa fa-edit"></i> <span> Transaksi</span>
            </a>
          </li>
          @else
          <li class="treeview">
            <a href="{{url('/transaksi')}}">
             <i class="fa fa-edit"></i> <span> Transaksi</span>
            </a>
          </li>
          @endif

          @if(\Request::is('/antrian'))
          <li class="treeview active">
            <a href="{{url('/antrian')}}">
             <i class="fas fa-cart-arrow-down"></i> <span> Antrian</span>
            </a>
          </li>
          @else
          <li class="treeview">
            <a href="{{url('/antrian')}}">
             <i class="fas fa-cart-arrow-down"></i> <span> Antrian</span>
            </a>
          </li>
          @endif

          @if(\Request::is('/laporan'))
          <li class="treeview active">
            <a href="{{url('/laporan')}}">
             <i class="fas fa-book"></i> <span> Laporan</span>
            </a>
          </li>
          @else
          <li class="treeview">
            <a href="{{url('/laporan')}}">
             <i class="fas fa-book"></i> <span> Laporan</span>
            </a>
          </li>
          @endif
        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>