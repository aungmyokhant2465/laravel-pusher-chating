import Vue from 'vue';
import VueRouter from 'vue-router';
import ChatMessages from '../components/ChatMessages.vue';

Vue.use(VueRouter);

export default new VueRouter({
    //mode: 'history',
    routes: [
        {
            path: '/messages/:receiver_id',
            name: 'messages',
            component: ChatMessages,
            props: true
        }
    ]
});