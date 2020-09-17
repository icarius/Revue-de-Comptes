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
                <p><?php echo $result; ?></p>
                <p><?php echo $_SERVER['AUTH_USER']; ?></p>
                <p>Welcome <?php echo $this->session->userdata('domain'); ?>\<?php echo $this->session->userdata('samaccountname'); ?> - <?php echo $this->session->userdata('displayname'); ?> - <?php echo $this->session->userdata('mail'); ?> - <?php echo $this->session->userdata('expire'); ?></p>

		          <p>Compte admin : <?php echo $this->session->userdata('inGroup'); ?></p>
                  <p><?php var_dump($this->session->userdata('Group')); ?></p>
                  
              </div>
            </div>
            <div class="card-footer small text-muted">&nbsp;</div>
          </div>                  