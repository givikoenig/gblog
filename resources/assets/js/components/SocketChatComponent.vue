<template>
    <div class="chartwrap">
        <div class="row">
            <div class="form-group">
                <div class="col-sm-12">
                    <textarea rows="6" readonly="" class="form-control">{{ dataMessages.join('\n') }}</textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-8">
                    <input type="text" class="form-control" placeholder="Наберите сообщение" v-model="message">
                </div>
                <div class="col-sm-4">
                    <button  @click="sendMessage" class="btn btn-small btn-dark-solid  btn-transparent" type="button">Отправить</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        
        data: function() {
            return {
                dataMessages: [],
                message: "",
            };
        },
        mounted() {
            var socket = io('http://givik.ru:3000');
            socket.on("news-action:App\\Events\\NewMessage", function(data) {
                this.dataMessages.push(data.message);
            }.bind(this));
        },
        methods: {
            sendMessage: function() {
                axios({
                    method: 'get',
                    url: '/send-message',
                    params:{ message: this.message}
                }).then((response) => {
                    this.message = "";
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
    .chartwrap .form-control,
    .chartwrap .btn{
            margin: 15px 0;
    }
    .charttitle {
            text-align: center;
    }
</style>