<template>
    <div class="left">
        <el-menu :default-active="$route.path" :router="true" class="el-menu-vertical-demo" background-color="#324157" text-color="#FFF">
            <el-submenu index="1">
                <template slot="title">
                    <i class="el-icon-location"></i>
                    <span>管理员管理</span>
                </template>
                <el-menu-item-group>
                    <div @click="setVal">
                        <el-menu-item index="/admin">管理员列表</el-menu-item>
                    </div>
                </el-menu-item-group>
            </el-submenu>

            <el-submenu index="2">
                <template slot="title">
                    <i class="el-icon-location"></i>
                    <span>公司介绍管理</span>
                </template>
                <el-menu-item-group>
                    <div @click="setVal">
                        <el-menu-item index="/introdList">公司介绍列表</el-menu-item>
                    </div>
                    <div @click="setVal">
                        <el-menu-item index="/addInfo">信息添加</el-menu-item>
                    </div>
                </el-menu-item-group>
            </el-submenu>

            <el-submenu index="3">
                <template slot="title">
                    <i class="el-icon-location"></i>
                    <span>产品管理</span>
                </template>
                <el-menu-item-group>
                    <div @click="setVal">
                        <el-menu-item index="/goodsClass">产品类别</el-menu-item>
                    </div>
                    <div @click="setVal">
                        <el-menu-item index="/goodsInfo">产品信息</el-menu-item>
                    </div>
                </el-menu-item-group>
            </el-submenu>

            <el-submenu index="4">
                <template slot="title">
                    <i class="el-icon-location"></i>
                    <span>公益事业</span>
                </template>
                <el-menu-item-group>
                    <div @click="setVal">
                        <el-menu-item index="/welfareList">公益事业管理列表</el-menu-item>
                    </div>
                    <div @click="setVal">
                        <el-menu-item index="/welfareAdd">公益事业信息增加</el-menu-item>
                    </div>
                </el-menu-item-group>
            </el-submenu>

            <el-submenu index="5">
                <template slot="title">
                    <i class="el-icon-location"></i>
                    <span>新闻管理</span>
                </template>
                <el-menu-item-group>
                    <div @click="setVal">
                        <el-menu-item index="/newsList">新闻列表</el-menu-item>
                    </div>
                    <div @click="setVal">
                        <el-menu-item index="/newsAdd">新闻增加</el-menu-item>
                    </div>
                </el-menu-item-group>
            </el-submenu>

            <el-submenu index="6">
                <template slot="title">
                    <i class="el-icon-location"></i>
                    <span>ssk全球管理列表</span>
                </template>
                <el-menu-item-group>
                    <div @click="setVal">
                        <el-menu-item index="/sskEarchList">ssk全球管理管理列表</el-menu-item>
                    </div>
                    <div @click="setVal">
                        <el-menu-item index="/sskEarchAdd">ssk全球信息增加</el-menu-item>
                    </div>
                </el-menu-item-group>
            </el-submenu>

            <el-submenu index="7">
                <template slot="title">
                    <i class="el-icon-location"></i>
                    <span>联系我们</span>
                </template>
                <el-menu-item-group>
                    <div @click="setVal">
                        <el-menu-item index="/contactMeList">联系我们列表</el-menu-item>
                    </div>
                    <div @click="setVal">
                        <el-menu-item index="/contactAdd">信息增加</el-menu-item>
                    </div>
                </el-menu-item-group>
            </el-submenu>

            <el-submenu index="8">
                <template slot="title">
                    <i class="el-icon-location"></i>
                    <span>左侧链接</span>
                </template>
                <el-menu-item-group>
                    <div @click="setVal">
                        <el-menu-item index="/urlAdmin">左侧链接管理</el-menu-item>
                    </div>
                    <div @click="setVal">
                        <el-menu-item index="/infoAdd">信息增加</el-menu-item>
                    </div>
                </el-menu-item-group>
            </el-submenu>

            <el-submenu index="9">
                <template slot="title">
                    <i class="el-icon-location"></i>
                    <span>ssk网站信息管理</span>
                </template>
                <el-menu-item-group>
                    <div @click="setVal">
                        <el-menu-item index="/sskInfoList">ssk网站信息列表</el-menu-item>
                    </div>
                    <div @click="setVal">
                        <el-menu-item index="/sskInfoAdd">ssk网站信息增加</el-menu-item>
                    </div>
                </el-menu-item-group>
            </el-submenu>

            <el-submenu index="10">
                <template slot="title">
                    <i class="el-icon-location"></i>
                    <span>ssk网站banner图切换</span>
                </template>
                <el-menu-item-group>
                    <div @click="setVal">
                        <el-menu-item index="/bannerInfo">ssk网站banner图切换信息</el-menu-item>
                    </div>
                    <div @click="setVal">
                        <el-menu-item index="/bannerAdd">ssk网站banner图切换信息增加</el-menu-item>
                    </div>
                </el-menu-item-group>
            </el-submenu>

        </el-menu>

    </div>
</template>

<script>
import store from "@/vuex/store";
import { mapState } from "vuex";

export default {
    data() {
        return {
            t: true
        };
    },
    methods: {
        setVal(e) {
            //这是我在上边定义好的点击事件，点击更换标题，改变vuex里面的数据
            var val = e.srcElement.innerText;
            //$store.commit()第一个参数是要触发mutation里面函数的名字 第二个是要传入的参数
            // 往mutations里面的getTIT 传值
            store.commit("getTit", val);
        }
    }
};
</script>
<style>
.el-submenu .el-menu-item {
    min-width: 0;
}
.el-menu-vertical-demo {
    width: 250px;
}
.left {
    float: left;
}
</style>
