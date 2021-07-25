<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Update Property</h4>
                </div>
                <div class="card-body">
                    <form  @submit="formSubmit" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-4 mb-2">
                                <div class="form-group">
                                    <label>County</label>
                                    <input type="text" class="form-control" v-model="property.county">
                                </div>
                                <span v-if="allerros.county" :class="['text-danger']">{{ allerros.county[0] }}</span>
                            </div>
                            <div class="col-4 mb-2">
                                <div class="form-group">
                                    <label>Country</label>
                                    <input type="text" class="form-control" v-model="property.country">
                                </div>
                                <span v-if="allerros.country" :class="['text-danger']">{{ allerros.country[0] }}</span>
                            </div>
                            <div class="col-4 mb-2">
                                <div class="form-group">
                                    <label>Town</label>
                                    <input type="text" class="form-control" v-model="property.town">
                                </div>
                                <span v-if="allerros.town" :class="['text-danger']">{{ allerros.town[0] }}</span>
                            </div>
                            <div class="col-4 mb-2">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea  class="form-control" v-model="property.description"></textarea>
                                </div>
                                <span v-if="allerros.description" :class="['text-danger']">{{ allerros.description[0] }}</span>
                            </div>
                            <div class="col-4 mb-2">
                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" class="form-control" v-model="property.address">
                                </div>
                                <span v-if="allerros.address" :class="['text-danger']">{{ allerros.address[0] }}</span>
                            </div>
                            <div class="col-4 mb-2">
                                <div class="form-group">
                                    <label>Latitude</label>
                                    <input type="number" class="form-control" v-model="property.latitude">
                                </div>
                                <span v-if="allerros.latitude" :class="['text-danger']">{{ allerros.latitude[0] }}</span>
                            </div>
                            <div class="col-4 mb-2">
                                <div class="form-group">
                                    <label>Longitude</label>
                                    <input type="number" class="form-control" v-model="property.longitude">
                                </div>
                                <span v-if="allerros.longitude" :class="['text-danger']">{{ allerros.longitude[0] }}</span>
                            </div>
                            <div class="col-4 mb-2">
                                <div class="form-group">
                                    <label>Num Bedrooms</label>
                                    <select  class="form-control"  v-model="property.num_bedrooms">
                                        <option v-for="n in 8" v-if="n >=1" :value="n">{{n}} {{ n==1 ? 'Bedroom': 'Bedrooms' }} </option>
                                    </select>
                                </div>
                                <span v-if="allerros.num_bedrooms" :class="['text-danger']">{{ allerros.num_bedrooms[0] }}</span>
                            </div>
                            <div class="col-4 mb-2">
                                <div class="form-group">
                                    <label>Num Bathrooms</label>
                                    <select  class="form-control"  v-model="property.num_bathrooms">
                                        <option v-for="n in 8" v-if="n >=1" :value="n">{{n}} {{ n==1 ? 'Bathroom': 'Bathrooms' }} </option>
                                    </select>
                                </div>
                                <span v-if="allerros.num_bathrooms" :class="['text-danger']">{{ allerros.num_bathrooms[0] }}</span>
                            </div>
                            <div class="col-4 mb-2">
                                <div class="form-group">
                                    <label>Price</label>
                                    <input type="number" class="form-control" v-model="property.price">
                                </div>
                                <span v-if="allerros.price" :class="['text-danger']">{{ allerros.price[0] }}</span>
                            </div>
                            <div class="col-4 mb-2">
                                <div class="form-group">
                                    <label>Type</label><br/>
                                    <input type="radio" id="sale" value="sale" v-model="property.type">
                                    <label for="jack">Sale</label>
                                    <input type="radio" id="rent" value="rent" v-model="property.type">
                                    <label for="john">Rent</label>
                                </div>
                                <span v-if="allerros.type" :class="['text-danger']">{{ allerros.type[0] }}</span>

                            </div>
                            <div class="col-4 mb-2">
                                <div class="form-group">
                                    <label>Property Type</label>
                                    <select class="form-control" v-model="property.property_type_id" >
                                        <option value="1">Flat</option>
                                        <option value="2">Detatched</option>
                                        <option value="3">Semi-detached</option>
                                        <option value="4">Terraced</option>
                                        <option value="5">End of Terrace</option>
                                        <option value="6">Cottage</option>
                                        <option value="7">Bungalow</option>
                                    </select>
                                </div>
                                <span v-if="allerros.property_type_id" :class="['text-danger']">{{ allerros.property_type_id[0] }}</span>
                            </div>
                            <div class="col-4 mb-2">
                                <div class="form-group">
                                    <label>Image</label>
                                    <input type="file" v-on:change="onImageChange" class="form-control" >
                                </div>

                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Update Now</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name:"update-category",
    data(){
        return {
            property:{
                county:"",
                country:"",
                town:"",
                description:"",
                address:"",
                latitude:"",
                longitude:"",
                num_bedrooms:"",
                num_bathrooms:"",
                price:"",
                type:"",
                property_type_id:"",
                image:"",
                image_thumbnail:"",
            },
            error:'',
            output:'',
            allerros: [],
        }
    },
    mounted(){
        this.showCategory()
    },
    methods:{
        onImageChange(e){
            console.log(e.target.files[0]);
            this.property.image = e.target.files[0];
        },
        async showCategory(e){
            let currentObj = this;
            await this.axios.get('/api/lists/'+this.$route.params.id).then(response => {
                    debugger;
                    console.log(response.item )
                    currentObj.property = response.data.item;
                })
                .catch(function (error) {
                    currentObj.output = error;
                });
        },
        formSubmit(e) {
            e.preventDefault();
            let currentObj = this;

            const config = {
                headers: { 'content-type': 'multipart/form-data' }
            }

            let formData = new FormData();
            formData.append('image', this.property.image);
            formData.append('county', this.property.county);
            formData.append('country', this.property.country);
            formData.append('town', this.property.town);
            formData.append('description', this.property.description);
            formData.append('address', this.property.address);
            formData.append('latitude', this.property.latitude);
            formData.append('longitude', this.property.longitude);
            formData.append('num_bedrooms', this.property.num_bedrooms);
            formData.append('num_bathrooms', this.property.num_bathrooms);
            formData.append('price', this.property.price);
            formData.append('type', this.property.type);
            formData.append('property_type_id', this.property.property_type_id);

            axios.post('/api/update/'+this.$route.params.id, formData, config)
                .then(function (response) {
                    debugger;
                    currentObj.error = response.data.error;
                    currentObj.allerros =[];
                    currentObj.$router.push({ name: 'propertyList' })
                })
                .catch(function (error) {
                    currentObj.allerros = error.response.data.errors;
                    currentObj.output = error;
                });
        },
    }
}
</script>
