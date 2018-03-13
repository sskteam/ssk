import Vue from 'vue';
import Vuex from 'vuex';




Vue.use(Vuex);
/*
    state状态对象 也就是所有的模块的共享值 谁都可以来拿
*/
const state = {
    tit:'欢迎',
}

/*
    mutations 操作state的方法，第一个参数默认是state 你要操作state当然要有state啦 第二个参数就是
    其他页面传进来的参数
*/
const mutations = {
    getTit(state,tit) { //标题
       state.tit = tit;
       
    }
}
/*
    localStorage 只能存字符串 如果要存对象 先转一下json字符串
*/
const handleStore = store => {//初始化时调用
    
    //replaceState 替换根实例的内容，这里比如要用replaceState 如果直接 = 会报错
    if(localStorage.state) store.replaceState(JSON.parse(localStorage.state))

    store.subscribe((mutation, state) => {//每次调用mutations时调用
        localStorage.setItem("state",JSON.stringify(state))
    })

}

/*
    export default的作用 模块化这个文件 然后输出Vuex.Store 在其他文件里直接import引用就可以
    比如 import 自定义名字 from 要引入文件的路径

    import 引入一个模块 但是不能放到 代码块中  import('路径') 可以放到代码块中，动态引入模块
*/

export default new Vuex.Store({
    state,
    mutations,
    plugins:[handleStore]
})