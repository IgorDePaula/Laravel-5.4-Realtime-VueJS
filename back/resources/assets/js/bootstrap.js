window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

window.$ = window.jQuery = require('jquery');

require('bootstrap-sass');

/**
 * Vue is a modern JavaScript library for building interactive web interfaces
 * using reactive data binding and reusable components. Vue's API is clean
 * and simple, leaving you to focus on building your next great project.
 */

window.Vue = require('vue');

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

// window.axios.defaults.headers.common = {
//     'X-CSRF-TOKEN': window.Laravel.csrfToken,
//     'X-Requested-With': 'XMLHttpRequest'
// };

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

import Echo from 'laravel-echo'

// window.Pusher = require('pusher-js');
const token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjMsImlzcyI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwXC9mYWtldG9rZW4iLCJpYXQiOjE0OTA2NjQ3MzUsImV4cCI6MTQ5MDY2ODMzNSwibmJmIjoxNDkwNjY0NzM1LCJqdGkiOiIwYzI3NzExOWFlYjkyMmNlZjQ5ZmRmM2EwYjI3Y2RmMCJ9.xUYuYw4NMNJL7jNMacYAfj2Ymu3u0wnVoe2kGk7d8QI'
const config = {
    broadcaster: 'socket.io',
    host: 'http://localhost:6001',
    auth: {
        headers: {
            'Authorization': `Bearer ${token}`
        }
    }
}
window.Echo = new Echo(config);
window.Echo.channel('chat').listen('MensagemEvent', (e) => {
    let mensagem = `<li>${e.user.name}: ${e.mensagem.mensgem}</li>`
    $('#mensagens').append(mensagem)
})

window.Echo.join(`chat`)
    .here((users) => {
        users.forEach(function (value, index) {
            let user = `<li id="user-${value.id}">${value.name}</li>`

            $('#users').append(user)
        })
    })
    .joining((user) => {
        let u = `<li id="user-${user.id}">${user.name}</li>`
        let elem = document.getElementById(`user-${user.id}`)
        console.log(elem)
        if (elem == null) {
            $('#users').append(u)
        }
    }).leaving((user) => {
    var iduser = '#user-' + user.id
    $(iduser).remove()
})

