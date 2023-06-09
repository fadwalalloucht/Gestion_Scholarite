    <template id="etudiantsEdit">
        <section class="page-component">
            <div v-if="showheader" class="bg-light p-3 mb-3">
                <div class="container">
                    <div class="row ">
                        <div class="col-12 comp-grid" :class="setGridSize">
                            <h3 class="record-title">modifier</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pb-2 mb-3 border-bottom">
                <div class="container">
                    <div class="row ">
                        <div class="col-md-7 comp-grid" :class="setGridSize">
                            <div class=" animated fadeIn">

                                <div v-show="loading" class="load-indicator static-center">
                                    <span class="animator">
                                        <clip-loader :loading="loading" color="gray" size="20px">
                                        </clip-loader>
                                    </span>
                                    <h4 style="color:gray" class="loading-text">Chargement...</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 comp-grid" :class="setGridSize">
                            <niceformwizard shape="tab" color="orange" step-size="md">
                                <template slot="header">
                                    <div class="text-left">
                                        <h4>Modifie Etudiant</h4>
                                        <p class="text-muted">Modifie les information d'etudiant</p>
                                    </div>
                                </template>
                                <tab-content icon=" " title="Step 1">
                                    <div class="">
                                        <div class="text-center">
                                            <form v-show="!loading" enctype="multipart/form-data" @submit="update()" class="form form-default" :action="'etudiants/edit/' + data.id" method="post">
                                                <div class="form-group " :class="{'has-error' : errors.has('photo')}">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <label class="control-label" for="photo">Photo </label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <div class="">
                                                                <niceupload fieldname="photo" control-class="upload-control" dropmsg="Drop files here to upload" uploadpath="uploads/files/" filenameformat="random" extensions="jpg , png , gif , jpeg" :filesize="3" :maximum="1" name="photo" v-model="data.photo" v-validate="{}" data-vv-as="Photo">
                                                                </niceupload>
                                                                <small v-show="errors.has('photo')" class="form-text text-danger">{{ errors.first('photo') }}</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group " :class="{'has-error' : errors.has('nom')}">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <label class="control-label" for="nom">Nom <span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <div class="">
                                                                <input v-model="data.nom" v-validate="{required:true}" data-vv-as="nom" class="form-control " type="text" name="nom" placeholder="Enter le Nom" />
                                                                <small v-show="errors.has('nom')" class="form-text text-danger">
                                                                    {{ errors.first('nom') }}
                                                                </small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group " :class="{'has-error' : errors.has('Prenom')}">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <label class="control-label" for="Prenom">Prenom <span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <div class="">
                                                                <input v-model="data.Prenom" v-validate="{required:true}" data-vv-as="Prenom" class="form-control " type="text" name="Prenom" placeholder="Enter Prenom" />
                                                                <small v-show="errors.has('Prenom')" class="form-text text-danger">
                                                                    {{ errors.first('Prenom') }}
                                                                </small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group " :class="{'has-error' : errors.has('CNE')}">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <label class="control-label" for="CNE">CNE <span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <div class="">
                                                                <input v-model="data.CNE" v-validate="{required:true}" data-vv-as="Cne" class="form-control " type="text" name="CNE" placeholder="Enter Cne" />
                                                                <small v-show="errors.has('CNE')" class="form-text text-danger">
                                                                    {{ errors.first('CNE') }}
                                                                </small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group " :class="{'has-error' : errors.has('CIN')}">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <label class="control-label" for="CIN">CIN <span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <div class="">
                                                                <input v-model="data.cin" v-validate="{required:true}" data-vv-as="Cin" class="form-control " type="text" name="cin" placeholder="Enter CIN" />
                                                                <small v-show="errors.has('CIN')" class="form-text text-danger">
                                                                    {{ errors.first('CIN') }}
                                                                </small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group " :class="{'has-error' : errors.has('lieu_naissance')}">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <label class="control-label" for="lieu_naissance">Lieu Naissance <span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <div class="">
                                                                <input v-model="data.lieu_naissance" v-validate="{required:true}" data-vv-as="Lieu Naissance" class="form-control " type="text" name="lieu_naissance" placeholder="Enter Lieu Naissance" />
                                                                <small v-show="errors.has('lieu_naissance')" class="form-text text-danger">
                                                                    {{ errors.first('lieu_naissance') }}
                                                                </small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group " :class="{'has-error' : errors.has('date_naissance')}">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <label class="control-label" for="date_naissance">Date Naissance <span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <div class="input-group">
                                                                <flat-pickr v-model="data.date_naissance" v-validate="{required:true}" data-vv-as="Date Naissance" name="date_naissance" placeholder="Enter Date Naissance" :config="{
                                                    dateFormat: 'Y-m-d',
                                                    altFormat: 'F j, Y',
                                                    altInput: true, 
                                                    allowInput:true
                                                    }">
                                                                </flat-pickr>
                                                                <small v-show="errors.has('date_naissance')" class="form-text text-danger">{{ errors.first('date_naissance') }}</small>
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group " :class="{'has-error' : errors.has('email')}">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <label class="control-label" for="email">Email <span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <div class="">
                                                                <input v-model="data.email" v-validate="{required:true}" data-vv-as="email" class="form-control " type="text" name="email" placeholder="Enter Email" />
                                                                <small v-show="errors.has('email')" class="form-text text-danger">
                                                                    {{ errors.first('email') }}
                                                                </small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group " :class="{'has-error' : errors.has('telephone')}">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <label class="control-label" for="telephone">Telephone <span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <div class="">
                                                                <input v-model="data.telephone" v-validate="{required:true}" data-vv-as="Cne" class="form-control " type="text" name="telephone" placeholder="Enter Telephone" />
                                                                <small v-show="errors.has('telephone')" class="form-text text-danger">
                                                                    {{ errors.first('telephone') }}
                                                                </small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group " :class="{'has-error' : errors.has('adresse')}">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <label class="control-label" for="adresse">Adresse <span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <div class="">
                                                                <textarea v-model="data.adresse" v-validate="{required:true}" data-vv-as="Adresse" placeholder="Enter Adresse" rows="2" name="adresse" class=" form-control"></textarea>
                                                                <small v-show="errors.has('adresse')" class="form-text text-danger">{{ errors.first('adresse') }}</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group " :class="{'has-error' : errors.has('genre')}">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <label class="control-label" for="genre">Genre <span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <div class="">
                                                                <dataradio v-model="data.genre" data-vv-value-path="data.genre" data-vv-as="Genre" v-validate="{required:false}" name="genre" :datasource="genreOptionList">
                                                                </dataradio>
                                                                <small v-show="errors.has('genre')" class="form-text text-danger">{{ errors.first('genre') }}</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </form>
                                            <wizardbtn icon='<i class="fa fa-chevron-right"></i>' text="Getting Started"></wizardbtn>
                                        </div>
                                    </div>
                                    <div class="card-body text-center"></div>
                                </tab-content>
                                <tab-content icon=" " title="Step 2">
                                    <div class="">
                                        <div class="text-center">
                                            <form v-show="!loading" enctype="multipart/form-data" @submit="update()" class="form form-default" :action="'etudiants/edit/' + data.id" method="post">

                                                <div class="form-group " :class="{'has-error' : errors.has('photoT')}">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <label class="control-label" for="photoT">Photo </label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <div class="">
                                                                <niceupload fieldname="photoT" control-class="upload-control" dropmsg="Drop files here to upload" uploadpath="uploads/files/" filenameformat="random" extensions="jpg , png , gif , jpeg" :filesize="3" :maximum="1" name="photoT" v-model="data.photoT" v-validate="{}" data-vv-as="PhotoT">
                                                                </niceupload>
                                                                <small v-show="errors.has('photoT')" class="form-text text-danger">{{ errors.first('photoT') }}</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group " :class="{'has-error' : errors.has('nomT')}">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <label class="control-label" for="nom">Nom <span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <div class="">
                                                                <input v-model="data.nomT" v-validate="{required:true}" data-vv-as="nomT" class="form-control " type="text" name="nomT" placeholder="Enter le Nom" />
                                                                <small v-show="errors.has('nomT')" class="form-text text-danger">
                                                                    {{ errors.first('nomT') }}
                                                                </small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group " :class="{'has-error' : errors.has('PrenomT')}">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <label class="control-label" for="PrenomT">Prenom <span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <div class="">
                                                                <input v-model="data.PrenomT" v-validate="{required:true}" data-vv-as="PrenomT" class="form-control " type="text" name="PrenomT" placeholder="Enter Prenom" />
                                                                <small v-show="errors.has('PrenomT')" class="form-text text-danger">
                                                                    {{ errors.first('PrenomT') }}
                                                                </small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group " :class="{'has-error' : errors.has('CINT')}">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <label class="control-label" for="CINT">CIN <span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <div class="">
                                                                <input v-model="data.cinT" v-validate="{required:true}" data-vv-as="CINT" class="form-control " type="text" name="CINT" placeholder="Enter CIN" />
                                                                <small v-show="errors.has('CINT')" class="form-text text-danger">
                                                                    {{ errors.first('CINT') }}
                                                                </small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="form-group " :class="{'has-error' : errors.has('emailT')}">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <label class="control-label" for="emailT">Email <span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <div class="">
                                                                <input v-model="data.emailT" v-validate="{required:true}" data-vv-as="emailT" class="form-control " type="text" name="emailT" placeholder="Enter Email" />
                                                                <small v-show="errors.has('emailT')" class="form-text text-danger">
                                                                    {{ errors.first('emailT') }}
                                                                </small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group " :class="{'has-error' : errors.has('telephoneT')}">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <label class="control-label" for="telephoneT">Telephone <span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <div class="">
                                                                <input v-model="data.telephoneT" v-validate="{required:true}" data-vv-as="telephoneT" class="form-control " type="text" name="telephoneT" placeholder="Enter Telephone" />
                                                                <small v-show="errors.has('telephoneT')" class="form-text text-danger">
                                                                    {{ errors.first('telephoneT') }}
                                                                </small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group " :class="{'has-error' : errors.has('adresseT')}">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <label class="control-label" for="adresseT">Adresse <span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <div class="">
                                                                <textarea v-model="data.adresseT" v-validate="{required:true}" data-vv-as="adresseT" placeholder="Enter Adresse" rows="2" name="adresseT" class=" form-control"></textarea>
                                                                <small v-show="errors.has('adresseT')" class="form-text text-danger">{{ errors.first('adresseT') }}</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group " :class="{'has-error' : errors.has('genreT')}">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <label class="control-label" for="genre">Genre <span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <div class="">
                                                                <dataradio v-model="data.genreT" data-vv-value-path="data.genreT" data-vv-as="genreT" v-validate="{required:false}" name="genreT" :datasource="genreOptionList">
                                                                </dataradio>
                                                                <small v-show="errors.has('genreT')" class="form-text text-danger">{{ errors.first('genreT  ') }}</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>



                                            </form>
                                            <wizardbtn icon='<i class="fa fa-chevron-right"></i>' text="Getting Started"></wizardbtn>
                                        </div>
                                    </div>
                                </tab-content>
                                <tab-content icon=" " title="Step 3">
                                    <div class="">
                                        <div class="text-center">
                                            <form v-show="!loading" enctype="multipart/form-data" @submit="update()" class="form form-default" :action="'etudiants/edit/' + data.id" method="post">



                                                <div class="form-group " :class="{'has-error' : errors.has('id_classe')}">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <label class="control-label" for="id_classe">Classe <span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <div class="">
                                                                <dataselect v-model="data.id_classe" data-vv-value-path="data.id_classe" data-vv-as="Id Classe" v-validate="{required:false}" placeholder="Select A Value ... " name="id_classe" :multiple="false" :datapath="'components/etudiants_id_classe_option_list/'">
                                                                </dataselect>
                                                                <small v-show="errors.has('id_classe')" class="form-text text-danger">{{ errors.first('id_classe') }}</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group text-center">
                                                    <button @click="update()" :disabled="errors.any()" class="btn btn-primary" type="button">
                                                        <i class="load-indicator">
                                                            <clip-loader :loading="saving" color="#fff" size="14px"></clip-loader>
                                                        </i>
                                                        {{submitbuttontext}}
                                                        <i class="fa fa-send"></i>
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </tab-content>

                            </niceformwizard>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </template>
    <script>
        var EtudiantsEditComponent = Vue.component('etudiantsEdit', {
            template: '#etudiantsEdit',
            mixins: [EditPageMixin],
            props: {
                pagename: {
                    type: String,
                    default: 'etudiants',
                },
                routename: {
                    type: String,
                    default: 'etudiantsedit',
                },
                apipath: {
                    type: String,
                    default: 'etudiants/edit',
                },
            },
            data: function() {
                return {
                    data: {
                        id_tuteur: '',
                        CNE: '',
                        id_user: '',
                        created_at: '',
                        update_at: '',
                        deleted_at: '',
                        id_classe: '',
                    },
                    genreOptionList: [{
                        "label": "féminin",
                        "value": "F"
                    }, {
                        "label": "Masculin",
                        "value": "M"
                    }],
                }
            },
            computed: {
                pageTitle: function() {
                    return 'modifier';
                },
            },
            methods: {
                actionAfterUpdate: function(response) {
                    this.$root.$emit('requestCompleted', this.msgafterupdate);
                    if (!this.ismodal) {
                        this.$router.push('/etudiants');
                    }
                },
            },
            watch: {
                id: function(newVal, oldVal) {
                    if (this.id) {
                        this.load();
                    }
                },
                modelBind: function() {
                    var binds = this.modelBind;
                    for (key in binds) {
                        this.data[key] = binds[key];
                    }
                },
                pageTitle: function() {
                    this.SetPageTitle(this.pageTitle);
                },
            },
            created: function() {
                this.SetPageTitle(this.pageTitle);
            },
            mounted: function() {
                //this.load();
            },
        });
    </script>