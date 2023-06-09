    <template id="absencesAdd">
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
                                <form enctype="multipart/form-data" @submit="save" class="form form-default" action="absences/add" method="post">
                                    <div class="form-group " :class="{'has-error' : errors.has('justifie')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="justifie">Justifie <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.justifie"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Justifie"
                                                    class="form-control "
                                                    type="text"
                                                    name="justifie"
                                                    placeholder="Enter Justifie"
                                                    />
                                                    <small v-show="errors.has('justifie')" class="form-text text-danger">
                                                        {{ errors.first('justifie') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('id_seance')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="id_seance">Id Seance <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.id_seance"
                                                    v-validate="{required:true,  numeric:true}"
                                                    data-vv-as="Id Seance"
                                                    class="form-control "
                                                    type="number"
                                                    name="id_seance"
                                                    placeholder="Enter Id Seance"
                                                    step="1" 
                                                    />
                                                    <small v-show="errors.has('id_seance')" class="form-text text-danger">
                                                        {{ errors.first('id_seance') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('id_etudiant')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="id_etudiant">Id Etudiant <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.id_etudiant"
                                                    v-validate="{required:true,  numeric:true}"
                                                    data-vv-as="Id Etudiant"
                                                    class="form-control "
                                                    type="number"
                                                    name="id_etudiant"
                                                    placeholder="Enter Id Etudiant"
                                                    step="1" 
                                                    />
                                                    <small v-show="errors.has('id_etudiant')" class="form-text text-danger">
                                                        {{ errors.first('id_etudiant') }}
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
                                                <div class="">
                                                    <input v-model="data.created_at"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Created At"
                                                    class="form-control "
                                                    type="text"
                                                    name="created_at"
                                                    placeholder="Enter Created At"
                                                    />
                                                    <small v-show="errors.has('created_at')" class="form-text text-danger">
                                                        {{ errors.first('created_at') }}
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
	var AbsencesAddComponent = Vue.component('absencesAdd', {
		template : '#absencesAdd',
		mixins: [AddPageMixin],
		props:{
			pagename : {
				type : String,
				default : 'absences',
			},
			routename : {
				type : String,
				default : 'absencesadd',
			},
			apipath : {
				type : String,
				default : 'absences/add',
			},
		},
		data : function() {
			return {
				id : {
					type : String,
					default : '',
				},
				data : {
					justifie: '',id_seance: '',id_etudiant: '',created_at: '',update_at: '',deleted_at: '',
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
				this.$router.push('/absences');
			},
			resetForm : function(){
				this.data = {justifie: '',id_seance: '',id_etudiant: '',created_at: '',update_at: '',deleted_at: '',};
				this.$validator.reset();
			},
		},
		mounted : function() {
		},
	});
	</script>
