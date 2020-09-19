                    <div class="container-fluid">
                        <h1 class="mt-4">Listing PCPASS - Totale : <?php echo $count; ?>
						<div class="float-right">
									<a href="javascript:void(0);" class="btn btn-success" onclick="formToggle('importFrm');"><i class="plus"></i> Importer</a>
								</div>
						</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="<?php echo site_url() ?>">Dashboard</a></li>
                            <li class="breadcrumb-item active">Listing PCPASS</li>
                        </ol>
						<div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-header">Comptes inactif</div>
                                    <div class="card-body text-center"><h1 class="mt-4"><?php echo $inactiveAccount; ?></h1></div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-header">Absents permanent</div>
									<div class="card-body text-center"><h1 class="mt-4"><?php echo $absents; ?></h1></div>
                                </div>
                            </div>
                        </div>						
						<div class="card mb-4">
                            <div id="importFrm" style="display: none;" class="card-body">
                                <form action="<?php echo base_url('PCPass/import'); ?>" method="post" enctype="multipart/form-data">
									<input type="file" name="file" />
									<input type="submit" class="btn btn-primary" name="importSubmit" value="Enregistrer">
								</form>
                            </div>
                        </div>
						
						<!-- Display status message -->
						<?php if(!empty($success_msg)){ ?>
						<div class="col-xs-12">
							<div class="alert alert-success"><?php echo $success_msg; ?></div>
						</div>
						<?php } ?>
						<?php if(!empty($error_msg)){ ?>
						<div class="col-xs-12">
							<div class="alert alert-danger"><?php echo $error_msg; ?></div>
						</div>
						<?php } ?>



                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                Listing
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" width="100%" cellspacing="0">
									    <thead>
											<tr>
												<th>#</th>
												<th>Photo</th>
												<th>NOM</th>
												<th>Prenom</th>
												<th>Matricule</th>
												<th>CDF</th>
												<th>Date de sortie</th>
												<th>Title</th>
												<th>Info</th>
											</tr>
										</thead>
										<tbody>
											<?php if(!empty($members)){ 
												$i=1;
												$absent=0;
												$lastLogon=0;
												$inactiveAccount=0;
												foreach($members as $row){ 
													$array = array("Matricule" => $row['matricule']);
													$result =  $this->models->getRowsRH($array);


													if ($result['Date_de_sortie_adm'] != "" || $result['UO_Analytique'] == "" || $row['info'] == "1"){ echo '<tr class="table-danger">'; }
													if ($row["matricule"] == ""){ echo '<tr class="table-warning">'; }
													if ($result['UO_Analytique'] == "17121"){ echo '<tr class="bg-danger">'; $absent++;} 
													
													//if (strtotime($row["lastLogon"]) + 30 * 24 * 60 * 60 < time()) { $inactiveAccount++; }
													
														echo'<td>'.$i++.'</td>
														<td></td>
														<td>'.utf8_decode(strtoupper($row["nom"])).'</td>
														<td>'.utf8_decode(Ucfirst($row["prenom"])).'</td>
														<td>'.$row["matricule"].'</td>
														<td>'.(($result['UO_Analytique']=="17121")?"Abs Perm":$result['UO_Analytique']).'</td>
														<td>'.$result["Date_de_sortie_adm"].'</td>	
														<td>'.utf8_decode($result["Libelle_Emploi_Contractuel"]).'</td>
														<td>'.$row["info"].'</td>
													</tr>';
													if($row["info"] == "1") {$inactiveAccount++;}
												$this->session->set_userdata('absents',$absent);
												$this->session->set_userdata('inactiveAccount',$inactiveAccount);
												} 
											} else { 
												echo ('<tr><td colspan="9">No member(s) found...</td></tr>');
											} 
											?>
											
											
										</tbody>
									</table>
								</div>
							</div>	
						</div>
					</div>	


					<script>
					function formToggle(ID){
						var element = document.getElementById(ID);
						if(element.style.display === "none"){
							element.style.display = "block";
						}else{
							element.style.display = "none";
						}
					}
					</script>
