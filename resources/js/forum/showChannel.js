Echo.private('ForumChannel.' + 1)
    .listen('ForumChannelMessagePosted', (e) => {
        const message = e.message;
        console.log('message', message);
    })
;
