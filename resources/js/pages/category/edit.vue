<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h2>Category Edit</h2>
                        <router-link :to="{name: 'category-list'}" class="btn btn-primary">Category List</router-link>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6 offset-3">
                                <form @submit.prevent="categoryUpdate">
                                    <div class="form-group">
                                        <label for="category">Category Name</label>
                                        <input type="text" v-model="categoryForm.name" class="form-control" name="name" placeholder="Category Name">
                                        <!-- <input v-model="categoryForm.username" type="text" name="username" placeholder="Username"> -->
                                        <div v-if="categoryForm.errors.has('name')" v-html="categoryForm.errors.get('name')" />
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-success" value="Update">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Form from 'vform';

export default {
    data: () => ({
        categoryForm: new Form({
            name: ''
        })
    }),
    methods: {
        async categoryUpdate () {
            let id = this.$route.params.id;

            await this.categoryForm.put(`/api/category/${id}`).then(response => {
                this.categoryForm.name = '';
                this.$toast.success({
                    title:'Success',
                    message:'Category Update Successfuly'
                })
            });
        },
        categoryLoad(){
            let id = this.$route.params.id;

            axios.get(`/api/category/${id}/edit`)
                .then(response=>{
                    this.categoryForm.name = response.data.name
                });
        }
    },
    mounted(){
        this.categoryLoad();
    }
}
</script>

<style>

</style>