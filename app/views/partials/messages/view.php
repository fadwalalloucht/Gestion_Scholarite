    <template id="messagesView">
        <section class="page-component">
            <div v-if="showheader" class="bg-light p-3 mb-3">
                <div class="container">
                    <div class="row ">
                        <div  class="col-12 comp-grid" :class="setGridSize">
                            <h3 class="record-title">Vue Messages</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div  class="pb-2 mb-3 border-bottom">
                <div class="container">
                    <div class="row ">
                        <div  class="col-md-12 comp-grid" :class="setGridSize">
                            <div  class=" animated fadeIn">
                                <div v-show="!loading">
                                    <div ref="datatable" id="datatable">
                                        <table class="table table-hover table-borderless table-striped">
                                            <!-- Table Body Start -->
                                            <tbody>
                                                <tr>
                                                    <th class="title"> Id Message :</th>
                                                    <td class="value"> {{ data.id_message }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Libelle Message :</th>
                                                    <td class="value"> {{ data.libelle_message }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Emmeteur :</th>
                                                    <td class="value"> {{ data.emmeteur }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Recepteur :</th>
                                                    <td class="value"> {{ data.recepteur }} </td>
                                                </tr>
                                            </tbody>
                                            <!-- Table Body End -->
                                        </table>
                                    </div>
                                    <div v-if="editbutton || deletebutton || exportbutton" class="py-3">
                                        <span >
                                            <router-link class="btn btn-sm btn-info has-tooltip" v-if="editbutton"  :to="'/messages/edit/'  + data.id_message">
                                            <i class="fa fa-edit"></i> Modifier
                                            </router-link>
                                            <button @click="deleteRecord" class="btn btn-sm btn-danger" v-if="deletebutton" :to="'/messages/delete/' + data.id_message">
                                            <i class="fa fa-times"></i> Effacer</button>
                                        </span>
                                        <button @click="exportRecord" class="btn btn-sm btn-primary" v-if="exportbutton">
                                            <i class="fa fa-save"></i> Exportation
                                        </button>
                                    </div>
                                </div>
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
	var MessagesViewComponent = Vue.component('messagesView', {
		template : '#messagesView',
		mixins: [ViewPageMixin],
		props: {
			pagename: {
				type : String,
				default : 'messages',
			},
			routename : {
				type : String,
				default : 'messagesview',
			},
			apipath: {
				type : String,
				default : 'messages/view',
			},
		},
		data: function() {
			return {
				data : {
					default :{
						id_message: '',libelle_message: '',emmeteur: '',recepteur: '',
					},
				},
			}
		},
		computed: {
			pageTitle: function(){
				return 'Vue Messages';
			},
		},
		methods :{
			resetData : function(){
				this.data = {
					id_message: '',libelle_message: '',emmeteur: '',recepteur: '',
				}
			},
		},
	});
	</script>
