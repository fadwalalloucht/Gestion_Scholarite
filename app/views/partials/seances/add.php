    <template id="seancesAdd">
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
                                <form enctype="multipart/form-data" @submit="save" class="form form-default" action="seances/add" method="post">
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
	var SeancesAddComponent = Vue.component('seancesAdd', {
		template : '#seancesAdd',
		mixins: [AddPageMixin],
		props:{
			pagename : {
				type : String,
				default : 'seances',
			},
			routename : {
				type : String,
				default : 'seancesadd',
			},
			apipath : {
				type : String,
				default : 'seances/add',
			},
		},
		data : function() {
			return {
				id : {
					type : String,
					default : '',
				},
				data : {
					Libelle_seance: '',heurDebut_seance: '',heurFin_seance: '',date_seance: '',
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
				this.$router.push('/seances');
			},
			resetForm : function(){
				this.data = {Libelle_seance: '',heurDebut_seance: '',heurFin_seance: '',date_seance: '',};
				this.$validator.reset();
			},
		},
		mounted : function() {
		},
	});
	</script>
