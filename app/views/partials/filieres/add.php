    <template id="filieresAdd">
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
                                <form enctype="multipart/form-data" @submit="save" class="form form-default" action="filieres/add" method="post">
                                    <div class="form-group " :class="{'has-error' : errors.has('libelle_filiere')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="libelle_filiere">Nom d'une Filiere <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.libelle_filiere"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Nom d'une Filiere"
                                                    class="form-control "
                                                    type="text"
                                                    name="libelle_filiere"
                                                    placeholder="Enter Nom d-une Filiere"
                                                    />
                                                    <small v-show="errors.has('libelle_filiere')" class="form-text text-danger">
                                                        {{ errors.first('libelle_filiere') }}
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
	var FilieresAddComponent = Vue.component('filieresAdd', {
		template : '#filieresAdd',
		mixins: [AddPageMixin],
		props:{
			pagename : {
				type : String,
				default : 'filieres',
			},
			routename : {
				type : String,
				default : 'filieresadd',
			},
			apipath : {
				type : String,
				default : 'filieres/add',
			},
		},
		data : function() {
			return {
				id : {
					type : String,
					default : '',
				},
				data : {
					libelle_filiere: '',
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
				this.$router.push('/filieres');
			},
			resetForm : function(){
				this.data = {libelle_filiere: '',};
				this.$validator.reset();
			},
		},
		mounted : function() {
		},
	});
	</script>
