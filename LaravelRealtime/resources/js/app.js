import './bootstrap';

Echo.private('notifications')
    .listen('UserSessionChanged', (e) => {
        const notificactionElement = document.getElementById('notification');

        notificactionElement.innerText = e.message;

        notificactionElement.classList.remove('invisible');
        notificactionElement.classList.remove('alert-success');
        notificactionElement.classList.remove('alert-danger');

        notificactionElement.classList.add('alert-' + e.type);
    });

  
 
const circleElement = document.getElementById('circle');
const timerElement = document.getElementById('timer');
const winnerElement = document.getElementById('winner');
const betElement = document.getElementById('bet');
const resultElement = document.getElementById('result');

Echo.channel('game')
    .listen('RemainingTimeChanged', (e) => {
        timerElement.innerText = e.time;

        circleElement.classList.add('refresh');

        winnerElement.classList.add('d-none');

        resultElement.innerText = '';

        winnerElement.classList.remove('text-success');

        winnerElement.classList.remove('text-danger');

    })
    .listen('WinnerNumberGenerated', (e) => {
    })

    // tercer desarrollo
    const usersElement = document.getElementById('users');
    
    Echo.join('chat')
        // cuando está
        .here((users) => {
            users.forEach((user, index) => {
            let element = document.createElement('li');

            element.setAttribute('id', user.id);
            element.innerText = user.name;

            usersElement.appendChild(element);
        });
        })

        // cuando se une
        .joining((users) => {
            let element = document.createElement('li');

            element.setAttribute('id', user.id);
            element.innerText = user.name;

            usersElement.appendChild(element);
        })

        // cuando se va
        .leaving((users) => {
            let element = document.getElementById(user.id);
                    if (element) {
                        element.parentNode.removeChild(element);
                    }
        })
