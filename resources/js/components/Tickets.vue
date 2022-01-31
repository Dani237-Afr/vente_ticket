<template>
    <div class="container"> 
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Liste Des Stades</h3>
                        <div class="card-tools">
                            <!-- data-bs-toggle="modal" data-bs-target="#addNew" -->
                            <button class="btn btn-success text-white "  @click="newModal">
                                Ajout Stade
                                <i class="fas fa-user-plus fa-fw"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <th>ID</th>
                                    <th>Nom Stade</th>
                                    <th>description</th>
                                    <th>Nombre de pLace</th>
                                    <th>Operation</th>
                                    
                                </tr>

                                <tr v-for="stade in stadeObjects" :key="stade.id">
                                    <td>{{stade.id}}</td>
                                    <td>{{stade.nom_stade}}</td>
                                    <td>{{stade.description}}</td>
                                    <td>{{stade.nombre_place}}</td>
                                    <!--<td>{{matiere.niveau_id}}</td> -->
                                    
                                    <td>
                                        <button type="button" class="btn btn-success text-white" @click="editModal(stade)">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        /
                                        <button type="button" class="btn btn-danger text-white" @click="deleteStade(stade.id,stade.nom_stade)">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>                             
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>    
        </div>


            <!-- Modal -->
        <div class="modal fade" id="addNew" tabindex="-1" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" v-show="!editMode" id="addNewLabel">Ajouter un nouveau Stade</h5>
                        <h5 class="modal-title" v-show="editMode" id="addNewLabel">Modifier info stade</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form @submit.prevent=" editMode ? modifStade() : ajoutStade() ">
                        <div class="modal-body">
                            <div class="form-group">
                                <input v-model="form.nom_stade" name="nom_stade" type="text" placeholder="Enrez le Nom du stade"
                                    class="form-control" :class="{'is-invalid' : form.errors.has('nom_stade') }"
                                >
                                
                                <has-error :form="form" field="nom_stade"></has-error>
                                
                            </div>
                            
                            <div class="form-group">
                                <input v-model="form.description" name="credit" type="text" placeholder="Enrez une description"
                                    class="form-control" :class="{'is-invalid' : form.errors.has('description') }"
                                >
                                <has-error :form="form" field="description"></has-error>
                            </div>

                            <div class="form-group">
                                <input v-model="form.nombre_place" name="nombre_place" type="number" placeholder="Enrez nombre de place"
                                    class="form-control" :class="{'is-invalid' : form.errors.has('description') }"
                                >
                                <has-error :form="form" field="nombre_place"></has-error>
                            </div>
                           
        
                            <!--
                            <div class="form-group">
                                <input v-model="form.nom" name="nom" type="text" placeholder="Enrez le nom"
                                    class="form-control" :class="{'is-invalid' : form.errors.has('nom') }"
                                >
                            </div> -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary bg-red" data-bs-dismiss="modal">Fermer</button>
                            <button type="submit" v-show="editMode" class="btn btn-primary bg-blue">Modifier</button>
                            <button type="submit"  v-show="!editMode" class="btn btn-primary bg-green">Ajouter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {Form} from 'vform';
import {HasError,AlertError} from 'vform/src/components/bootstrap5';
import Vue from 'vue';
import axios from 'axios';
import Swal from 'sweetalert2';

Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);
    export default {

        data(){
            return{
                editMode : false,
                //matieres : {},
                stadeObjects:{},
                form : new Form({
                   id: '',
                   nom_stade : '',
                   description :'',
                   nombre_place : '',
                })
            }
        },
        
        methods:{
            editModal(user){
                this.editMode = true;
                this.form.reset();
                $('#addNew').modal('show');
                this.form.fill(user);

            },


            newModal(){
                    this.editMode = false;
                    this.form.reset();
                    $('#addNew').modal('show');
            },

            ajoutStade(){
                this.form.post('api/stade')
                .then(() =>{
                    Fire.$emit('AfterCreate');
                    $('#addNew').modal('hide');
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: this.form.nom_stade + ' ajouté avec succes',
                        showConfirmButton: false,
                        timer: 3000
                    });
                })
                .catch(()=>{
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Les informations contiennent des erreurs',
                        timer: 2000
                    })
                }) 
            },

            deleteStade(){

            },

            loadStades(){
               axios.get('api/stade').then(({data}) => (this.stadeObjects = data.data));
            },
        },

        created() {
            this.loadStades();
            Fire.$on('AfterCreate' ,()=>{
                this.loadStades();
            })
           // setInterval(()=>this.loadUsers(), 5000);
        }
    }
</script>
