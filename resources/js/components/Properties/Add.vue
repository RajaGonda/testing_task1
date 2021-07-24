<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Add Property</h4>
                </div>
                <div class="card-body">
                    <form @submit.prevent="create">
                        <div class="row">
                            <div class="col-4 mb-2">
                                <div class="form-group">
                                    <label>County</label>
                                    <input type="text" class="form-control" v-model="property.county">
                                </div>
                            </div>
                            <div class="col-4 mb-2">
                                <div class="form-group">
                                    <label>Country</label>
                                    <input type="text" class="form-control" v-model="property.country">
                                </div>
                            </div>
                            <div class="col-4 mb-2">
                                <div class="form-group">
                                    <label>Town</label>
                                    <input type="text" class="form-control" v-model="property.town">
                                </div>
                            </div>
                            <div class="col-4 mb-2">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea  class="form-control" v-model="property.description"></textarea>
                                </div>
                            </div>
                            <div class="col-4 mb-2">
                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" class="form-control" v-model="property.address">
                                </div>
                            </div>
                            <div class="col-4 mb-2">
                                <div class="form-group">
                                    <label>Latitude</label>
                                    <input type="number" class="form-control" v-model="property.latitude">
                                </div>
                            </div>
                            <div class="col-4 mb-2">
                                <div class="form-group">
                                    <label>Longitude</label>
                                    <input type="number" class="form-control" v-model="property.longitude">
                                </div>
                            </div>
                            <div class="col-4 mb-2">
                                <div class="form-group">
                                    <label>Num Bedrooms</label>
                                    <select  class="form-control"  v-model="property.num_bedrooms">
                                        <option v-for="n in 8" v-if="n >=1" :value="n">{{n}} {{ n==1 ? 'Bedroom': 'Bedrooms' }} </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-4 mb-2">
                                <div class="form-group">
                                    <label>Num Bathrooms</label>
                                    <select  class="form-control"  v-model="property.num_bathrooms">
                                        <option v-for="n in 8" v-if="n >=1" :value="n">{{n}} {{ n==1 ? 'Bathroom': 'Bathrooms' }} </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-4 mb-2">
                                <div class="form-group">
                                    <label>Price</label>
                                    <input type="number" class="form-control" v-model="property.price">
                                </div>
                            </div>
                            <div class="col-4 mb-2">
                                <div class="form-group">
                                    <label>Type</label><br/>
                                    <input type="radio" id="sale" value="sale" v-model="property.type">
                                    <label for="jack">Sale</label>
                                    <input type="radio" id="rent" value="rent" v-model="property.type">
                                    <label for="john">Rent</label>
                                </div>
                            </div>
                            <div class="col-4 mb-2">
                                <div class="form-group">
                                    <label>Property Type</label>
                                    <select class="form-control" v-model="property.property_type" >
                                        <option value="1">Flat</option>
                                        <option value="2">Detatched</option>
                                        <option value="3">Semi-detached</option>
                                        <option value="4">Terraced</option>
                                        <option value="5">End of Terrace</option>
                                        <option value="6">Cottage</option>
                                        <option value="7">Bungalow</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-4 mb-2">
                                <div class="form-group">
                                    <label>Image</label>
                                    <input type="file" class="form-control" >
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Save</button>
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
    name:"add-category",
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
                property_type:"",
                image:"",
            }
        }
    },
    methods:{
        async create(){
            await this.axios.post('/api/category',this.category).then(response=>{
                this.$router.push({name:"categoryList"})
            }).catch(error=>{
                console.log(error)
            })
        }
    }
}
</script>
