<template>
<div class="body table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>TITLE</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(problem, index) in contest.problems">
                <th scope="row">{{ problem.id }}</th>
                <td><router-link :to="{ path: 'detail', query:{pid:index}}">
                    {{ problem.title }}
                </router-link></td>
            </tr>
        </tbody>
    </table>
</div>
</template>

<script>
import axios from 'axios'
import headerPart from '../part/header'
export default {
    data: function(){
        return {
            id:1,
            contest:{}
        };
    },
    components: {headerPart},
    mounted: function () {
        var q = this.$route.query;
        this.id = q.id?q.id:1;
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
