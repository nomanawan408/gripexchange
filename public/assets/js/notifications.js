// Initialize Pusher
// const pusher = new Pusher('bba3c138a6a9d253bef1', {
//     cluster: 'us3',
//     encrypted: true
// });

// Subscribe to the user's private channel
const userId = document.querySelector('meta[name="user-id"]').content;
const channel = pusher.subscribe(`private-App.Models.User.${userId}`);

// Listen for notifications
channel.bind('Illuminate\\Notifications\\Events\\BroadcastNotificationCreated', function(data) {
    // Update notification count
    const notificationCount = document.getElementById('notificationCount');
    let count = parseInt(notificationCount.innerText) || 0;
    notificationCount.innerText = count + 1;

    // Add notification to dropdown
    const dropdownMenu = document.querySelector('.drop-down-box');
    const newNotification = `
        <li style="border-bottom:1px solid rgb(236, 236, 236);border-radius:0">
            <a class="dropdown-item" href="#">${data.message}</a>
        </li>
    `;
    dropdownMenu.insertAdjacentHTML('afterbegin', newNotification);
});
