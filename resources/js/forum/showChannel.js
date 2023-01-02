const channel_id = getChannelId();

const messages = document.getElementById('messages');
messages.scrollTop = messages.scrollHeight;

Echo.join(`ForumChannel.${channel_id}`)
    .here((current_users) => {
        window.dispatchEvent(new CustomEvent('channel-user-init', { detail: current_users }));
    })
    .joining((user) => {
        window.dispatchEvent(new CustomEvent('channel-user-joined', { detail: user }));
    })
    .leaving((user) => {
        window.dispatchEvent(new CustomEvent('channel-user-left', { detail: user }));
    })
    .listen('ForumChannelMessagePosted', (e) => {
        const message = e.message;
        console.log('message', message);
    })
;

function getChannelId() {
    return window.location.pathname.split('/')[3];
}
