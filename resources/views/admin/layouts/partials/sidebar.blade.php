<aside class="sidebar">
    <div class="sidebar__top hidden-sm hidden-xs">
        <a href="/" title="Главная" class="logo"><img src="/admin/img/logo.svg" alt=""></a>
    </div>
    <div class="menu-wrapper">
        <ul class="menu">
            <li class="dropdown">
                <a href="javascript:;" title="Роли"><i class="icon-users"></i>Новости</a>
                <ul>
                    <li><a class="nav-link" href="{{ route('panel.feeds.index') }}">Список новостей</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="javascript:;" title="Роли"><i class="icon-users"></i>Запросы</a>
                <ul>
                    <li><a class="nav-link" href="{{ route('panel.requests.index') }}">Список запросов</a></li>
                </ul>
            </li>
        </ul>
    </div>
</aside>
