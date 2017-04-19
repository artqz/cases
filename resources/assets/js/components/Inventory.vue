<template>
    <div>
        <div class="col-sm-6">
            {{searchText}}
            <input type="text" v-model="searchTest" placeholder="Search title...">
            <div v-if="loading">Загрузка... </div>
            <div class="inventory row">
                <div v-for="item in items filterBy searchTest" class="col-sm-6" v-on:click="selectItem">
                    <div class="item-card">
                        <div class="item-name">{{ item.name }}</div>
                        <div class="item-icon"><img :src="'http://steamcommunity-a.akamaihd.net/economy/image/'+item.icon_url" :alt="item.name"></div>
                    </div>
                </div>
            </div>
        </div>
        {{ steam_id }}
        <pre>{{ $data }}</pre>
    </div>
</template>

<script>
    export default {
        data () { /* ES2015 эквивалент для: `data: function () {` */
            return {
                items: null,
                searchTest: '123',
                loading: true,
            };
        },
        created () {
            this.fetchData();
        },
        methods: {
            selectItem: function (e) {
                console.log('123')
            },
            fetchData: function () {
                var self = this;
                $.get( {
                    url: '/api/steam/getInventory?steamid=' + this.steam_id,
                    headers: {

                    }
                },
                function( data ) {
                    self.items = JSON.parse(data).descriptions;
                    self.loading = false;
                    console.log(self.items);
                });
            }
        },
        props: ['steam_id'],
    }
</script>

<style>
    .inventory .item-card {
        background-color: #fff;
        padding: 5px 10px;
        margin-bottom: 15px;
        border-radius: 3px;
        box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05);
        position: relative;
    }

    .inventory .item-card img {
        width: 100px;
    }

</style>