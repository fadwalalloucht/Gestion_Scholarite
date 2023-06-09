    <template id="examensEdit">
        <section class="page-component">
            <div v-if="showheader" class="bg-light p-3 mb-3">
                <div class="container">
                    <div class="row ">
                        <div  class="col-12 comp-grid" :class="setGridSize">
                            <h3 class="record-title">Ajouter un examen</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div  class="pb-2 mb-3 border-bottom">
                <div class="container">
                    <div class="row ">
                        <div  class="col-md-7 comp-grid" :class="setGridSize">
                            <div  class=" animated fadeIn">
                                <form  v-show="!loading" enctype="multipart/form-data" @submit="update()" class="form form-default" :action="'examens/edit/' + data.id" method="post">
                                    <div class="form-group " :class="{'has-error' : errors.has('libelle_examen')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="libelle_examen"> Examen <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.libelle_examen"
                                                    v-validate="{required:true}"
                                                    data-vv-as=" Examen"
                                                    class="form-control "
                                                    type="text"
                                                    name="libelle_examen"
                                                    placeholder="Enter  Examen"
                                                    />
                                                    <small v-show="errors.has('libelle_examen')" class="form-text text-danger">
                                                        {{ errors.first('libelle_examen') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('date')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="date">Date <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <flat-pickr
                                                    v-model="data.date"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Date"
                                                    name="date"
                                                    placeholder="Enter Date"
                                                    :config="{
                                                    dateFormat: 'Y-m-d',
                                                    altFormat: 'F j, Y',
                                                    altInput: true, 
                                                    allowInput:true
                                                    }"
                                                    >
                                                    </flat-pickr>
                                                    <small v-show="errors.has('date')" class="form-text text-danger">{{ errors.first('date') }}</small>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('heur_debut')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="heur_debut">Heur Debut <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <flat-pickr
                                                    v-model="data.heur_debut"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Heur Debut"
                                                    name="heur_debut"
                                                    placeholder="Enter Heur Debut"
                                                    :config="{
                                                    enableTime: true,
                                                    noCalendar: true, 
                                                    dateFormat: 'H:i:S',
                                                    altInput: true,
                                                    allowInput:true
                                                    }"
                                                    >
                                                    </flat-pickr>
                                                    <small v-show="errors.has('heur_debut')" class="form-text text-danger">{{ errors.first('heur_debut') }}</small>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"><i class="fa fa-clock"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('heur_fin')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="heur_fin">Heur Fin <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <flat-pickr
                                                    v-model="data.heur_fin"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Heur Fin"
                                                    name="heur_fin"
                                                    placeholder="Enter Heur Fin"
                                                    :config="{
                                                    enableTime: true,
                                                    noCalendar: true, 
                                                    dateFormat: 'H:i:S',
                                                    altInput: true,
                                                    allowInput:true
                                                    }"
                                                    >
                                                    </flat-pickr>
                                                    <small v-show="errors.has('heur_fin')" class="form-text text-danger">{{ errors.first('heur_fin') }}</small>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"><i class="fa fa-clock"></i></span>
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
	var ExamensEditComponent = Vue.component('examensEdit', {
		template : '#examensEdit',
		mixins: [EditPageMixin],
		props: {
			pagename : {
				type : String,
				default : 'examens',
			},
			routename : {
				type : String,
				default : 'examensedit',
			},
			apipath : {
				type : String,
				default : 'examens/edit',
			},
		},
		data: function() {
			return {
				data : { libelle_examen: '',date: '',heur_debut: '',heur_fin: '', },
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
					this.$router.push('/examens');
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
