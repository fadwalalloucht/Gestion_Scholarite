    <template id="professeursEdit">
        <section class="page-component">
            <div v-if="showheader" class="bg-light p-3 mb-3">
                <div class="container">
                    <div class="row ">
                        <div class="col-12 comp-grid" :class="setGridSize">
                            <h3 class="record-title">modifier </h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pb-2 mb-3 border-bottom">
                <div class="container">
                    <div class="row ">
                        <div class="col-md-7 comp-grid" :class="setGridSize">
                            <div class=" animated fadeIn">
                                <form v-show="!loading" enctype="multipart/form-data" @submit="update()" class="form form-default" :action="'professeurs/edit/' + data.id" method="post">
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
                                    <div class="form-group " :class="{'has-error' : errors.has('cnp')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="cnp">CNP <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.cnp" v-validate="{required:true}" data-vv-as="Cnp" class="form-control " type="text" name="cnp" placeholder="Enter Cnp" />
                                                    <small v-show="errors.has('cnp')" class="form-text text-danger">
                                                        {{ errors.first('cnp') }}
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
                                                    <input v-model="data.CIN" v-validate="{required:true}" data-vv-as="Cin" class="form-control " type="text" name="CIN" placeholder="Enter CIN" />
                                                    <small v-show="errors.has('CIN')" class="form-text text-danger">
                                                        {{ errors.first('CIN') }}
                                                    </small>
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
                                                    <input v-model="data.nom" v-validate="{required:true}" data-vv-as="Cne" class="form-control " type="text" name="nom" placeholder="Enter le Nom" />
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
                                                    <small v-show="errors.has('CNE')" class="form-text text-danger">
                                                        {{ errors.first('Prenom') }}
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
        var ProfesseursEditComponent = Vue.component('professeursEdit', {
            template: '#professeursEdit',
            mixins: [EditPageMixin],
            props: {
                pagename: {
                    type: String,
                    default: 'professeurs',
                },
                routename: {
                    type: String,
                    default: 'professeursedit',
                },
                apipath: {
                    type: String,
                    default: 'professeurs/edit',
                },
            },
            data: function() {
                return {
                    data: {
                        cnp: '',
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
                        this.$router.push('/professeurs');
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