<template>
    <div class="cntr panel panel-default">
      <div class="cpanel-heading">
        <pacman-loader class="custom-class" :color="color" :loading="loading" :size="size"></pacman-loader>
      </div>
    </div>
</template>

<script>
    import { PacmanLoader } from '@saeris/vue-spinners'

    export default {
     components: {
       PacmanLoader
     },
     data() {
      return {
       loading: true,
       color: '#50E3C2',
       size: 30
      };
     },
     mounted() {
        console.log('Component SpinnerComponent mounted.');
     }
    }
</script>

<style>
 .cntr {
   text-align: center;
 }
 .cpanel-heading {
   display: inline-block;
   float:left;
 }
</style>
