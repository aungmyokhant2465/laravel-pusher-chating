<template>
    <form @submit.prevent="sendMessage">
        <input type="hidden" name="receiver_id" v-model="receiver_id">
        <div class="input-group">
            <textarea @focus="trysent" v-on:focusout="untry" name="message" v-model="message" class="form-control" rows="1" placeholder="Enter message" aria-label="Recipient's username" aria-describedby="button-addon2">
                
            </textarea>
            <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="submit" id="button-addon2"><i class="far fa-paper-plane"></i></button>
            </div>
        </div>
    </form>
</template>

<script>
export default {
    data() {
        return {
            message: ''
        }
    },

    props: {
        receiver_id: {
            required: true
        }
    },

    methods: {
        sendMessage() {
            this.$emit('messagesent', {
                message: this.message,
                receiver_id: this.receiver_id
            });

            this.message = '';
        },
        trysent() {
            this.$emit('trytosent')
        },
        untry() {
            this.$emit('tryout')
        }
    }
}
</script>

<style>

</style>