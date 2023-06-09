        <template id="Home">
            <div>
                <div  class="bg-light p-3 mb-3">
                    <div class="container">
                        <div class="row ">
                            <div  class="col-md-12 comp-grid" :class="setGridSize">
                                <h3 >Le tableau de bord</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div  class="pb-2 mb-3 border-bottom">
                    <div class="container">
                        <div class="row ">
                            <div  class="col-md-12 comp-grid" :class="setGridSize">
                            </div>
                        </div>
                    </div>
                </div>
                <div  class="pb-2 mb-3 border-bottom">
                    <div class="container">
                        <div class="row ">
                            <div  class="col-md-3 col-sm-4 col-6 comp-grid" :class="setGridSize">
                            <recordprogress layout="box" :diameter="90" animate="zoomIn" datapath="components/getcount_etudiants" title="Etudiants" desc="" link="/etudiants" icon='<i class="fa fa-user "></i>' :progressmax="100" displaystyle="card" variant="success"></recordprogress>
                        </div>
                        <div  class="col-md-3 col-sm-4 col-6 comp-grid" :class="setGridSize">
                        <recordprogress layout="box" :diameter="90" animate="zoomIn" datapath="components/getcount_professeurs" title="Professeurs" desc="" link="/professeurs" icon='<i class="fa fa-users "></i>' :progressmax="100" displaystyle="card" variant="warning"></recordprogress>
                    </div>
                    <div  class="col-md-3 col-sm-4 col-6 comp-grid" :class="setGridSize">
                    <recordprogress layout="box" :diameter="90" animate="zoomIn" datapath="components/getcount_tuteurs" title="Tuteurs" desc="" link="/tuteurs" icon='<i class="fa fa-user-secret "></i>' :progressmax="100" displaystyle="card" variant="info"></recordprogress>
                </div>
                <div  class="col-md-3 col-sm-4 col-6 comp-grid" :class="setGridSize">
                <recordprogress layout="box" :diameter="90" animate="zoomIn" datapath="components/getcount_classes" title="Classes" desc="" link="/classes" icon='<i class="fa fa-clone "></i>' :progressmax="100" displaystyle="card" variant="danger"></recordprogress>
            </div>
        </div>
        </div>
        </div>
        <div  class="pb-2 mb-3 border-bottom">
            <div class="container">
                <div class="row ">
                    <div  class="col-md-12 comp-grid" :class="setGridSize">
                    </div>
                    <div  class="col-md-6 comp-grid" :class="setGridSize">
                        <div class="">
                            <div>
                                <h4>Nombre des étudiants dans une fiiére </h4>
                                <small class="text-muted">Le nombre des étudinats dans chaque filiéres</small>
                            </div>
                            <hr />
                            <div>
                                <nicechart
                                    charttype="bar"
                                    :datapath="'components/barchart_nombredestudiantsdansunefiire/'"
                                    :datasets="[{
                                    label: 'Dataset 1',
                                    backgroundColor:'rgba(255 , 128 , 0, 0.5)',
                                    borderWidth:3,
                                    data : []
                                    }]"
                                    :xlabel="'Filiére'"
                                    :ylabel="'Nb.etudiants'"
                                    :gridlines="true"
                                    :ticks="true"
                                    >
                                </nicechart>
                            </div>
                        </div>
                    </div>
                    <div  class="col-md-6 comp-grid" :class="setGridSize">
                        <div class="">
                            <div>
                                <h4>Le nombre des étudiants par L'année</h4>
                                <small class="text-muted">Le nombre des étudiants par chaque année</small>
                            </div>
                            <hr />
                            <div>
                                <nicechart
                                    charttype="bar"
                                    :datapath="'components/barchart_lenombredestudiantsparlanne/'"
                                    :datasets="[{
                                    label: 'Dataset 1',
                                    backgroundColor:'rgba(64 , 0 , 128, 0.5)',
                                    borderWidth:3,
                                    data : []
                                    }]"
                                    :xlabel="'Nb.Etudiants'"
                                    :ylabel="'Année'"
                                    :gridlines="true"
                                    :ticks="true"
                                    >
                                </nicechart>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </template>
        <script>
			var HomeComponent = Vue.component('HomeComponent', {
				template : '#Home',
				props: {
					resetgrid : {
						type : Boolean,
						default : false,
					},
				},
				data : function() {
					return {
						loading : false,
						ready: false,
					}
				},
				computed: {
					setGridSize: function(){
						if(this.resetgrid){
							return 'col-sm-12 col-md-12 col-lg-12';
						}
					}
				},
				methods : {

				},
				mounted : function() {
					this.ready = true;
				},
			});
		</script>
	