<template>
  <div class="box">
    <div @click="isShow()" v-if='show'>开始答题</div>
    <div v-else>
      <ul v-for="(item,index) in questions" :key="index" v-if="index == isIndex">

        <li>{{item.subject}}</li>
        <li  v-for="(items,i) in Answer" :key="i" v-if="index == i">{{i}}
          <div v-for="(ite,q) in items" class="flex" :key="q">
            <input type="checkbox" @click="checkTit(q,i)" v-model="items.isShow">
            <div :class="items.isShow? red : ble">{{ite.ID}}</div>
            <div :class="items.isShow? red : ble">{{ite.text}}</div>
          </div>

        </li>
      </ul>
    </div>

  </div>
</template>
<script>
/*
  展示出来数据，通过下标控制分页
  然后点击记录点击数据的下标
  找到这条数据
*/
export default {
    data() {
        return {
            show: true,
            Answer: [], //题
            bel: false,
            numArr: [],
            red:'red',
            ble:'ble',
            isIndex: 0,
            questions: [
                {
                    subject: "您的资产情况：",
                    Answer: [
                        {
                            ID: "A",
                            text: "≤50万元"
                        },
                        {
                            ID: "B",
                            text: ".50—100万元"
                        },
                        {
                            ID: "C",
                            text: "100—200万元"
                        },
                        {
                            ID: "D",
                            text: "200—300万元"
                        },
                        {
                            ID: "E",
                            text: "≥300万元"
                        }
                    ]
                },
                {
                    subject: "最近三年您个人年均收入：",
                    Answer: [
                        {
                            ID: "A",
                            text: "≤50万元"
                        },
                        {
                            ID: "B",
                            text: ".50—100万元"
                        },
                        {
                            ID: "C",
                            text: "100—200万元"
                        },
                        {
                            ID: "D",
                            text: "200—300万元"
                        },
                        {
                            ID: "E",
                            text: "≥300万元"
                        }
                    ]
                },
                {
                    subject: "您是否有数额较大的债务：",
                    Answer: [
                        {
                            ID: "A",
                            text: "没有"
                        },
                        {
                            ID: "B",
                            text: "有，为房贷等长期债务"
                        },
                        {
                            ID: "C",
                            text: "有，信用卡、消费信贷等短期债务"
                        },
                        {
                            ID: "D",
                            text: "有，向亲戚朋友借款"
                        }
                    ]
                },
                {
                    subject: "以下描述符合您实际情况的是：",
                    Answer: [
                        {
                            ID: "A",
                            text: "自修并略懂金融、财经、投资类知识"
                        },
                        {
                            ID: "B",
                            text: "具有金融、财经、投资类学习经历"
                        },
                        {
                            ID: "C",
                            text: "从事过金融、财经、投资相关工作"
                        },
                        {
                            ID: "D",
                            text: "我没有金融投资专业知识"
                        }
                    ]
                },
                {
                    subject: "以下描述符合您实际情况的是：",
                    Answer: [
                        {
                            ID: "A",
                            text: "自修并略懂金融、财经、投资类知识"
                        },
                        {
                            ID: "B",
                            text: "具有金融、财经、投资类学习经历"
                        },
                        {
                            ID: "C",
                            text: "从事过金融、财经、投资相关工作"
                        },
                        {
                            ID: "D",
                            text: "我没有金融投资专业知识"
                        }
                    ]
                },
                {
                    subject: "以下描述符合您实际情况的是：",
                    Answer: [
                        {
                            ID: "A",
                            text: "自修并略懂金融、财经、投资类知识"
                        },
                        {
                            ID: "B",
                            text: "具有金融、财经、投资类学习经历"
                        },
                        {
                            ID: "C",
                            text: "从事过金融、财经、投资相关工作"
                        },
                        {
                            ID: "D",
                            text: "我没有金融投资专业知识"
                        }
                    ]
                },
                {
                    subject: "以下描述符合您实际情况的是：",
                    Answer: [
                        {
                            ID: "A",
                            text: "自修并略懂金融、财经、投资类知识"
                        },
                        {
                            ID: "B",
                            text: "具有金融、财经、投资类学习经历"
                        },
                        {
                            ID: "C",
                            text: "从事过金融、财经、投资相关工作"
                        },
                        {
                            ID: "D",
                            text: "我没有金融投资专业知识"
                        }
                    ]
                },
                {
                    subject: "以下描述符合您实际情况的是：",
                    Answer: [
                        {
                            ID: "A",
                            text: "自修并略懂金融、财经、投资类知识"
                        },
                        {
                            ID: "B",
                            text: "具有金融、财经、投资类学习经历"
                        },
                        {
                            ID: "C",
                            text: "从事过金融、财经、投资相关工作"
                        },
                        {
                            ID: "D",
                            text: "我没有金融投资专业知识"
                        }
                    ]
                },
                {
                    subject: "以下描述符合您实际情况的是：",
                    Answer: [
                        {
                            ID: "A",
                            text: "自修并略懂金融、财经、投资类知识"
                        },
                        {
                            ID: "B",
                            text: "具有金融、财经、投资类学习经历"
                        },
                        {
                            ID: "C",
                            text: "从事过金融、财经、投资相关工作"
                        },
                        {
                            ID: "D",
                            text: "我没有金融投资专业知识"
                        }
                    ]
                },
                {
                    subject: "以下描述符合您实际情况的是：",
                    Answer: [
                        {
                            ID: "A",
                            text: "自修并略懂金融、财经、投资类知识"
                        },
                        {
                            ID: "B",
                            text: "具有金融、财经、投资类学习经历"
                        },
                        {
                            ID: "C",
                            text: "从事过金融、财经、投资相关工作"
                        },
                        {
                            ID: "D",
                            text: "我没有金融投资专业知识"
                        }
                    ]
                },
                {
                    subject: "以下描述符合您实际情况的是：",
                    Answer: [
                        {
                            ID: "A",
                            text: "自修并略懂金融、财经、投资类知识"
                        },
                        {
                            ID: "B",
                            text: "具有金融、财经、投资类学习经历"
                        },
                        {
                            ID: "C",
                            text: "从事过金融、财经、投资相关工作"
                        },
                        {
                            ID: "D",
                            text: "我没有金融投资专业知识"
                        }
                    ]
                },
                {
                    subject: "以下描述符合您实际情况的是：",
                    Answer: [
                        {
                            ID: "A",
                            text: "自修并略懂金融、财经、投资类知识"
                        },
                        {
                            ID: "B",
                            text: "具有金融、财经、投资类学习经历"
                        },
                        {
                            ID: "C",
                            text: "从事过金融、财经、投资相关工作"
                        },
                        {
                            ID: "D",
                            text: "我没有金融投资专业知识"
                        }
                    ]
                },
                {
                    subject: "以下描述符合您实际情况的是：",
                    Answer: [
                        {
                            ID: "A",
                            text: "自修并略懂金融、财经、投资类知识"
                        },
                        {
                            ID: "B",
                            text: "具有金融、财经、投资类学习经历"
                        },
                        {
                            ID: "C",
                            text: "从事过金融、财经、投资相关工作"
                        },
                        {
                            ID: "D",
                            text: "我没有金融投资专业知识"
                        }
                    ]
                },
                {
                    subject: "以下描述符合您实际情况的是：",
                    Answer: [
                        {
                            ID: "A",
                            text: "自修并略懂金融、财经、投资类知识"
                        },
                        {
                            ID: "B",
                            text: "具有金融、财经、投资类学习经历"
                        },
                        {
                            ID: "C",
                            text: "从事过金融、财经、投资相关工作"
                        },
                        {
                            ID: "D",
                            text: "我没有金融投资专业知识"
                        }
                    ]
                },
                {
                    subject: "以下描述符合您实际情况的是：",
                    Answer: [
                        {
                            ID: "A",
                            text: "自修并略懂金融、财经、投资类知识"
                        },
                        {
                            ID: "B",
                            text: "具有金融、财经、投资类学习经历"
                        },
                        {
                            ID: "C",
                            text: "从事过金融、财经、投资相关工作"
                        },
                        {
                            ID: "D",
                            text: "我没有金融投资专业知识"
                        }
                    ]
                }
            ]
        };
    },
    methods: {
        isShow() {
            this.show = !this.show;
            this.questions.forEach(item => {
                item.Answer.forEach(items => {
                    items.isShow = false;
                });
                this.Answer.push(item.Answer);
            });
            console.log(this.Answer);
        },
        checkTit(i,index) {
          //i children
          //index father
            this.isIndex++;
            this.Answer[index][i].isShow = true;

            this.numArr.push(this.isIndex+''+this.Answer[index][i].ID) //获取到选择的id
         
            if(this.isIndex == this.questions.length) {  //答完了
              var str = this.numArr.join(',')
                console.log(str)
            }

        }
    }
};
</script>
	<style scoped>
.flex {
    display: flex;
}
.red{
  color:red;
}
.ble{
  color:black;
}
</style>
