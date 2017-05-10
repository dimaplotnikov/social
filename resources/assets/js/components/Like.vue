<template>
<div>
    <hr v-if="post.likes.length > 0">
    <p class="text-center" v-for="like in post.likes">
        <img :src="like.user.avatar" alt="" width="40px" height="40px" class="avatar-like">
    </p>
    <hr>

    <button class="btn btn-success btn-xs" v-if="!auth_user_like_post" @click="like()">
        Like post
    </button>

    <button class="btn btn-danger btn-xs" v-else @click="unlike()">
        Unlike post
    </button>
</div>
</template>

<script>
    const Noty = require('noty');
    export default {
        mounted() {

        },
        props: ['id'],
        computed: {
            likers(){
                var likers = []

                this.post.likes.forEach((like) => {
                    likers.push(like.user.id)
                })

                return likers
            },
            auth_user_like_post() {
                var check_index = this.likers.indexOf(
                    this.$store.state.auth_user.id
                )

                if (check_index === -1)
                    return false
                else
                    return true
            },
            post() {
                return this.$store.state.posts.find((post) => {
                    return post.id === this.id
                })
            }
        },
        methods: {
            like() {
                this.$http.get('/like/' + this.id)
                    .then((resp) => {
                        this.$store.commit('update_post_likes', {
                            id: this.id,
                            like: resp.body
                        })
                        new Noty({
                            type: 'success',
                            layout: 'bottomLeft',
                            theme: 'mint',
                            text: 'You successfully liked the post!',
                            timeout: 5000,
                            progressBar: true,
                            closeWith: ['click', 'button'],
                            animation: {
                                open: 'noty_effects_open',
                                close: 'noty_effects_close'
                            },
                            id: false,
                            force: false,
                            killer: false,
                            queue: 'global',
                            container: false,
                            buttons: [],
                            sounds: {
                                sources: [],
                                volume: 1,
                                conditions: []
                            },
                            titleCount: {
                                conditions: []
                            },
                            modal: false
                        }).show()

                    })
            },
            unlike() {
                this.$http.get('/unlike/' + this.id)
                    .then((response) => {
                        this.$store.commit('unlike_post', {
                            post_id: this.id,
                            like_id: response.body
                        })
                        new Noty({
                            type: 'success',
                            layout: 'bottomLeft',
                            theme: 'mint',
                            text: 'You successfully unliked the post!',
                            timeout: 5000,
                            progressBar: true,
                            closeWith: ['click', 'button'],
                            animation: {
                                open: 'noty_effects_open',
                                close: 'noty_effects_close'
                            },
                            id: false,
                            force: false,
                            killer: false,
                            queue: 'global',
                            container: false,
                            buttons: [],
                            sounds: {
                                sources: [],
                                volume: 1,
                                conditions: []
                            },
                            titleCount: {
                                conditions: []
                            },
                            modal: false
                        }).show()
                    })
            }
        }
    }
</script>

<style>
    .avatar-like {
        border-radius:50%;
    }
</style>