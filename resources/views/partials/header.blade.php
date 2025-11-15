<!--nav open-->
<style>
    /* ==== Navbar Animation ==== */
    .main-navbar {
        animation: slideDownNav 0.4s ease-out;
        box-shadow: 0 2px 10px rgba(60, 59, 63, 0.1);
        transition: box-shadow 0.3s ease;
    }

    .main-navbar:hover {
        box-shadow: 0 4px 20px rgba(60, 59, 63, 0.15);
    }

    @keyframes slideDownNav {
        from {
            transform: translateY(-100%);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    /* Brand Logo Animation */
    .main-navbar .text-white {
        transition: all 0.3s ease;
        display: inline-block;
    }

    .main-navbar a:hover .text-white {
        transform: scale(1.05);
        text-shadow: 0 2px 10px rgba(255, 255, 255, 0.3);
    }

    /* ==== Custom Dropdown Styling ==== */
    .custom-dropdown {
        position: relative;
        display: inline-block;
    }

    .custom-dropdown-menu {
        display: none;
        position: absolute;
        right: 0;
        top: 100%;
        min-width: 200px;
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 8px 25px rgba(60, 59, 63, 0.15);
        z-index: 9999;
        opacity: 0;
        transform: translateY(-10px) scale(0.95);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .custom-dropdown-menu.show {
        display: block;
        animation: dropdownSlideIn 0.3s ease-out forwards;
    }

    @keyframes dropdownSlideIn {
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    @keyframes dropdownSlideOut {
        from {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
        to {
            opacity: 0;
            transform: translateY(-10px) scale(0.95);
        }
    }

    .custom-dropdown-menu a {
        color: #333;
        padding: 12px 15px;
        display: block;
        text-decoration: none;
        transition: all 0.2s ease;
        position: relative;
        border-radius: 4px;
        margin: 4px 8px;
    }

    .custom-dropdown-menu a::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        width: 3px;
        height: 100%;
        background: linear-gradient(135deg, #3C3B3F, #605C3C);
        transform: scaleY(0);
        transition: transform 0.2s ease;
        border-radius: 0 4px 4px 0;
    }

    .custom-dropdown-menu a:hover {
        background: linear-gradient(135deg, rgba(60, 59, 63, 0.08), rgba(96, 92, 60, 0.08));
        transform: translateX(5px);
        padding-left: 20px;
    }

    .custom-dropdown-menu a:hover::before {
        transform: scaleY(1);
    }

    .custom-dropdown-menu a i {
        transition: transform 0.2s ease;
    }

    .custom-dropdown-menu a:hover i {
        transform: rotate(-15deg) scale(1.1);
    }

    .custom-dropdown-header {
        border-bottom: 1px solid #eee;
        text-align: center;
        padding: 15px 0;
        animation: fadeIn 0.3s ease-out 0.1s both;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    /* Profile Toggle Button Animation */
    #profileToggle {
        transition: all 0.3s ease;
        border-radius: 8px;
        padding: 8px 12px;
        cursor: pointer;
    }

    #profileToggle:hover {
        background: rgba(255, 255, 255, 0.1);
        transform: translateY(-2px);
    }

    #profileToggle i {
        transition: all 0.3s ease;
    }

    #profileToggle:hover i {
        transform: rotate(90deg) scale(1.1);
        color: rgba(255, 255, 255, 0.9);
    }

    /* Navbar Links Animation */
    .nav-link {
        transition: all 0.3s ease;
    }

    .nav-link.toggle {
        transition: all 0.3s ease;
        border-radius: 6px;
        padding: 8px;
    }

    .nav-link.toggle:hover {
        background: rgba(255, 255, 255, 0.1);
        transform: scale(1.1);
    }

    /* Text Animation */
    .text-white {
        transition: all 0.3s ease;
    }

    /* Icon Styling */
    .nav-link i {
        font-size: 8px;
        margin-right: 8px;
        vertical-align: middle;
        transition: all 0.3s ease;
    }

    /* Smooth Scrollbar for dropdown if needed */
    .custom-dropdown-menu::-webkit-scrollbar {
        width: 6px;
    }

    .custom-dropdown-menu::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }

    .custom-dropdown-menu::-webkit-scrollbar-thumb {
        background: linear-gradient(135deg, #3C3B3F, #605C3C);
        border-radius: 10px;
    }

    .custom-dropdown-menu::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(135deg, #605C3C, #3C3B3F);
    }

    /* ==== Layout Improvements ==== */
    /* Navbar Container */
    .main-navbar {
        padding: 12px 25px;
        background: linear-gradient(135deg, #3C3B3F, #605C3C);
        min-height: 70px;
        display: flex;
        align-items: center;
    }

    /* Brand Section */
    .main-navbar .header-brand,
    .main-navbar > a[href*="dashboard"] {
        display: flex;
        align-items: center;
        padding: 8px 15px;
        border-radius: 10px;
        transition: all 0.3s ease;
        margin-right: 20px;
    }

    .main-navbar .header-brand:hover,
    .main-navbar > a[href*="dashboard"]:hover {
        background: rgba(255, 255, 255, 0.1);
    }

    .main-navbar .text-white {
        font-size: 1.75rem;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    /* Toggle Button */
    .nav-link.toggle {
        width: 45px;
        height: 45px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
        border-radius: 10px;
        background: rgba(255, 255, 255, 0.1);
    }

    .nav-link.toggle::before {
        content: '☰';
        font-size: 20px;
        color: #fff;
    }

    /* Search Section */
    .form-inline {
        flex: 1;
        display: flex;
        align-items: center;
    }

    .search-element {
        max-width: 300px;
    }

    /* Profile Section */
    .navbar-right {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    #profileToggle {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 18px;
        border-radius: 12px;
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    #profileToggle .text-white {
        font-size: 16px;
        font-weight: 600;
        letter-spacing: 0.5px;
    }

    #profileToggle i {
        font-size: 18px;
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(255, 255, 255, 0.15);
        border-radius: 8px;
    }

    /* Dropdown Menu Layout */
    .custom-dropdown-menu {
        margin-top: 10px;
        padding: 8px 0;
        min-width: 220px;
    }

    .custom-dropdown-header {
        padding: 18px 20px;
        background: linear-gradient(135deg, rgba(60, 59, 63, 0.05), rgba(96, 92, 60, 0.05));
        border-bottom: 2px solid rgba(60, 59, 63, 0.1);
    }

    .custom-dropdown-header h5 {
        font-size: 16px;
        font-weight: 600;
        margin: 0;
        color: #3C3B3F;
    }

    .custom-dropdown-menu a {
        padding: 14px 20px;
        margin: 4px 10px;
        display: flex;
        align-items: center;
        font-size: 14px;
        font-weight: 500;
    }

    .custom-dropdown-menu a i {
        font-size: 18px;
        width: 25px;
        margin-right: 12px;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .main-navbar {
            padding: 10px 15px;
        }

        .main-navbar .text-white {
            font-size: 1.5rem;
        }

        #profileToggle .text-white {
            display: none !important;
        }

        #profileToggle {
            padding: 10px;
        }
    }
</style>

@if (Auth::guard('admin')->check())
    {
    <nav class="navbar navbar-expand-lg main-navbar">
        <a href="#" data-toggle="sidebar" class="nav-link nav-link toggle app-sidebar__toggle">
        </a>
        <a class="d-flex align-items-center" href="{{ route('admin.dashboard') }}">
            <span class="text-white font-weight-bold ml-2">Taleemkhan</span>
        </a>

       <form class="form-inline mr-auto">
            <ul class="navbar-nav mr-2">

            </ul>
        </form>
        <ul class="navbar-nav navbar-right">
            <li class="custom-dropdown">
                <a href="#" class="nav-link nav-link-lg" id="profileToggle">
                    <span class="mr-2 d-none d-lg-block text-white">Admin</span>
                    <i class="fa fa-cog"></i>
                </a>

                <div class="custom-dropdown-menu" id="customDropdown">
                    <div class="custom-dropdown-header">
                        <h5 class="text-capitalize text-dark mb-0">{{ Auth::user()->name }}</h5>
                        <small class="text-muted" style="font-size: 12px;">Administrator</small>
                    </div>

                    <a href="{{ route('admin.logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="mdi mdi-logout-variant"></i> Logout
                    </a>

                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST"
                        style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
    </nav>
    }
@elseif (Auth::guard('school')->check())
    {
    <nav class="navbar navbar-expand-lg main-navbar">
        <a href="#" data-toggle="sidebar" class="nav-link nav-link toggle app-sidebar__toggle">
        </a>
        <a class="header-brand d-flex align-items-center" href="{{ route('school.dashboard') }}">
            <span class="text-white font-weight-bold ml-2">Taleemkhan</span>
        </a>
        <form class="form-inline mr-auto">
            <ul class="navbar-nav mr-2">

            </ul>
        </form>
        <ul class="navbar-nav navbar-right">
            <li class="custom-dropdown">
                <a href="#" class="nav-link nav-link-lg" id="profileToggle">
                    <span class="mr-2 d-none d-lg-block text-white">School Admin</span>
                    <i class="fa fa-cog"></i>
                </a>

                <div class="custom-dropdown-menu" id="customDropdown">
                    <div class="custom-dropdown-header">
                        <h5 class="text-capitalize text-dark mb-0">{{ Auth::user()->school_name }}</h5>
                        <small class="text-muted" style="font-size: 12px;">School Administrator</small>
                    </div>

                    <a href="{{ route('school.logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="mdi mdi-logout-variant"></i> Logout
                    </a>

                    <form id="logout-form" action="{{ route('school.logout') }}" method="POST"
                        style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
    </nav>
    }
@endif

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const profileToggle = document.getElementById('profileToggle');
    const customDropdown = document.getElementById('customDropdown');
    let isAnimating = false;

    if (profileToggle && customDropdown) {

        // Handle profile toggle click
        profileToggle.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation(); // stop the click from reaching the document

            if (isAnimating) return;

            isAnimating = true;

            if (customDropdown.classList.contains('show')) {
                // Close dropdown
                closeDropdown();
            } else {
                openDropdown();
            }
        });

        // Open dropdown function
        function openDropdown() {
            customDropdown.classList.add('show');
            customDropdown.style.animation = 'dropdownSlideIn 0.3s ease-out forwards';
            setTimeout(() => {
                isAnimating = false;
            }, 300);
        }

        // Close dropdown function
        function closeDropdown() {
            customDropdown.style.animation = 'dropdownSlideOut 0.2s ease-out forwards';
            setTimeout(() => {
                customDropdown.classList.remove('show');
                isAnimating = false;
            }, 200);
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            // Ignore clicks inside the dropdown or on toggle
            if (profileToggle.contains(e.target) || customDropdown.contains(e.target)) return;

            if (customDropdown.classList.contains('show') && !isAnimating) {
                closeDropdown();
            }
        });

        //  Close dropdown with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && customDropdown.classList.contains('show')) {
                closeDropdown();
            }
        });
    }
});
</script>
@endpush

<!--nav closed-->
