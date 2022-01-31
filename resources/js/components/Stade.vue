<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Liste Des tickets Acheté</h3>
                        <div class="card-tools">
                            <!-- data-bs-toggle="modal" data-bs-target="#addNew" -->
                            <button class="btn btn-success text-white "  @click="newModal">
                                Ajout transaction
                                <i class="fas fa-user-plus fa-fw"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <th>ID</th>
                                    <th>classe</th>
                                    <th>prix</th>
                                    <th>ID Client</th>
                                    <th>ID Stade</th>
                                    
                                </tr>

                                <tr v-for="ticket in ticketObjects" :key="ticket.id">
                                    <td>{{ticket.id}}</td>
                                    <td>{{ticket.classe}}</td>
                                    <td>{{ticket.prix}} FCFA</td>
                                    <td>{{ticket.user_id}}</td>
                                    <td>{{ticket.stade_id}}</td>
                                    <!--<td>{{matiere.niveau_id}}</td> -->
                                    
                                    <td>
                                        <button type="button" class="btn btn-success text-white" @click="editModal(ticket)">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        /
                                        <button type="button" class="btn btn-danger text-white" @click="deleteTicket(ticket.id,ticket.classe)">
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
                        <h5 class="modal-title" v-show="!editMode" id="addNewLabel">Ajouter un nouveau paiement</h5>
                        <h5 class="modal-title" v-show="editMode" id="addNewLabel">Modifier info paiement</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form @submit.prevent=" editMode ? modifTicket() : ajoutTicket() ">
                        <div class="modal-body">
                            <div class="form-group">
                                <select name="classe" v-model="form.classe" id="" class="form-control"
                                    :class="{'is-valid': form.errors.has('classe')}">
                                    <option value="">Selectionner la classe du ticket</option>
                                    <option value="classique">CLASSIQUE</option>
                                    <option value="premium 1">PREMIUM I</option>
                                    <option value="premium 2">PREMIUM II</option>
                                    <option value="vip">VIP</option>
                                </select>
                                <has-error :form="form" field="classe"></has-error>
                            </div>
                            
                            <div class="form-group">
                                <input v-model="form.prix" name="prix" type="number" placeholder="Enrez prix"
                                    class="form-control" :class="{'is-invalid' : form.errors.has('prix') }"
                                > 
                                <has-error :form="form" field="prix"></has-error>
                            </div>

                            <div class="form-group">
                                <label for="nomPayer"> Selectionnez l'Utilisateur</label>
                                <select name="user_id" v-model="form.user_id" id="" class="form-control"
                                    :class="{'is-valid': form.errors.has('user_id')}">
                                   <!-- <option v-for="student in users" :key="student.id" value="">Selectionner l'utilisateur</option>
                                    <option value="1">Bachelor I</option>-->
                                    <option v-for="student in usersObjects" :key="student.identifiant"  v-bind:value="student.id">{{student.nom}} {{student.prenom}}</option>
                                </select>
                                <has-error :form="form" field="user_id"></has-error>
                            </div>

                            <div class="form-group">
                                <label for="nomPayer"> Selectionnez le stade</label>
                                <select name="stade_id" v-model="form.stade_id" id="" class="form-control"
                                    :class="{'is-valid': form.errors.has('stade_id')}">
                                   <!-- <option v-for="student in users" :key="student.id" value="">Selectionner l'utilisateur</option>
                                    <option value="1">Bachelor I</option>-->
                                    <option v-for="stade in stadeObjects" :key="stade.identifiant"  v-bind:value="stade.id">{{stade.nom_stade}}</option>
                                </select>
                                <has-error :form="form" field="stade_id"></has-error>
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
                ticketObjects:{},
                usersObjects:{},
                stadeObjects:{},
                form : new Form({
                   id: '',
                   classe : '',
                   prix :'',
                   user_id : '',
                   stade_id : '',
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

            ajoutTicket(){
                this.form.post('api/ticket')
                .then(() =>{
                    Fire.$emit('AfterCreate');
                    $('#addNew').modal('hide');
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'transaction ajouté avec succes',
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

            deleteTicket(){

            },

            loadTicket(){
               axios.get('api/ticket').then(({data}) => (this.ticketObjects = data.data));
            },
            loadStades(){
               axios.get('api/stade').then(({data}) => (this.stadeObjects = data.data));
            },
            loadUsers(){
                axios.get('api/user').then(({data}) => (this.usersObjects = data.data ));
            },
        },

        created() {
            this.loadStades();
            this.loadUsers();
            this.loadTicket();
            Fire.$on('AfterCreate' ,()=>{
                this.loadTicket();
            })
           // setInterval(()=>this.loadUsers(), 5000);
        }



    }
</script>
