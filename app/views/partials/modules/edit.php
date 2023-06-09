    <template id="modulesEdit">
        <section class="page-component">
            <div v-if="showheader" class="bg-light p-3 mb-3">
                <div class="container">
                    <div class="row ">
                        <div  class="col-12 comp-grid" :class="setGridSize">
                            <h3 class="record-title">modifier</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div  class="pb-2 mb-3 border-bottom">
                <div class="container">
                    <div class="row ">
                        <div  class="col-md-7 comp-grid" :class="setGridSize">
                            <div  class=" animated fadeIn">
                                <form  v-show="!loading" enctype="multipart/form-data" @submit="update()" class="form form-default" :action="'modules/edit/' + data.id" method="post">
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
                                                <label class="control-label" for="id_filiere">Filiere <span class="text-danger">*</span></label>
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
                                        <button @click="update()" :disabled="errors.any()" class="btn btn-primary" type="button">
                                            <i class="load-indicator"><clip-loader :loading="saving" color="#fff" size="14px"></clip-loader> </i>
                                            {{submitbuttontext}}
                                            <i class="fa fa-send"></i>
                                        </button>
                                    </div>
                                </form>
                                <div v-show="loading" class="load-indicator static-center">
                                    <span class="animator">
                                        <clip-loader :loading="loading" color="gray" size="20px">
                                        </clip-loader>
                                    </span>
                                    <h4 style="color:gray" class="loading-text">Chargement...</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </template>
    <script>
	var ModulesEditComponent = Vue.component('modulesEdit', {
		template : '#modulesEdit',
		mixins: [EditPageMixin],
		props: {
			pagename : {
				type : String,
				default : 'modules',
			},
			routename : {
				type : String,
				default : 'modulesedit',
			},
			apipath : {
				type : String,
				default : 'modules/edit',
			},
		},
		data: function() {
			return {
				data : { libelle_module: '',id_filiere: '', },
			}
		},
		computed: {
			pageTitle: function(){
				return 'modifier';
			},
		},
		methods: {
			actionAfterUpdate : function(response){
				this.$root.$emit('requestCompleted' , this.msgafterupdate);
				if(!this.ismodal){
					this.$router.push('');
				}
			},
		},
		watch: {
			id: function(newVal, oldVal) {
				if(this.id){
					this.load();
				}
			},
			modelBind: function(){
				var binds = this.modelBind;
				for(key in binds){
					this.data[key]= binds[key];
				}
			},
			pageTitle: function(){
				this.SetPageTitle( this.pageTitle );
			},
		},
		created: function(){
			this.SetPageTitle(this.pageTitle);
		},
		mounted: function() {
			//this.load();
		},
	});
	</script>
