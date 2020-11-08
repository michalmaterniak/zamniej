<template>
  <li @click="isOpen = !isOpen" class="nav-item dropdown" :class="{'show' : isOpen}" v-if="isMessages">
    <a class="nav-link waves-effect waves-dark"  href="#" id="2"
       aria-haspopup="true" :aria-expanded="isOpen ? 'true' : 'false'"> <i class="font-24 mdi mdi-comment-processing"></i>
    </a>
    <div class="dropdown-menu dropdown-menu-right mailbox animated bounceInDown" :class="{'show' : isOpen}" aria-labelledby="2">
      <ul class="list-style-none">
        <li>
          <div class="">
            <!-- Message -->
            <a href="javascript:void(0)" class="link border-top" v-if="newProgramsCount > 0">
              <div class="d-flex no-block align-items-center p-10">
                <span class="btn btn-success btn-circle"><i class="ti-calendar"></i></span>
                <div class="m-l-10">
                  <h5 class="m-b-0">Nowe progrmy (<span v-text="newProgramsCount"></span>)</h5>
                  <span class="mail-desc">
                    <router-link :to="{name: 'panel-affiliations-webepartners-programs-new'}" >Zaakceptuj program afiliacyjny</router-link>
                  </span>
                </div>
              </div>
            </a>


<!--            &lt;!&ndash; Message &ndash;&gt;-->
<!--            <a href="javascript:void(0)" class="link border-top">-->
<!--              <div class="d-flex no-block align-items-center p-10">-->
<!--                <span class="btn btn-info btn-circle"><i class="ti-settings"></i></span>-->
<!--                <div class="m-l-10">-->
<!--                  <h5 class="m-b-0">Settings</h5>-->
<!--                  <span class="mail-desc">You can customize this template</span>-->
<!--                </div>-->
<!--              </div>-->
<!--            </a>-->
<!--            &lt;!&ndash; Message &ndash;&gt;-->
<!--            <a href="javascript:void(0)" class="link border-top">-->
<!--              <div class="d-flex no-block align-items-center p-10">-->
<!--                <span class="btn btn-primary btn-circle"><i class="ti-user"></i></span>-->
<!--                <div class="m-l-10">-->
<!--                  <h5 class="m-b-0">Pavan kumar</h5>-->
<!--                  <span class="mail-desc">Just see the my admin!</span>-->
<!--                </div>-->
<!--              </div>-->
<!--            </a>-->
<!--            &lt;!&ndash; Message &ndash;&gt;-->
<!--            <a href="javascript:void(0)" class="link border-top">-->
<!--              <div class="d-flex no-block align-items-center p-10">-->
<!--                <span class="btn btn-danger btn-circle"><i class="fa fa-link"></i></span>-->
<!--                <div class="m-l-10">-->
<!--                  <h5 class="m-b-0">Luanch Admin</h5>-->
<!--                  <span class="mail-desc">Just see the my new admin!</span>-->
<!--                </div>-->
<!--              </div>-->
<!--            </a>-->
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
      return (this.newProgramsCount > 0)
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
