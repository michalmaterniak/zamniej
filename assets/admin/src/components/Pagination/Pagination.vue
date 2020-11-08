<template>
  <nav aria-label="...">
    <ul class="pagination">
      <template v-for="page in maxPages">
        <li class="page-item " :class="{active : pagination.page === page}">
          <a @click.prevent="$emit('changePage', page)" class="page-link" href="#"><span v-text="page"></span> <span v-if="pagination.page === page" class="sr-only">(current)</span></a>
        </li>
      </template>
<!--      <li class="page-item disabled">-->
<!--        <a class="page-link" href="#" tabindex="-1">Previous</a>-->
<!--      </li>-->
<!--      <li class="page-item"><a class="page-link" href="#">1</a></li>-->

<!--      <li class="page-item"><a class="page-link" href="#">3</a></li>-->
<!--      <li class="page-item">-->
<!--        <a class="page-link" href="#">Next</a>-->
<!--      </li>-->
    </ul>
  </nav>





</template>

<script>
export default {
  name: "Pagination",
  props:['pagination'],
  data(){
    return {
      countPerPage: 50
    }
  },
  computed:{
    maxResult(){
      return this.pagination.maxResult ? this.pagination.maxResult : this.countPerPage;
    },
    maxPages()
    {
      // page 1
      // countAll
      // perPage
      return Math.ceil(this.pagination.countAll / this.maxResult);
    }
  }
}
</script>

<style scoped>

</style>
