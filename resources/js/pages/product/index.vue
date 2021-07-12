<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-item-center">
                        <h5 class="mb-0">Product List</h5>
                        <router-link :to="{name: 'product-create'}" class="btn btn-success btn-sm">Create</router-link>
                    </div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th width="10%">Sl.</th>
                                    <th width="20%">Name</th>
                                    <th width="10%">price</th>
                                    <th width="40%">Description</th>
                                    <th width="20%">Action</th>
                                </tr>
                            </thead>
                            <tbody  v-if="products.length">
                                <tr v-for="product in products" :key="product.id">
                                    <td>{{product.id}}</td>
                                    <td>{{product.name}}</td>
                                    <td>{{product.price}}</td>
                                    <td>{{product.description}}</td>
                                    <td>
                                        <router-link :to="{name: 'product-edit', params: {id: product.id}}" class="btn btn-primary btn-sm">Edit</router-link>
                                        <a @click.prevent="productDelete(product)" href="#" class="btn btn-danger btn-sm">Delete</a>
                                    </td>
                                </tr>
                            </tbody>
                            <tbody v-else>
                                <tr>
                                    <td colspan="4" style="text-align: center;">No Product Found</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                products: []
            }
        },
        methods: {
            loadProduct(){
                axios.get('/api/product')
                    .then(response => {
                        console.log(response.products);
                        this.products = response.data;
                    });
            },
            productDelete(product){
                axios.delete(`/api/product/${product.id}`)
                    .then(()=>{
                        this.$toast.success({
                            title:'Success',
                            message:'Product Delete Successfuly'
                        })
                    })
                var that = this;
                setTimeout(function () {
                    let productIndex = that.products.indexOf(product);
                    that.products.splice(productIndex, 1);
                }, 1000);
            }
        },
        mounted() {
            this.loadProduct();
        }
    }
</script>