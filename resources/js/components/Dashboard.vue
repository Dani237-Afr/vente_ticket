<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="">
                    
                    <div class="row text-dark">
            <div class="col-12 col-sm-6 col-md-3 mt-3">
                <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text"><strong>Nombre Utilisateurs</strong></span>
                    <span class="info-box-number">
                    5
                    <small>Utilisateur(s)</small>
                    </span>
                </div>
                <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>

            <div class="col-12 col-sm-6 col-md-3 mt-3">
                <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1"
                    ><i class="fas fa-book"></i
                ></span>
                <div class="info-box-content">
                    <span class="info-box-text"><strong>Nombre ticket vendu</strong></span>
                    <span class="info-box-number">10,000<small> tichet(s)</small></span>
                </div>
                <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>

						<!--<div class="clearfix hidden-md-up"></div> -->

						<div class="col-12 col-sm-6 col-md-3 mt-3">
            	<div class="info-box mb-3">
              	<span class="info-box-icon bg-success elevation-1"><i class="fas fa-layer-group"></i></span>

             		<div class="info-box-content">
                	<span class="info-box-text"><strong>Nombre ticket restant</strong></span>
                	<span class="info-box-number">20,000<small> ticket(s)</small></span>
              	</div>
              <!-- /.info-box-content -->
            	</div>
           		<!-- /.info-box -->
          	</div>
						
						<div class="col-12 col-sm-6 col-md-3 mt-3">
							<div class="info-box mb-3">
								<span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

								<div class="info-box-content">
									<span class="info-box-text"><strong>Nombre total ticket</strong></span>
									<span class="info-box-number"> 30, 000<small>ticket(s)</small></span>
								</div>
							<!-- /.info-box-content -->
							</div>
            <!-- /.info-box -->
          	</div>
          </div>

				<div class="row mt-3" >
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Report Mensuel</h5>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button> 
                
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-8">
                    <p class="text-center">
                      <strong>Achat enregistré : 3 dernière semaines</strong>
                    </p>

                    <div class="chart"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                      <!-- Sales Chart Canvas -->
                      <canvas id="salesChart" height="180" style="height: 180px; display: block; width: 680px;" width="680" class="chartjs-render-monitor"></canvas>
                    </div>
                    <!-- /.chart-responsive -->
                  </div>
                  <!-- /.col -->
                  <div class="col-md-4">
                    <p class="text-center">
                      <strong>Porcentage Général </strong>
                    </p>

                    <div class="progress-group">
                      Maximum ticket vendu
                      <span class="float-right"><b>10,000</b>/30,000</span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-primary" style="width: 35%"></div>
                      </div>
                    </div>
                    <!-- /.progress-group -->

                    <div class="progress-group">
                      Maximum ticket enregistré
                      <span class="float-right"><b>30,000</b>/30,000</span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-danger" style="width: 99%"></div>
                      </div>
                    </div>

                    <!-- /.progress-group -->
                    <div class="progress-group">
                      <span class="progress-text">Maximum jour overture</span>
                      <span class="float-right"><b>5/7</b></span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-warning" style="width: 75%"></div>
                      </div>
                    </div>

                    <!-- /.progress-group 
                    <div class="progress-group">
                      Send Inquiries
                      <span class="float-right"><b>250</b>/500</span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-warning" style="width: 50%"></div>
                      </div>
                    </div>
                    /.progress-group -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
              <!-- ./card-body -->
              <div class="card-footer">
                <div class="row">
                  <div class="col-sm-3 col-6">
                    <div class="description-block border-right">
                      <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 17%</span>
                      <h5 class="description-header">35,210,000.43 FCFA</h5>
                      <span class="description-text">MONTANT EN CAISSE</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-3 col-6">
                    <div class="description-block border-right">
                      <span class="description-percentage text-warning"><i class="fas fa-caret-left"></i> 0%</span>
                      <h5 class="description-header">10,390,000.00 FCFA</h5>
                      <span class="description-text">SPONSOR ANNEE 2021-2022</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-3 col-6">
                    <div class="description-block border-right">
                      <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 20%</span>
                      <h5 class="description-header">12,100,099.53 FCFA</h5>
                      <span class="description-text">MONTANT GAIN</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-3 col-6">
                    <div class="description-block">
                      <span class="description-percentage text-danger"><i class="fas fa-caret-down"></i> 18%</span>
                      <h5 class="description-header">10,390,000.00 FCFA</h5>
                      <span class="description-text">MONTANT DEPENSE</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                </div>
                <!-- /.row -->
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>





                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
