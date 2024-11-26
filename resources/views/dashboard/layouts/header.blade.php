<div class="">
  <div class="navBar">
        <div class="profile ">
          <div class="profile_pic">
            <img src="{{ asset('img/avatar.png')}}" alt="">
          </div>
          {{-- logged in user name  --}}
          <h5>{{  Auth::user()->name  }}</h5>
        </div>
              <div class="nav_buttons">
                  <ul class="nav_options">
                    <li class="btn badge-primary">
                      <div class="dropdown show">
                          <a class="btn badge-primary dropdown-toggle position-relative" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                              <ion-icon name="notifications-outline"></ion-icon>
                              <span id="notificationCount" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="display: none;">
                                  {{ Auth::user()->unreadNotifications->count() }}
                              </span>
                          </a>
                        
                          <ul class="dropdown-menu drop-down-box" aria-labelledby="dropdownMenuLink">
                              @if (Auth::user()->unreadNotifications->count() == 0)
                                  <li class="text-center" style="border-bottom:1px solid rgb(236, 236, 236);border-radius:0"><a class="dropdown-item" href="#">No Notification found</a></li>
                              @else
                                  @foreach (Auth::user()->unreadNotifications as $notification)
                                      <li style="border-bottom:1px solid rgb(236, 236, 236);border-radius:0">
                                          <a class="dropdown-item" href="#">{{ $notification->data['message'] }}</a>
                                      </li>
                                  @endforeach
                              @endif
                          </ul>
                      </div>
                  </li>
                  
                      <li>
                        
                        <div class="dropdown show">
                            <a class="btn badge-primary" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                              <ion-icon name="ellipsis-vertical-outline"></ion-icon>
                            </a>
                          
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                              <li></li>
                              <li><a class="dropdown-item" href="/profile/edit/{{ Auth::user()->id }}">Edit Profile</a></li>
                              <li><a class="dropdown-item" href="{{ url('/change-password') }}">Change Password</a></li>
                              <li><a class="dropdown-item" href="{{ url('/wallet/reset-pin') }}">Pin Reset</a></li>
                              <li><a class="dropdown-item" href="{{route('logout')}}">Logout</a></li>
                            </ul>
                        </div>
                      </li>
                      
                  </ul>
              </div>
          </div>
      </div>

      <script>
        function fetchNotificationCount() {
            fetch('{{ route('notifications.count') }}')
                .then(response => response.json())
                .then(data => {
                    // Update the notification count in the UI
                    const notificationCountElement = document.getElementById('notificationCount');
                    notificationCountElement.textContent = data.count;
    
                    // Optionally, hide/show the badge if count is 0
                    if (data.count > 0) {
                        notificationCountElement.style.display = 'inline-block';
                    } else {
                        notificationCountElement.style.display = 'none';
                    }
                })
                .catch(error => console.error('Error fetching notifications:', error));
        }
    
        // Fetch notifications initially and set interval to poll every 10 seconds
        fetchNotificationCount();
        setInterval(fetchNotificationCount, 5000); // 10 seconds
    </script>

<script>
  document.getElementById('dropdownMenuLink').addEventListener('click', function () {
      fetch('{{ route('notifications.markAsRead') }}', {
          method: 'POST',
          headers: {
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
              'Content-Type': 'application/json',
          },
      })
      .then(response => response.json())
      .then(data => {
          if (data.success) {
              // Reset notification count
              const notificationCountElement = document.getElementById('notificationCount');
              notificationCountElement.textContent = '0';
              notificationCountElement.style.display = 'none';

              // Dim the dropdown items
              const dropdownItems = document.querySelectorAll('.dropdown-item');
              dropdownItems.forEach(item => {
                  item.classList.add('text-muted');
              });
          }
      })
      .catch(error => console.error('Error marking notifications as read:', error));
  });
</script>

