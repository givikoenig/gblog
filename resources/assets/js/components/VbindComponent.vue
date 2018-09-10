<template>
    <div class="cntr panel panel-default">
      <div class="panel-heading">
       <span v-bind:title="message">
         Наведи курсор на меня на пару секунд,
         чтобы увидеть динамически связанное значение title!
       </span>
      </div>
    </div>
</template>

<script>
    export default {
     data() {
      return {
       message: 'Вы загрузили эту страницу в: ' + new Date().toLocaleString()
      }
     },
     mounted() {
        console.log('Component VbindComponent mounted.');
     }
    }
</script>

<style>
 .cntr {
   text-align: center;
 }
</style>
