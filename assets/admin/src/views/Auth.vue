<template>
    <div class="auth-wrapper d-flex no-block justify-content-center align-items-center bg-dark">
        <div class="auth-box bg-dark border-top border-secondary">
            <div>
                <div class="text-center p-t-20 p-b-20">
                    <span class="db"><a :href="rootLink"><img class="logo-src" src="/admin/images/commit2.png"
                                                              alt="logo"/></a></span>
                </div>
                <router-view/>
            </div>
        </div>
    </div>
</template>

<script>
	export default {
		name: "Auth"
	}
</script>

<style scoped>
    .logo-src {
        width: 100%;
    }
</style>
