<template>
  <div>
    <div class="row">
      <div class="col-md-12">
        <ul class="nav nav-tabs" role="tablist">
          <li class="nav-item">
            <a class="nav-link" href="#" :class="{active : subtab === 'tab1'}" data-toggle="tab" role="tab" @click="changeTab('tab1')">
              <span class="hidden-sm-up"></span>
              <span class="hidden-xs-down">Tab1</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#" :class="{active : subtab === 'tab2'}" data-toggle="tab" role="tab" @click="changeTab('tab2')">
              <span class="hidden-sm-up"></span>
              <span class="hidden-xs-down">Tab2</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="row mt-5">
      <div class="tab-pane active" id="home" role="tabpanel" v-if="">
        <div class="p-20">
          <p>Tab1 iple paragraphs and is full of waffle to pad out the comment. Usually, you just wish these sorts of comments would come to an end.multiple paragraphs and is full of waffle to pad out the comment..</p>
        </div>
      </div>
      <div class="tab-pane  p-20" id="profile" role="tabpanel">
        <div class="p-20">
          <p class="m-t-10">Tab2 waffle to It has multiple paragraphs and is full of waffle to pad out the comment. Usually, you just wish these sorts of comments would come to an end.multiple paragraphs and is full of waffle to pad out the comment..</p>
        </div>
      </div>
    </div>
  </div>
</template>
<script>

export default {
  props:{
    program:{
      type: Object
    }
  },
  name: "PagesSettings",
  data(){
    return {
      subtab: 'tab1'
    }
  },
  computed:{
    tab()
    {
      switch (this.subtab)
      {
        case 'homepage' : return 'homepage';


        default : return 'homepage';
      }
    }
  },
  methods:{

    changeTab(subtab)
    {
      this.subtab = subtab;
    }
  }
}
</script>

<style scoped>

</style>

