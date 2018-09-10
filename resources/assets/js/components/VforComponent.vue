<template>
    <div class="panel panel-default">
      <div class="panel-heading">
        <ol>
         <li v-for="todo in todos">
          {{ todo.text }}
         </li>
        </ol>
      </div>
    </div>
</template>

<script>
    
    export default {
    
    data() {
      return {
        todos: [
          { text: 'Изучить JavaScript' },
          { text: 'Изучить Vue' },
          { text: 'Создать что-нибудь классное' }
        ]
      }
     },
     mounted() {
        console.log('Component VforComponent mounted.')
     }
    }
</script>

<style>
 .cntr {
   text-align: center;
 }
</style>
