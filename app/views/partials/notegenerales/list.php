<?php 
$can_add = PageAccessManager::is_allowed('notegenerales/add');
$can_edit = PageAccessManager::is_allowed('notegenerales/edit');
$can_view = PageAccessManager::is_allowed('notegenerales/view');
$can_delete = PageAccessManager::is_allowed('notegenerales/delete');
?>
<template id="notegeneralesList">
    <section class="page-component">
        <div v-if="showheader" class="bg-light p-3 mb-3">
            <div class="container-fluid">
                <div class="row ">
                    <div  class="col-sm-4 comp-grid" :class="setGridSize">
                        <h3 class="record-title">Notegenerales</h3>
                    </div>
                    <div  class="col-sm-3 comp-grid" :class="setGridSize">
                        <?php 
                        if($can_add){
                        ?>
                        <router-link v-if="addbutton" class="btn btn btn-primary btn-block" :to="'/notegenerales/add'">
                        <i class="fa fa-plus"></i>
                        Ajouter un nouveau
                        </router-link>
                        <?php 
                        }
                        ?>
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
                        <div  class=" animated fadeIn">
                            <div class="">
                                <nav v-if="fieldname || filterMsgs.length" class="page-header-breadcrumbs mb-3" aria-label="breadcrumb">
                                    <ul class="breadcrumb m-0 p-2">
                                        <li v-if="fieldname" class="breadcrumb-item">
                                            <router-link class="text-capitalize" to="/notegenerales">Notegenerales</router-link>
                                        </li>
                                        <li v-if="fieldvalue" class="breadcrumb-item active"  aria-current="page"> 
                                            <span class="text-capitalize">{{ fieldname|makeRead }} </span> &raquo;
                                            <span class="bold">{{ fieldvalue }}</span>
                                        </li>
                                        <li v-if="filterMsgs.length" v-for="msg in filterMsgs" class="breadcrumb-item active"  aria-current="page"> 
                                            <span>{{ msg.label }} </span> 
                                            &raquo;
                                            <span class="bold">{{ msg.value }}</span> 
                                        </li>
                                    </ul>
                                </nav>
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
                                                <th > Nom De L' Examen</th>
                                                <th > Filiere</th>
                                                <th > Nom De Module</th>
                                                <th > Nom De Matiere</th>
                                                <th > Note</th>
                                                <th class="td-btn"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(data,index) in records">
                                                <th v-if="multicheckbox" class="td-checkbox">
                                                    <label>
                                                        <input type="checkbox" :value="data.id" name="selectedid" v-model="selected" />
                                                    </label>
                                                </th>
                                                <th v-if="listsequence" class="td-sno">{{index + 1}}</th>
                                                <td> {{ data.libelle_examen }} </td>
                                                <td> {{ data.libelle_filiere }} </td>
                                                <td> {{ data.Libelle_module }} </td>
                                                <td> {{ data.Libelle_matiere }} </td>
                                                <td> {{ data.note }} </td>
                                                <th class="td-btn">
                                                    <div >
                                                        <?php 
                                                        if($can_view){
                                                        ?>
                                                        <button v-if="viewbutton" class="btn btn-sm btn-outline-primary" title="View Record" @click="showPageModal({page:'notegeneralesView',  id:data.id})">
                                                            <i class="fa fa-eye"></i> Vue
                                                        </button>
                                                        <?php 
                                                        }
                                                        ?>
                                                        <?php 
                                                        if($can_edit){
                                                        ?>
                                                        <button v-if="editbutton" class="btn btn-sm btn-outline-success" title="Edit This Record" @click="showPageModal({page:'notegeneralesEdit', id: data.id})">
                                                            <i class="fa fa-edit"></i> Modifier
                                                        </button>
                                                        <?php 
                                                        }
                                                        ?>
                                                        <?php 
                                                        if($can_delete){
                                                        ?>
                                                        <button  v-if="deletebutton" class="btn btn-outline-danger btn-sm" @click="deleteRecord(data.id,index)" title="Delete This Record">
                                                            <span v-show="deleting != data.id"><i class="fa fa-times"></i></span>
                                                            Effacer
                                                            <clip-loader :loading="deleting == data.id" color="#fff" size="14px"></clip-loader>
                                                        </button>
                                                        <?php 
                                                        }
                                                        ?>
                                                    </div>
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
	var NotegeneralesListComponent = Vue.component('notegeneralesList', {
		template: '#notegeneralesList',
		mixins: [ListPageMixin],
		props: {
			limit : {
				type : Number,
				default : defaultPageLimit,
			},
			pagename : {
				type : String,
				default : 'notegenerales',
			},
			routename : {
				type : String,
				default : 'notegeneraleslist',
			},
			apipath : {
				type : String,
				default : 'notegenerales/list',
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
				return 'Notes';
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
						var id = this.records[i].id;
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
