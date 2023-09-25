@php
$url_group = '';
if (Auth::user()->role_id == 5) {
$url_group = 'user';
}
@endphp


<div class="col-md-4 col-lg-4">
    <div class="left-section">
        <div class="col-12 profile-image">
            <img class="img-fluid"
                src="{{ (Auth::user()->user_more_info) ? asset('storage/'.Auth::user()->user_more_info->avatar) : asset('all/user/images/profile-icon-png-910.png') }}"
                alt="Profile Icon">
        </div>
        <div class="col-12 dashboard-item"><a href="{{route('user.dashboard')}}">Dashboard</a></div>
        <div class="col-12 dashboard-item"><a href="{{route('user.profile')}}">Profile</a></div>
        <div class="col-12 dashboard-item"><a href="{{route('user.transaction')}}">Transaction</a></div>
        <div class="col-12 dashboard-item"><a href="{{route('user.deposit')}}">Deposit</a></div>
        <div class="col-12 dashboard-item"><a href="{{route('user.withdraw')}}">Withdraw</a></div>
        <div class="col-12 dashboard-item"><a href="{{ route('logout') }}" onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">Logout</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </div>
</div>

<script>
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
    if (!event.target.matches('.dropbtn')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
        }
    }
}
</script>