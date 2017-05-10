<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">

                    <div class="panel-body">
                        <textarea rows="5" class="form-control" v-model="content"></textarea>
                        <br>
                        <button class="btn btn-success pull-right" :disabled="not_working" @click="create_post()">
                            Create a post
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    const Noty = require('noty');
    export default {
        mounted() {

        },
        data() {
            return {
                content: '',
                not_working: true
            }
        },
        methods: {
            create_post() {
                this.$http.post('/create/post', {content: this.content})
                    .then((resp) => {
                        this.content = ''
                        new Noty({
                            type: 'success',
                            layout: 'bottomLeft',
                            theme: 'mint',
                            text: 'Your post has been published',
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
                        console.log(resp)
                    })
            }
        },
        watch: {
            content() {
                if(this.content.length > 0)
                    this.not_working = false
                else
                    this.not_working = true
            }
        }
    }
</script>