<template>
    <div class="container">
        <div class="row">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                {{ contest.title }}
                                <small>{{ contest.description }}</small>
                            </h2>
                        </div>
                        <div class="body">
                            <div class="progress">
                                <div class="progress-bar" role="progressbar"
                                aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%;">
                                    {{ contest.start_time | time }} - {{ contest.end_time | time }}
                                </div>
                            </div>
                            <nav-btn-group :cid="id"></nav-btn-group>
                        </div>
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
                                        <td><router-link :to="{ path: '/contest/problem/detail', query:{id:id,pid:index}}">
                                            {{ problem.title }}
                                        </router-link></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
import navBtnGroup from './part/C-nav-btn-group'
export default {
    data(){
        return {
            id:1,
            contest:{}
        };
    },
    components: {navBtnGroup},
    mounted:function(){
        var q = this.$route.query;
        this.id = q.id?q.id:1;

        this.__construct();
    },
    methods:
    {
        __construct:function()
        {
            var _this = this;
            axios.get('/i/contest/detail/'+this.id)
            .then(function(res){
                _this.contest = res.data;
                console.log(res.data);
            });
        }
    }
}
</script>
