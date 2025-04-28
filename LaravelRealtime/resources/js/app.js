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
    const messagesElement = document.getElementById('messages');
    
    Echo.join('chat')
        // cuando está
        .here((users) => {
            users.forEach((user, index) => {
            let element = document.createElement('li');
            // ejemplo <li id="5" onclick="greetUser('5')">Nombre de usuario</li>
            element.setAttribute('id', user.id);
            // para usuarios determinados
            element.setAttribute('onclick', 'greetUser("' + user.id +'")');
            element.innerText = user.name;

            usersElement.appendChild(element);
        });
        })

        // cuando se une
        .joining((user) => {
            let element = document.createElement('li');

            element.setAttribute('id', user.id);
            // para usuarios determinados
            element.setAttribute('onclick', 'greetUser("' + user.id +'")');
            element.innerText = user.name;

            usersElement.appendChild(element);
        })

        // cuando se va
        .leaving((user) => {
            let element = document.getElementById(user.id);
                    if (element) {
                        element.parentNode.removeChild(element);
                    }
        })
        .listen('MessageSent', (e) => {
            let element = document.createElement('li');

            element.innerText = e.user.name + ': ' + e.message;

            messagesElement.appendChild(element);
        });

        const sendElement = document.getElementById('send');
        const messageElement = document.getElementById('message');
    
    
        sendElement.addEventListener('click', (e) => {
            /* evitar que la página se cargue de nuevo */
            e.preventDefault();
    
            window.axios.post('/chat/message', {
                message: messageElement.value
            })
            /** elemento hijo */
            document.querySelector("#message").value = "";
        });

        // El user des Laravel userId: {{ auth()->user()->id }}
        // con true lo suscribe al canal
        // se usa al inicio (DOMLoad) y se usa al momento de actualizar desde el Back-end, algo en el Front-end
        Echo.private('chat.greet.' + window.Laravel.userId)
        .listen('GreetingSent', (e) => {
        let element = document.createElement('li');

        element.innerText = e.message;
        element.classList.add('text-success');
        messagesElement.appendChild(element);
    });
