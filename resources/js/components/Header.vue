<template>
    <nav class="mb-3 navbar navbar-expand-lg navbar-dark bg-primary text-white">
        <div class="container">
            <router-link class="navbar-brand" :to="{name: 'home'}">Site Logo</router-link>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <router-link class="nav-link" :to="{name: 'home'}">Homes</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" :to="{name: 'category-list'}">Category</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" :to="{name: 'product-list'}">Product</router-link>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>