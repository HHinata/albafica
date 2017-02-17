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
                                        <th>=</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="contest in contests">
                                        <th scope="row">{{ contest.id }}</th>
                                        <td>{{ contest.title }}</td>
                                        <td>{{ contest.start_time }}</td>
                                        <td>{{ contest.end_time }}</td>
                                        <td><router-link :to="{ path: 'detail?id=' + contest.id }">修改</router-link></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="body table-responsive">
                            <div class="col-sm-12">
                                <router-link type="button" class="btn btn-primary btn-lg m-l-15 waves-effect"
                                :to="{ path: 'detail'}">
                                Add</router-link>
                            </div>
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
    data: function(){
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
            axios.get('/contest').then(function(res){
                _this.contests = res.data;
            });
        }
    }
}
</script>
