<template>
    <div class="card card-default">
        <h5>{{ colors.hex }}
        <br />
            {{ 'rgba(' + colors.rgba.r + ', ' + colors.rgba.g + ', ' + colors.rgba.b + ', ' + colors.rgba.a + ')' }}
        <br />
            {{ 'hsla(' + Math.round(colors.hsl.h) + ', ' + Math.round(colors.hsl.s*100)  + '%, ' + Math.round(colors.hsl.l*100) + '%, ' + colors.hsl.a + ')' }}
        </h5>
        <div class="card-fbody"  :style="{ background: colors.hex, opacity: colors.a }"></div>
        <div class="card-body">   
            <div class="wrap mb-5" >
                <chrome-picker v-model="colors" />
            </div>
        </div>
    </div> 
</template>

<script>
var VueColor = require('vue-color');
var colors = {
    hex: '#C3DFA4',
    hsl: { h: 88, s: 0.48, l: 0.76, a: 1 },
    rgba: { r: 195, g: 223, b: 164, a: 1 },
    a: 1
};
export default {
    components:  {
        'photoshop-picker': VueColor.Photoshop,
        'material-picker': VueColor.Material,
        'compact-picker': VueColor.Compact,
        'chrome-picker': VueColor.Chrome
    },
    data: function() {
        return {
          colors
        };
    }
}
</script>

<style>
    .mb-5 {
       margin-bottom: 20px;
    }
    .card-fbody {
        height: 50px;
    }
    .card h5 {
        padding: 10px;
    } 
    .wrap > div{
        margin-left: auto;
        margin-right: auto;
    }
</style>