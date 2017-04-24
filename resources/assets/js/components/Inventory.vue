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
                <div v-for="(item, index) in filteredItems" class="col-sm-6">
                    <div :id="index" class="item-card"  @mouseenter="mouseenterItem" @mouseleave="mouseleaveItem">
                        <div class="item-name">{{ item.name }}</div>
                        <div class="item-icon"><img :src="'http://steamcommunity-a.akamaihd.net/economy/image/'+item.icon_url" :alt="item.name"></div>
                    </div>
                </div>
            </div>
        </div>
        <pre>{{ $data }}</pre>
        <div id="tooltip" ref="tooltip" class="tooltip-steamclicks"></div>
    </div>

</template>

<script>
    export default {
        data () {
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
                contextid: 2,
                tooltip:  {}
            };
        },
        created () {
            this.fetchData();
        },
        methods: {
            mouseenterItem: function (e) {
                var self = this;
                var target = e.target;
                var coords = e.target.getBoundingClientRect();
                var item = self.items[target.id];
                var tooltip = self.$refs.tooltip;


                tooltip.style.display = 'block';
                tooltip.innerHTML =
                    '<div style="color:#'+ item.name_color +'">' + item.name + '</div>' +
                    '<div>' + item.descriptions[0].value + '</div>' +
                    '<div>' + item.type + '</div>';
                tooltip.style.top = coords.top + 'px';
                tooltip.style.left = coords.right + 10 + 'px';
            },
            mouseleaveItem (e) {
                var self = this;
                var tooltip = self.$refs.tooltip;

                tooltip.style.display = 'none';
            },
            selectCategory: function (e) {
                var self = this;
                var target = e.target;

                self.loading = true;
                self.appid = self.categories[target.id].appid;
                self.contextid = self.categories[target.id].contextid;
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
                });
            }
        },
        computed: {
            filteredItems () {
                var self = this;
                return self.items
                    .filter(item => item.name.toLowerCase().includes(self.searchTest.toLowerCase()))
                    .filter(item => item.tradable == 1);
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

    .tooltip-steamclicks {
        position: fixed;
        background-color: #dedede;
        padding: 5px;
        border: 1px solid #fff;
        width: 250px;
        opacity: 1;
    }

</style>