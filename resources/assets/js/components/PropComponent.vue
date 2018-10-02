<template>
<!--        <div class="row justify-content-center">
                <h5>Передача данных из шаблона Blade во Vue компонент</h5>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Наименование</th>
                            <th>URL</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="url in urldata">
                            <td>{{url.title}}</td>
                            <td> <a :href="url.alias" target="_blank">{{url.alias.substring(0, 10)}}</a></td>
                        </tr>
                    </tbody>
                </table>
        </div>-->

        <div class="widget">
            <div class="heading-title-alt text-left heading-border-bottom">
                <h6 class="text-uppercase">Последние статьи</h6>
            </div>
            <ul class="widget-latest-post">
                <li v-for="url in urldata">
                    <div class="thumb">
                        <a :href="url.alias"><img :src="'/assets/public/img/post/' +  url.img"></a>
                    </div>
                    <div class="w-desk">
                        <a :href="url.alias">{{ url.title }}</a>
                    </div>
                    
                </li>
            </ul>
        </div>
</template>

<script>
    export default {
        props: [
            'urldata'
        ],
        mounted() {
            this.update()
        },
        methods: {
            update: function() {
                console.log(this.urldata);
            }
        }
    }
</script>
