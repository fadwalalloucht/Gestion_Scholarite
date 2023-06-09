    <template id="usersAdd">
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
                                <form enctype="multipart/form-data" @submit="save" class="form form-default" action="users/add" method="post">
                                    <div class="form-group " :class="{'has-error' : errors.has('nom')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="nom">Nom <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.nom"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Nom"
                                                    class="form-control "
                                                    type="text"
                                                    name="nom"
                                                    placeholder="Enter Nom"
                                                    />
                                                    <small v-show="errors.has('nom')" class="form-text text-danger">
                                                        {{ errors.first('nom') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('Prenom')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="Prenom">Prenom <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.Prenom"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Prenom"
                                                    class="form-control "
                                                    type="text"
                                                    name="Prenom"
                                                    placeholder="Enter Prenom"
                                                    />
                                                    <small v-show="errors.has('Prenom')" class="form-text text-danger">
                                                        {{ errors.first('Prenom') }}
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
                                    <div class="form-group " :class="{'has-error' : errors.has('telephone')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="telephone">Telephone <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.telephone"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Telephone"
                                                    class="form-control "
                                                    type="text"
                                                    name="telephone"
                                                    placeholder="Enter Telephone"
                                                    />
                                                    <small v-show="errors.has('telephone')" class="form-text text-danger">
                                                        {{ errors.first('telephone') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('mot_passe')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="mot_passe">Mot Passe <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.mot_passe"
                                                    v-validate="{required:true,  max:255}"
                                                    data-vv-as="Mot Passe"
                                                    class="form-control "
                                                    type="password"
                                                    name="mot_passe"
                                                    placeholder="Enter Mot Passe"
                                                    />
                                                    <small v-show="errors.has('mot_passe')" class="form-text text-danger">
                                                        {{ errors.first('mot_passe') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('confirm_password')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="confirm_password">Confirm Password <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input
                                                    v-model="data.confirm_password"
                                                    v-validate="{ required:true, confirmed:'mot_passe' }"
                                                    data-vv-as="Confirm Password"
                                                    class="form-control "
                                                    type="password"
                                                    name="confirm_password"
                                                    placeholder="Confirm Password"
                                                    />
                                                    <small v-show="errors.has('confirm_password')" class="form-text text-danger">{{ errors.first('confirm_password') }}</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('type')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="type">Type <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.type"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Type"
                                                    class="form-control "
                                                    type="text"
                                                    name="type"
                                                    placeholder="Enter Type"
                                                    />
                                                    <small v-show="errors.has('type')" class="form-text text-danger">
                                                        {{ errors.first('type') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('lieu_naissance')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="lieu_naissance">Lieu Naissance <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.lieu_naissance"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Lieu Naissance"
                                                    class="form-control "
                                                    type="text"
                                                    name="lieu_naissance"
                                                    placeholder="Enter Lieu Naissance"
                                                    />
                                                    <small v-show="errors.has('lieu_naissance')" class="form-text text-danger">
                                                        {{ errors.first('lieu_naissance') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('date_naissance')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="date_naissance">Date Naissance <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <flat-pickr
                                                    v-model="data.date_naissance"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Date Naissance"
                                                    name="date_naissance"
                                                    placeholder="Enter Date Naissance"
                                                    :config="{
                                                    dateFormat: 'Y-m-d',
                                                    altFormat: 'F j, Y',
                                                    altInput: true, 
                                                    allowInput:true
                                                    }"
                                                    >
                                                    </flat-pickr>
                                                    <small v-show="errors.has('date_naissance')" class="form-text text-danger">{{ errors.first('date_naissance') }}</small>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('genre')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="genre">Genre <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.genre"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Genre"
                                                    class="form-control "
                                                    type="text"
                                                    name="genre"
                                                    placeholder="Enter Genre"
                                                    />
                                                    <small v-show="errors.has('genre')" class="form-text text-danger">
                                                        {{ errors.first('genre') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('cin')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="cin">Cin <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.cin"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Cin"
                                                    class="form-control "
                                                    type="text"
                                                    name="cin"
                                                    placeholder="Enter Cin"
                                                    />
                                                    <small v-show="errors.has('cin')" class="form-text text-danger">
                                                        {{ errors.first('cin') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('adresse')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="adresse">Adresse <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.adresse"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Adresse"
                                                    class="form-control "
                                                    type="text"
                                                    name="adresse"
                                                    placeholder="Enter Adresse"
                                                    />
                                                    <small v-show="errors.has('adresse')" class="form-text text-danger">
                                                        {{ errors.first('adresse') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('photo')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="photo">Photo <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <niceupload
                                                        fieldname="photo"
                                                        control-class="upload-control"
                                                        dropmsg="Drop files here to upload"
                                                        uploadpath="uploads/files/"
                                                        filenameformat="random" 
                                                        extensions="jpg , png , gif , jpeg"  
                                                        :filesize="3" 
                                                        :maximum="1" 
                                                        name="photo"
                                                        v-model="data.photo"
                                                        v-validate="{required:true}"
                                                        data-vv-as="Photo"
                                                        >
                                                    </niceupload>
                                                    <small v-show="errors.has('photo')" class="form-text text-danger">{{ errors.first('photo') }}</small>
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
	var UsersAddComponent = Vue.component('usersAdd', {
		template : '#usersAdd',
		mixins: [AddPageMixin],
		props:{
			pagename : {
				type : String,
				default : 'users',
			},
			routename : {
				type : String,
				default : 'usersadd',
			},
			apipath : {
				type : String,
				default : 'users/add',
			},
		},
		data : function() {
			return {
				id : {
					type : String,
					default : '',
				},
				data : {
					nom: '',Prenom: '',email: '',telephone: '',mot_passe: '',confirm_password: '',type: '',lieu_naissance: '',date_naissance: '',genre: '',cin: '',adresse: '',photo: '',
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
				this.$router.push('/users');
			},
			resetForm : function(){
				this.data = {nom: '',Prenom: '',email: '',telephone: '',mot_passe: '',confirm_password: '',type: '',lieu_naissance: '',date_naissance: '',genre: '',cin: '',adresse: '',photo: '',};
				this.$validator.reset();
			},
		},
		mounted : function() {
		},
	});
	</script>
