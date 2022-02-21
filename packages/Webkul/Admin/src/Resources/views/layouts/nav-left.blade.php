@php($menu = Menu::prepare())

<div class="navbar-left" v-bind:class="{'open': isMenuOpen}">
    <div class="menubar-bottom pill shadow-sm relative text-gray border-gray" @click="toggleMenu">
        <span class="mdi absolute right" v-bind:class="[isMenuOpen ? 'mdi-chevron-right' : 'mdi-chevron-left']"></span>
    </div>
    <div class="text-white p-1 flex lh-1" v-bind:class="[isMenuOpen ? 'fs-xxl row' : 'fs-xs column']">
        <div>Steve</div><div class="bold italic"><strong>CRM</strong></div>
    </div>
    <ul class="menubar flex column center">
        @foreach ($menu->items as $menuItem)
            <li
                class="menu-item p-5 {{ Menu::getActive($menuItem) }}"
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

                <a href="{{ $menuItem['url'] }}">
                    <i class="mdi fs-l sprite {{ $menuItem['icon-class'] }}"></i>
                    <span class="menu-label">{{ $menuItem['name'] }}</span>
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