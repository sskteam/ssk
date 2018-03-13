<template>
  <div class="box admin">
    <div class="optionMsg">
      <el-button type="primary" @click="goAdd()">添加管理员</el-button>
    </div>

    <el-table :data="tableData" style="width: 100%">
      <el-table-column label="ID" width="180">
        <template slot-scope="scope">
          <span style="margin-left: 10px">{{ scope.row.date }}</span>
        </template>
      </el-table-column>
      <el-table-column label="登录名" width="180">
        <template slot-scope="scope">
          <div slot="reference" class="name-wrapper">
            <el-tag size="medium">{{ scope.row.name }}</el-tag>
          </div>
        </template>
      </el-table-column>
      <el-table-column label="操作" width="180">
        <template slot-scope="scope">
          <el-button size="mini" @click="handleEdit(scope.$index, scope.row)">编辑</el-button>
          <el-button size="mini" type="danger" @click="handleDelete(scope.$index, scope.row)">删除</el-button>
        </template>
      </el-table-column>
    </el-table>

  </div>
</template>
<script>
import store from "@/vuex/store";
import { mapState } from "vuex";
import config from "../../config";
export default {
    data() {
        return {
            tableData: [
                {
                    date: "2016-05-02",
                    name: "王小虎",
                    address: "上海市普陀区金沙江路 1518 弄"
                },
                {
                    date: "2016-05-04",
                    name: "王小虎",
                    address: "上海市普陀区金沙江路 1517 弄"
                },
                {
                    date: "2016-05-01",
                    name: "王小虎",
                    address: "上海市普陀区金沙江路 1519 弄"
                },
                {
                    date: "2016-05-03",
                    name: "王小虎",
                    address: "上海市普陀区金沙江路 1516 弄"
                }
            ]
        };
    },
    methods: {
        handleEdit(index, row) {
            this.$router.push("adminWrite");
        },
        handleDelete(index, row) {
            console.log(index, row);
        },
        goAdd() {
            this.$router.push("/addAdmin");
        }
    },
    created() {
        store.commit("getTit", "管理员列表");
        this.$http.post(`/admin/admin/lists`).then(res => {
            console.log(res);
        });
    }
};
</script>
<style>

</style>
