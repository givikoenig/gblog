<template>
    <li>
        <a href="javascript:void(0)"><i class="fa fa-search"></i> Поиск</a>
        <div class="megamenu megamenu-half-width navbar-search searchwrap">
                <input type="text" class="form-control" placeholder="Поиск статьи…" v-debounce="delay" v-model.lazy="keywords">
                <br>
                
                <ul v-if="results.length > 0" class="post-meta listwrap">
                    <li v-for="result in results" :key="result.id">
                        <div class="linkwrap">
                            <a :href="'/posts/' + result.alias"><img :src="'/assets/img/post/'+ result.img" width="76"></a>
                            <span>{{moment(result.created_at).format('YYYY-MM-DD')}}&nbsp;&nbsp;</span>
                            <span>|&nbsp;&nbsp;{{result.user.name}}&nbsp;&nbsp;|&nbsp;&nbsp;</span>
                            <a :href="/posts/ + result.alias" v-html="highlight(result.title)">{{result.title}}</a>
                            <p v-html="result.desc.length > 200 ? result.desc.substring(0,200) + '...' : result.desc"></p>
                            <div class="cntr">--------------------------</div>
                        </div>
                    </li>
                </ul>
        </div>
    </li>
</template>

<script>
import debounce from './index';
var moment = require('moment');
export default {
    data() {
        return {
            keywords: null,
            results: [],
            delay: 700,
            moment: moment
        };
    },

    watch: {
        keywords(after, before) {
            this.fetch();
        }
    },

    methods: {
        fetch() {
            axios.get('/api/search', { params: { keywords: this.keywords } })
                .then(response => this.results = response.data)
                .catch(error => {});
        },
        highlight(text) {
            return text.replace(new RegExp(this.keywords, 'gi'), '<span class="highlighted">$&</span>');
        }
   },
    
   directives: {debounce}
}
</script>

<style>
    .searchwrap {
       background: #ededed!important; 
    }
    .listwrap {
        background: #ededed!important;
        border-radius: 0 0 0.7em 0.7em;
        /*max-height: 80rem;*/
        max-height: 90vh;
        overflow-y: scroll;
        opacity: .75;
    }
    .linkwrap {
        padding: 10px;
    }
    .listwrap li p,
    .listwrap li span {
        text-transform: none;
    }
    .cntr {
        text-align: center;
    }
    .highlighted {
        color: red;
        text-transform: uppercase!important;
    }
</style>


