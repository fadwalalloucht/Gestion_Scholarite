    <template id="modulesAdd">
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
                                <form enctype="multipart/form-data" @submit="save" class="form form-default" action="modules/add" method="post">
                                    <div class="form-group " :class="{'has-error' : errors.has('libelle_module')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="libelle_module">Libelle Module <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.libelle_module"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Libelle Module"
                                                    class="form-control "
                                                    type="text"
                                                    name="libelle_module"
                                                    placeholder="Enter Libelle Module"
                                                    />
                                                    <small v-show="errors.has('libelle_module')" class="form-text text-danger">
                                                        {{ errors.first('libelle_module') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('id_filiere')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="id_filiere">Id Filiere <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <dataselect
                                                        v-model="data.id_filiere"
                                                        data-vv-value-path="data.id_filiere"
                                                        data-vv-as="Id Filiere"
                                                        v-validate="{required:true}"
                                                        placeholder="Select A Value ... " name="id_filiere" :multiple="false" 
                                                        :datapath="'components/modules_id_filiere_option_list/'"
                                                        >
                                                    </dataselect>
                                                    <small v-show="errors.has('id_filiere')" class="form-text text-danger">{{ errors.first('id_filiere') }}</small>
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
	var ModulesAddComponent = Vue.component('modulesAdd', {
		template : '#modulesAdd',
		mixins: [AddPageMixin],
		props:{
			pagename : {
				type : String,
				default : 'modules',
			},
			routename : {
				type : String,
				default : 'modulesadd',
			},
			apipath : {
				type : String,
				default : 'modules/add',
			},
		},
		data : function() {
			return {
				id : {
					type : String,
					default : '',
				},
				data : {
					libelle_module: '',id_filiere: '',
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
				this.$router.push('');
			},
			resetForm : function(){
				this.data = {libelle_module: '',id_filiere: '',};
				this.$validator.reset();
			},
		},
		mounted : function() {
		},
	});
	</script>
