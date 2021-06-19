<template>
  <button class="btn btn-orange" @mouseenter="enterMouse" @mouseleave="leaveMouse">Przejdź do promocji</button>
</template>

<script>
export default {
  name: "ButtonHoverTimeout",
  data() {
    return {
      hover: true,
    }
  },
  methods: {
    enterMouse(ev) {
      setTimeout(() => {
        ev.target.classList.add('btn-orange-hover');
      }, 100);
    },
    leaveMouse(ev) {
      ev.target.classList.remove('btn-orange-hover');
    }
  }
}
</script>

<style scoped>

.btn-orange {
  color: #fff;
  background-color: #f57f25;
  border-color: #f57f25;
  width: 100%;
}

.btn-orange-hover {
  color: #212529;
  background-color: #eee;
  border-color: #f57f25;
}

</style>
