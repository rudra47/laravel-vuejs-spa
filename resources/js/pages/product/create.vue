<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h2>Product Create</h2>
                        <router-link :to="{name: 'product-list'}" class="btn btn-primary">Product List</router-link>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6 offset-3">
                                <form @submit.prevent="productCreate">
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
                                    <div class="form-group">
                                        <label for="image">Product Image</label>
                                        <input type="file" class="form-control-file" @change="onImageChange" name="image">
                                        <div v-if="productForm.errors.has('image')" v-html="productForm.errors.get('image')" />
                                    </div>
                                    <div class="form-group">
                                        <label for="product">Product Description</label>
                                        <textarea name="description" rows="3" v-model="productForm.description" class="form-control"  placeholder="Product Description"></textarea>
                                        <div v-if="productForm.errors.has('description')" v-html="productForm.errors.get('description')" />
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
        </div>
    </div>
</template>

<script>
import Form from 'vform';
import { objectToFormData } from 'object-to-formdata'

export default {
    data: () => ({
        productForm: new Form({
            name: '',
            price: '',
            image: '',
            description: ''
        })
    }),
    methods: {
        async productCreate () {
            await this.productForm.post('/api/product', {
                    transformRequest: [function (data, headers) {
                        return objectToFormData(data)
                    }],
                    onUploadProgress: e => {
                        // Do whatever you want with the progress event
                        console.log(e)
                    }
                }).then(() => {
                this.productForm.name  = '';
                this.productForm.price = '';
                this.productForm.description = '';

                this.$toast.success({
                    title:'Success',
                    message:'Product Create Successfuly'
                })
            });
        },
        // productCreate(){
            
        //     axios.post('/api/category', {name: this.name}).then(response => {
        //         console.log(response);
        //     });
        // }
        onImageChange(e){
            console.log(e);
            const file = e.target.files[0];
            this.productForm.image = file;
        }
    }
}
</script>

<style>

</style>