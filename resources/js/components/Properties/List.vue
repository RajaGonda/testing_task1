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
                                    <img v-bind:src="property.image_thumbnail" class="img-fluid"/>
                                </td>
                                <td>{{ property.property_type.title }}</td>
                                <td>{{ property.county }}</td>
                                <td>{{ property.description }}</td>
                                <td>
                                    <router-link :to='{name:"propertyEdit",params:{id:property.property_type_id}}'
                                                 class="btn btn-success">Edit
                                    </router-link>
                                    <button type="button" @click="deleteProperty(property.property_type_id)"
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
                            <div class="btn-group " role="group" aria-label="Basic example">
                                <button :disabled="firstsPage ? false : true" @click="goPage(firstsPage)"
                                        class="btn btn-primary">First
                                </button>
                                <button :disabled="prevPage ? false : true" @click="goPage(prevPage)"
                                        class="btn btn-primary">Prev
                                </button>

                                <button
                                        class="btn btn-info"> {{ properties.current_page }}
                                </button>

                                <button :disabled="nextPage ? false : true" @click="goPage(nextPage)"
                                        class="btn btn-primary">NEXT
                                </button>
                                <button :disabled="lastPage ? false : true" @click="goPage(lastPage)"
                                        class="btn btn-primary">Last
                                </button>


                            </div>
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
        async getProperties() {
            let self = this;
            self.show = true;


            let apiurl = '/api/properties';
            if (self.page) {
                apiurl = '/api/properties?page=' + self.page;
            }

            await this.axios.get(apiurl).then(response => {
                self.properties = response.data;

                console.log(self.properties.next_page_url);

                self.firstsPage = self.properties.first_page_url ? new URLSearchParams(new URL(self.properties.first_page_url).search).get('page[number]') : null;
                self.prevPage = self.properties.prev_page_url ? new URLSearchParams(new URL(self.properties.prev_page_url).search).get('page[number]') : null;
                self.nextPage = self.properties.next_page_url ? new URLSearchParams(new URL(self.properties.next_page_url).search).get('page[number]') : null;
                self.lastPage = self.properties.last_page_url ? new URLSearchParams(new URL(self.properties.last_page_url).search).get('page[number]') : null;

                console.log(self.nextPage);
                self.show = false;
                console.log(self.properties)

            }).catch(error => {
                console.log(error)
                self.properties = []
            })
        },
        deleteProperty(id) {
            if (confirm("Are you sure to delete this category ?")) {
                this.axios.delete(`https://trial.craig.mtcserver15.com/api/properties/${id}`).then(response => {
                    this.getProperties()
                }).catch(error => {
                    console.log(error)
                })
            }
        }
    }
}
</script>
