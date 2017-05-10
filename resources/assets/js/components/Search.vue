<template>
<div class="container">
    <div class="row">
        <div class="col-lg-6 col-lg-offset-3">
            <input class="form-control" placeholder="Search for users" v-model="query" @keyup.enter="search()">
            <br>
            <div class="row" v-if="results.length">
                <div class="text-center" v-for="user in results">
                    <img :src="user.avatar" alt="" width="50px" height="50px" class="searched-user">
                    <h4 class="text-center">{{ user.name }}</h4>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
    var algoliasearch = require('algoliasearch');
    var client = algoliasearch('WTQLLA12IW', 'af3c5cc53abd06fc1bde9fd8071fe10f');
    var index = client.initIndex('users');

    export default {
        mounter(){
        },
        data() {
            return {
                query:'',
                results:[]
            }
        },
        methods: {
            search() {
                index.search(this.query, (err, content) => {
                    this.results = content.hits
                })
            }
        }
    }
</script>

<style>
    .searched-user{
        border-radius: 50%;
    }
</style>
