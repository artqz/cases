<template>
    <div>
        <div class="col-sm-12">
            <div v-for="(category, index) in categories">
                <div :id="index" @click="selectCategory">{{ category.name }}</div>
            </div>
        </div>
        <div class="col-sm-6">
            {{appid}}
            <input type="text" v-model="searchTest" placeholder="Search title...">
            <div v-if="loading">Загрузка... </div>
            <div class="inventory row">
                <div v-for="item in filteredItems" class="col-sm-6" v-on:mouseover="selectItem">
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
                categories: [
                    {
                        name: 'Steam Gifts',
                        appid: 753,
                        contextid: 1
                    },
                    {
                        name: 'Steam Card',
                        appid: 753,
                        contextid: 6
                    },
                    {
                        name: 'Dota 2',
                        appid: 570,
                        contextid: 2
                    },
                    {
                        name: 'CS',
                        appid: 730,
                        contextid: 2
                    }
                ],
                items: [],
                searchTest: '',
                loading: true,
                appid: 570,
                contextid: 2
            };
        },
        created () {
            this.fetchData();
        },
        methods: {
            selectItem: function (e) {
                console.log('123')
            },
            selectCategory: function (e) {
                var self = this;
                var id = e.target.id;

                self.loading = true;
                self.appid = self.categories[id].appid;
                self.contextid = self.categories[id].contextid;
                self.items = [];
                self.fetchData();
            },
            fetchData: function () {
                var self = this;
                $.get( {
                    url: '/api/steam/getInventory?steamid=' + self.steam_id + '&appid=' + self.appid + '&contextid=' + self.contextid,
                },
                function( data ) {
                    self.items = JSON.parse(data).descriptions;
                    self.loading = false;
                    console.log(self.items);
                });
            }
        },
        computed: {
            filteredItems () {
                var self = this;
                return self.items.filter(item => item.name.toLowerCase().includes(self.searchTest.toLowerCase()));
            },
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