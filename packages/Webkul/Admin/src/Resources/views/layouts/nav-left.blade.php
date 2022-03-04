@php($menu = Menu::prepare())

<div class="navbar-left" v-bind:class="{'open': isMenuOpen}">
    <div class="menubar-bottom pill shadow-sm relative text-gray border-gray btn-circle btn-sm fs-18 z-2" @click="toggleMenu">
        <span class="mdi" v-bind:class="[isMenuOpen ? 'mdi-chevron-right' : 'mdi-chevron-left']"></span>
    </div>
    <div class="d-flex fs-xxl lh-1 px-3 py-2 text-white" v-bind:class="[isMenuOpen ? 'fs-xxl flex-row' : 'fs-xs flex-column']">
        <div>Steve</div><div class="bold italic"><strong>CRM</strong></div>
    </div>
    <ul class="menubar flex column center p-0">
        @foreach ($menu->items as $menuItem)
            <li
                class="menu-item {{ Menu::getActive($menuItem) }}"
                title="{{ $menuItem['name'] }}"
                @if (! count($menuItem['children'])
                    && $menuItem['key'] != 'configuration'
                )
                    v-tooltip.right="{
                        content: '{{ $menuItem['name'] }}',
                        classes: [isMenuOpen ? 'hide' : 'show']
                    }"
                @endif
            >

                <a href="{{ $menuItem['url'] }}" class="align-items-center d-flex flex-row">
                    <i class="mdi mdi-24px mx-1 my-2 d-flex {{ $menuItem['icon-class'] }}"></i>
                    <span class="menu-label m-0">{{ $menuItem['name'] }}</span>
                </a>

                @if ($menuItem['key'] != 'configuration')
                    @if ($menuItem['key'] != 'settings' && count($menuItem['children']))
                        <ul class="sub-menubar">
                            @foreach ($menuItem['children'] as $subMenuItem)
                                <li class="sub-menu-item {{ Menu::getActive($subMenuItem) }}">
                                    <a href="{{ count($subMenuItem['children']) ? current($subMenuItem['children'])['url'] : $subMenuItem['url'] }}">
                                        <span class="menu-label">{{ $subMenuItem['name'] }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                @else
                    <ul class="sub-menubar">
                        @foreach (app('core_config')->items as $key => $item)
                            <li class="sub-menu-item {{ $item['key'] == request()->route('slug') ? 'active' : '' }}">
                                <a href="{{ route('admin.configuration.index', $item['key']) }}">
                                    {{ isset($item['name']) ? trans($item['name']) : '' }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </li>
        @endforeach
    </ul>

    
</div>