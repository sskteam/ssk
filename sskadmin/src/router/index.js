import Vue from 'vue'
import Router from 'vue-router'
import login from '@/pages/login/login'                                   //登录
import home from '@/pages/home/home'                                      //首页

import welcome from '@/children/welcome/welcome'                          //欢迎
//管理员管理
import admin from '@/children/admin/admin'                                //管理员列表
import adminWrite from '@/children/admin/adminWrite'                      //编辑    
import addAdmin from '@/children/admin/addAdmin'                          //增加    
   
// 公司介绍管理
import introdList from '@/children/introduceAdmin/introdList'             //公司介绍列表
import addInfo from '@/children/introduceAdmin/addInfo'                   //信息添加
// 产品管理
import goodsClass from '@/children/goodsAdmin/goodsClass'                 //产品类别  
import goodsInfo from '@/children/goodsAdmin/goodsInfo'                   //产品信息
import goodsAdminChild from '@/children/goodsAdmin/goodsAdminChild'       //信息添加

// 公益事业
import welfareAdd from '@/children/welfareCause/welfareAdd'               //公益事业信息增加  
import welfareList from '@/children/welfareCause/welfareList'             //公益事业列表 
// 新闻管理
import newsList from '@/children/newsAdmin/newsList'                      //新闻列表  
import newsAdd from '@/children/newsAdmin/newsAdd'                        //新闻增加 
//ssk全球管理列表
import sskEarchAdd from '@/children/sskEarth/sskEarchAdd'                 //增加  
import sskEarchList from '@/children/sskEarth/sskEarchList'               //列表 
//联系我们
import contactAdd from '@/children/contactMe/contactAdd'                  //增加  
import contactMeList from '@/children/contactMe/contactMeList'            //列表 
//左侧链接
import infoAdd from '@/children/leftUrl/infoAdd'                          //增加  
import urlAdmin from '@/children/leftUrl/urlAdmin'                        //管理 
//ssk网站信息管理
import sskInfoAdd from '@/children/sskInfo/sskInfoAdd'                    //增加  
import sskInfoList from '@/children/sskInfo/sskInfoList'              //列表 
//banner图
import bannerAdd from '@/children/banner/bannerAdd'                      //增加  
import bannerInfo from '@/children/banner/bannerInfo'                    //列表 



   


Vue.use(Router)

/*
  @ / 就是首页 暂时先这么理解吧
  @path 是跳转途径 可以随便定义 to=/path
  @component 就是通过import导入的那个组件
  @children 子路由
*/
export default new Router({
  
  routes: [
    {
      path: '/',redirect: '/home', children: [

        { path: '/', name: 'admin', redirect: '/admin' },
      ]
    },
   

    { path: '/login', component: login },

    {
      path: '/home', component: home, children: [
        // 欢迎页面
        // { path: '/', name: 'welcome3', redirect: '/welcome'},
        // { path: '/welcome', name: 'welcome', component: welcome },
        // 管理员管理
        { path: '/', name: 'admin2', redirect: '/admin' },
        { path: '/admin', name: 'admin', component: admin },
        { path: '/adminWrite', name: 'adminWrite', component: adminWrite },
        { path: '/addAdmin', name: 'addAdmin', component: addAdmin },
        // 公司介绍管理
        { path: '/introdList', name: 'introdList', component: introdList },
        { path: '/addInfo', name: 'addInfo', component: addInfo },
        // 产品管理
        { path: '/goodsClass', name: 'goodsClass', component: goodsClass },
        { path: '/goodsInfo', name: 'goodsInfo', component: goodsInfo },
        { path: '/goodsAdminChild', name: 'goodsAdminChild', component: goodsAdminChild },
        // 公益事业
        { path: '/welfareAdd', name: 'welfareAdd', component: welfareAdd },
        { path: '/welfareList', name: 'welfareList', component: welfareList },
        // 新闻管理
        { path: '/newsList', name: 'newsList', component: newsList },
        { path: '/newsAdd', name: 'newsAdd', component: newsAdd },
        // ssk全球管理列表
        { path: '/sskEarchAdd', name: 'sskEarchAdd', component: sskEarchAdd },
        { path: '/sskEarchList', name: 'sskEarchList', component: sskEarchList },
        // 联系我们
        { path: '/contactAdd', name: 'contactAdd', component: contactAdd },
        { path: '/contactMeList', name: 'contactMeList', component: contactMeList },
        // 左侧链接
        { path: '/infoAdd', name: 'infoAdd', component: infoAdd },
        { path: '/urlAdmin', name: 'urlAdmin', component: urlAdmin },
        // ssk网站信息管理
        { path: '/sskInfoAdd', name: 'sskInfoAdd', component: sskInfoAdd },
        { path: '/sskInfoList', name: 'sskInfoList', component: sskInfoList },
        // banner图
        { path: '/bannerAdd', name: 'bannerAdd', component: bannerAdd },
        { path: '/bannerInfo', name: 'bannerInfo', component: bannerInfo },

      ]
    },
  ]
})
