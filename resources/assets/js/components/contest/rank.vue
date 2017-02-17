<template>
<div class="body table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th v-for="problem in contest.problems">{{problem.id}}</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(value, key, index) in ranks">
                <td>{{value.user_id}}</td>
                <td v-for="item in value.result">{{item.up}}/{{item.down}}</td>
            </tr>
        </tbody>
    </table>
</div>
</template>

<script>
import axios from 'axios'
import headerPart from './part/header'
export default {
    data: function(){
        return {
            id:1,
            ranks:[],
            contest:{}
        };
    },
    components: {headerPart},
    mounted:function(){
        var query = this.$route.query;
        if(query.id)    this.id = query.id;
        this.__construct();
    },
    methods:
    {
        __construct:function()
        {
            var _this = this;
            axios.get('/i/contest/rank/'+this.id).then(function(res){
                _this.ranks = res.data;
            });
        }
    }
}
</script>
