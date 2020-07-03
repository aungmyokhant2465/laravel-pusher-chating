<template>
    <div class="card">
        <div class="card-header pr-1" style="background-color: gray">
            <div class="row">
                <div class="col-2">
                    <a class="navbar-brand text-black-50" href="#">
                        <i class="fas fa-comments"></i>
                    </a>
                </div>
                <div class="col-10">
                    <form action="">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="button-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-outline-light" type="button" id="button-addon2"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-body friend-body p-0">
            <div class="list-group">
                <router-link
                    :to="{name: 'messages', params: {receiver_id: friend.friend_id, receiver_name: friend.user.name}}"
                    v-for="friend in friends"
                    :key="friend.id"
                    class="list-group-item list-group-item-action">
                    <div class="row">
                        <div class="col-10 col-sm-10">
                            <img src="#" width="30" height="30" class="img rounded-circle d-inline-block align-top" alt="N" loading="lazy">
                                {{friend.user.name}}
                            <span class="badge badge-pill badge-primary">Primary</span>
                        </div>
                        <div class="col-2 col-sm-2">
                            <div v-if="checkActive(friend.user.id)" style="background-color: #22cc11; border: 1px #22cc11 solid; border-radius: 1em; width: 1em; height: 1em;"></div>
                        </div>
                    </div>
                </router-link>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    props: {
        friends: {
            type: Array,
            default: []
        },
        activefriends: {
            type: Array,
        }
    },
    mounted() {
    },
    methods: {
        checkActive(id) {
            return this.activefriends.find((activefriend) => {
                return activefriend.id == id;
            } );
        }
    }
}
</script>

<style>

</style>