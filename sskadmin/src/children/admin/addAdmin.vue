<template>
    <div class="box">
        <div class="conter">
            <el-form :model="ruleForm2" status-icon :rules="rules2" ref="ruleForm2" class="demo-ruleForm">
                <el-form-item label="账号" prop="user">
                    <el-input v-model="ruleForm2.user"></el-input>
                </el-form-item>
                <el-form-item label="密码" prop="pass">
                    <el-input type="password" v-model="ruleForm2.pass" auto-complete="off"></el-input>
                </el-form-item>
                <el-form-item label="确认密码" prop="checkPass">
                    <el-input type="password" v-model="ruleForm2.checkPass" auto-complete="off"></el-input>
                </el-form-item>

                <el-form-item>
                    <el-button type="primary" @click="submitForm()">保存</el-button>
                </el-form-item>
            </el-form>
        </div>
    </div>
</template>
<script>
import store from "@/vuex/store";
import { mapState } from "vuex";

export default {
    data() {
        var checkUser = (rule, value, callback) => {
            if (!value) {
                return callback(new Error("年龄不能为空"));
            }
            setTimeout(() => {
                if (!Number.isInteger(value)) {
                    callback(new Error("请输入数字值"));
                } else {
                    if (value < 18) {
                        callback(new Error("必须年满18岁"));
                    } else {
                        callback();
                    }
                }
            }, 1000);
        };
        var validatePass = (rule, value, callback) => {
            if (value === "") {
                callback(new Error("请输入密码"));
            } else {
                if (this.ruleForm2.checkPass !== "") {
                    this.$refs.ruleForm2.validateField("checkPass");
                }
                callback();
            }
        };
        var validatePass2 = (rule, value, callback) => {
            if (value === "") {
                callback(new Error("请再次输入密码"));
            } else if (value !== this.ruleForm2.pass) {
                callback(new Error("两次输入密码不一致!"));
            } else {
                callback();
            }
        };
        return {
            ruleForm2: {
                pass: "",
                checkPass: "",
                user: ""
            },
            rules2: {
                pass: [{ validator: validatePass, trigger: "blur" }],
                checkPass: [{ validator: validatePass2, trigger: "blur" }],
                user: [{ validator: checkUser, trigger: "blur" }]
            },
            value3: true
        };
    },
    created() {
        store.commit("getTit", "新增管理员");
    },
    methods: {
        submitForm() {
            this.$http.post("/admin/admin/add").then(res => {
                console.log(res);
                if (res.data.isSuccess == 1) {
                    console.log(1111);
                    
                    this.$router.push("/home");
                }
            });
        }
    }
};
</script>

<style scoped>
.conter {
    width: 500px;
    margin: 50px auto;
}
.el-form-item__content {
    text-align: center;
}
.auth {
    color: #606266;
}
</style>
