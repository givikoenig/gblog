<template>
    <div class="chartwrap">
        <div class="charttitle">
            <h5 v-if="id == 10"> Admin panel</h5>
            <h5 v-else> User browser</h5>
        </div>
        <div class="row">
            <line-chart :chart-data="data" :height="100" :options="{responsive: true, maintainAspectRatio: true}"></line-chart>
        </div>
        <div class="row">
            <div class="form-group"  v-if="id == 10">
                <div class="col-sm-2 checkbox">
                    <label  class="rt-check">
                        <input type="checkbox" v-model="realtime"> RealTime
                    </label>
                </div>
                <div class="col-sm-4">
                    <input type="text" v-model="label" placeholder="Добавьте месяц" class="form-control">
                </div>
                <div class="col-sm-4">
                    <input type="text" v-model="sale" placeholder="Введите данные" class="form-control">
                </div>
                <div class="col-sm-2">
                    <button @click="sendData" class="btn btn-extra-small btn-dark-solid  btn-transparent">Обновить</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import LineChart from './LineChart.js'
    export default {
        components: {
            LineChart
        },
        data: function() {
            return {
                data: [],
                realtime: false,
                label: "",
                sale: null,
                id: 10
            };
        },
        mounted() {
            var socket = io('http://givik.ru:3000');
            var app = this;
            socket.on("news-action:App\\Events\\NewEvent", function(data) {
                app.data = data.result;
            });
            this.id = this._uid;
            this.update();
        },
        methods: {
            update: function() {
                axios.get('/socket-chart').then((response) => {
                    this.data = response.data;
                });

            },
            sendData: function() {
                axios({
                    method: 'get',
                    url: '/socket-chart',
                    params:{ label: this.label, sale: this.sale, realtime: this.realtime}
                }).then((response) => {
                    this.data = response.data;
                });
            }
        }
    }
</script>

<style>
    .rt-check {
      color: #999;
    }
    .chartwrap {
        margin: 5rem 0;
        border: solid 1px #cecece;
        border-radius: 5px;
    }
    .chartwrap .row {
      padding: 30px;
    }
    .charttitle {
            text-align: center;
    }
</style>