<template>
  <div>
    <div id="status"></div>
    <form id="ratingForm">
      <fieldset class="rating">
        <input type="radio" id="star5" name="rating" value="5" /><label for="star5" title="Bardzo dobry">5 gwiazdek</label>
        <input type="radio" id="star4" name="rating" value="4" /><label for="star4" title="Dobry">4 gwiazdki</label>
        <input type="radio" id="star3" name="rating" value="3" /><label for="star3" title="Może być">3 gwiazdki</label>
        <input type="radio" id="star2" name="rating" value="2" /><label for="star2" title="Słaby">2 gwiazdki</label>
        <input type="radio" id="star1" name="rating" value="1" /><label for="star1" title="Bardzo słaby">1 gwiazdka</label>
      </fieldset>
      <div class="clearfix"></div>
    </form>

  </div>
</template>

<script>
export default {
  name: "Rating2",

}
</script>

<style scoped>
.rating {
  float:left;
}

/* :not(:checked) is a filter, so that browsers that don’t support :checked don’t
   follow these rules. Every browser that supports :checked also supports :not(), so
   it doesn’t make the test unnecessarily selective */
.rating:not(:checked) > input {
  position:absolute;
  top:-9999px;
  clip:rect(0,0,0,0);
}

.rating:not(:checked) > label {
  float:right;
  width:1em;
  padding:0 .1em;
  overflow:hidden;
  white-space:nowrap;
  cursor:pointer;
  font-size:200%;
  line-height:1.2;
  color:#ddd;
  text-shadow:1px 1px #bbb, 2px 2px #666, .1em .1em .2em rgba(0,0,0,.5);
}

.rating:not(:checked) > label:before {
  content: '★ ';
}

.rating > input:checked ~ label {
  color: #f70;
  text-shadow:1px 1px #c60, 2px 2px #940, .1em .1em .2em rgba(0,0,0,.5);
}

.rating:not(:checked) > label:hover,
.rating:not(:checked) > label:hover ~ label {
  color: #f57f25;
  text-shadow:1px 1px goldenrod, 2px 2px #B57340, .1em .1em .2em rgba(0,0,0,.5);
}

.rating > input:checked + label:hover,
.rating > input:checked + label:hover ~ label,
.rating > input:checked ~ label:hover,
.rating > input:checked ~ label:hover ~ label,
.rating > label:hover ~ input:checked ~ label {
  color: #f57f25;
  text-shadow:1px 1px goldenrod, 2px 2px #B57340, .1em .1em .2em rgba(0,0,0,.5);
}

.rating > label:active {
  position:relative;
  top:2px;
  left:2px;
}

/* end of Lea's code */

/*
 * Clearfix from html5 boilerplate
 */

.clearfix:before,
.clearfix:after {
  content: " "; /* 1 */
  display: table; /* 2 */
}

.clearfix:after {
  clear: both;
}

/*
 * For IE 6/7 only
 * Include this rule to trigger hasLayout and contain floats.
 */

.clearfix {
  *zoom: 1;
}

/* my stuff */
#status, button {
  margin: 20px 0;
}


</style>
