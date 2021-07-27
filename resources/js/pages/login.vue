<template>
    <div class="container">
        <div class="row">
            <div class="col-6 offset-3">
                <div class="card card-header">
                    <div class="card-header d-flex justify-content-between">
                        <h2>Login</h2>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="login">
                            <div class="form-group">
                                <label for="category">Email</label>
                                <input type="text" v-model="loginForm.email" class="form-control" name="email" placeholder="Email">
                                <div v-if="loginForm.errors.has('email')" v-html="loginForm.errors.get('email')" />
                            </div>
                            <div class="form-group">
                                <label for="category">Password</label>
                                <input type="text" v-model="loginForm.password" class="form-control" name="password" placeholder="Password">
                                <div v-if="loginForm.errors.has('password')" v-html="loginForm.errors.get('password')" />
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-success">
                            </div>
                        </form>
                            
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Form from 'vform';

// axios.defaults.withCredentials = true;
// axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

export default {
    data: () => ({
        loginForm: new Form({
            name: ''
        })
    }),
    methods: {
        login () {
            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.post('/login', {
                    email: 'rudra@gmail.com',
                    password: '123456'
                }).then(response => {
                    this.$router.push('dashboard');
                    this.$toast.success({
                        title:'Success',
                        message:'Login Successfuly'
                    });
                    this.getUserData();
                });
            }); 
        },
        getUserData(){
            axios.get('/api/user').then(response => {
                console.log(response.data);
                this.$store.commit('SET_USER', response.data);
                this.$store.commit('SET_AUTHENTICATED', true);

                localStorage.setItem("auth", true);
            });
        }
    }
}
</script>

<style>

</style>