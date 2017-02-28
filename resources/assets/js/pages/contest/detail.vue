<template>
<div>
    <div class='caption'>
      <h2>{{ contest.title }}</h2>
    </div>
    <div class='content'>
        <h3>Desc</h3>
            <blockquote>{{ contest.desc }}</blockquote>
        <el-table :data="contest.problem_list" stripe style="width: 100%">
            <el-table-column prop="order" label="#" width="180">
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
                }
            };
        },
        props: ['cid'],
        mounted() {
            this.__construct();
        },
        methods: {
            __construct: function () {
                console.log(this.cid);
                var _this = this;
                axios.get('contest/detail', { params: { id: this.cid }})
                .then(function(res) {
                    _this.contest = res.data;
                    console.log(_this.contest);
                });
            },
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