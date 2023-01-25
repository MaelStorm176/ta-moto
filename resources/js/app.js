import './bootstrap';

document.addEventListener('DOMContentLoaded', () => {
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach((alert) => {
        setTimeout(() => {
            alert.remove();
        }, 5000);
    });
});

console.log('app.js loaded');

