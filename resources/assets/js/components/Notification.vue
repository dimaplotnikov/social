<template>
    <div>

    </div>
</template>

<script>
    const Noty = require('noty');
    export default {
        mounted() {
            this.listen()
        },
        props: ['id'],
        methods:{
            listen() {
                Echo.private('App.User.' + this.id)
                    .notification((notification) => {
                            new Noty({
                                type: 'success',
                                layout: 'bottomLeft',
                                theme: 'mint',
                                text: notification.name + notification.message,
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

                        this.$store.commit('add_not', notification)

                        document.getElementById("noty_audio").play()
                    }
                    )
            }
        }
    }
</script>