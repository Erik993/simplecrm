<div class="bg-dark text-white p-3 " style="width: 200px; position: fixed; top: 56px; left: 0; height: calc(100vh - 56px); z-index: 1000;">
    <h5 class="text-center text-white mb-4">{{ __('sidebar.menu') }}</h5>

    <ul class="nav flex-column">
        <li class="nav-item mb-3">
            <a class="nav-link text-white sidebar-link" href="#"> <i class="bi bi-house-door"></i> {{ __('sidebar.dashboard') }}</a>
        </li>
        <li class="nav-item mb-3">
            <a class="nav-link text-white sidebar-link" href="#"> <i class="bi bi-list-check"></i> {{ __('sidebar.todo') }}</a>
        </li>
        <li class="nav-item mb-3">
            <a class="nav-link text-white sidebar-link" href="#"> <i class="bi bi-people"></i> {{ __('sidebar.my_clients') }}</a>
        </li>
        <li class="nav-item mb-3">
            <a class="nav-link text-white sidebar-link" href="#"> <i class="bi bi-box-seam"></i> {{ __('sidebar.my_orders') }}</a>
        </li>
        <li class="nav-item mb-3">
            <a class="nav-link text-white sidebar-link" href="{{route('notes.index')}}"><i class="bi bi-clipboard"></i> {{ __('sidebar.my_notes') }}</a>
        </li>

        <li class="nav-item mb-3">
            <a href="{{ route('notify.heads') }}"
               class="btn btn-outline-info w-100 text-start">
                <i class="bi bi-envelope-paper"></i> Notify Heads
            </a>
        </li>

    </ul>
</div>
