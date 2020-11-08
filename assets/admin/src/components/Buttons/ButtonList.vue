<template>
    <button @click="action" class="btn" :class="{'btn-success' : active || color === 'success', 'btn-danger' : !active || color === 'danger'}" :title="title" :disabled="!changeable">
        <slot/>
    </button>
</template>

<script>
	export default {
		props: {
      parentRes:{
          type: Number
      },
      callbackAction:{
          type: Function
      },
      color:{
          type: String,
          default: ''
      },
			active: {
				type: Boolean,
				default: true
			},
      changeable: {
				type: Boolean,
				default: true
			},
			title: {
				type: String,
				default: null
			}
		},
    methods:{
		  action()
      {
        this.callbackAction(this.parentRes);
      }
    },
		name: "ButtonList"
	}
</script>

<style scoped>

</style>
