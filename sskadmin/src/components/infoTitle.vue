<template>
    <div class="box">
        <div class="title">{{title}}</div>
      
    </div>
</template>
<script>
import store from "@/vuex/store";
import {mapState} from "vuex";
export default {
    data() {
        return {
            
        };
    },
    /*      title 这个函数名就是模板{{函数名}}，当然这个操作也可以自定义一个方法完成，但他们的区别是
        计算属性是基于他们的依赖进行缓存的，计算属性只有在它的相关依赖发生改变时才会重新求值。也就是只有title改变的时候再回触发这个方法。

        ...展开运算符作用和字面意思一样就是展开比如
        var arr = [4,5];
        var arr2 = [1,2,3];
        arr2.push(..arr) 12345
        这里就是直接把arr展开放到arr数组最后 而不是直接把这个数据放进去
    
    */
    computed:{ 
        ...mapState({   
             title:state=>state.tit //标题
        })

    },
    store
};
</script>

<style scoped>
.title {
    width: 900px;
    text-align: center;
    font-size: 20px;
    font-family: "Helvetica Neue";
    height: 50px;
    line-height: 50px;
    border-bottom: 1px solid #ebeef5;
    font-weight: bold;
}
</style>

