<template>
    <div class="container">
        <div class="row justify-content-end my-3">
            <div class="col-2">
                <button class="btn btn-primary" @click="create()">
                    <i class="fas fa-plus-circle">Create</i>
                </button>
            </div>
            <div class="col-4">
                <form @submit.prevent="view()">
                    <div class="input-group">
                        <input
                            v-model="search"
                            type="text"
                            plcaholder="Search"
                            class="form-control"
                        />

                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <h4 class="card-header">
                        {{ isedit ? "Edit" : "Create" }}
                    </h4>
                    <div class="card-body">
                        <alert-error
                            :form="product"
                            :message="message"
                        ></alert-error>
                        <form @submit.prevent="isedit ? update() : store()">
                            <div class="form-group">
                                <label for="">Name</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    v-model="product.name"
                                    :class="{
                                        'is-invalid': product.errors.has('name')
                                    }"
                                />

                                <has-error
                                    :form="product"
                                    field="name"
                                ></has-error>

                                <div class="text-danger"></div>
                            </div>
                            <div class="form-group">
                                <label for="">Price</label>
                                <input
                                    type="number"
                                    class="form-control"
                                    v-model="product.price"
                                    :class="{
                                        'is-invalid': product.errors.has(
                                            'price'
                                        )
                                    }"
                                />

                                <has-error
                                    :form="product"
                                    field="price"
                                ></has-error>
                            </div>

                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-save mr-2">Save</i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="product in products.data" :key="product.id">
                            <th scope="row">{{ product.id }}</th>
                            <td>{{ product.name }}</td>
                            <td>{{ product.price }}</td>
                            <td>
                                <button
                                    class="btn btn-success btn-sm"
                                    @click="edit(product)"
                                >
                                    <i class="fas fa-edit mr-2"></i>Edit
                                </button>
                                <button
                                    class="btn btn-danger btn-sm"
                                    @click="destory(product.id)"
                                >
                                    <i class="fas fa-trash mr-2"></i>Delete
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <!-- Pagination -->
                <pagination
                    :data="products"
                    @pagination-change-page="view"
                ></pagination>
            </div>
        </div>

        <!-- Loading -->
        <loading :active.sync="isLoading" :is-full-page="fullPage" :color="color"></loading>
    </div>
</template>

<script>
// Import component
import Loading from "vue-loading-overlay";
// Import stylesheet
import "vue-loading-overlay/dist/vue-loading.css";
export default {
    name: "product-com",
    data() {
        return {
            isLoading: false,
            fullPage: true,
            color:"blue",
            search: "",
            isedit: false,
            products: {},
            message: "",
            product: new Form({
                id: "",
                name: "",
                price: ""
            })
        };
    },
    components: {
        Loading
    },
    methods: {
        view(page = 1) {
            this.isLoading=true;
            this.$Progress.start();
            axios
                .get(
                    `http://localhost:8000/api/product/?page=${page}&search=${this.search}`
                )
                .then(response => {
                    // console.log(response.data)
                    this.products = response.data;
                    this.$Progress.finish();
                    this.isLoading=false;
                });
        },
        store() {
            this.product
                .post("http://localhost:8000/api/product/")
                .then(res => {
                    this.view();
                    // this.product = { id:'',name: "", price: "" };
                    this.product.reset();
                    Toast.fire({
                        icon: "success",
                        title: "Created  successfully"
                    });
                })
                .catch(error => {
                    this.message = error.response.data.message;
                });
        },
        edit(product) {
            this.product.clear(),
                (this.isedit = true),
                // (this.product.id = product.id),
                // (this.product.name = product.name),
                // (this.product.price = product.price);
                this.product.fill(product);
        },
        create() {
            (this.isedit = false),
                (this.product.id = ""),
                (this.product.name = ""),
                (this.product.price = "");
            // this.product.reset();
            this.product.clear();
        },
        update() {
            // alert('hello')
            this.product
                .put(`http://localhost:8000/api/product/${this.product.id}`)
                .then(res => {
                    this.view();
                    //  this.product={ id:'',name:'', price:''}
                    this.product.reset();
                    Toast.fire({
                        icon: "success",
                        title: "Updated  successfully"
                    });
                });
        },
        destory(id) {
            Swal.fire({
                title: "Are you sure?",

                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Delete"
            }).then(result => {
                if (result.isConfirmed) {
                    axios.delete(`/api/product/${id}`).then(
                        res => this.view(),
                        Swal.fire({ title: "Deleted", icon: "success" }),

                        Toast.fire({
                            icon: "success",
                            title: "Deleted  successfully"
                        })
                    );
                }
            });
        }
        // searchpro(){
        //     axios.get('/api/product?search='+ this.search)
        //     .then(res=>this.products = res.data)
        // }
    },
    created() {
        this.view();
    }
};
</script>

<style></style>
