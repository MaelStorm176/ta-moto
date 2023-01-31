const communication_id = getCommunicationId();

document.addEventListener('alpine:init', () => {
    Alpine.data('messageForm', messageForm);
    initialize_communication();
});

const messageForm = () => {
    return {
        data: {
            message: '',
        },
        submit() {
            axios.post(`/communication/${communication_id}/messages`, this.data)
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
    Echo.join(`Communication.${communication_id}`)
        .here((current_users) => {
            window.dispatchEvent(new CustomEvent('channel-user-init', {detail: current_users}));
        })
        .joining((user) => {
            window.dispatchEvent(new CustomEvent('channel-user-joined', {detail: user}));
        })
        .leaving((user) => {
            window.dispatchEvent(new CustomEvent('channel-user-left', {detail: user}));
        })
        .listen('CommunicationMessagePosted', (e) => {
            const message = e.message;
            window.dispatchEvent(new CustomEvent('channel-message-posted', {detail: message}));
        })
    ;
}

function getCommunicationId() {
    return window.location.pathname.split('/')[2];
}

console.log('showChannel.js loaded');
