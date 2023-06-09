
<?php 
$can_addCours = PageAccessManager::is_allowed('cours/add');
$can_addExercices = PageAccessManager::is_allowed('exercices/add');
$can_edit = PageAccessManager::is_allowed('matieres/edit');
$can_view = PageAccessManager::is_allowed('matieres/view');
$can_delete = PageAccessManager::is_allowed('matieres/delete');
$can_examen= PageAccessManager::is_allowed('examens/add');
?>  
<template id="matieresList">
        <section class="page-component">
            <div v-if="showheader" class="bg-light p-3 mb-3">
                <div class="container-fluid">
                    <div class="row ">
                        <div  class="col-sm-4 comp-grid" :class="setGridSize">
                            <h3 class="record-title">Matieres</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div  class="pb-2 mb-3 border-bottom">
                <div class="container-fluid">
                    <div class="row ">
                        <div  class="col-md-12 comp-grid" :class="setGridSize">
                            <div  class=" animated fadeIn">
                                <div class="">

                                    <div v-if="records.length" ref="datatable" class="table-responsive">
                                        <table class="table" :class="tablestyle">
                                            <thead class="table-header bg-light">
                                                <tr>
                                                    <th v-if="multicheckbox" class="td-sno td-checkbox">
                                                        <label>
                                                            <input type="checkbox" v-model="allSelected" />
                                                        </label>
                                                    </th>
                                                    <th v-if="listsequence" class="td-sno">#</th>
                                                    <th > Libelle Matiere</th>
                                                    <th class="td-btn"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(data,index) in records">
                                                    <th v-if="multicheckbox" class="td-checkbox">
                                                        <label>
                                                            <input type="checkbox" :value="data.id_matiere" name="selectedid" v-model="selected" />
                                                        </label>
                                                    </th>
                                                    <th v-if="listsequence" class="td-sno">{{index + 1}}</th>
                                                    <td> {{ data.Libelle_matiere }} </td>
                                                    <th class="td-btn">
                                                        <div >
                                                        <div >
                                                        <?php 

if($can_addCours){
?>
    <button v-if="viewbutton" class="btn btn-sm btn-outline-primary" title="View Record" @click="showPageModal({page:'examensEdit',  id:data.id_matiere+'-Ex'})">
        <i class="fa fa-eye"></i> Examens
    </button>
    <?php 
    }

?>
                                                        <?php 

                                                        if($can_addCours){
                                                        ?>
                                                            <button v-if="viewbutton" class="btn btn-sm btn-outline-primary" title="View Record" @click="showPageModal({page:'coursEdit',  id:data.id_matiere+'-AC'})">
                                                                <i class="fa fa-eye"></i> Cours
                                                            </button>
                                                            <?php 
                                                            }
                                                            if($can_addExercices){

                                                        ?>
                                                            <button v-if="editbutton" class="btn btn-sm btn-outline-success" title="Edit This Record" @click="showPageModal({page:'exercicesEdit', id: data.id_matiere+'-AE'})">
                                                                <i class="fa fa-edit"></i> Exercices
                                                            </button>
                                                            <?php 
                                                            }
                                                            if($can_view){

                                                        ?>
                                                        
                                                            <router-link v-if="viewbutton" class="btn btn-sm btn-outline-primary" title="View Record" :to="'/matieres/view/' + data.id_matiere">
                                                            <i class="fa fa-eye"></i> Détail
                                                            </router-link>
                                                            <?php 
                                                            }
                                                            if($can_edit){

                                                        ?>
                                                        
                                                            <router-link v-if="editbutton" class="btn btn-sm btn-outline-success" title="Edit This Record" :to="'/matieres/edit/' + data.id_matiere">
                                                            <i class="fa fa-edit"></i> Modifier
                                                            </router-link>
                                                            <?php 
                                                            }
                                                            if($can_delete){

                                                        ?>
                                                            <button  v-if="deletebutton" class="btn btn-outline-danger btn-sm" @click="deleteRecord(data.id_matiere,index)" title="Delete This Record">
                                                                <span v-show="deleting != data.id_matiere"><i class="fa fa-times"></i></span>
                                                                Effacer
                                                                <clip-loader :loading="deleting == data.id_matiere" color="#fff" size="14px"></clip-loader>
                                                            </button>
                                                            <?php 
                                                            }

                                                        ?>
                                                        
                                                    </th>
                                                </tr>
                                            </tbody>
                                        </table>
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
                                        <button @click="exportRecord()" v-if="exportbutton" class="btn btn-sm btn-primary"><i class="fa fa-save"></i> Exportation</button>
                                        <dataimport extensions="" buttontext="Importer des données" post-action="matieres/import_data" v-if="importbutton"></dataimport>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </template>
    <script>
	var MatieresListComponent = Vue.component('matieresList', {
		template: '#matieresList',
		mixins: [ListPageMixin],
		props: {
			limit : {
				type : Number,
				default : defaultPageLimit,
			},
			pagename : {
				type : String,
				default : 'matieres',
			},
			routename : {
				type : String,
				default : 'matiereslist',
			},
			apipath : {
				type : String,
				default : 'matieres/list',
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
				return 'Matieres';
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
						var id = this.records[i].id_matiere;
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
