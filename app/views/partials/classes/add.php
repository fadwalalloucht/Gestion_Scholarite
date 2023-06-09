    <template id="classesAdd">
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
                                <form enctype="multipart/form-data" @submit="save" class="form form-default" action="classes/add" method="post">
                                    <div class="form-group " :class="{'has-error' : errors.has('libelle_classe')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="libelle_classe">Nom de filiére <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <dataselect
                                                        v-model="data.libelle_classe"
                                                        data-vv-value-path="data.libelle_classe"
                                                        data-vv-as="Nom de filiére"
                                                        v-validate="{required:true}"
                                                        placeholder="Select A Value ... " name="libelle_classe" :multiple="false" 
                                                        :datapath="'components/classes_libelle_classe_option_list/'"
                                                        >
                                                    </dataselect>
                                                    <small v-show="errors.has('libelle_classe')" class="form-text text-danger">{{ errors.first('libelle_classe') }}</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('niveau')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="niveau">Niveau <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <dataselect
                                                        v-model="data.niveau"
                                                        data-vv-value-path="data.niveau"
                                                        data-vv-as="Niveau"
                                                        v-validate="{required:true}"
                                                        placeholder="Select A Value ... " name="niveau" :multiple="false" 
                                                        :datasource="niveauOptionList"
                                                        >
                                                    </dataselect>
                                                    <small v-show="errors.has('niveau')" class="form-text text-danger">{{ errors.first('niveau') }}</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('nb_etudiants')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="nb_etudiants">Nb Etudiants <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.nb_etudiants"
                                                    v-validate="{required:true,  numeric:true}"
                                                    data-vv-as="Nb Etudiants"
                                                    class="form-control "
                                                    type="number"
                                                    name="nb_etudiants"
                                                    placeholder="Enter Nb Etudiants"
                                                    step="1" 
                                                    />
                                                    <small v-show="errors.has('nb_etudiants')" class="form-text text-danger">
                                                        {{ errors.first('nb_etudiants') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('annee_scolaire')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="annee_scolaire">Annee Scolaire <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.annee_scolaire"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Annee Scolaire"
                                                    class="form-control "
                                                    type="text"
                                                    name="annee_scolaire"
                                                    placeholder="Enter Annee Scolaire"
                                                    />
                                                    <small v-show="errors.has('annee_scolaire')" class="form-text text-danger">
                                                        {{ errors.first('annee_scolaire') }}
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
	var ClassesAddComponent = Vue.component('classesAdd', {
		template : '#classesAdd',
		mixins: [AddPageMixin],
		props:{
			pagename : {
				type : String,
				default : 'classes',
			},
			routename : {
				type : String,
				default : 'classesadd',
			},
			apipath : {
				type : String,
				default : 'classes/add',
			},
		},
		data : function() {
			return {
				id : {
					type : String,
					default : '',
				},
				data : {
					libelle_classe: '',niveau: '',nb_etudiants: '',annee_scolaire: '',
				},
				niveauOptionList: [{"label":"1","value":"1"},{"label":"2","value":"2"}],
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
				this.$router.push('/classes');
			},
			resetForm : function(){
				this.data = {libelle_classe: '',niveau: '',nb_etudiants: '',annee_scolaire: '',};
				this.$validator.reset();
			},
		},
		mounted : function() {
		},
	});
	</script>
