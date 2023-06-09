    <template id="administrationsAdd">
        <section class="page-component">
            <div v-if="showheader" class="bg-light p-3 mb-3">
                <div class="container">
                    <div class="row ">
                        <div  class="col-12 comp-grid" :class="setGridSize">
                            <h3 class="record-title">Ajouter un nouveau</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div  class="pb-2 mb-3 border-bottom">
                <div class="container">
                    <div class="row ">
                        <div  class="col-md-7 comp-grid" :class="setGridSize">
                            <div  class=" animated fadeIn">
                                <form enctype="multipart/form-data" @submit="save" class="form form-default" action="administrations/add" method="post">
                                    <div class="form-group " :class="{'has-error' : errors.has('logo')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="logo">Logo <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.logo"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Logo"
                                                    class="form-control "
                                                    type="text"
                                                    name="logo"
                                                    placeholder="Enter Logo"
                                                    />
                                                    <small v-show="errors.has('logo')" class="form-text text-danger">
                                                        {{ errors.first('logo') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('nom_ecole')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="nom_ecole">Nom Ecole <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.nom_ecole"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Nom Ecole"
                                                    class="form-control "
                                                    type="text"
                                                    name="nom_ecole"
                                                    placeholder="Enter Nom Ecole"
                                                    />
                                                    <small v-show="errors.has('nom_ecole')" class="form-text text-danger">
                                                        {{ errors.first('nom_ecole') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('address')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="address">Address <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.address"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Address"
                                                    class="form-control "
                                                    type="text"
                                                    name="address"
                                                    placeholder="Enter Address"
                                                    />
                                                    <small v-show="errors.has('address')" class="form-text text-danger">
                                                        {{ errors.first('address') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('capital')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="capital">Capital <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.capital"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Capital"
                                                    class="form-control "
                                                    type="text"
                                                    name="capital"
                                                    placeholder="Enter Capital"
                                                    />
                                                    <small v-show="errors.has('capital')" class="form-text text-danger">
                                                        {{ errors.first('capital') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('ville')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="ville">Ville <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.ville"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Ville"
                                                    class="form-control "
                                                    type="text"
                                                    name="ville"
                                                    placeholder="Enter Ville"
                                                    />
                                                    <small v-show="errors.has('ville')" class="form-text text-danger">
                                                        {{ errors.first('ville') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('code_postal')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="code_postal">Code Postal <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.code_postal"
                                                    v-validate="{required:true,  numeric:true}"
                                                    data-vv-as="Code Postal"
                                                    class="form-control "
                                                    type="number"
                                                    name="code_postal"
                                                    placeholder="Enter Code Postal"
                                                    step="1" 
                                                    />
                                                    <small v-show="errors.has('code_postal')" class="form-text text-danger">
                                                        {{ errors.first('code_postal') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('telephone')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="telephone">Telephone <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.telephone"
                                                    v-validate="{required:true,  numeric:true}"
                                                    data-vv-as="Telephone"
                                                    class="form-control "
                                                    type="number"
                                                    name="telephone"
                                                    placeholder="Enter Telephone"
                                                    step="1" 
                                                    />
                                                    <small v-show="errors.has('telephone')" class="form-text text-danger">
                                                        {{ errors.first('telephone') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('created_at')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="created_at">Created At <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <flat-pickr
                                                    v-model="data.created_at"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Created At"
                                                    name="created_at"
                                                    placeholder="Enter Created At"
                                                    :config="{
                                                    dateFormat: 'Y-m-d',
                                                    altFormat: 'F j, Y',
                                                    altInput: true, 
                                                    allowInput:true
                                                    }"
                                                    >
                                                    </flat-pickr>
                                                    <small v-show="errors.has('created_at')" class="form-text text-danger">{{ errors.first('created_at') }}</small>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('update_at')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="update_at">Update At <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <flat-pickr
                                                    v-model="data.update_at"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Update At"
                                                    name="update_at"
                                                    placeholder="Enter Update At"
                                                    :config="{
                                                    dateFormat: 'Y-m-d',
                                                    altFormat: 'F j, Y',
                                                    altInput: true, 
                                                    allowInput:true
                                                    }"
                                                    >
                                                    </flat-pickr>
                                                    <small v-show="errors.has('update_at')" class="form-text text-danger">{{ errors.first('update_at') }}</small>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('cnss')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="cnss">Cnss <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.cnss"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Cnss"
                                                    class="form-control "
                                                    type="text"
                                                    name="cnss"
                                                    placeholder="Enter Cnss"
                                                    />
                                                    <small v-show="errors.has('cnss')" class="form-text text-danger">
                                                        {{ errors.first('cnss') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('ice')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="ice">Ice <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.ice"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Ice"
                                                    class="form-control "
                                                    type="text"
                                                    name="ice"
                                                    placeholder="Enter Ice"
                                                    />
                                                    <small v-show="errors.has('ice')" class="form-text text-danger">
                                                        {{ errors.first('ice') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('num_patente')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="num_patente">Num Patente <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.num_patente"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Num Patente"
                                                    class="form-control "
                                                    type="text"
                                                    name="num_patente"
                                                    placeholder="Enter Num Patente"
                                                    />
                                                    <small v-show="errors.has('num_patente')" class="form-text text-danger">
                                                        {{ errors.first('num_patente') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('site_web')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="site_web">Site Web <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.site_web"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Site Web"
                                                    class="form-control "
                                                    type="text"
                                                    name="site_web"
                                                    placeholder="Enter Site Web"
                                                    />
                                                    <small v-show="errors.has('site_web')" class="form-text text-danger">
                                                        {{ errors.first('site_web') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('email')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="email">Email <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.email"
                                                    v-validate="{required:true,  email:true}"
                                                    data-vv-as="Email"
                                                    class="form-control "
                                                    type="email"
                                                    name="email"
                                                    placeholder="Enter Email"
                                                    />
                                                    <small v-show="errors.has('email')" class="form-text text-danger">
                                                        {{ errors.first('email') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('rs')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="rs">Rs <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.rs"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Rs"
                                                    class="form-control "
                                                    type="text"
                                                    name="rs"
                                                    placeholder="Enter Rs"
                                                    />
                                                    <small v-show="errors.has('rs')" class="form-text text-danger">
                                                        {{ errors.first('rs') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group text-center">
                                        <button class="btn btn-primary"  :disabled="errors.any()" type="submit">
                                            <i class="load-indicator">
                                                <clip-loader :loading="saving" color="#fff" size="15px"></clip-loader>
                                            </i>
                                            {{submitbuttontext}}
                                            <i class="fa fa-send"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </template>
    <script>
	var AdministrationsAddComponent = Vue.component('administrationsAdd', {
		template : '#administrationsAdd',
		mixins: [AddPageMixin],
		props:{
			pagename : {
				type : String,
				default : 'administrations',
			},
			routename : {
				type : String,
				default : 'administrationsadd',
			},
			apipath : {
				type : String,
				default : 'administrations/add',
			},
		},
		data : function() {
			return {
				id : {
					type : String,
					default : '',
				},
				data : {
					logo: '',nom_ecole: '',address: '',capital: '',ville: '',code_postal: '',telephone: '',created_at: '',update_at: '',cnss: '',ice: '',num_patente: '',site_web: '',email: '',rs: '',
				},
			}
		},
		computed: {
			pageTitle: function(){
				return 'Ajouter un nouveau';
			},
		},
		methods: {
			actionAfterSave : function(response){
				this.$root.$emit('requestCompleted' , this.msgaftersave);
				this.$router.push('/administrations');
			},
			resetForm : function(){
				this.data = {logo: '',nom_ecole: '',address: '',capital: '',ville: '',code_postal: '',telephone: '',created_at: '',update_at: '',cnss: '',ice: '',num_patente: '',site_web: '',email: '',rs: '',};
				this.$validator.reset();
			},
		},
		mounted : function() {
		},
	});
	</script>
