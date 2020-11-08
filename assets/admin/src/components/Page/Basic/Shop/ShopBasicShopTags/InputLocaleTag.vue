<template>
  <td @click.stop="openEdit" class="pointerCursor" >
    <span v-text="tag"  v-if="!edit"  ></span>
    <span v-else class="row">
      <span class="col-md-10">
        <input type="text" class="form-control" v-model="valueTag">
      </span>
      <span class="col-md-2">
        <button class="btn btn-success" @click.stop="closeEdit"><i class="mdi mdi-check"></i> </button>
      </span>
    </span>
  </td>
</template>

<script>
export default {
  name: "InputLocaleTag",
  props:['tag', 'idShopTag', 'locale'],
  data()
  {
    return {
      edit: false,
      valueTag: ''
    }
  },
  methods:{
    openEdit()
    {
      this.edit = true;
    },
    closeEdit()
    {
      this.ajax({
        url: '/admin/api/tags/store/' + this.idShopTag,
        data: {
          tag: this.valueTag,
          locale: this.locale
        },
        responseCallbackSuccess: res => {
          this.$emit('editTag', {
            name: this.valueTag,
            locale: this.locale,
            id: this.idShopTag
          })
        }
      })
      this.edit = false;
    }
  },
  created() {
    this.valueTag = this.tag;
  }
}
</script>

<style scoped>

</style>
