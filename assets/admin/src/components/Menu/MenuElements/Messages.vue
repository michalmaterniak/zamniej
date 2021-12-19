<template>
  <li @click="isOpen = !isOpen" class="nav-item dropdown" :class="{'show' : isOpen}" v-if="isMessages && false">
    <a class="nav-link waves-effect waves-dark" @click.prevent="null"  href="#" id="2"
       aria-haspopup="true" :aria-expanded="isOpen ? 'true' : 'false'"> <i class="font-24 mdi mdi-comment-processing"></i>
    </a>
    <div class="dropdown-menu dropdown-menu-right mailbox animated bounceInDown" :class="{'show' : isOpen}" aria-labelledby="2">
      <ul class="list-style-none">
        <li v-if="newProgramsCount.webepartners > 0">
          <div class="">
            <!-- Message webepartners -->
            <a href="javascript:void(0)" class="link border-top" v-if="newProgramsCount.webepartners > 0">
              <div class="d-flex no-block align-items-center p-10">
                <span class="btn btn-success btn-circle"><i class="ti-calendar"></i></span>
                <div class="m-l-10">

                  <span class="mail-desc">
                    <router-link :to="{name: 'panel-affiliations-webepartners-programs-new'}" >
                      <h5 class="m-b-0">Nowe progrmy webepartners<br>(<span v-text="newProgramsCount.webepartners"></span>)</h5>
                    </router-link>
                  </span>
                </div>
              </div>
            </a>
            <!-- Message webepartners -->
          </div>
        </li>
        <li v-if="newProgramsCount.convertiser > 0">
          <div class="">
            <!-- Message convertiser -->
            <a href="javascript:void(0)" class="link border-top" v-if="newProgramsCount.convertiser > 0">
              <div class="d-flex no-block align-items-center p-10">
                <span class="btn btn-success btn-circle"><i class="ti-calendar"></i></span>
                <div class="m-l-10">
                  <span class="mail-desc">
                    <router-link :to="{name: 'panel-affiliations-convertiser-programs-new'}" >
                      <h5 class="m-b-0">Nowe progrmy convertiser<br>(<span v-text="newProgramsCount.convertiser"></span>)</h5>
                    </router-link>
                  </span>
                </div>
              </div>
            </a>
            <!-- Message convertiser -->
          </div>
        </li>
        <li v-if="newProgramsCount.tradetracker > 0">
          <div class="">
            <!-- Message tradetracker -->
            <a href="javascript:void(0)" class="link border-top" v-if="newProgramsCount.tradetracker > 0">
              <div class="d-flex no-block align-items-center p-10">
                <span class="btn btn-success btn-circle"><i class="ti-calendar"></i></span>
                <div class="m-l-10">
                  <span class="mail-desc">
                    <router-link :to="{name: 'panel-affiliations-tradetracker-programs-new'}" >
                      <h5 class="m-b-0">Nowe progrmy tradetracker<br>(<span v-text="newProgramsCount.tradetracker"></span>)</h5>
                    </router-link>
                  </span>
                </div>
              </div>
            </a>
            <!-- Message tradetracker -->
          </div>
        </li>
      </ul>
    </div>
  </li>
</template>

<script>
export default {
  name: "Messages",
  data(){
    return {
      isOpen: true
    }
  },
  computed:{
    isMessages(){
      return (this.newProgramsCount.total > 0)
    },
    system()
    {
      return this.$store.getters.system;
    },
    newProgramsCount()
    {
      return this.system.countNewPrograms;
    },
  },
  mounted() {
    setTimeout(() => {
      this.isOpen = !this.isOpen;
    }, 5000);
  }
}
</script>
<style scoped>
</style>
