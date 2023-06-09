    <template id="exercicesList">
        <section class="page-component">
            <div v-if="showheader" class="bg-light p-3 mb-3">
                <div class="container-fluid">
                    <div class="row ">
                        <div  class="col-sm-4 comp-grid" :class="setGridSize">
                            <h3 class="record-title">Exercices</h3>
                        </div>
                        <div  class="col-sm-3 comp-grid" :class="setGridSize">
                        </div>
                        <div v-if="searchfield" class="col-sm-5 comp-grid" :class="setGridSize">
                            <input @keyup.enter="dosearch()" v-model="searchtext" class="form-control" type="text" name="search" placeholder="Chercher" />
                        </div>
                    </div>
                </div>
            </div>
            <div  class="pb-2 mb-3 border-bottom">
                <div class="container-fluid">
                    <div class="row ">
                        <div  class="col-md-12 comp-grid" :class="setGridSize">
                        </div>
                    </div>
                </div>
            </div>
            <div  class="pb-2 mb-3 border-bottom">
                <div class="container">
                    <div class="row ">
                        <div  class="col-md-12 comp-grid" :class="setGridSize">
                            <div class="card">
                                <b-tabs horizontal  card class="" >
                                <b-tab title=" Liste Des Examens">
                                <div  class=" animated fadeIn">
                                    <div class="">
                                        <div v-if="records.length" ref="datatable">
                                            <div class="row">
                                                <div class="col-sm-4" v-for="(data,index) in records" >
                                                    <div class="card p-2 mb-4">
                                                        <div>
                                                            <strong>Description Exercice</strong> :  {{ data.description_Exercice }} 
                                                        </div>
                                                        <div>
                                                    <strong>Fichier : </strong> <a class="btn btn-info btn-sm" target="" v-if="data.photo" :href="data.photo"><i class="fa fa-file"></i></a>
                                                    </div>
                                                        <div >
                                                            <button v-if="viewbutton" class="btn btn-sm btn-outline-primary" title="View Record" @click="showPageModal({page:'exercicesView',  id:data.id_Exercice})">
                                                                <i class="fa fa-eye"></i> Vue
                                                            </button>
                                                            <button v-if="editbutton" class="btn btn-sm btn-outline-success" title="Edit This Record" @click="showPageModal({page:'exercicesEdit', id: data.id_Exercice})">
                                                                <i class="fa fa-edit"></i> Modifier
                                                            </button>
                                                            <button  v-if="deletebutton" class="btn btn-outline-danger btn-sm" @click="deleteRecord(data.id_Exercice,index)" title="Delete This Record">
                                                                <span v-show="deleting != data.id_Exercice"><i class="fa fa-times"></i></span>
                                                                Effacer
                                                                <clip-loader :loading="deleting == data.id_Exercice" color="#fff" size="14px"></clip-loader>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div v-if="!records.length && emptyrecordmsg != '' && !loading" class="text-muted p-4 text-center">
                                            <h4><i class="fa fa-ban"></i> {{emptyrecordmsg}}</h4>
                                        </div>
                                        <div v-show="loading" class="load-indicator static-center">
                                            <span class="animator">
                                                <clip-loader :loading="loading" color="gray" size="20px">
                                                </clip-loader>
                                            </span>
                                            <h4 style="color:gray" class="loading-text">Chargement...</h4>
                                        </div>
                                        <div v-if="paginate" class="page-header">
                                            <div v-if="paginate">
                                                <pagination
                                                    :total-items="totalrecords"
                                                    :current-items-count="currentItemsCount"
                                                    :items-per-page="limit"
                                                    :offset="5"
                                                    :show-record-count="true"
                                                    :show-page-count="true"
                                                    :show-page-limit="true"
                                                    @limit-changed="limitChanged"
                                                    @changepage="changepage">
                                                </pagination>
                                            </div>
                                        </div>
                                        <div v-if="showfooter" class="page-footer">
                                            <button @click="deleteRecord()" v-if="selected.length" class="btn btn-sm btn-danger">
                                                <i class="fa fa-times"></i> Effacer
                                            </button>
                                            <button @click="exportRecord()" v-if="exportbutton" class="btn btn-sm btn-primary"><i class="fa fa-save"></i> Exporter</button>
                                            <dataimport extensions="" buttontext="Importer des données" post-action="exercices/import_data" v-if="importbutton"></dataimport>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body text-center"></div>
                                </b-tab>
                                </b-tabs>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </template>
    <script>
	var ExercicesListComponent = Vue.component('exercicesList', {
		template: '#exercicesList',
		mixins: [ListPageMixin],
		props: {
			limit : {
				type : Number,
				default : defaultPageLimit,
			},
			pagename : {
				type : String,
				default : 'exercices',
			},
			routename : {
				type : String,
				default : 'exerciceslist',
			},
			apipath : {
				type : String,
				default : 'exercices/list',
			},
			importbutton: {
				type: Boolean,
				default: false,
			},
			tablestyle: {
				type: String,
				default: ' table-striped table-sm',
			},
			promptdeletemessage: {
				type: String,
				default: 'Êtes-vous sûr de vouloir supprimer cet enregistrement?',
			},
		},
		data: function(){
			return {
				pagelimit : defaultPageLimit,
			}
		},
		computed : {
			pageTitle: function(){
				return 'Exercices';
			},
			filterGroupChange: function(){
				return ;
			},
		},
		watch : {
			allSelected: function(){
				//toggle selected record
				this.selected = [];
				if(this.allSelected == true){
					for (var i in this.records){
						var id = this.records[i].id_Exercice;
						this.selected.push(id);
					}
				}
			}
		},
		methods:{
			load:function(){
				this.records = [];
				if (this.loading == false){
					this.ready = false;
					this.loading = true;
					var url = this.apiUrl;
					this.$http.get(url).then(function (response) {
						var data = response.body;
						if(data && data.records){
							this.totalrecords = data.total_records ;
							if(this.pagelimit  > data.records.length){
								this.loadcompleted = true;
							}
							this.records = data.records;
						}
						else{
							this.$root.$emit('requestError' , response);
						}
						this.loading = false
						this.ready = true
					},
					function (response) {
						this.loading = false;
						this.$root.$emit('requestError' , response);
					});
				}
			},	
			filterGroup: function(){
				var filters = {};
				this.filterMsgs = [];
				this.filter(filters);
			},
		}
	});
	</script>
