/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

//Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


import router from './router/index.js';

import ChatForm from './components/ChatForm.vue';
import ChatMessages from './components/ChatMessages.vue';
import FriendsList from './components/FriendsList.vue';

Vue.component('chat-form', ChatForm);

const app = new Vue({
    el: '#app',
    router,
    components: {
        ChatMessages,
        FriendsList
    },
    data() {
        return {
            friends: [],
            activeFriends: [],
        }
    },
    created() {
        this.fetchFriends();
    },

    mounted() {
        window.Echo.join('user-status')
            .here((users) => {
                console.log("Users : ",users);
                this.activeFriends = users;
                console.log(this.activeFriends);
            })
            .joining((user) => {
                console.log("Joining User : ",user.name);
                this.activeFriends.push(user);
            })
            .leaving((user) => {
                console.log("leave User : ",user.name);
                this.activeFriends.pop(user);
            })
    },
    methods: {
        
        fetchFriends() {
            axios.get('/home/friends/friends')
                .then(res => {
                    this.friends = res.data;
                })
                .catch(err => {
                    console.log(err)
                })
        }
    },

});

export default app
