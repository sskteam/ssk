<template>
  <div class="home">
    <header-nav></header-nav>
    <left-nav @getVal="getVal"></left-nav>
    <infoTitle ></infoTitle>
    <router-view/>
  </div>
</template>

<script>

import headerNav from "@/components/headerNav"; //引入头部导航栏
import leftNav from "@/components/leftNav"; //引入头部导航栏
import infoTitle from "@/components/infoTitle"; //引入标题

export default {
    
    components: {
        "header-nav": headerNav,
        "left-nav": leftNav,
        "infoTitle":infoTitle
    },
    data() {
        return {
          tit:""
        };
    },
    mounted() {
        
    },
    methods: {
        getVal(val) {
            this.tit = val;
            console.log(this.tit)
        }
    }
};
</script>
<style>
.box {
    float: left;
    width: 900px;
    margin-left: 24px;
}
.home {
    overflow: hidden;
    width: 100%;
}
.optionMsg{
   height: 80px; 
   border-bottom:1px solid #ebeef5;
   line-height: 80px;
  }
</style>

