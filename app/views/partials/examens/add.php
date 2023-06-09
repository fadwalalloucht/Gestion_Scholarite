    <template id="examensAdd">
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
                                <form enctype="multipart/form-data" @submit="save" class="form form-default" action="examens/add" method="post">
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
	var ExamensAddComponent = Vue.component('examensAdd', {
		template : '#examensAdd',
		mixins: [AddPageMixin],
		props:{
			pagename : {
				type : String,
				default : 'examens',
			},
			routename : {
				type : String,
				default : 'examensadd',
			},
			apipath : {
				type : String,
				default : 'examens/add',
			},
		},
		data : function() {
			return {
				id : {
					type : String,
					default : '',
				},
				data : {
					libelle_examen: '',date: '',heur_debut: '',heur_fin: '',
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
				this.data = {libelle_examen: '',date: '',heur_debut: '',heur_fin: '',};
				this.$validator.reset();
			},
		},
		mounted : function() {
		},
	});
	</script>
