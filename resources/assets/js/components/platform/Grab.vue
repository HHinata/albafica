<template>
    <div class="container">
        <div class="row">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                PROBLEM CRAW
                            </h2>
                        </div>
                        <div class="body">
                            <form>
                                <div class="row clearfix">
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                                        <select v-model="keyword.platform">
                                          <option v-for="option in keyword.options" v-bind:value="option.value">
                                            {{ option.text }}
                                          </option>
                                        </select>
                                    </div>
                                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text"  v-model='keyword.id' class="form-control" placeholder="Problem ID">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-6">
                                        <button type="button" class="btn btn-primary btn-lg m-l-15 waves-effect" v-on:click="grab">GRAB</button>
                                    </div>
                                    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-6">
                                        <button type="button" class="btn btn-primary btn-lg m-l-15 waves-effect" v-on:click="join">JOIN</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row clearfix" v-if="problem.id">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body">
                            <h4 v-if="problem.title">Title</h4>
                            <blockquote class="m-b-25" v-if="problem.title" v-html="problem.title">
                            </blockquote>

                            <h4 v-if="problem.description">Description</h4>
                            <blockquote class="m-b-25" v-if="problem.description" v-html="problem.description">
                            </blockquote>

                            <h4 v-if="problem.input">Input</h4>
                            <blockquote class="m-b-25" v-if="problem.input" v-html="problem.input">
                            </blockquote>

                            <h4 v-if="problem.output">Output</h4>
                            <blockquote class="m-b-25" v-if="problem.output" v-html="problem.output">
                            </blockquote>

                            <h4 v-if="problem.sample_input">Sample Input</h4>
                            <blockquote class="m-b-25" v-if="problem.sample_input" v-html="problem.sample_input">
                            </blockquote>

                            <h4 v-if="problem.sample_output">Sample Output</h4>
                            <blockquote class="m-b-25" v-if="problem.sample_output" v-html="problem.sample_output">
                            </blockquote>

                            <h4 v-if="problem.anthor">Anthor</h4>
                            <blockquote class="m-b-25" v-if="problem.anthor" v-html="problem.anthor">
                            </blockquote>

                            <h4 v-if="problem.recommend">Recommend</h4>
                            <blockquote class="m-b-25" v-if="problem.recommend" v-html="problem.recommend">
                            </blockquote>

                            <h4 v-if="problem.source">Recommend</h4>
                            <blockquote class="m-b-25" v-if="problem.source" v-html="problem.source">
                            </blockquote>
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
            keyword:{
                platform:'HDU',
                options: [
                  { text: 'HDU', value: 'HDU' },
                  { text: 'POJ', value: 'POJ' }
                ],
                id:''
            },
            problem:{
                id:"",
                title:"Title",
                description:"Description",
                input:"Input",
                output:"Output",
                sample_input:"Sample Input",
                sample_output:"Sample Output",
                anthor:"Anthor",
                recommend:"Recommend",
                source:"Source"
            }
        };
    },
    methods:
    {
        grab:function()
        {
            var _this = this;
            axios.post('/plat/grab', this.keyword).then(function(res){
                console.log(res);
                _this.problem.id = res.data.id;
                _this.problem.title = res.data.title;
                _this.problem.description = res.data.description;
                _this.problem.input = res.data.input;
                _this.problem.output = res.data.output;
                _this.problem.sample_input = res.data.sample_input;
                _this.problem.sample_output = res.data.sample_output;
                _this.problem.anthor = res.data.anthor;
                _this.problem.recommend = res.data.recommend;
                _this.problem.source = res.data.source;
                _this.problem.platform = _this.keyword.platform;
                _this.problem.sign = _this.keyword.id;
                console.log(_this.problem);
            });
        },
        join:function()
        {
            axios.post('/problem', this.problem).then(function(res){
                console.log(res);
            });
        }
    }
}
</script>
