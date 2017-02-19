<template>
    <div class="container-fluid">
        <div class="row">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                ACCOUNT TABLES
                                <small>Basic example without any additional modification classes</small>
                            </h2>
                        </div>
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
            solutions:[]
        };
    },
    mounted:function(){
        this.getProblems();
    },
    methods:
    {
        getProblems:function()
        {
            var _this = this;
            axios.get('/i/solution/in-problem').then(function(res){
                _this.solutions = res.data;
            });
        }
    }
}
</script>
