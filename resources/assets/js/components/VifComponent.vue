<template>
    <div class="cntr panel panel-default">
      <div class="panel-heading">
       <span v-if="seen">Сейчас меня видно</span>
      </div>
    </div>
</template>

<script>
    export default {
     data() {
      return {
       seen: true
      }
     },
     mounted() {
        console.log('Component VifComponent mounted.')
     }
    }
</script>

<style>
 .cntr {
   text-align: center;
 }
</style>
