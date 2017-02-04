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
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text"  v-model='keyword.id' class="form-control" placeholder="Problem ID">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <button type="button" class="btn btn-primary btn-lg m-l-15 waves-effect" v-on:click="obtain">OBTAIN</button>
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

                            <h4 v-if="problem.content">Content</h4>
                            <blockquote class="m-b-25" v-if="problem.content" v-html="problem.content">
                            </blockquote>

                            <h4 v-if="problem.input">Input</h4>
                            <blockquote class="m-b-25" v-if="problem.input" v-html="problem.input">
                            </blockquote>

                            <h4 v-if="problem.output">Output</h4>
                            <blockquote class="m-b-25" v-if="problem.output" v-html="problem.output">
                            </blockquote>

                            <h4 v-if="problem.sampleInput">Sample Input</h4>
                            <blockquote class="m-b-25" v-if="problem.sampleInput" v-html="problem.sampleInput">
                            </blockquote>

                            <h4 v-if="problem.sampleOutput">Sample Output</h4>
                            <blockquote class="m-b-25" v-if="problem.sampleOutput" v-html="problem.sampleOutput">
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
                content:"Content",
                input:"Input",
                output:"Output",
                sampleInput:"Sample Input",
                sampleOutput:"Sample Output",
                anthor:"Anthor",
                recommend:"Recommend",
                source:"Source"
            }
        };
    },
    methods:
    {
        obtain:function()
        {
            var _this = this;
            axios.post('/problem/obtain', this.keyword).then(function(res){
                console.log(res);
                _this.problem.id = res.data.id;
                _this.problem.title = res.data.title;
                _this.problem.content = res.data.content;
                _this.problem.input = res.data.input;
                _this.problem.output = res.data.output;
                _this.problem.sampleInput = res.data.sample_input;
                _this.problem.sampleOutput = res.data.sample_output;
                _this.problem.anthor = res.data.anthor;
                _this.problem.recommend = res.data.recommend;
                _this.problem.source = res.data.source;
            });
        }
    }
}
</script>
