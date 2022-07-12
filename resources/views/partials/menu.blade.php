<div class="navigation">
    <ul>
        <li>
            <a href="#">
                <span class="title">TODO</span>
            </a>
        </li>

        <li>
            <a href="{{ route('home')}}">
                <span class="icon">
                    <ion-icon name="home-outline"></ion-icon>
                </span>
                <span class="title">Dashboard</span>
            </a>
        </li>

        <li>
            <a href="{{ route('task.index') }}">
                <span class="icon">
                    <ion-icon name="list-circle-outline"></ion-icon>
                </span>
                <span class="title">Task</span>
            </a>
        </li>

        <li>
            <a href="{{ route('setting') }}">
                <span class="icon">
                    <ion-icon name="settings-outline"></ion-icon>
                </span>
                <span class="title">Settings</span>
            </a>
        </li>

        <li>
            <a href="{{ route('logout') }}"
            onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">
            <span class="icon">
                <ion-icon name="log-out-outline"></ion-icon>
            </span>
            <span class="title">Sign Out</span>
         </a>

         <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
             @csrf
         </form>
        </li>
    </ul>
</div>
