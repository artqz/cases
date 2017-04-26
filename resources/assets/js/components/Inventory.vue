<template>
    <div>
        <div class="col-sm-12">
            <div class="row items-categories">
                <div class="col-sm-3 col-md-3" v-for="(category, index) in categories">
                    <div class="category" :class="{ 'active' : category.active}" :id="index" @click="selectCategory">
                        <img class="category-icon" :src="'http://localhost:8000/images/games/icons/'+category.appid+'_'+category.contextid+'.jpg'" :alt="category.name">
                        <span class="category-name">{{ category.name }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <h4>Ваш инвентарь</h4>
            <input type="text" v-model="searchTest" placeholder="Search title...">
            <div v-if="loading">Загрузка... </div>
            <div class="inventory row">
                <div v-for="(item, index) in filteredItems" class="col-sm-6">
                    <div :id="index" :data-classid="item.classid" class="item-card"  @mouseenter="mouseenterItem" @mouseleave="mouseleaveItem" @click="selectItem">
                        <div class="item-name" :style="{ color: '#' + item.name_color }">{{ item.name }}</div>
                        <div class="item-icon"><img :src="'http://steamcommunity-a.akamaihd.net/economy/image/'+item.icon_url" :alt="item.name"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <h4>Ваши лоты</h4>
            <div v-for="(item, index) in itemsOnSale" class="last-buy-games-list">
                <div class="last-buy-game-card">
                    <div class="game-image"><img :src="'http://steamcommunity-a.akamaihd.net/economy/image/'+item.icon_url" :alt="item.name"></div>
                    <div class="game-name" :style="{ color: '#' + item.name_color }">{{ item.name }}</div>
                    <div class="game-buyer"><input type="text" class="price" v-model="item.price" placeholder="Укажите цену.."></div>
                </div>
            </div>
            <div @click="itemsSell">Продать</div>
        </div>
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
                        contextid: 1,
                        active: false
                    },
                    {
                        name: 'Steam Card',
                        appid: 753,
                        contextid: 6,
                        active: true
                    },
                    {
                        name: 'Dota 2',
                        appid: 570,
                        contextid: 2,
                        active: false
                    },
                    {
                        name: 'CS',
                        appid: 730,
                        contextid: 2,
                        active: false
                    }
                ],
                items: [],
                itemsAssets: [],
                itemsOnSale: [],
                searchTest: '',
                loading: true,
                appid: 753,
                contextid: 6,
                tooltip:  {}
            };
        },
        created () {
            this.fetchData();
        },
        methods: {
            itemsSell () {
                console.log(this.itemsOnSale);
            },
            mouseenterItem: function (e) {
                var self = this;
                var target = e.target;
                var coords = e.target.getBoundingClientRect();
                var classid = target.getAttribute('data-classid');
                var item = self.items.filter(item => item.classid == classid)[0];
                var itemAssets = self.itemsAssets.filter(item => item.classid == classid)[0];
                var tooltip = self.$refs.tooltip;

                tooltip.style.display = 'block';
                tooltip.innerHTML =
                    '<div class="name" style="color:#'+ item.name_color +'">' + item.name + '</div>' +
                    '<div class="description">' + item.descriptions[0].value + '</div>' +
                    '<div class="type">' + item.type + '</div>';
                tooltip.style.top = coords.top + 'px';
                tooltip.style.left = coords.right + 10 + 'px';
            },
            mouseleaveItem (e) {
                var self = this;
                var tooltip = self.$refs.tooltip;

                tooltip.style.display = 'none';
            },
            selectItem: function (e) {
                var self = this;
                var target = e.currentTarget;
                var classid = target.getAttribute('data-classid');
                var item = self.items.filter(item => item.classid == classid)[0];

                console.log(item);

                self.itemsOnSale.push({
                    name: item.name,
                    icon_url: item.icon_url,
                    price: ''
                });
            },
            selectCategory: function (e) {
                var self = this;
                var target = e.currentTarget;

                self.categories.forEach(function(app, i) {
                    app.active = false;
                });

                self.loading = true;
                self.appid = self.categories[target.id].appid;
                self.contextid = self.categories[target.id].contextid;
                self.items = [];
                self.itemsAssets = [];
                self.categories[target.id].active = true;
                self.fetchData();
            },
            fetchData: function () {
                var self = this;

                $.get( {
                    url: '/api/steam/getInventory?steamid=' + self.steam_id + '&appid=' + self.appid + '&contextid=' + self.contextid,
                },
                function( data ) {
                    self.items = JSON.parse(data).descriptions.filter(item => item.tradable == 1).filter(item => item.classid != '667924416');
                    self.itemsAssets = JSON.parse(data).assets.filter(item => item.classid != '667924416');
                    self.loading = false;
                });
            }
        },
        computed: {
            filteredItems () {
                var self = this;

                if (self.items.length > 0) {
                    return self.items
                        .filter(item => item.name.toLowerCase().includes(self.searchTest.toLowerCase()))
                }
                else return self.items = [];
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
        cursor: pointer;
        text-align: center;
    }

    .inventory .item-card:hover {
        background-color: #fffcd2;
    }

    .inventory .item-card img {
        width: 100px;
        border-radius: 3px;
        margin-bottom: 5px;
    }

    .tooltip-steamclicks {
        position: fixed;
        display: none;
        background-color: #fff;
        padding: 5px;
        border-radius: 3px;
        width: 250px;
        opacity: 1;
    }

    .tooltip-steamclicks .name {
        font-size: 12px;
        margin-bottom: 5px;
        font-weight: bold;
    }

    .tooltip-steamclicks .description {
        font-size: 11px;
        color: #0d3625;
        margin-bottom: 5px;
    }

    .tooltip-steamclicks .type {
        font-size: 11px;
        color: #0d3625;
    }

    .last-buy-game-card .price {
        border: 0;
        margin: 0;
        padding: 0;
        display: block;
        width: 100px;
        line-height: 2;
        font-size: inherit;
        border-bottom: 1px solid #eee;
        text-align: right;
    }

</style>