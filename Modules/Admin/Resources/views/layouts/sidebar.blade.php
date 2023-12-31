<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
        <img src="{{ asset('frontend/images/android-chrome-192x192.png') }}"
            alt="{{ \App\Helpers\AdminHelper::getValueByKey('website_name') }}" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">{{ \App\Helpers\AdminHelper::getValueByKey('website_name') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ Nav::isRoute('dashboard') }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-header">PRODUCT MANAGEMENT</li>
                <li
                    class="nav-item {{ Nav::isResource('product-main-category', '', 'menu-open') }} {{ Nav::isResource('product-sub-category', '', 'menu-open') }} {{ Nav::isRoute(['product.index', 'product.create', 'product.edit'], 'menu-open') }}">
                    <a href="#"
                        class="nav-link {{ Nav::isResource('product-main-category') }} {{ Nav::isResource('product-sub-category') }} {{ Nav::isResource('flower-type') }} {{ Nav::isResource('delivery-location') }} {{ Nav::isRoute(['product.index', 'product.create', 'product.edit'], '', 'menu-open') }}">
                        <i class="nav-icon fab fa-product-hunt"></i>
                        <p>
                            Products
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('product.index') }}"
                                class="nav-link {{ Nav::isRoute(['product.index', 'product.create', 'product.edit']) }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Product</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('product-main-category.index') }}"
                                class="nav-link {{ Nav::isResource('product-main-category') }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Main Category</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('product-sub-category.index') }}"
                                class="nav-link {{ Nav::isResource('product-sub-category') }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Sub Category</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-header">Quotation Management</li>
                <li class="nav-item">
                    <a href="{{ route('quotation-management.index') }}"
                        class="notification nav-link {{ Nav::isRoute('quotation-management.index') }}">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        Quotation Management
                        @if ($pendingQuotationApprovalCount > 0)
                            <span class="badge">{{ $pendingQuotationApprovalCount }}</span>
                        @endif
                    </a>
                </li>
                <li class="nav-header">Order Management</li>
                <li class="nav-item">
                    <a href="{{ route('order.index') }}"
                        class="nav-link notification {{ Nav::isRoute('order.index') }}  {{ Nav::isRoute('order.details') }}">
                        <i class="nav-icon fab fa-first-order-alt"></i>
                        <p>
                            Order
                            @if ($pendingOrderActionCount > 0)
                                <span class="badge">{{ $pendingOrderActionCount }}</span>
                            @endif
                        </p>
                    </a>
                </li>
                <li class="nav-header">Report Management</li>
                <li class="nav-item">
                    <a href="{{ route('report.index') }}" class="nav-link {{ Nav::isRoute('report.index') }}">
                        <i class="nav-icon fas fa-file-excel"></i>
                        <p>
                            Reports
                        </p>
                    </a>
                </li>
                <li class="nav-header">User Management</li>
                <li class="nav-item">
                    <a href="{{ route('user-management.index') }}"
                        class="nav-link notification {{ Nav::isRoute('user-management.index') }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            User Management
                            @if ($pendingUserActionCount > 0)
                                <span class="badge">{{ $pendingUserActionCount }}</span>
                            @endif
                        </p>
                    </a>
                </li>
                <li class="nav-header">CMS</li>
                <li
                    class="nav-item {{ Nav::isRoute(['home-banner.index', 'home-banner.create', 'home-banner.edit', 'about-us.edit', 'why-choose.edit', 'how-to-buy.edit', 'contact.edit', 'privacy-policy.edit', 'terms-and-conditions.edit', 'site-common-cms.edit', 'auth-page-management.edit', 'contact-enquiry-listing.index', 'contact-enquiry-listing.show'], 'menu-open') }}">
                    <a href="#"
                        class="nav-link {{ Nav::isRoute(['about-us.edit', 'why-choose.edit', 'how-to-buy.edit', 'contact.edit', 'privacy-policy.edit', 'terms-and-conditions.edit', 'site-common-cms.edit', 'auth-page-management.edit']) }}  {{ Nav::isResource('home-banner') }} {{ Nav::isResource('contact-enquiry-listing') }}">
                        <i class="nav-icon fa fa-info"></i>
                        <p>
                            Cms
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('about-us.edit') }}"
                                class="nav-link {{ Nav::isRoute('about-us.edit') }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>About Us</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('home-banner.index') }}"
                                class="nav-link {{ Nav::isResource('home-banner') }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Home Banner</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('why-choose.edit') }}"
                                class="nav-link {{ Nav::isRoute('why-choose.edit') }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Why Choose Cms</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('how-to-buy.edit') }}"
                                class="nav-link {{ Nav::isRoute('how-to-buy.edit') }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>How To Buy Cms</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('contact.edit') }}" class="nav-link {{ Nav::isRoute('contact.edit') }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Contact</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('contact-enquiry-listing.index') }}"
                                class="nav-link {{ Nav::isResource('contact-enquiry-listing') }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Contact Enquiry Listing</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('privacy-policy.edit') }}"
                                class="nav-link {{ Nav::isRoute('privacy-policy.edit') }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Privacy Policy</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('terms-and-conditions.edit') }}"
                                class="nav-link {{ Nav::isRoute('terms-and-conditions.edit') }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Terms & Conditions</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('auth-page-management.edit', 'login-page') }}"
                               class="nav-link {{ request()->is('al-masar-admin-auth/auth-page-management/login-page*') ? ' active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Login Page CMS</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('auth-page-management.edit', 'register-page') }}"
                               class="nav-link {{ request()->is('al-masar-admin-auth/auth-page-management/register-page*') ? ' active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Register Page CMS</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('auth-page-management.edit', 'otp-page') }}"
                               class="nav-link {{ request()->is('al-masar-admin-auth/auth-page-management/otp-page*') ? ' active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>OTP Page CMS</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('site-common-cms.edit') }}"
                                class="nav-link {{ Nav::isRoute('site-common-cms.edit') }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Site Common Cms</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-header">General Settings</li>
                <li class="nav-item">
                    <a href="#"
                        class="nav-link  {{ Nav::isRoute('config.index') }} {{ Nav::isRoute('config.edit') }} {{ Nav::isResource('country') }} {{ Nav::isResource('currency') }} {{ Nav::isRoute('payment.index') }} {{ Nav::isRoute('payment.create') }} {{ Nav::isRoute('payment.edit') }} {{ Nav::isResource('provider') }} {{ Nav::isRoute('site-settings.edit') }}">
                        <i class="nav-icon fab fa-product-hunt"></i>
                        <p>
                            General Settings
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('config.index') }}"
                                class="nav-link {{ Nav::isRoute('config.index') }} {{ Nav::isRoute('config.edit') }}">
                                <i class="nav-icon fa-circle far"></i>
                                <p>
                                    Admin Config
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('country.index') }}"
                                class="nav-link {{ Nav::isResource('country') }}">
                                <i class="nav-icon fa-circle far"></i>
                                <p>
                                    Country
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('vendor.index') }}" class="nav-link {{ Nav::isResource('vendor') }}">
                                <i class="nav-icon fa-circle far"></i>
                                <p>
                                    Vendor
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('currency.index') }}"
                                class="nav-link {{ Nav::isResource('currency') }}">
                                <i class="nav-icon fa-circle far"></i>
                                <p>
                                    Currency
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('payment.index') }}"
                                class="nav-link {{ Nav::isResource('payment') }}">
                                <i class="nav-icon fa-circle far"></i>
                                <p>
                                    Payment
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('provider.index') }}"
                                class="nav-link {{ Nav::isResource('provider') }}">
                                <i class="nav-icon fa-circle far"></i>
                                <p>
                                    Provider
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('site-settings.edit') }}"
                                class="nav-link {{ Nav::isRoute('site-settings') }}">
                                <i class="nav-icon fa-circle far"></i>
                                <p>
                                    Site Settings
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- <li class="nav-item">
                    <a href="{{ route('payment-methods.index') }}"
                       class="nav-link {{ Nav::isResource('payment-methods') }}">
                        <i class="nav-icon fas fa-money-check-alt"></i>
                        <p>Payment Methods</p>
                    </a>
                </li> --}}
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
