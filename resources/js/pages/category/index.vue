<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-item-center">
                        <h5 class="mb-0">Category Component</h5>
                        <router-link :to="{name: 'category-create'}" class="btn btn-success btn-sm">Create</router-link>
                    </div>

                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th width="10%">Sl.</th>
                                <th width="40%">Name</th>
                                <th width="30%">Slug</th>
                                <th width="20%">Action</th>
                            </tr>
                            <tr v-for="category in categories" :key="category.id">
                                <td>{{category.id}}</td>
                                <td>{{category.name}}</td>
                                <td>{{category.slug}}</td>
                                <td>
                                    <router-link :to="{name: 'category-edit', params: {id: category.id}}" class="btn btn-primary btn-sm">Edit</router-link>
                                    <a @click.prevent="categoryDelete(category)" href="#" class="btn btn-danger btn-sm">Delete</a>
                                </td>
                            </tr>
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
                categories: []
            }
        },
        methods: {
            loadCategory(){
                axios.get('/api/category')
                    .then(response => {
                        this.categories = response.data
                    });
            },
            categoryDelete(category){
                axios.delete(`/api/category/${category.id}`)
                    .then(()=>{
                        this.$toast.success({
                            title:'Success',
                            message:'Category Delete Successfuly'
                        })
                    })
                var that = this;
                setTimeout(function () {
                    let categoryIndex = that.categories.indexOf(category);
                    that.categories.splice(categoryIndex, 1);
                }, 1000);

            }
        },
        mounted() {
            this.loadCategory();
        }
    }
</script>
