<template>
<div>
    <el-row :gutter="20">
        <el-col :span="24">
            <h1>New Problem</h1>
        </el-col>
        <el-col :span="24">
            <h3>Title</h3>
            <el-input v-model="contest.title" placeholder="请输入内容"></el-input>
        </el-col>
        <el-col :span="12">
            <h3>Time range</h3>
            <el-date-picker
                    v-model="contest.time"
                    type="datetimerange"
                    placeholder="选择时间范围">
            </el-date-picker>
        </el-col>
        <el-col :span="12">
            <h3>Status</h3>
            <el-select v-model="contest.private" placeholder="请选择">
                <el-option
                        v-for="item in options"
                        :label="item.label"
                        :value="item.value">
                </el-option>
            </el-select>
        </el-col>
        <el-col :span="24">
            <h3>Descript</h3>
            <quill-editor v-model="contest.description" :config="editorOption"></quill-editor>
        </el-col>
        <el-col :span="12"><h3>Problem List</h3></el-col>
        <el-col :span="12" style="margin-top: 10px">
            <el-autocomplete
                v-model="problem_tmp"
                :fetch-suggestions="querySearchAsync"
                @select="handleSelect"
                placeholder="请输入题目信息">
            </el-autocomplete>
        </el-col>
        <el-col :span="24">
            <el-table :data="contest.problems">
                <el-table-column type="index" label="#" width="100">
                </el-table-column>
                <el-table-column prop="id" label="ID" width="180">
                </el-table-column>
                <el-table-column prop="title" label="Title">
                </el-table-column>
                <el-table-column label="Alias" width="180">
                    <template scope="scope">
                        <el-input v-model="contest.problems[scope.$index].alias" ></el-input>
                    </template>
                </el-table-column>
                <el-table-column label="操作" width="100">
                    <template scope="scope">
                        <el-button @click="remove(scope.$index, contest.problems)" type="text" size="small">删除</el-button>
                    </template>
                </el-table-column>
            </el-table>
        </el-col>
        <el-col :span="24">
            <el-button type="primary" @click="submit">添加比赛</el-button>
        </el-col>
    </el-row>
</div>
</template>

<script>
    export default {
        data () {
            return {
                contest: {
                    title: 'This is title input box',
                    description: '<b>This is descript input box</b>',
                    time: [new Date(2000, 10, 10, 10, 10), new Date(2000, 10, 11, 10, 10)],
                    private: true,
                    problems: []
                },
                options:[
                    {
                        value: true,
                        label: "Private"
                    },
                    {
                        value: false,
                        label: "Public"
                    }
                ],
                problem_tmp: "",
                editorOption: {
                    theme: 'snow',
                    modules: { toolbar: this.$refs.toolbar }
                },
            }
        },
        methods: {
            handleSelect:　function (item) {
                this.contest.problems.push(item);
            },
            remove: function (index, rows) {
                rows.splice(index, 1);
            },
            submit: function () {
                var _this = this;
                axios.put("contest", _this.contest)
                    .then(function (res) {
                        _this.$message({
                            message: '恭喜你，比赛添加成功',
                            type: 'success'
                        });
                    });
            },
            querySearchAsync(queryString, cb) {
                var _this = this;
                axios.get("problem/seek", {params: {query: queryString}})
                    .then(function (res) {
                        cb(res.data);
                    });
            },
        }
    }
</script>
