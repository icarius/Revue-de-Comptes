<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

          <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i> Liste des utilisateurs
            </div>
            <div class="card-body">
              <div class="table-responsive">

                <p>Welcome</p>
				<?php if($git_update){
					echo'Nouvelle version existante';
				}
                ?> 
<?php if($sucess){
					echo'Nouvelle version mis a jour';
				}
                ?>				
              </div>
            </div>
            <div class="card-footer small text-muted">&nbsp;</div>
          </div>                  