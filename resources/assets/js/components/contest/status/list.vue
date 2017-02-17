<template>
<div class="body table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>PID</th>
                <th>TIME</th>
                <th>MEMERY</th>
                <th>RESULT</th>
                <th>LANGUAGE</th>
                <th>CREATE TIME</th>
                <th>USER</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="solution in solutions">
                <th scope="row">{{ solution.id }}</th>
                <td>{{ solution.problem_id }}</td>
                <td>{{ solution.time }}</td>
                <td>{{ solution.memory }}</td>
                <td>{{ solution.result }}</td>
                <td>{{ solution.language }}</td>
                <td>{{ solution.created_at }}</td>
                <td>{{ solution.user.name }}</td>
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
            solutions:[],
            contest:{}
        };
    },
    components:{headerPart},
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
            axios.get('/i/solution/in-contest/'+this.id).then(function(res){
                _this.solutions = res.data;
            });
            axios.get('/i/contest/detail/'+this.id).then(function(res){
                _this.contest = res.data;
                console.log(res.data);
            });
        }
    }
}
</script>
