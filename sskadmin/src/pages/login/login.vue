<template>
    <div>
        <div class="tit">SSK企业网站管理平台</div>
        <div class="login_box">
            <el-form :model="ruleForm2" status-icon :rules="rules2" ref="ruleForm2" class="demo-ruleForm">
                <el-form-item label="账号" prop="useName">
                    <el-input v-model="ruleForm2.useName" auto-complete="off"></el-input>
                </el-form-item>
                <el-form-item label="密码" prop="pass">
                    <el-input type="password" v-model="ruleForm2.pass" auto-complete="off"></el-input>
                </el-form-item>
                <el-form-item>
                    <el-button type="primary" @click="login()">登录</el-button>
                </el-form-item>
            </el-form>
        </div>
    </div>
</template>

<script>

import store from "@/vuex/store";
import {mapState} from 'vuex';

export default {
    data() {
        //账号
        var userName = (rule, value, callback) => {
            if (value === "") {
                callback(new Error("请输入账号"));
                this.isLogin = false;
            } else if (value.length < 4) {
                callback(new Error("不能小于四位"));
                this.isLogin = false;
            } else {
                callback();
                this.isLogin = true;
            }
        };

        // 密码
        var validatePass = (rule, value, callback) => {
            if (value === "") {
                callback(new Error("请输入密码"));
                this.isLogin2 = false;
            } else if (value.length < 6) {
                callback(new Error("密码不能少于六位"));
                this.isLogin2 = false;
            } else {
                callback();
                this.isLogin2 = true;
            }
        };

        return {
            ruleForm2: {
                useName: "",
                pass: ""
            },
            isLogin: false, //判断是否登录
            isLogin2: false,
            rules2: {
                useName: [{ validator: userName, trigger: "blur" }],
                pass: [{ validator: validatePass, trigger: "blur" }]
            }
        };
    },
    methods: {
        login() {

            if(!this.isLogin || !this.isLogin2) return;
            
            this.$router.push({path:"/home"})
        }
    }
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.login_box {
    background-clip: padding-box;
    margin: 180px auto;
    width: 350px;
    padding: 35px 35px 15px 35px;
    background: #fff;
    border: 1px solid #eaeaea;
    box-shadow: 0 0 25px #cac6c6;
}
.tit {
    font-family: "Helvetica Neue";
    font-size: 30px;
    text-align: center;
    margin-top: 30px;
}
</style>
