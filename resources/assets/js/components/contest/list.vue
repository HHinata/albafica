<template>
    <div class="container">
        <div class="row">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                CONTEST TABLES
                                <small>Basic example without any additional modification classes</small>
                            </h2>
                        </div>
                        <div class="body table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>TITLE</th>
                                        <th>START TIME</th>
                                        <th>END TIME</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="contest in contests">
                                        <th scope="row">{{ contest.id }}</th>
                                        <td><router-link :to="{ path: 'detail?id=' + contest.id }">{{ contest.title }}</router-link></td>
                                        <td>{{ contest.start_time | time }}</td>
                                        <td>{{ contest.end_time | time}}</td>
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
export default {
    data(){
        return {
            contests:[]
        };
    },
    mounted:function(){
        this.getContests();
    },
    methods:
    {
        getContests:function()
        {
            var _this = this;
            axios.get('/i/contest/list').then(function(res){
                _this.contests = res.data;
            });
        }
    }
}
</script>
