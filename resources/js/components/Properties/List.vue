<template>
    <div class="row">
        <b-overlay :show="show"  rounded="sm">
        <div class="col-12 mb-2 text-end">
            <router-link :to='{name:"propertyAdd"}' class="btn btn-primary">Create</router-link>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Properties</h4>
                </div>
                <div class="card-body">


                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Type</th>
                                <th>county</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody v-if="properties.data && properties.data.length > 0">
                            <tr v-for="(property,key) in properties.data" :key="key">
                                <td>{{ property.uuid }}</td>
                                <td>
                                    <img width="250" v-bind:src="property.image_thumbnail" class="img-fluid"/>
                                </td>
                                <td>{{ property.get_property_type.title }}</td>
                                <td>{{ property.county }}</td>
                                <td>{{ property.description }}</td>
                                <td>
                                    <router-link :to='{name:"propertyEdit",params:{id:property.id}}'
                                                 class="btn btn-success">Edit
                                    </router-link>
                                    <button type="button" @click="deleteProperty(property.id)"
                                            class="btn btn-danger">Delete
                                    </button>
                                </td>
                            </tr>
                            </tbody>
                            <tbody v-else>
                            <tr>
                                <td colspan="4" align="center">No Properties Found.</td>
                            </tr>
                            </tbody>
                        </table>

                        <div class="text-center">
                            <pagination :data="properties" @pagination-change-page="getProperties"></pagination>
                        </div>


                    </div>
                </div>
            </div>
        </div>
        </b-overlay>
    </div>
</template>

<script>
import pagination from 'laravel-vue-pagination'

export default {
    name: "properties",
    props: ['page'],
    components: {
        pagination
    },
    data() {
        return {
            show: false,
            pege: null,
            firstsPage: null,
            prevPage: null,
            nextPage: null,
            lastPage: null,
            properties: []
        }
    },
    mounted() {
        this.getProperties();
        this.page = this.$route.params.page;
    },
    methods: {
        scrollToTop() {
            window.scrollTo(0,0);
        },
        goPage(no) {
            let self = this;
            self.scrollToTop();
            self.page = no;
            console.log('no')
            console.log(no)
            this.getProperties();
        },
        deleteProperties(id) {
            this.axios
                .delete(`http://localhost:8000/api/post/delete/${id}`)
                .then(response => {
                    let i = this.posts.map(item => item.id).indexOf(id); // find index of your object
                    this.posts.splice(i, 1)
                });
        },
        async getProperties(page) {
            let self = this;
            self.show = true;

            if (typeof page === 'undefined') {
                page = 1;
            }

            // let apiurl = '/api/lists';
            // if (self.page) {
            // }

               let apiurl = '/api/lists?page=' + page;
            await this.axios.get(apiurl).then(response => {
                self.properties = response.data.list;
                self.show = false;

            }).catch(error => {
                console.log(error)
                self.properties = []
            })
        },
        deleteProperty(id) {
            if (confirm("Are you sure to delete this category ?")) {
                this.axios.delete(`/api/delete/${id}`).then(response => {
                    this.getProperties()
                }).catch(error => {
                    console.log(error)
                })
            }
        }
    }
}
</script>
