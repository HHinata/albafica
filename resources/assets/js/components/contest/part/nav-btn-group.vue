<template>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 align-center">
    <div class="btn-group" role="group" aria-label="Default button group">
        <router-link :to="{ path: '/contest/detail/'+cid }" type="button" class="btn bg-cyan waves-effect">
            Overview
        </router-link>
        <router-link :to="{ path: '/contest/detail/'+cid+'/problem/detail' }" type="button" class="btn bg-cyan waves-effect">
            Problem
        </router-link>
        <router-link :to="{ path: '/contest/detail/'+cid+'/status/list' }" type="button" class="btn bg-cyan waves-effect">
            Status
        </router-link>
        <router-link :to="{ path: '/contest/detail/'+cid+'/rank' }" type="button" class="btn bg-cyan waves-effect">
            Rank
        </router-link>
    </div>
</div>/detail
</template>

<script>
import axios from 'axios'
export default {
    data: function(){
        return {
        };
    },
    props:['cid']
}
</script>
