<template>
    <div>
        <table class="table">
            <tr>
                <th style="width: 100px">UserName</th>
                <th style="width: 100px">Time</th>
                <th v-for="item in rank['problems']">{{item.title}}</th>
            </tr>
            <tr v-for="item in rank['rank']">
                <td>{{item.name}}</td>
                <td>{{item.time}}</td>
                <td v-for="value in item['info']">{{value.submited}}/{{value.solved}}</td>
            </tr>
        </table>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                rank: [
                    [],
                ]
            }
        },
        props: ['cid'],
        mounted: function () {
            var _this = this;
            axios.get('contest/rank', { params: { id: this.cid }})
                .then(function(res) {
                    _this.rank = res.data;
                });
        }
    }
</script>

<style>
    .table{
        font-size:12px;
    }
    .table{
        table-layout:fixed;
        empty-cells:show;
        border-collapse: collapse;
        margin:0 auto;
    }
    .table td{
        height:30px;
    }
    .table{
        border:1px solid #cad9ea;
        width: 100%;
        color:#666;
    }
    .table th {
        background-repeat:repeat-x;
        height:30px;
    }
    .table td,.table th{
        border:1px solid #cad9ea;
        padding:0 1em 0;
    }
    .table tr.alter{
        background-color:#f5fafe;
    }
</style>