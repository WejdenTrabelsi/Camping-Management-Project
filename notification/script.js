// Function to fetch notifications from the server
function fetchNotifications() {
    fetch('fetch_notifications.php') // Make a request to fetch notifications
        .then(response => response.json()) // Parse the response as JSON
        .then(data => {
            const notificationList = document.getElementById('notification-list');
            const notificationCount = document.getElementById('notification-count');

            // Clear the previous notifications in the list
            notificationList.innerHTML = "";

            // Update the notification badge if there are unread notifications
            if (data.unreadCount > 0) {
                notificationCount.textContent = data.unreadCount; // Set the number of unread notifications
                notificationCount.style.display = "inline-block"; // Show the badge
            } else {
                notificationCount.style.display = "none"; // Hide badge if no unread notifications
            }

            // Loop through each notification and display them in the list
            data.notifications.forEach(notification => {
                const li = document.createElement('li');
                // Add the notification message and its creation date to the list item
                li.textContent = `${notification.message} - ${new Date(notification.created_at).toLocaleString()}`;
                notificationList.appendChild(li); // Append the list item to the notification list
            });
        });
}

// Function to toggle the visibility of the notification modal
function toggleNotifications() {
    const modal = document.getElementById('notification-modal');
    // Toggle the modal visibility between "block" and "none"
    modal.style.display = modal.style.display === "block" ? "none" : "block";

    // Mark notifications as read when the modal is opened
    if (modal.style.display === "block") {
        markNotificationsAsRead(); // Call function to mark notifications as read
    }
}

// Function to mark notifications as read by making a POST request to the server
function markNotificationsAsRead() {
    fetch('mark_notifications_read.php', { method: 'POST' }) // Send a POST request to mark notifications as read
        .then(() => fetchNotifications()); // Refresh notifications after marking them as read
}

// Automatically fetch notifications when the page loads
window.onload = fetchNotifications;
