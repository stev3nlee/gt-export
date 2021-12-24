
    <!-- Left side column. contains the sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- Sidebar user panel -->

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu tree" data-widget="tree">
          <li class="header"></li>


          <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/dashboard') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>

              <li class="treeview">
                <a href="#">
                  <i class="fa fa-building"></i>
                  <span>Website</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu" >
                  <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/banner') }}"><i class="fa fa-image"></i> <span>Home Banner</span></a></li>
                  <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/about') }}"><i class="fa fa-info-circle"></i> <span>About</span></a></li>
                 <!--  <li class="treeview">
                    <a href="#">
                      <i class="fa fa-sitemap"></i>
                      <span>About Us</span>
                      <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                      </span>
                    </a>
                    <ul class="treeview-menu" >
                      
                      <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/our_value') }}"><i class="fa fa-info-circle"></i> <span>Our Value</span></a></li>
                    </ul>
                  </li> -->
                  <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/regulation') }}"><i class="fa fa-info"></i> <span>Regulation</span></a></li>
                  <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/company_data') }}"><i class="fa fa-phone"></i> <span>Company Data</span></a></li>
                  <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/privacy_policy') }}"><i class="fa fa-exclamation"></i> <span>Privacy Policy</span></a></li>
                  <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/terms') }}"><i class="fa fa-info-circle"></i> <span>Terms & Conditions</span></a></li>
                  <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/disclaimers') }}"><i class="fa fa-info-circle"></i> <span>Disclaimers</span></a></li>

                  <li class="treeview">
                    <a href="#">
                      <i class="fa fa-question-circle"></i>
                      <span>Procurement Flow</span>
                      <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                      </span>
                    </a>
                    <ul class="treeview-menu" >
                      <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/procurement_flow/title') }}"><i class="fa fa-reorder"></i> <span>Title</span></a></li>
                      <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/procurement_flow') }}"><i class="fa fa-info-circle"></i> <span>Procurement Flow</span></a></li>
                    </ul>
                  </li>
                  <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/payment') }}"><i class="fa fa-paypal"></i> <span>Payment</span></a></li>

                  <li class="treeview">
                    <a href="#">
                      <i class="fa fa-question-circle"></i>
                      <span>FAQ</span>
                      <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                      </span>
                    </a>
                    <ul class="treeview-menu" >
                      <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/faq_category') }}"><i class="fa fa-reorder"></i> <span>Category</span></a></li>
                      <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/faq') }}"><i class="fa fa-question"></i> <span>FAQ</span></a></li>
                    </ul>
                  </li>
                  <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/contact') }}"><i class="fa fa-envelope"></i> <span>Contact Us</span></a></li>
                </ul>
              </li>

              <li class="treeview">
                <a href="#">
                  <i class="fa fa-car"></i>
                  <span>Quote</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu" >
                  <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/member') }}"><i class="fa fa-users"></i> <span>Member</span></a></li>
                  <!-- <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/newsletter') }}"><i class="fa fa-newspaper-o"></i> <span>Newsletter</span></a></li> -->

                  <li class="treeview">
                    <a href="#">
                      <i class="fa fa-car"></i>
                      <span>Product</span>
                      <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                      </span>
                    </a>
                    <ul class="treeview-menu" >
                      <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/brand') }}"><i class="fa fa-bars"></i> <span>Brand</span></a></li>
                      <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/model') }}"><i class="fa fa-bars"></i> <span>Model</span></a></li>
                      <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/transmission') }}"><i class="fa fa-bars"></i> <span>Transmission</span></a></li>
                      <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/accessories') }}"><i class="fa fa-bars"></i> <span>Accessories</span></a></li>
                      <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/product') }}"><i class="fa fa-car"></i> <span>Cars</span></a></li>
                    </ul>
                  </li>
                  <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/reservation_time') }}"><i class="fa fa-clock-o"></i> <span>Reservation Time</span></a></li>
                  <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/country') }}"><i class="fa fa-truck"></i> <span>Country</span></a></li>
                  <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/port') }}"><i class="fa fa-truck"></i> <span>Port</span></a></li>
                  <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/quotation') }}"><i class="fa fa-shopping-cart"></i> <span>Quotation</span></a></li>
                  <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/invoice') }}"><i class="fa fa-file-pdf-o"></i> <span>Invoice</span></a></li>
                  <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/shipment_document') }}"><i class="fa fa-book"></i> <span>Shipment Document</span></a></li>

                </ul>
              </li>

              <li class="treeview">
                <a href="#">
                  <i class="fa fa-gear"></i>
                  <span>Settings</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu" >
                  <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/metadata') }}"><i class="fa fa-pencil"></i> <span>Metadata</span></a></li>
                  <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/change-password') }}"><i class="fa fa-lock"></i> <span>Change Password</span></a></li>
                </ul>
              </li>

        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>
