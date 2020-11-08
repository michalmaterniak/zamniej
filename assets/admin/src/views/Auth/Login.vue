<template>
    <div class="form-horizontal m-t-20" id="loginform" @keyup.enter="login">
        <div class="row p-b-30">
            <div class="col-12">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-danger text-white" id="basic-addon1"><i
                                class="mdi mdi-email"></i></span>
                    </div>
                    <input type="email" class="form-control form-control-lg" placeholder="Email" aria-label="Email"
                           aria-describedby="basic-addon1" required="" v-model="email">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-warning text-white" id="basic-addon2"><i class="ti-pencil"></i></span>
                    </div>
                    <input type="password" class="form-control form-control-lg" placeholder="Hasło" aria-label="Hasło"
                           aria-describedby="basic-addon1" required="" v-model="password">
                </div>
            </div>
        </div>
        <div class="row border-top border-secondary">
            <div class="col-12">
                <div class="form-group">
                    <div class="p-t-20">
                        <button class="btn btn-success float-right" type="submit" @click.prevent="login">Login</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
	export default {
		name: "Login",
		data() {
			return {
				email: 'michal.materniak@commit-m.pl',
				password: 'q',
			}
		},
    mounted() {
    },
    created() {
		  let token = null;
		  if (this.getToken)
		    token = this.getToken;
		  else
		    token = localStorage.getItem('token');

		  if (token)
      {
        this.setToken(token);
        this.checkAuth();
      }

      this.setLoading(false);
		},
	}
</script>

<style scoped>

</style>
