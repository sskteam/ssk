<template>
    <div>
        <div class="header">
            <div class="name" @click="goWelcome"> SSk企业网管理平台欢迎您</div>

            <!-- 这里不能再el上写组件上写事件 定义组件事件的话不能有（）不然就是一个方法的名字了 -->
            <!-- <el-col :span="2" class="loginout" :push="4"></el-col> -->
            <div  @click="loginout" class="log">退出</div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {};
    },
   
   
    methods: {
        // 退出
        loginout() {
            this.$router.push({path:"/login"});
        },
        goWelcome() {
             this.$router.push({path:"/welcome"});
        }
    }
};
</script>


<style scoped>
.header {
    background-color: #242F42;
    color: #fff;
    height: 80px;
    line-height: 80px;
    display:flex;
    justify-content: space-between;
}
.name{
    font-size: 25px;
    margin-left: 50px;
}
.log{
    margin-right: 50px;
}
</style>
