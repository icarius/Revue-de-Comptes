                    <div class="container-fluid">
                        <h1 class="mt-4">Listing RH - Totale : <?php echo $count; ?>
						<div class="float-right">
									<a href="javascript:void(0);" class="btn btn-success" onclick="formToggle('importFrm');"><i class="plus"></i> Importer</a>
								</div>
						</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="<?php echo site_url() ?>">Dashboard</a></li>
                            <li class="breadcrumb-item active">Listing RH</li>
                        </ol>
						<div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-warning text-white mb-4">
                                    <div class="card-header">RACF non trouvé</div>
                                    <div class="card-body text-center"><h1 class="mt-4"><?php echo (($absents == "") ? "N/A" : $absents); ?></h1></div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-header">Absents permanent</div>
									<div class="card-body text-center"><h1 class="mt-4"><?php echo $this->models->count_cdf("17121"); ?></h1></div>
                                </div>
                            </div>
                        </div>
						<div class="card mb-4">
                            <div id="importFrm" style="display: none;" class="card-body">
                                <form action="<?php echo base_url('rh/import'); ?>" method="post" enctype="multipart/form-data">
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
												<th>RACF</th>
												<th>Matricule</th>
												<th>Nom Usuel</th>
												<th>Nom De Naissance</th>
												<th>Prenom</th>
												<th>Libelle Emploi Contractuel</th>
												<th>Date De Sortie</th>
												<th>UO Analytique</th>
											</tr>
										</thead>
										<tbody>

											
											<?php if(!empty($members)){ 
												$i=1;
												$absent=0;
												foreach($members as $row){ 
													$array = array("employeeID" => $row["Matricule"]);
													$result =  $this->models->getRowsAD($array);


													if ($row['Date_de_sortie_adm'] != "" || $row['UO_Analytique'] == "" || $result['AccountDisabled'] == "1"){ echo '<tr class="table-danger">'; }
													if ($result["employeeID"] == ""){ echo '<tr class="table-warning">'; }
													if ($row['UO_Analytique'] == "17121"){ echo '<tr class="bg-danger">'; } 
													if ($result["samaccountname"] == ""){ $absent++; }
													
														echo'<td>'.$i++.'</td>
														<td>'.strtoupper($result["samaccountname"]).'</td>
														<td>'.$row["Matricule"].'</td>
														<td>'.utf8_decode(strtoupper($row["Nom_usuel"])).'</td>
														<td>'.utf8_decode(strtoupper($row["Nom_de_naissance"])).'</td>
														<td>'.utf8_decode(Ucfirst($row["Prenom"])).'</td>
														<td>'.utf8_decode($row["Libelle_Emploi_Contractuel"]).'</td>
														<td>'.$row["Date_de_sortie_adm"].'</td>	
														<td>'.(($row['UO_Analytique'] == "17121" || $row['UO_Analytique'] == "27186") ? "Absent Permanent" : $row['UO_Analytique']).'</td>
													</tr>';
													$this->session->set_userdata('absents',$absent);
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
