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
            <div class="col-sm-12 col-md-12"><h3>Import/Export CSV File Data into MySQL Database in CodeIgniter</h3></div>
            <div class="col-sm-12 col-md-12">
                <div class="form-group text-right"><a href="<?php print site_url();?>assets/csv-sample-customer.csv">Download Sample File</a></div>
            </div>        
        </div>        
    </div>
    <?php if(form_error('fileURL')) {?>    
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?php print form_error('fileURL'); ?>
        </div>       
    <?php } ?>
     <form action="<?php print site_url();?>ad2/save" class="spsec-validation" id="spsec-validation" enctype="multipart/form-data" method="post" accept-charset="utf-8">
    <div class="row">
        <div class="col-sm-6 col-md-6">
                   <input type="file" name="fileURL" id="file-url" class="filestyle" data-allowed-file-extensions="[CSV, csv]" accept=".CSV, .csv" data-buttontext="Choose File">
        </div>   
        
        <div class="col-sm-6 col-md-6">
            <div class="form-group text-right">
                <button type="submit" name="import_csv" id="import_csv" class="btn btn-primary mrgT">Import</button>
            </div>   
        </div>     
    </div>
    </form>
</div>