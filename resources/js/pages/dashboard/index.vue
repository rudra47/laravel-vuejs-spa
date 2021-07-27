<template>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Menus</div>
                    <div class="card-body">
                        <div class="list-group">
                            <a href="#" class="list-group-item list-group-item-action active" @click.prevent="logout">Logout</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>
                    <div class="card-body">
                        <h2 class="text-center">
                            Welcome {{ user.name }}!
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        methods: {
            logout(){
                axios.post('/logout').then(response => {
                    localStorage.removeItem("auth");
                    this.$store.commit('SET_AUTHENTICATED', false);
                    this.$router.push('login');

                    this.$toast.success({
                        title:'Success',
                        message:'Logout Successfuly'
                    });

                });
            }
        },
        computed: {
            user(){
                return this.$store.getters.getUser;
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
