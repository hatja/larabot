let stream = new EventSource('/stream', {withCredentials: true}),
    list = document.querySelector('#messages');

stream.addEventListener('ping', event => {
    JSON.parse(event.data).forEach(message => {
        let li = document.createElement('li');
        li.innerHTML = `<em>${message.created_at}</em>: ${message.body}`;
        list.appendChild(li);
    });
});
