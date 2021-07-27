<template>
    <nav class="mb-3 navbar navbar-expand-lg navbar-dark bg-primary text-white">
        <div class="container">
            <router-link class="navbar-brand" :to="{name: 'home'}">Site Logo</router-link>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <router-link class="nav-link" :to="{name: 'home'}">Homes</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" :to="{name: 'category-list'}">Category</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" :to="{name: 'product-list'}">Product</router-link>
                    </li>
                    <li class="nav-item" v-if="checkAuth">
                        <router-link class="nav-link" :to="{name: 'dashboard'}">Dashboard</router-link>
                    </li>
                    <li class="nav-item" v-if="!checkAuth">
                        <router-link class="nav-link" :to="{name: 'login'}">Login</router-link>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
export default {
    methods: {
        // logout(){
        //     axios.post('/logout').then(response => {
        //         this.$router.push('login');
        //         this.$toast.success({
        //             title:'Success',
        //             message:'Logout Successfuly'
        //         });
        //     });
        // }
    },
    computed: {
        checkAuth(){
            return this.$store.getters.getAuthenticated;
        }
    }
}
</script>