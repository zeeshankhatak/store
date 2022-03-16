<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
          <a href="{{ url('/') }}" class="logo">
        </a>
      <!-- Sidebar user panel -->
      <div class="user-panel">
        
       
      </div>
 

        <ul class="sidebar-menu" data-widget="tree">

          <li class="{{ Route::is('items.index') ? 'active' : '' }}"><a href="{{route('items.index')}}"><i class="fa fa-cart-plus" aria-hidden="true"></i><span>Items</span></a></li>

         {{-- <li class="{{ Route::is('store') ? 'active' : '' }}"><a href="{{route('store')}}"><i class="fa fa-credit-card" aria-hidden="true"></i><span>Store</span></a></li>
         
         <li class="{{ Route::is('attributes') ? 'active' : '' }}"><a href="{{route('attributes')}}"><i class="fa fa-money" aria-hidden="true"></i><span>Attributes</span></a></li> --}}

          <li class="{{ Route::is('categories') ? 'active' : '' }}"><a href="{{route('categories')}}"><i class="fa fa-money" aria-hidden="true"></i><span>Categories</span></a></li>

         <li class="{{ Route::is('sub_categories') ? 'active' : '' }}"><a href="{{route('sub_categories')}}"><i class="fa fa-money" aria-hidden="true"></i><span>Sub Categories</span></a></li>

         <li class="{{ Route::is('countries') ? 'active' : '' }}"><a href="{{route('countries')}}"><i class="fa fa-money" aria-hidden="true"></i><span>Countries</span></a></li>
         <li class="{{ Route::is('areas') ? 'active' : '' }}"><a href="{{route('areas')}}"><i class="fa fa-money" aria-hidden="true"></i><span>Areas</span></a></li>
         {{--<li class="{{ Route::is('attributes') ? 'active' : '' }}"><a href="{{route('attributes')}}"><i class="fa fa-money" aria-hidden="true"></i><span>Inner in Sub Categories</span></a></li>

         <li class="{{ Route::is('attributes') ? 'active' : '' }}"><a href="{{route('attributes')}}"><i class="fa fa-money" aria-hidden="true"></i><span>Area</span></a></li>
         <li class="{{ Route::is('attributes') ? 'active' : '' }}"><a href="{{route('attributes')}}"><i class="fa fa-money" aria-hidden="true"></i><span>City</span></a></li>
         <li class="{{ Route::is('attributes') ? 'active' : '' }}"><a href="{{route('attributes')}}"><i class="fa fa-money" aria-hidden="true"></i><span>Country</span></a></li> --}}



        

        </ul>


    </section>
    <!-- /.sidebar -->
</aside>
