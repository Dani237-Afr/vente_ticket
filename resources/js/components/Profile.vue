<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                    <!-- Widget: user widget style 1 -->
                <div class="card card-widget widget-user">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header text-white" style="background-image: url('./img/pexel.jpg');">
                        <h3 class="widget-user-username text-right">TCHAKOUNTE Wolf</h3>
                        <h5 class="widget-user-desc text-right">Admin</h5>
                    </div>
                    <div class="widget-user-image">
                       <!-- <img class="img-circle" src="" alt="User Avatar"> -->
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">2 Ticket(s)</h5>
                                    <span class="description-text">NOMBRE TICKET ACHETE</span>
                                </div>
                                    <!-- /.description-block -->
                            </div>
                                <!-- /.col -->
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">10,000 FCFA</h5>
                                    <span class="description-text">PRIX-UNITAIRE</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                                <!-- /.col -->
                            <div class="col-sm-4">
                                <div class="description-block">
                                    <h5 class="description-header">20, 000 FCFA</h5>
                                    <span class="description-text">PRIX-TOTAUX TICKET</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                        </div>
                            <!-- /.row -->
                    </div>
                </div>
                <!-- FORM PART -->
                <div class="card-body">
                    <div class="tab-content">
                        
                        <!-- /.post -->

                        <div class="tab-pane active" id="settings">
                            <form class="form-horizontal">
                               <div class="form-group row">
                                    <label for="inputNom" class="col-sm-2 col-form-label">Nom</label>
                                        <div class="col-sm-10">
                                            <input v-model="form.nom" name="nom" type="text" placeholder="Enrez le nouveau Nom"
                                                class="form-control" :class="{'is-invalid' : form.errors.has('nom') }"
                                            >
                                
                                            <has-error :form="form" field="nom"></has-error>
                                        </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label for="inputPrenom" class="col-sm-2 col-form-label">Prenom</label>
                                        <div class="col-sm-10">
                                            <input v-model="form.prenom" name="prenom" type="text" placeholder="Enrez le nouveau Prenom"
                                                class="form-control" :class="{'is-invalid' : form.errors.has('prenom') }"
                                            >
                                
                                            <has-error :form="form" field="prenom"></has-error>
                                        </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputLogin" class="col-sm-2 col-form-label">Login</label>
                                        <div class="col-sm-10">
                                            <input v-model="form.login" name="login" type="text" placeholder="Enrez le nouveau Login"
                                                class="form-control" :class="{'is-invalid' : form.errors.has('login') }"
                                            >
                                
                                            <has-error :form="form" field="login"></has-error>
                                        </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-10">
                                            <input v-model="form.email" name="email" type="email" placeholder="Enrez le nouveau Email"
                                                class="form-control" :class="{'is-invalid' : form.errors.has('email') }"
                                            >
                                
                                            <has-error :form="form" field="email"></has-error>
                                        </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputNumero_CNI" class="col-sm-2 col-form-label">Numero CNI</label>
                                        <div class="col-sm-10">
                                            <input v-model="form.numero_CNI" name="prenom" type="text" placeholder="Enrez le nouveau numero CNI"
                                                class="form-control" :class="{'is-invalid' : form.errors.has('numero_CNI') }"
                                            >
                                
                                            <has-error :form="form" field="numero_CNI"></has-error>
                                        </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 col-form-label">Mot de Passe</label>
                                        <div class="col-sm-10">
                                            <input v-model="form.password" name="password" type="text" placeholder="Enrez le nouveau Mot de passe"
                                                class="form-control" :class="{'is-invalid' : form.errors.has('password') }"
                                            >
                                
                                            <has-error :form="form" field="password"></has-error>
                                        </div>
                                </div>

                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox"> j'accepte les <a href="#">termes et conditions</a>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                        <button type="submit" class="btn btn-primary text-white">Mettre a jour</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                   
                </div>   
            </div>
        </div>
    </div>
</template>
<style>
.widget-user-header{
    background-position: center center;
    background-size: cover;
  
}
.widget-user .widget-user-header{
    height: 235px;
}
</style>

<script>
import {Form} from 'vform';
import Swal from 'sweetalert2';
import Vue from 'vue';
import {HasError,AlertError} from 'vform/src/components/bootstrap5';
import axios from 'axios';


Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);
    export default {
        data(){
            return{
                user : {},
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
            udpdateUser(){

            },
        },
        mounted() {
            console.log('Component mounted.')
        },

        created(){
            axios.get("api/profile").then(({data}) => (this.form.fill(data)));
        },
    }
</script>
