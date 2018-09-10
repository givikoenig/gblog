<template>
    <div class="cntr panel panel-default">
      <div class="panel-heading">
       <p>{{ message }}</p>
       <button class="btn btn-default btn-sm" v-on:click="reverseMessage">Перевернуть сообщение</button>
      </div>
    </div>
</template>

<script>
    export default {
     data() {
      return {
       message: 'Привет, Vue.js!'
      };
     },
     methods: {
      reverseMessage: function () {
       this.message = this.message.split('').reverse().join('')
      }
     },
     mounted() {
        console.log('Component VonComponent mounted.')
     }
    }
</script>

<style>
 .cntr {
   text-align: center;
 }
</style>
