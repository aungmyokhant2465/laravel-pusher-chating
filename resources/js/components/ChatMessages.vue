<template>
    <div class="card p-0">
        <div class="card-header" style="background-color: #e6e6e6">
            <div class="row">
                <div class="col-11 col-md-11 col-sm-11 col-xs-11">
                    <a class="navbar-brand text-black-50" href="#">
                        <img src="#" width="30" height="30" class="img rounded-circle d-inline-block align-top" alt="N" loading="lazy">
                            {{this.receiver_name}}
                    </a>
                </div>
                <div class="col-1 col-md-1 col-sm-1 col-xs-1">
                    <a class="navbar-brand text-black-50" href="#">
                        <i class="fas fa-ellipsis-v"></i>                                    
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body chat-body" style="position: relative; width: 100%">
            <ul style="list-style-type: none; position: static; left: 0px; bottom: 0px">
                <li
                    v-for="(message, index) in messages"
                    :key="index"
                >
                    <span v-if="message.receiver_id == receiver_id" style="color: red">{{message.message}}</span>
                    <span v-else>{{message.message}}</span>
                </li>
                <li v-if="tryingName" style="border-top: 1px #ccc solid; color: #ccc">{{tryingName}} is trying ...</li>
            </ul>
        </div>
        <div class="card-footer p-0">
            <chat-form
                v-on:messagesent="addMessage"
                v-on:trytosent="tryToSent"
                v-on:tryout="tryOut"
                :receiver_id="receiver_id"
            >
            </chat-form>
        </div>
    </div>
</template>

<script>
export default {

    data() {
        return {
            messages: [],
            timeout: null,
            tryingName: null
        }
    },

    props: {
        user: {
            type: Object
        },
        receiver_id: {
            required: true
        },
        receiver_name: {
            type: String
        }
    },

    created() {
        this.fetchMessages();
    },

    mounted() {

        window.Echo.private(`chat.${this.user.id}`)
            .listen('MessageSent', (e) => {
                console.log('message: ', e);
                if(e.user.id == this.receiver_id) {
                    this.messages.push(e.message);
                }
            });
        window.Echo.private(`try-or-not.${this.user.id}.${this.receiver_id}`)
            .listenForWhisper('typing', (e) => {
                this.tryingName = e.name
            })
            .listenForWhisper('untyping', (e) => {
                this.timeout = setTimeout(() => {
                    this.tryingName = null
                }, 100);
            });
    },
    
    methods: {
        fetchMessages() {
            axios.get('/home/chat/messages/'+this.receiver_id)
                .then(res => {
                    this.messages = res.data;
                })
                .catch(err => {
                    console.log('err in fetch messagess', err)
                })
        },

        addMessage(message) {
            this.messages.push(message);

            axios.post('/home/chat/messages', {
                message: message.message,
                receiver_id: message.receiver_id
            })
                .catch(err => {
                    console.log(err)
                })
        },
        tryToSent() {
            window.Echo.private(`try-or-not.${this.receiver_id}.${this.user.id}`)
                .whisper('typing', {
                    name: this.user.name
                });
        },
        tryOut() {
            window.Echo.private(`try-or-not.${this.receiver_id}.${this.user.id}`)
                .whisper('untyping', {
                    name: this.user.name
                });
        }
    },

    beforeDestroy() {
        clearTimeout(this.timeout);
    }
}
</script>

<style scoped>
</style>