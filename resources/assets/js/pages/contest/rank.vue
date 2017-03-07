<template>
    <div>
        <el-table :data="tableData">
            <el-table-column  prop="date" label="日期">
            </el-table-column>
            <el-table-column  prop="date" label="日期">
            </el-table-column>
            <el-table-column  prop="date" label="日期">
            </el-table-column>
        </el-table>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                rank: []
            }
        },
        props: ['cid'],
    }
</script>