<style>
    /* Sidebar Scrollbar */
    .side-menu {
        max-height: 70vh !important;
        overflow-y: auto;
        -ms-overflow-style: none;
        scrollbar-width: none;
    }

    .side-menu::-webkit-scrollbar {
        display: none;
    }

    /* Sidebar Animation */
    .app-sidebar {
        animation: slideInLeft 0.3s ease-out;
        max-height: 950vh !important;
        overflow-y: auto;
        padding: 0;
        background: #fff;
        border-right: 1px solid rgba(60, 59, 63, 0.1);
    }

    @keyframes slideInLeft {
        from {
            transform: translateX(-100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

.app-sidebar__user {
    position: relative;
    overflow: hidden;
    border-radius: 0 0 20px 20px;
    background: linear-gradient(135deg, #3C3B3F 0%, #605C3C 100%);
    padding: 10px 15px !important;
    margin-bottom: 5px;
    box-shadow: 0 4px 20px rgba(60, 59, 63, 0.3);
}



/* User Info Text - Complete Redesign */
.user-info {
    margin-top: 15px !important;
    padding-top: 15px !important;
    border-top: 1px solid rgba(255, 255, 255, 0.2);
    position: relative;
    z-index: 2;
}

.user-info h6 {
    font-size: 16px !important;
    font-weight: 700;
    margin: 0;
    color: #fff !important;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
    letter-spacing: 0.5px;
    transition: all 0.3s ease;
    position: relative;
    display: inline-block;
}

.user-info h6::after {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 0;
    width: 0;
    height: 2px;
    background: linear-gradient(90deg, transparent, #fff, transparent);
    transition: width 0.3s ease;
}

.user-info:hover h6::after {
    width: 100%;
}

.user-info .text-muted {
    font-size: 12px !important;
    color: rgba(255, 255, 255, 0.8) !important;
    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
    font-weight: 500;
    margin-top: 4px;
    display: block;
}



/* Dynamic Menu Items Animation for ALL items */
.side-menu li {
    animation: fadeInLeft 0.4s ease-out both;
    margin-bottom: 4px;
}

/* Dynamic animation delay for all menu items */
.side-menu li {
    animation-delay: calc(var(--item-index, 0) * 0.05s + 0.1s);
}

/* JavaScript will set --item-index for each li */
@keyframes fadeInLeft {
    from {
        transform: translateX(-25px);
        opacity: 0;
        filter: blur(5px);
    }
    to {
        transform: translateX(0);
        opacity: 1;
        filter: blur(0);
    }
}

/* Nav Link Container Enhancement */
.app-sidebar__user .nav-link {
    position: relative;
    padding: 10px !important;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
}

    /* Menu Item Hover Effects */
    .side-menu__item {
        position: relative;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border-radius: 8px;
        margin: 2px 8px !important;
        padding: 10px 15px !important;
        overflow: hidden;
        display: flex;
        align-items: center;
        text-decoration: none;
        color: #495057;
        font-weight: 500;
        font-size: 13px;
    }

    .side-menu__item::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        width: 3px;
        height: 100%;
        background: linear-gradient(135deg, #3C3B3F, #605C3C);
        transform: scaleY(0);
        transition: transform 0.3s ease;
    }

    .side-menu__item:hover {
        transform: translateX(3px);
        background: linear-gradient(135deg, rgba(60, 59, 63, 0.08), rgba(96, 92, 60, 0.08));
    }

    .side-menu__item:hover::before {
        transform: scaleY(1);
    }

    .side-menu__item.active {
        background: linear-gradient(135deg, rgba(60, 59, 63, 0.12), rgba(96, 92, 60, 0.12));
    }

    .side-menu__item.active::before {
        transform: scaleY(1);
    }

    /* Icon Animation */
    .side-menu__icon {
        transition: all 0.3s ease;
        display: inline-block;
        width: 30px !important;
        height: 30px !important;
        display: flex !important;
        align-items: center;
        justify-content: center;
        margin-right: 10px !important;
        font-size: 14px !important;
        border-radius: 6px;
        background: rgba(60, 59, 63, 0.05);
    }

    .side-menu__item:hover .side-menu__icon {
        transform: scale(1.1);
        color: #3C3B3F;
        background: linear-gradient(135deg, rgba(60, 59, 63, 0.12), rgba(96, 92, 60, 0.12));
    }

    .side-menu__item.active .side-menu__icon {
        background: linear-gradient(135deg, rgba(60, 59, 63, 0.15), rgba(96, 92, 60, 0.15));
    }

    .side-menu__label {
        flex: 1;
        line-height: 1.4;
    }

    /* Slide Menu Animation */
    .slide-menu {
        animation: slideDown 0.3s ease-out;
        padding: 5px 0 !important;
        margin: 5px 0 5px 15px !important;
        border-left: 2px solid rgba(60, 59, 63, 0.1);
        padding-left: 12px !important;
    }

    @keyframes slideDown {
        from {
            max-height: 0;
            opacity: 0;
        }
        to {
            max-height: 500px;
            opacity: 1;
        }
    }

    .slide-item {
        transition: all 0.2s ease;
        padding: 8px 12px !important;
        margin: 2px 0 !important;
        position: relative;
        display: block;
        color: #6c757d;
        font-size: 12px;
        border-radius: 5px;
        text-decoration: none;
    }

    .slide-item::before {
        content: '→';
        position: absolute;
        left: 5px;
        opacity: 0;
        transition: all 0.2s ease;
        color: #3C3B3F;
        font-size: 10px;
    }

    .slide-item:hover {
        transform: translateX(3px);
        padding-left: 20px !important;
        background: rgba(60, 59, 63, 0.05);
    }

    .slide-item:hover::before {
        opacity: 1;
        left: 8px;
    }

    /* User Info Text Animation */
    .user-info h6 {
        transition: all 0.3s ease;
    }

    .app-sidebar__user:hover .user-info h6 {
        color: #3C3B3F;
        transform: scale(1.02);
    }

    /* Menu Container */
    .side-menu {
        padding: 8px 0 !important;
        margin: 0;
        list-style: none;
    }

    /* Divider */
    /* .side-menu::before {
        content: '';
        display: block;
        height: 1px;
        background: linear-gradient(90deg, transparent, rgba(60, 59, 63, 0.15), transparent);
        margin: 8px 15px;
    } */

    /* Nav Link Adjustments */
    .app-sidebar__user .nav-link {
        position: relative;
        padding: 8px !important;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    /* Active state for slide menu parent */
    .side-menu__item.active[data-toggle="slide"] .side-menu__icon {
        transform: rotate(90deg);
        background: linear-gradient(135deg, rgba(60, 59, 63, 0.15), rgba(96, 92, 60, 0.15));
    }
</style>
  @if (Auth::guard('admin')->check())
      {
      <aside class="app-sidebar">
          <div class="app-sidebar__user">
              <div class="dropdown user-pro-body text-center">
                  <div class="nav-link pl-1 pr-1 leading-none position-relative">
                      <img src="{{ asset('assets/img/taleemkhan-logo.png') }}" alt="user-img"
                          class="avatar-xl rounded-circle mb-1">
                      <span class="pulse bg-success position-absolute" aria-hidden="true"></span>
                  </div>
                  <div class="user-info">
                      <h6 class="mb-0 text-dark text-capitalize">{{ Auth::user()->name }}</h6>
                      <small class="text-muted d-block mt-1" style="font-size: 12px;">Administrator</small>
                  </div>
              </div>
          </div>

          <ul class="side-menu">
              <li>
                  <a class="side-menu__item" href="{{ route('admin.dashboard') }}"><i
                          class="side-menu__icon fa fa-laptop"></i><span class="side-menu__label">Dashboard</span>
                  </a>

              </li>
              <li>
                  <a class="side-menu__item" href="{{ route('schools.create') }}"><i
                          class="side-menu__icon fa fa-plus-square"></i><span class="side-menu__label">Add
                          School</span></a>
              </li>
              <li>
                  <a class="side-menu__item" href="{{ route('schools.index') }}"><i
                          class="side-menu__icon fa fa-home"></i><span class="side-menu__label">Manage
                          School</span></a>
              </li>
              <li class="slide">
                  <a class="side-menu__item" data-toggle="slide" href="#"><i
                          class="side-menu__icon fa fa-cog"></i>
                      </i><span class="side-menu__label">Settings</span>
                  </a>
                  <ul class="slide-menu">
                      <li>
                          <a class="slide-item" href="{{ route('districts.index') }}"><span
                                  class="side-menu__label">Manage
                                  Districts</span></a>
                      </li>
                      <li>
                          <a class="slide-item" href="{{ route('tehsils.index') }}"><span
                                  class="side-menu__label">Manage
                                  Tehsils</span></a>
                      </li>
                      <li>
                          <a class=" slide-item" href="{{ route('grades.index') }}"><span
                                  class="side-menu__label">Manage
                                  Grades</span></a>
                      </li>
                      <li>
                          <a class=" slide-item" href="{{ route('subjects.index') }}"><span
                                  class="side-menu__label">Manage
                                  Subjects</span></a>
                      </li>
                  </ul>
              </li>
               <li>
                  <a class="side-menu__item" href="{{ route('item-bank.create') }}"><i
                          class="side-menu__icon fa fa-folder-open"></i><span class="side-menu__label">Create
                          Item Bank</span></a>
              </li>
               <li>
                  <a class="side-menu__item" href="{{ route('item-bank.index') }}"><i
                          class="side-menu__icon fa fa-database"></i><span class="side-menu__label">Manage Item Bank</span></a>
              </li>
               <li>
                  <a class="side-menu__item" href="{{ route('paper-formats.create') }}"><i
                          class="side-menu__icon fa fa-file-code"></i><span class="side-menu__label">Create Paper Format</span></a>
              </li>
               <li>
                  <a class="side-menu__item" href="{{ route('paper-formats.index') }}"><i
                          class="side-menu__icon fa fa-tasks"></i><span class="side-menu__label">Manage Paper Format</span></a>
              </li>

               {{-- <li>
                  <a class="side-menu__item" href="{{ route('admin.studentslist') }}"><i
                          class="side-menu__icon fa fa-database"></i><span class="side-menu__label">Manage Students</span></a>
              </li> --}}

          </ul>
      </aside>
      }
  @elseif (Auth::guard('school')->check())
      {
      <aside class="app-sidebar">
          <div class="app-sidebar__user">
              <div class="dropdown user-pro-body text-center">
                  <div class="nav-link pl-1 pr-1 leading-none position-relative">
                      <img src="{{ asset('assets/img/taleemkhan-logo.png') }}" alt="user-img"
                          class="avatar-xl rounded-circle mb-1 object-fill">
                      {{-- <span class="pulse bg-success position-absolute" aria-hidden="true"></span> --}}
                  </div>
                  <div class="user-info">
                      <h6 class="mb-0 text-dark text-capitalize">{{ Auth::user()->school_name }}</h6>
                      <small class="text-muted d-block mt-1" style="font-size: 12px;">School Admin</small>
                  </div>
              </div>
          </div>
          <ul class="side-menu">
              <li>
                  <a class="side-menu__item" href="{{ route('school.dashboard') }}"><i
                          class="side-menu__icon fa fa-laptop"></i><span class="side-menu__label">Dashboard</span></a>
              </li>
              <li>
                  <a class="side-menu__item" href="{{ route('school.students.create') }}"><i
                          class="side-menu__icon fa fa-plus-square"></i><span class="side-menu__label">Add
                          Students</span></a>
              </li>
              <li>
                  <a class="side-menu__item" href="{{ route('school.students.index') }}"><i
                          class="side-menu__icon fa fa-users"></i><span class="side-menu__label">Manage
                          Students</span></a>
              </li>
              <li>
                  <a class="side-menu__item" href="{{ route('fees.create') }}"><i
                          class="side-menu__icon fa fa-users"></i><span class="side-menu__label">Add Fees
                          </span></a>
              </li>
              <li>
                  <a class="side-menu__item" href="{{ route('fees.index') }}"><i
                          class="side-menu__icon fa fa-users"></i><span class="side-menu__label">
                            Fees Record
                        </span></a>
              </li>
              <li>
                  <a class="side-menu__item" href="{{ route('fee-formats.index') }}"><i
                          class="side-menu__icon fa fa-users"></i><span class="side-menu__label">Manage
                          Fees Format</span></a>
              </li>
               <li>
                  <a class="side-menu__item" href="{{ route('paper-formats.create') }}"><i
                          class="side-menu__icon fa fa-file-code"></i><span class="side-menu__label">Create Paper Format</span></a>
              </li>
              <li>
                  <a class="side-menu__item" href="{{ route('paper-generator.index') }}"><i
                          class="side-menu__icon fa fa-edit"></i><span class="side-menu__label">Generate
                          Papers</span></a>
              </li>
              <li>
                  <a class="side-menu__item" href="{{ route('school.results.index') }}"><i
                          class="side-menu__icon fa fa-edit"></i><span class="side-menu__label">Add Result</span></a>
              </li>
              <li>
                  <a class="side-menu__item" href="{{ route('school.results.view') }}"><i
                          class="side-menu__icon fa fa-edit"></i><span class="side-menu__label">View Result</span></a>
              </li>
          </ul>
      </aside>
      }
  @endif
  <!--aside closed-->

  @push('scripts')
      <script>
          $(document).ready(function() {
              // When user clicks on a parent menu item with data-toggle="slide"
              $('.side-menu__item[data-toggle="slide"]').on('click', function(e) {
                  e.preventDefault();

                  // Find the next ul (submenu)
                  const submenu = $(this).next('.slide-menu');

                  // Slide toggle current submenu with animation
                  if (submenu.is(':visible')) {
                      submenu.slideUp(300, function() {
                          $(this).removeClass('slide-menu');
                      });
                  } else {
                      submenu.addClass('slide-menu').slideDown(300);
                  }

                  // Toggle active class for arrow/rotation effect
                  $(this).toggleClass('active');

                  // Rotate icon on toggle
                  const icon = $(this).find('.side-menu__icon');
                  if ($(this).hasClass('active')) {
                      icon.css('transform', 'rotate(90deg)');
                  } else {
                      icon.css('transform', 'rotate(0deg)');
                  }

                  // Hide other open menus (accordion behavior)
                  $('.slide-menu').not(submenu).slideUp(300, function() {
                      $(this).prev('.side-menu__item').removeClass('active');
                      $(this).prev('.side-menu__item').find('.side-menu__icon').css('transform', 'rotate(0deg)');
                  });
                  $('.side-menu__item').not(this).removeClass('active');
              });

              // Add active state to current page menu item
              const currentPath = window.location.pathname;
              $('.side-menu__item').each(function() {
                  const href = $(this).attr('href');
                  if (href && currentPath.includes(href.replace(/\/$/, ''))) {
                      $(this).addClass('active');
                  }
              });

              // Smooth scroll for sidebar
              $('.side-menu').on('mouseenter', function() {
                  $(this).css('overflow-y', 'auto');
              });
          });
      </script>
  @endpush

  @push('scripts')
  <script>
document.addEventListener('DOMContentLoaded', function() {
    // Set dynamic animation delays for all menu items
    const menuItems = document.querySelectorAll('.side-menu li');
    menuItems.forEach((item, index) => {
        item.style.setProperty('--item-index', index);
    });

    // Enhanced hover effects for user section
    const userSection = document.querySelector('.app-sidebar__user');
    if (userSection) {
        userSection.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-2px)';
        });

        userSection.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    }
});
</script>
@endpush
