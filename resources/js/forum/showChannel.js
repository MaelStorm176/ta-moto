const channel_id = getChannelId();

const messageForm = () => {
    return {
        data: {
            message: '',
        },
        submit() {
            axios.post(`/forum/channels/${channel_id}/messages`, this.data)
                .then(response => {
                    console.log(response.data);
                    this.data.message = '';
                }).catch(error => {
                    console.log(error);
                });
            }
        }
    }


const initialize_communication = () => {
    Echo.join(`ForumChannel.${channel_id}`)
        .here((current_users) => {
            window.dispatchEvent(new CustomEvent('channel-user-init', {detail: current_users}));
        })
        .joining((user) => {
            window.dispatchEvent(new CustomEvent('channel-user-joined', {detail: user}));
        })
        .leaving((user) => {
            window.dispatchEvent(new CustomEvent('channel-user-left', {detail: user}));
        })
        .listen('ForumChannelMessagePosted', (e) => {
            const message = e.message;
            window.dispatchEvent(new CustomEvent('channel-message-posted', {detail: message}));
        })
    ;
}

function getChannelId() {
    return window.location.pathname.split('/')[3];
}

document.addEventListener('alpine:init', () => {
    Alpine.data('messageForm', messageForm);
    initialize_communication();
});

console.log('showChannel.js loaded');
