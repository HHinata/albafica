<template>
    <div>
        <el-table :data="rank.data" style="width: 100%">
            <el-table-column type="index" label="#" width="100">
            </el-table-column>
            <el-table-column label="Name">
                <template scope="scope">
                    <a :href="'#/home/'+rank.data[scope.$index].name">
                        {{rank.data[scope.$index].name}}
                    </a>
                </template>
            </el-table-column>
            <el-table-column prop="info" label="">
            </el-table-column>
            <el-table-column prop="rating" label="Rating" width="100">
            </el-table-column>
        </el-table>
        <el-row type='flex' justify='center' style="margin-top: 20px">
            <el-pagination layout="prev, pager, next" @current-change="pageSwitch" :total="rank.total"
                           :page-size="rank.per_page">
            </el-pagination>
        </el-row>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                rank: {
                    data: []
                }
            };
        },
        mounted() {
            this.update(1);
        },
        methods: {
            pageSwitch: function (val) {
                this.update(val);
            },
            update: function (val) {
                var _this = this;
                axios.get('rank', {params: {page: val}})
                    .then(function (res) {
                        _this.rank = res.data;
                    });
            }
        }
    }
</script>
