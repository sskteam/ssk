
<template>
    <div class="box">
        我是第一个欢迎页面
    </div>
</template>

<script>

import store from "@/vuex/store";
import { mapState } from "vuex";

export default {
    created() {
        store.commit('getTit','欢迎') 
    }
};
</script>
