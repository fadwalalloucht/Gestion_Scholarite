    <template id="Register">
        <section class="page-component">
            <div v-if="showheader" class="bg-light p-3 mb-3">
                <div class="container">
                    <div class="row ">
                        <div  class="col-md-6 comp-grid" :class="setGridSize">
                            <h3 class="record-title">Enregistrement de l'utilisateur</h3>
                        </div>
                        <div  class="col-md-6 comp-grid" :class="setGridSize">
                            <div class="">
                                <div class="text-right">
                                    Vous avez déjà un compte?  <router-link class="btn btn-primary" to="/"> S'identifier </router-link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div  class="pb-2 mb-3 border-bottom">
                <div class="container">
                    <div class="row ">
                        <div  class="col-md-7 comp-grid" :class="setGridSize">
                            <div  class=" animated fadeIn">
                                <form enctype="multipart/form-data" @submit="save" class="form form-default" action="" method="post">
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
                                    <div class="form-group " :class="{'has-error' : errors.has('mot_passe')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="mot_passe">Mot Passe <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.mot_passe"
                                                    v-validate="{required:true}"
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
                                                    <dataradio
                                                        v-model="data.type"
                                                        data-vv-value-path="data.type"
                                                        data-vv-as="Type"
                                                        v-validate="{required:true}"
                                                        name="type" 
                                                        :datasource="typeOptionList"
                                                        >
                                                    </dataradio>
                                                    <small v-show="errors.has('type')" class="form-text text-danger">{{ errors.first('type') }}</small>
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
                                    <hr />
                                    <div class="text-center">
                                        <button class="btn btn-primary" type="submit">
                                            <i class="load-indicator"><clip-loader :loading="saving" color="#fff" size="14px"></clip-loader> </i>
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
	var RegisterComponent = Vue.component('Register', {
		template : '#Register',
		mixins: [AddPageMixin],
		props:{
			pagename : {
				type : String,
				default : 'users',
			},
			routename : {
				type : String,
				default : 'usersuserregister',
			},
			apipath : {
				type : String,
				default : 'index/register',
			},
		},
		data : function() {
			return {
				id : {
					type : String,
					default : '',
				},
				data : {
					nom: '',Prenom: '',email: '',mot_passe: '',confirm_password: '',type: '',adresse: '',
				},
				typeOptionList: [{"label":"Admin","value":"admin"},{"label":"Etudiant","value":"Etudiant"},{"label":"Profeseur","value":"Profeseur"},{"label":"Tuteur","value":"Tuteur"}],
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
				window.location = response.body;
			},
			resetForm : function(){
				this.data = {nom: '',Prenom: '',email: '',mot_passe: '',confirm_password: '',type: '',adresse: '',};
				this.$validator.reset();
			},
		},
		mounted : function() {
		},
	});
	</script>
