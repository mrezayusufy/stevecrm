<div class="navbar-top flex center space-between">
    <div class="navbar-top-left h-auto w-auto flex center">
        <div class="brand-logo flex">
            <a href="{{ route('admin.dashboard.index') }}" class="fs-xl">
                Steve<strong><i>CRM</i></strong>
            </a>
        </div>
        <div class="fs-xxl p-1 bold" style="--l:20px;">@yield('title')</div>
    </div>

    <div class="navbar-top-right w-auto flex center">
        @yield('navbar-top')

        @if (bouncer()->hasPermission('leads.create')
            || bouncer()->hasPermission('quotes.create')
            || bouncer()->hasPermission('mail.create')
            || bouncer()->hasPermission('contacts.persons.create')
            || bouncer()->hasPermission('contacts.organizations.create')
            || bouncer()->hasPermission('products.create')
            || bouncer()->hasPermission('settings.automation.attributes.create')
            || bouncer()->hasPermission('settings.user.roles.create')
            || bouncer()->hasPermission('settings.user.users.create')
        )
            <div class="quick-create flex center">
                <span class="bg-primary pill p-1 square lh-1 button dropdown-toggle" style="--w: 35px;">
                    <i class="mdi mdi-plus fs-18" style="--m: 5px;"></i>
                </span>

                <div class="dropdown-list bottom-right">

                    <div class="quick-link-container">
                        @if (bouncer()->hasPermission('leads.create'))
                            <div class="quick-link-item">
                                <a href="{{ route('admin.leads.create') }}">
                                    <i class="icon lead-icon"></i>
                                    <span>{{ __('admin::app.layouts.lead') }}</span>
                                </a>
                            </div>
                        @endif

                        @if (bouncer()->hasPermission('quotes.create'))
                            <div class="quick-link-item">
                                <a href="{{ route('admin.quotes.create') }}">
                                    <i class="icon quotation-icon"></i>

                                    <span>{{ __('admin::app.layouts.quote') }}</span>
                                </a>
                            </div>
                        @endif

                        @if (bouncer()->hasPermission('mail.create'))
                            <div class="quick-link-item">
                                <a href="{{ route('admin.mail.index', ['route' => 'compose']) }}">
                                    <i class="icon mail-icon"></i>

                                    <span>{{ __('admin::app.layouts.email') }}</span>
                                </a>
                            </div>
                        @endif

                        @if (bouncer()->hasPermission('contacts.persons.create'))
                            <div class="quick-link-item">
                                <a href="{{ route('admin.contacts.persons.create') }}">
                                    <i class="icon person-icon"></i>

                                    <span>{{ __('admin::app.layouts.person') }}</span>
                                </a>
                            </div>
                        @endif

                        @if (bouncer()->hasPermission('contacts.organizations.create'))
                            <div class="quick-link-item">
                                <a href="{{ route('admin.contacts.organizations.create') }}">
                                    <i class="icon organization-icon"></i>

                                    <span>{{ __('admin::app.layouts.organization') }}</span>
                                </a>
                            </div>
                        @endif

                        @if (bouncer()->hasPermission('products.create'))
                            <div class="quick-link-item">
                                <a href="{{ route('admin.products.create') }}">
                                    <i class="icon product-icon"></i>

                                    <span>{{ __('admin::app.layouts.product') }}</span>
                                </a>
                            </div>
                        @endif

                        @if (bouncer()->hasPermission('settings.automation.attributes.create'))
                            <div class="quick-link-item">
                                <a href="{{ route('admin.settings.attributes.create') }}">
                                    <i class="icon attribute-icon"></i>

                                    <span>{{ __('admin::app.layouts.attribute') }}</span>
                                </a>
                            </div>
                        @endif

                        @if (bouncer()->hasPermission('settings.user.roles.create'))
                            <div class="quick-link-item">
                                <a href="{{ route('admin.settings.roles.create') }}">
                                    <i class="icon role-icon"></i>

                                    <span>{{ __('admin::app.layouts.role') }}</span>
                                </a>
                            </div>
                        @endif

                        @if (bouncer()->hasPermission('settings.user.users.create'))
                            <div class="quick-link-item">
                                <a href="{{ route('admin.settings.users.create') }}">
                                    <i class="icon user-icon"></i>

                                    <span>{{ __('admin::app.layouts.user') }}</span>
                                </a>
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        @endif

        <div class="profile-info">
            <div class="dropdown-toggle">
                @if (auth()->guard('user')->user()->image)
                    <div class="avatar">
                        <img src="{{ auth()->guard('user')->user()->image_url }}"/>
                    </div>
                @else
                    <div class="avatar">
                        <span class="icon avatar-icon"></span>
                    </div>
                @endif

                <div class="info">
                    <span class="howdy">{{ __('admin::app.layouts.howdy') }}</span>
                    <span class="user">{{ strtok(auth()->guard('user')->user()->name, ' ') }}</span>
                </div>

                <i class="icon ellipsis-icon"></i>
            </div>

            <div class="dropdown-list bottom-right">
                <span class="app-version">{{ __('admin::app.layouts.app-version', ['version' => 'v' . config('app.version')]) }}</span>
                <span class="mdi mdi-plus text-primary fs-xl"></span>
                <div class="dropdown-container">
                    <ul>
                        <li>
                            <a class="l-primary" href="{{ route('admin.user.account.edit') }}">{{ __('admin::app.layouts.my-account') }}</a>
                        </li>
                        <li>
                            <a class="l-primary" href="{{ route('admin.session.destroy') }}">{{ __('admin::app.layouts.sign-out') }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
