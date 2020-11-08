<template>
  <div class="main-header">
    <div id="main-menu" class="wa-main-menu main-menu">
      <!-- Menu -->
      <div class="wathemes-menu relative">
        <!-- navbar -->
        <div class="navbar navbar-default theme-bg mar0" role="navigation">
          <div class="container">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="navbar-header">
                  <!-- Button For Responsive toggle -->
                  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
                  <!-- Logo -->
                </div>
                <!-- Navbar Collapse -->
                <div class="navbar-collapse collapse">
                  <div class="row">
                    <!-- nav -->
                    <ul class="nav navbar-nav">
                      <li class="marR20">
                        <nuxt-link :to="{path: '/'}" class="nav-item nav-link" exact-active-class="active">Home</nuxt-link>
                      </li>
                      <li>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">deals <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                        <ul class="dropdown-menu">
                          <li><a href="deals-grid.html">deals grid</a></li>
                          <li><a href="deals-grid-sidebar.html">deals grid sidebar</a></li>
                          <li><a href="deals-list.html">deals list</a></li>
                          <li><a href="deals-list-sidebar.html">deals list sidebar</a></li>
                          <li><a href="deals-single.html">deals single</a></li>
                        </ul>
                      </li>
                      <li>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">coupons <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                        <ul class="dropdown-menu">
                          <li><a href="coupon-grid.html">coupon grid</a></li>
                          <li><a href="coupan-grid-sidebar.html">coupon grid sidebar</a></li>
                          <li><a href="coupon-list.html">coupon list</a></li>
                          <li><a href="coupon-list-sidebar.html">coupon list sidebar</a></li>
                          <li><a href="coupons-details.html">coupon details</a></li>
                        </ul>
                      </li>
                      <li>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">blog <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                        <ul class="dropdown-menu">
                          <li><a href="blog-grid.html">blog grid</a></li>
                          <li><a href="blog-grid-sidebar.html">blog grid sidebar</a></li>
                          <li><a href="blog-list.html">blog list</a></li>
                          <li><a href="blog-list-sidebar.html">blog list sidebar</a></li>
                          <li><a href="blog-details.html">blog details</a></li>
                        </ul>
                      </li>
                      <li>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">pages <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                        <ul class="dropdown-menu">
                          <li><a href="categories.html">categories</a></li>
                          <li><a href="shopcart.html">shopcart</a></li>
                          <li><a href="wishlist.html">wishlist</a></li>
                        </ul>
                      </li>
                      <li>
                        <a href="store-search.html">stores</a>
                      </li>

                    </ul>
                    <!-- navbar-collapse -->
                  </div>
                </div>
              </div>
              <!-- col-md-12 -->
            </div>
            <!-- row -->
          </div>
          <!-- container -->
        </div>
        <!-- navbar -->
      </div>
      <!--  Menu -->
    </div>
  </div>
  <!-- //***Header-section End***// -->
</template>

<script>
export default {
  name: "Navbar"
}
</script>

<style scoped>
.row{
  max-width: 100%;
}
</style>
