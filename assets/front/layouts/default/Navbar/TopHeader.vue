<template>
  <div class="top-header">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <div class="header-contact">
            <ul>
              <li>Welcome to Our store Multikart</li>
              <li><i aria-hidden="true" class="fa fa-phone"></i>Call Us: 123 - 456 - 7890</li>
            </ul>
          </div>
        </div>
        <div class="col-lg-6 text-right">
          <ul class="header-dropdown">
            <li class="mobile-wishlist"><a href="#"><i aria-hidden="true" class="fa fa-heart"></i></a>
            </li>
            <li class="onhover-dropdown mobile-account"><i aria-hidden="true" class="fa fa-user"></i>
              My Account
              <ul class="onhover-show-div">
                <li><a data-lng="en" href="#">Login</a></li>
                <li><a data-lng="es" href="#">Logout</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "TopHeader"
}
</script>

<style scoped>

</style>
