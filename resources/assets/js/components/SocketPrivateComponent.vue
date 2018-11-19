<template>
    <div class="chartwrap">
        <div class="row">
            <p>Я - {{user.name}}</p>
            <div class="form-group">
                <div class="col-sm-4">
                    <label for="sel1" ><small>Выбери получателей ( никому - значит всем ):</small></label>
                    <select multiple="" class="form-control" v-model="usersSelect" id="sel1">
                        <option v-for="suser in dbusers" :value="'news-action.' + suser.id">{{suser.name}}</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <textarea rows="6" readonly="" class="form-control">{{ dataMessages.join('\n') }}</textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-8">
                    <!--@keyup.enter="sendMessage"-->
                    <input  type="text" class="form-control" placeholder="Наберите сообщение" v-model="message">
                </div>
                <div class="col-sm-4">
                    <button @click="sendMessage" class="btn btn-small btn-dark-solid btn-transparent" :disabled="!message.length || message.trim() === ''" type="button">Отправить</button>
                </div>
                <!--{{dbusers}}-->
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
                usersSelect: [],
                dbusers: [],
            };
        },
        props: [
           'user'
        ],
        created() {
            var socket = io('http://givik.ru:3300');
            socket.on("news-action." + this.user.id + ":App\\Events\\PrivateMessage", function(data) {
                this.dataMessages.push(data.message.user + ': ' + data.message.message);
            }.bind(this));
            
            socket.on("news-action.:App\\Events\\PrivateMessage", function(data) {
//                if (data.message.user !== this.user.name)
                    this.dataMessages.push(data.message.user + ': ' + data.message.message);
            }.bind(this));
            this.update();
        },
        methods: {
            update: function(){
                axios.get('/get-db-data').then((response) => {
                    this.dbusers = response.data.dbusers;
                });
            },
            sendMessage: function() {
                if (!this.usersSelect.length)
                    this.usersSelect.push('news-action.');
                axios({
                    method: 'get',
                    url: '/send-private-message',
                    params:{channels: this.usersSelect, message: this.message, user: this.user.name}
                }).then((response) => {
                    this.dataMessages.push(this.user.name + ': ' + this.message);
                    this.message = "";
                });
            }
        },
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
    small {
       font-weight: 400;
       color: #7e7e7e;
    }
/*    textarea {
        background-color: transparent!important;
    }*/
</style>