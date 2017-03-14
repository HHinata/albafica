<template>
<div>
    <div class='caption'>
      <h2>{{ contest.title }}</h2>
      <h4>{{ timestamp|time }}</h4>
    </div>
    <div class='content'>
        <el-row>
            <el-col :span="4">{{ contest.start_time|time }}</el-col>
            <el-col :span="4" :offset="16">{{ contest.end_time|time }}</el-col>
            <el-col :span="24" style="margin-top: 10px">
                <el-progress :text-inside="true" :stroke-width="18" :percentage="speed"></el-progress>
            </el-col>
        </el-row>
        <h3>Desc</h3>
        <blockquote v-html="contest.desc"></blockquote>
        <el-table :data="contest.problems" stripe style="width: 100%">
            <el-table-column type="index" label="#" width="180">
            </el-table-column>
            <el-table-column prop="title" label="Title">
            </el-table-column>
            <el-table-column prop="submited" label="Submited" width="180">
            </el-table-column>
            <el-table-column prop="solved" label="Solved" width="180">
            </el-table-column>
            <el-table-column prop="solved" label="Solved" width="180">
            </el-table-column>
            <el-table-column label="Op" width="180">
                <template scope="scope">
                    <el-button @click.native.prevent="show(scope.$index)"  type="text" size="small">查看</el-button>
                    <el-button @click.native.prevent="submit(scope.$index)"  type="text" size="small">提交</el-button>
                </template>
            </el-table-column>
        </el-table>
    </div>
</div>
</template>

<script>
    export default {
        data: function () {
            return {
                contest: {
                },
                speed: 0,
                timestamp: 0
            };
        },
        props: ['cid'],
        mounted() {
            var _this = this;
            axios.get('contest/detail', { params: { id: this.cid }})
                .then(function(res) {
                    _this.contest = res.data;
                    setInterval(function () {
                        var timestamp = (new Date()).valueOf()/1000;
                        _this.timestamp = timestamp;
                        if (timestamp < _this.contest.start_time)    _this.speed = 0;
                        else if (timestamp > _this.contest.end_time)    _this.speed = 100;
                        else
                            _this.speed = parseInt((timestamp-_this.contest.start_time)/(_this.contest.end_time-_this.contest.start_time) * 100);
                    }, 1000);
                });
        },
        methods: {
            show: function (index) {
                this.$emit('show', index);
            },
            submit: function (index) {
                this.$emit('submit', index);
            }
        },
        watch: {
            cid: function () {
                var _this = this;
                axios.get('contest/detail', { params: { id: this.cid }})
                .then(function(res) {
                    _this.contest = res.data;
                    console.log(_this.contest);
                });
            }
        }
    }
</script>

<style>
    .caption {
        text-align: center;
    }
    .footer {
        margin-top: 20px;
        text-align: center;
    }
</style>