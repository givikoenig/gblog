<template>
    <div class="cntr panel panel-default">
      <div class="panel-heading">
       {{message}}
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
        console.log('Component JustAMessageComponent mounted.')
     }
    }
</script>

<style>
 .cntr {
   text-align: center;
 }
</style>
