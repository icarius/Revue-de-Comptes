<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <?php if(!empty($breadcrumbs) && count($breadcrumbs)>0) {?>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <?php foreach($breadcrumbs as $key=>$element) {?>
                    <li class="breadcrumb-item"><a href="<?php print $element;?>"><?php print $key;?></a></li>
                <?php } ?>
              </ol>
            </nav>
            <?php } ?>        
        </div>        
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-12"><h3>Import/Export CSV File Data into MySQL Database in CodeIgniter</h3></div>
        <div class="col-sm-12 col-md-12"><div class="form-group text-right">
                <a href="<?php print site_url();?>ad2/add" name="import_csv" id="import_csv" class="btn btn-success"> <i class="fa fa-upload" aria-hidden="true"></i> Import</a>
                <a href="<?php print site_url();?>ad2/export" name="import_csv" id="import_csv" class="btn btn-primary"><i class="fa fa-download"></i>Export</a>
            </div></div>
        <div class="col-sm-12 col-md-12">
            <table class="table table-bordered table-hover table-striped print-table order-table">
            <?php if(!empty($ad2Info)) { ?>
                <thead>
                    <tr>
                    <th>#</th>
                    <th>RACF</th>
                    <th>Matricule</th>
                    <th>Nom</th>
                    <th>Prenom</th>
                    <th>CDF</th>
                    <th>Date de sortie</th>
                    <th>Title</th>                          
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $grandTotal =0;
                    foreach($ad2Info as $key=>$element) { ?>
                        <tr>
                            <td><?php print $element['firstname'];?></td>
                            <td><?php print $element['lastname'];?></td>
                            <td><?php print $element['email'];?></td>
                            <td><?php print $element['phone'];?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                <?php } else { ?>
                    <tr><td colspan="4">There is no result yet.</td></tr>
                <?php }?>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 float-right">
            <?php if (!empty($customerInfo) && count($customerInfo)>0) echo $page_links; ?>        
        </div>
    </div>
</div>