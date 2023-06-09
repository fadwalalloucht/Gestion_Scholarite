    <template id="paiementEdit">
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
                                <form  v-show="!loading" enctype="multipart/form-data" @submit="update()" class="form form-default" :action="'paiement/edit/' + data.id" method="post">
                                    <div class="form-group " :class="{'has-error' : errors.has('Date_Paiement')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="Date_Paiement">Date Paiement <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <flat-pickr
                                                    v-model="data.Date_Paiement"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Date Paiement"
                                                    name="Date_Paiement"
                                                    placeholder="Enter Date Paiement"
                                                    :config="{
                                                    dateFormat: 'Y-m-d',
                                                    altFormat: 'F j, Y',
                                                    altInput: true, 
                                                    allowInput:true
                                                    }"
                                                    >
                                                    </flat-pickr>
                                                    <small v-show="errors.has('Date_Paiement')" class="form-text text-danger">{{ errors.first('Date_Paiement') }}</small>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"><i class="fa fa-calendar "></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('Montant')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="Montant">Montant <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <input v-model="data.Montant"
                                                    v-validate="{required:true,  numeric:true}"
                                                    data-vv-as="Montant"
                                                    class="form-control "
                                                    type="number"
                                                    name="Montant"
                                                    placeholder="Enter Montant"
                                                    step="1" 
                                                    />
                                                    <small v-show="errors.has('Montant')" class="form-text text-danger">
                                                        {{ errors.first('Montant') }}
                                                    </small>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"><i class="fa fa-money "></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('Type_paiement')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="Type_paiement">Moyen de Paiment </label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <dataselect
                                                        v-model="data.Type_paiement"
                                                        data-vv-value-path="data.Type_paiement"
                                                        data-vv-as="Moyen de Paiment"
                                                        v-validate="{}"
                                                        placeholder="  de paiment__" name="Type_paiement" :multiple="false" 
                                                        :datasource="Type_paiementOptionList"
                                                        >
                                                    </dataselect>
                                                    <small v-show="errors.has('Type_paiement')" class="form-text text-danger">{{ errors.first('Type_paiement') }}</small>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"><i class="fa fa-credit-card-alt "></i></span>
                                                    </div>
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
	var PaiementEditComponent = Vue.component('paiementEdit', {
		template : '#paiementEdit',
		mixins: [EditPageMixin],
		props: {
			pagename : {
				type : String,
				default : 'paiement',
			},
			routename : {
				type : String,
				default : 'paiementedit',
			},
			apipath : {
				type : String,
				default : 'paiement/edit',
			},
		},
		data: function() {
			return {
				data : { Date_Paiement: '',Montant: '',Type_paiement: '', },
				Type_paiementOptionList: [{"label":"Cheque","value":"cheque"},{"label":"Espaces","value":"espaces"},{"label":"Carte Bancaire","value":"carte bancaire"},{"label":"Viresement","value":"viresement"}],
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
					this.$router.push('/paiement');
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
