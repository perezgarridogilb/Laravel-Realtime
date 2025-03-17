import './bootstrap';

Echo.channel('notifications')
    .listen('UserSessionChanged', (e) => {
        const notificactionElement = document.getElementById('notification');

        notificactionElement.innerText = e.message;
        
        notificactionElement.classList.remove('invisible');
        notificactionElement.classList.remove('alert-success');
        notificactionElement.classList.remove('alert-danger');

        notificactionElement.classList.add('alert-' + e.type);
    });
