document.addEventListener('alpine:init', () => {
    Alpine.data('chatbot', () => ({
        open: false,
        chatbotMessages: [],
        query: { step: 'start', input: '' },
        url: '/chatbot/messages?',
        queryToParams: function() { return Object.keys(this.query).map(key => key + '=' + this.query[key]).join('&'); },
        getMessages: function() {
            fetch(this.url + this.queryToParams(), {method: 'GET', headers: { 'Content-Type': 'application/json' }})
                .then(response => response.json())
                .then(data => this.chatbotMessages.push(data))
                .then(() => this.scrollToBottom())
                .catch(error => console.error(error));
        },
        goNext: function(step) {
            this.query.step = step;
            this.query.input = '';
            this.getMessages();
        },
        scrollToBottom: function() {
            this.$refs.bot.scrollTop = this.$refs.bot.scrollHeight;
        },
        init: function() {
            this.getMessages();
        }
    }));
});
