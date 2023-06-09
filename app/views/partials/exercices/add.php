    <template id="exercicesAdd">
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
                                <form enctype="multipart/form-data" @submit="save" class="form form-default" action="exercices/add" method="post">
                                    <div class="form-group " :class="{'has-error' : errors.has('libelle_Exercice')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="libelle_Exercice">Libelle Exercice <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.libelle_Exercice"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Libelle Exercice"
                                                    class="form-control "
                                                    type="text"
                                                    name="libelle_Exercice"
                                                    placeholder="Enter Libelle Exercice"
                                                    />
                                                    <small v-show="errors.has('libelle_Exercice')" class="form-text text-danger">
                                                        {{ errors.first('libelle_Exercice') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('description_Exercice')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="description_Exercice">Description Exercice <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.description_Exercice"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Description Exercice"
                                                    class="form-control "
                                                    type="text"
                                                    name="description_Exercice"
                                                    placeholder="Enter Description Exercice"
                                                    />
                                                    <small v-show="errors.has('description_Exercice')" class="form-text text-danger">
                                                        {{ errors.first('description_Exercice') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('piece_jointe')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="piece_jointe">Piece Jointe <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.piece_jointe"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Piece Jointe"
                                                    class="form-control "
                                                    type="text"
                                                    name="piece_jointe"
                                                    placeholder="Enter Piece Jointe"
                                                    />
                                                    <small v-show="errors.has('piece_jointe')" class="form-text text-danger">
                                                        {{ errors.first('piece_jointe') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('id_professeur')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="id_professeur">Id Professeur <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.id_professeur"
                                                    v-validate="{required:true,  numeric:true}"
                                                    data-vv-as="Id Professeur"
                                                    class="form-control "
                                                    type="number"
                                                    name="id_professeur"
                                                    placeholder="Enter Id Professeur"
                                                    step="1" 
                                                    />
                                                    <small v-show="errors.has('id_professeur')" class="form-text text-danger">
                                                        {{ errors.first('id_professeur') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('id_classe')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="id_classe">Id Classe <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.id_classe"
                                                    v-validate="{required:true,  numeric:true}"
                                                    data-vv-as="Id Classe"
                                                    class="form-control "
                                                    type="number"
                                                    name="id_classe"
                                                    placeholder="Enter Id Classe"
                                                    step="1" 
                                                    />
                                                    <small v-show="errors.has('id_classe')" class="form-text text-danger">
                                                        {{ errors.first('id_classe') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('id_matiere')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="id_matiere">Id Matiere <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.id_matiere"
                                                    v-validate="{required:true,  numeric:true}"
                                                    data-vv-as="Id Matiere"
                                                    class="form-control "
                                                    type="number"
                                                    name="id_matiere"
                                                    placeholder="Enter Id Matiere"
                                                    step="1" 
                                                    />
                                                    <small v-show="errors.has('id_matiere')" class="form-text text-danger">
                                                        {{ errors.first('id_matiere') }}
                                                    </small>
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
                                                    enableTime: true, 
                                                    dateFormat: 'Y-m-d H:i:S',
                                                    altFormat: 'F j, Y - H:i',
                                                    altInput: true, allowInput:true
                                                    }"
                                                    >
                                                    </flat-pickr>
                                                    <small  v-show="errors.has('update_at')" class="form-text text-danger">{{ errors.first('update_at') }}</small>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('deleted_at')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="deleted_at">Deleted At <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.deleted_at"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Deleted At"
                                                    class="form-control "
                                                    type="text"
                                                    name="deleted_at"
                                                    placeholder="Enter Deleted At"
                                                    />
                                                    <small v-show="errors.has('deleted_at')" class="form-text text-danger">
                                                        {{ errors.first('deleted_at') }}
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
	var ExercicesAddComponent = Vue.component('exercicesAdd', {
		template : '#exercicesAdd',
		mixins: [AddPageMixin],
		props:{
			pagename : {
				type : String,
				default : 'exercices',
			},
			routename : {
				type : String,
				default : 'exercicesadd',
			},
			apipath : {
				type : String,
				default : 'exercices/add',
			},
		},
		data : function() {
			return {
				id : {
					type : String,
					default : '',
				},
				data : {
					libelle_Exercice: '',description_Exercice: '',piece_jointe: '',id_professeur: '',id_classe: '',id_matiere: '',update_at: '',deleted_at: '',
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
				this.$router.push('/exercices');
			},
			resetForm : function(){
				this.data = {libelle_Exercice: '',description_Exercice: '',piece_jointe: '',id_professeur: '',id_classe: '',id_matiere: '',update_at: '',deleted_at: '',};
				this.$validator.reset();
			},
		},
		mounted : function() {
		},
	});
	</script>
