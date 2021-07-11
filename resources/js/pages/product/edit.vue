<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h2>Product Edit</h2>
                        <router-link :to="{name: 'product-list'}" class="btn btn-primary">Product List</router-link>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6 offset-3">
                                <form @submit.prevent="productUpdate">
                                    <div class="form-group">
                                        <label for="product">Product Name</label>
                                        <input type="text" v-model="productForm.name" class="form-control" name="name" placeholder="Product Name">
                                        <!-- <input v-model="productForm.username" type="text" name="username" placeholder="Username"> -->
                                        <div v-if="productForm.errors.has('name')" v-html="productForm.errors.get('name')" />
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
        productForm: new Form({
            name: ''
        })
    }),
    methods: {
        async productUpdate () {
            let id = this.$route.params.id;

            await this.productForm.put(`/api/product/${id}`).then(response => {
                this.productForm.name = '';
                this.$toast.success({
                    title:'Success',
                    message:'product Update Successfuly'
                })
            });
        },
        productLoad(){
            let id = this.$route.params.id;

            axios.get(`/api/product/${id}/edit`)
                .then(response=>{
                    this.productForm.name = response.data.name
                });
        }
    },
    mounted(){
        this.productLoad();
    }
}
</script>

<style>

</style>