<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h2>Product Edit - {{productForm.name}}</h2>
                        <router-link :to="{name: 'product-list'}" class="btn btn-primary">Product List</router-link>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6 offset-3">
                                <form @submit.prevent="productUpdate">
                                    <div class="form-group">
                                        <label for="product">Product Name</label>
                                        <input type="text" v-model="productForm.name" class="form-control" name="name" placeholder="Product Name">
                                        <div v-if="productForm.errors.has('name')" v-html="productForm.errors.get('name')" />
                                    </div>
                                    <div class="form-group">
                                        <label for="product">Product Price</label>
                                        <input type="text" v-model="productForm.price" class="form-control" name="price" placeholder="Product Price">
                                        <div v-if="productForm.errors.has('price')" v-html="productForm.errors.get('price')" />
                                    </div>
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="form-group">
                                                <label for="image">Product Image</label>
                                                <input type="file" class="form-control-file" @change="onImageChange" name="image">

                                                <div v-if="productForm.errors.has('image')" v-html="productForm.errors.get('image')" />
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div>
                                                <img :src="existImage" :alt="productForm.name" class="img-fluid">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="product">Product Description</label>
                                        <textarea name="description" rows="3" v-model="productForm.description" class="form-control"  placeholder="Product Description"></textarea>
                                        <div v-if="productForm.errors.has('description')" v-html="productForm.errors.get('description')" />
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
import { objectToFormData } from 'object-to-formdata';

export default {
    data: () => ({
        productForm: new Form({
            name       : '',
            price      : '',
            image      : '',
            description: '',
            _method    : 'put'
        }),
        existImage: ''
    }),
    methods: {
        async productUpdate () {
            let id = this.$route.params.id;
            await this.productForm.post('/api/product/'+id, {
                    transformRequest: [function (data, headers) {
                        return objectToFormData(data)
                    }],
                    onUploadProgress: e => {
                        // Do whatever you want with the progress event
                        console.log(e)
                    }
                }).then(() => {
                this.$toast.success({
                    title:'Success',
                    message:'Product Update Successfuly'
                })
            });
        },
        productLoad(){
            let id = this.$route.params.id;

            axios.get(`/api/product/${id}/edit`)
                .then(response=>{
                    this.productForm.name        = response.data.name,
                    this.productForm.price       = response.data.price,
                    this.productForm.description = response.data.description,
                    this.existImage              = response.data.image
                });
        },
        onImageChange(e){
            const file = e.target.files[0];
            this.productForm.image = file;
        }
    },
    mounted(){
        this.productLoad();
    }
}
</script>

<style>

</style>