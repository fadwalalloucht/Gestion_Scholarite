    <template id="seancesEdit">
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
                                <form  v-show="!loading" enctype="multipart/form-data" @submit="update()" class="form form-default" :action="'seances/edit/' + data.id" method="post">
                                    <div class="form-group " :class="{'has-error' : errors.has('Libelle_seance')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="Libelle_seance">Libelle Seance </label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.Libelle_seance"
                                                    v-validate="{}"
                                                    data-vv-as="Libelle Seance"
                                                    class="form-control "
                                                    type="text"
                                                    name="Libelle_seance"
                                                    placeholder="Enter Libelle Seance"
                                                    />
                                                    <small v-show="errors.has('Libelle_seance')" class="form-text text-danger">
                                                        {{ errors.first('Libelle_seance') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('heurDebut_seance')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="heurDebut_seance">Heurdebut Seance </label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.heurDebut_seance"
                                                    v-validate="{}"
                                                    data-vv-as="Heurdebut Seance"
                                                    class="form-control "
                                                    type="text"
                                                    name="heurDebut_seance"
                                                    placeholder="Enter Heurdebut Seance"
                                                    />
                                                    <small v-show="errors.has('heurDebut_seance')" class="form-text text-danger">
                                                        {{ errors.first('heurDebut_seance') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('heurFin_seance')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="heurFin_seance">Heurfin Seance </label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.heurFin_seance"
                                                    v-validate="{}"
                                                    data-vv-as="Heurfin Seance"
                                                    class="form-control "
                                                    type="text"
                                                    name="heurFin_seance"
                                                    placeholder="Enter Heurfin Seance"
                                                    />
                                                    <small v-show="errors.has('heurFin_seance')" class="form-text text-danger">
                                                        {{ errors.first('heurFin_seance') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('date_seance')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="date_seance">Date Seance </label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <flat-pickr
                                                    v-model="data.date_seance"
                                                    v-validate="{}"
                                                    data-vv-as="Date Seance"
                                                    name="date_seance"
                                                    placeholder="Enter Date Seance"
                                                    :config="{
                                                    dateFormat: 'Y-m-d',
                                                    altFormat: 'F j, Y',
                                                    altInput: true, 
                                                    allowInput:true
                                                    }"
                                                    >
                                                    </flat-pickr>
                                                    <small v-show="errors.has('date_seance')" class="form-text text-danger">{{ errors.first('date_seance') }}</small>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
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
	var SeancesEditComponent = Vue.component('seancesEdit', {
		template : '#seancesEdit',
		mixins: [EditPageMixin],
		props: {
			pagename : {
				type : String,
				default : 'seances',
			},
			routename : {
				type : String,
				default : 'seancesedit',
			},
			apipath : {
				type : String,
				default : 'seances/edit',
			},
		},
		data: function() {
			return {
				data : { Libelle_seance: '',heurDebut_seance: '',heurFin_seance: '',date_seance: '', },
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
					this.$router.push('/seances');
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
