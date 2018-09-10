<template>
    <div class="cntr panel panel-default">
      <div class="panel-heading">
       <p>{{ message }}</p>
       <input class="form-control" v-model="message">
      </div>
    </div>
</template>

<script>
    export default {
     data() {
      return {
       message: 'Привет, Vue!'
      }
     },
     mounted() {
        console.log('Component VmodelComponent mounted.')
     }
    }
</script>

<style>
 .cntr {
   text-align: center;
 }
</style>
