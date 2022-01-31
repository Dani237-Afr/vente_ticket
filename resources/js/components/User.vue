<template>
    <div class="container">
      <div class="row">
          <div class="col-md-12">
              <div class="card">
                  <div class="card-header">
                        <h3 class="card-title">Info Utilisateurs</h3>
                        <div class="card-tools">
                            <!-- data-bs-toggle="modal" data-bs-target="#addNew" -->
                            <button class="btn btn-success text-white"  @click="newModal">
                                Ajout Utilisateur
                                <i class="fas fa-user-plus fa-fw"></i>
                            </button>
                        </div>
                  </div>
                  <div class="card-body table-responsive p-0">
                      <table class="table table-hover">
                          <tbody>
                              <tr>
                                  <th>ID</th>
                                  <th>Nom</th>
                                  <th>Prenom</th>
                                  <th>Numero CNI</th>
                                  <th>Statut</th>
                                  <th>Login</th>
                                  <th>Email</th>
                                  <th>Operation</th>

                              </tr>
                              <tr v-for="user in users" :key="user.id">
                                  <td>{{user.id}}</td>
                                  <td>{{user.nom}}</td>
                                  <td>{{user.prenom}}</td>
                                  <td>{{user.numero_CNI}}</td>
                                  <td>{{user.statut | capitalise}}</td>
                                  <td>{{user.name }}</td>
                                  <td>{{user.email}}</td>
                                  <td>
                                      <button type="button" class="btn btn-success text-white" @click="editModal(user)">
                                          <i class="fa fa-edit"></i>
                                      </button>
                                      /
                                      <button type="button" class="btn btn-danger text-white" @click="deleteUser(user.id,user.name)">
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
                        <h5 class="modal-title" v-show="!editMode" id="addNewLabel">Ajouter un nouvel utilisateur</h5>
                        <h5 class="modal-title" v-show="editMode" id="addNewLabel">Modifier info utilisateur</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form @submit.prevent=" editMode ? updateUser() : createUser() ">
                        <div class="modal-body">
                            <div class="form-group">
                                <input v-model="form.nom" name="nom" type="text" placeholder="Enrez son Nom"
                                    class="form-control" :class="{'is-invalid' : form.errors.has('nom') }"
                                >
                                
                                <has-error :form="form" field="nom"></has-error>
                                
                            </div>
                            <div class="form-group">
                                <input v-model="form.prenom" name="prenom" type="text" placeholder="Enrez son Prenom"
                                    class="form-control" :class="{'is-invalid' : form.errors.has('prenom') }"
                                >
                                <has-error :form="form" field="prenom"></has-error>
                            </div>
                            <div class="form-group">
                                <input v-model="form.name" name="name" type="text" placeholder="Enrez son Login"
                                    class="form-control" :class="{'is-invalid' : form.errors.has('name') }"
                                >
                                <has-error :form="form" field="name"></has-error>
                            </div>
                            <div class="form-group">
                                <input v-model="form.email" name="email" type="email" placeholder="Enrez son Email"
                                    class="form-control" :class="{'is-invalid' : form.errors.has('email') }"
                                >
                                <has-error :form="form" field="email"></has-error>
                            </div>
                            <div class="form-group">
                                <input v-model="form.numero_CNI" name="numero_CNI" type="text" placeholder="Enrez son Numero de CNI"
                                    class="form-control" :class="{'is-invalid' : form.errors.has('numero_CNI') }"
                                >
                                <has-error :form="form" field="numero_CNI"></has-error>
                            </div>
                            <div class="form-group">
                                <input v-model="form.password" name="password" type="password" placeholder="Enrez son Mot De Passe"
                                    class="form-control" :class="{'is-invalid' : form.errors.has('password') }"
                                > 
                                <has-error :form="form" field="password"></has-error>
                            </div>
                            <div class="form-group">
                                <select name="statut" v-model="form.statut" id="" class="form-control"
                                    :class="{'is-valid': form.errors.has('statut')}">
                                    <option value="">Selectionner le type de Compte</option>
                                    <option value="admin">Administrateur</option>
                                    <option value="user">Utilisateur</option>
                                    <option value="entreprise">Enterprise</option>
                                </select>
                                <has-error :form="form" field="status"></has-error>
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
                users : {},
                form : new Form({
                   id: '',
                   nom : '',
                   prenom :'',
                   name : '',
                   email : '',
                   password : '',
                   numero_CNI: '',
                   statut:'',
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
            updateUser(){
                //Updating using via form
                this.form.put('api/user/' + this.form.id)
                .then(()=>{
                    Fire.$emit('AfterCreate');
                    $('#addNew').modal('hide');
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: this.form.name + ' a été mis a jour avec succes',
                        showConfirmButton: false,
                        timer: 3000
                    });
                })
                .catch(()=>{

                })
            },
            deleteUser(userId,userLogin){
                Swal.fire({
                    title: 'Voulez vous vraiment supprimer '+ userLogin+'?',
                    text: "Le processus ne pourras pas etre annulé!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Oui, Supprimer!',
                    cancelButtonText: 'Annuler'
                    })
                    .then((result) => {
                        
                        if (result.isConfirmed) {
                            this.form.delete('api/user/' + userId)
                            .then(()=>{
                      
                            })
                            .catch(()=>{
                                Swal.fire({
                                    title: 'Oooops!',
                                    text: 'Désolé, le processus n\'a pas a échoué!'
                                })
                            })

                            Swal.fire(
                                'Supprimé!',
                                userLogin +' a été supprimé avec succes.',
                                'success'
                            )
                            Fire.$emit('AfterCreate');
                        }
                        //Send an Http request to the server
                       
                       
                    })
            },
            loadUsers(){
                axios.get('api/user').then(({data}) => (this.users = data.data ));
            },
            createUser(){
                this.form.post('api/user')
                .then(() =>{
                    Fire.$emit('AfterCreate');
                    $('#addNew').modal('hide');
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: this.form.statut + ' ajouté avec succes',
                        showConfirmButton: false,
                        timer: 3000
                    });
                })
                .catch(()=>{
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Vos informations contiennent des erreurs',
                        timer: 2000
                    })
                }) 
                

            }
        },
        created() {
            this.loadUsers();
            Fire.$on('AfterCreate' ,()=>{
                this.loadUsers();
            })
           // setInterval(()=>this.loadUsers(), 5000);
        }
    }
</script>
