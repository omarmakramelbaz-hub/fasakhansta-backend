@include('admin.layouts.header')
@if(\Request::route()->getName() != 'chooseType')
@include('admin.layouts.menu')
@endif
@include('admin.layouts.navbar')

@yield('content')

@include('admin.layouts.footer')

@if(Auth::guard('admin')->user()->can('setting-list'))
<script>
document.addEventListener('DOMContentLoaded', function () {
    const sidebarMenu = document.querySelector('.main-sidebar .nav-sidebar');
    if (!sidebarMenu || sidebarMenu.querySelector('[data-header-image-menu]')) {
        return;
    }

    const settingsLink = sidebarMenu.querySelector('a[href$="/admin/settings"]');
    const item = document.createElement('li');
    item.className = 'nav-item';
    item.setAttribute('data-header-image-menu', '1');

    item.innerHTML = `
        <a href="{{ url('/admin/header-image') }}"
           class="nav-link {{ request()->is('admin/header-image') ? 'active' : '' }}">
            <i class="fas fa-image nav-icon"></i>
            <p>تعديل صورة هيدر التطبيق</p>
        </a>
    `;

    if (settingsLink && settingsLink.closest('li.nav-item')) {
        settingsLink.closest('li.nav-item').insertAdjacentElement('afterend', item);
    } else {
        sidebarMenu.appendChild(item);
    }
});
</script>
@endif
