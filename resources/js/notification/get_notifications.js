const eventSource = new EventSource('/notifications/stream', { withCredentials: true });

eventSource.addEventListener('notification', (event) => {
    const notification = JSON.parse(event.data);
    window.dispatchEvent(new CustomEvent('notification-received', {detail: notification}));
});


