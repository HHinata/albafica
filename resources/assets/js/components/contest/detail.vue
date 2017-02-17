<template>
    <div class="container">
        <div class="row">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <header-part :cid='id'></header-part>
                        <router-view></router-view>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
import headerPart from './part/header'
export default {
    data: function () {
        return {
            id: 1,
            contest: {}
        };
    },
    components: {headerPart},
    mounted: function () {
        this.id = this.$route.params.id;
        this.__construct();
    },
    methods: {
        __construct: function () {
            var _this = this;
            axios.get('/i/contest/detail/'+this.id)
            .then(function (res) {
                _this.contest = res.data;
            });
        }
    }
}
</script>
