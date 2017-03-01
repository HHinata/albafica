<template>
    <div>
        <el-table :data="rank.data" style="width: 100%">
            <el-table-column prop="id" label="#" width="100">
            </el-table-column>
            <el-table-column prop="name" label="Name">
            </el-table-column>
            <el-table-column prop="rating" label="Rating">
            </el-table-column>
            <el-table-column label="操作" width="100">
                <template scope="scope">
                    <el-button @click.native.prevent="handleClick(scope.$index, rank.data)" type="text" size="small">
                        查看
                    </el-button>
                </template>
            </el-table-column>
        </el-table>
        <el-row type='flex' justify='center' style="margin-top: 20px">
            <el-pagination layout="prev, pager, next" @current-change="handleCurrentChange" :total="rank.total"
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
            this.__construct();
        },
        methods: {
            __construct: function () {
                this.updateRank(1);
            },
            handleCurrentChange: function (val) {
                this.updateRank(val);
            },
            updateRank: function (val) {
                var _this = this;
                axios.get('rank', {params: {page: val}})
                    .then(function (res) {
                        _this.rank = res.data;
                    });
            },
            handleClick: function (index, rows) {
                window.location.hash = '/rank/' + rows[index].id;
            }
        }
    }
</script>
