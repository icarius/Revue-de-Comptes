<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * The user name of the git hub user who owns the repo
 */
$config['github_user'] = 'icarius';

/**
 * The repo on GitHub we will be updating from
 */
$config['github_repo'] = 'Revue-de-Comptes';

/**
 * The branch to update from
 */
$config['github_branch'] = 'master';

/**
 * The current commit the files are on.
 * 
 * NOTE: You should only need to set this initially it will be
 * automatically set by the library after subsequent updates.
 */
$config['current_commit'] = '84c59840369ff2f9e60cdbc25e9a75d1d6f8d886';


/**
 * A list of files or folders to never perform an update on.
 * Not specifying a relative path from the webroot will apply
 * the ignore to any files with a matching segment.
 *
 * I.E. Specifying 'admin' as an ignore will ignore
 * 'application/controllers/admin.php'
 * 'application/views/admin/test.php'
 * and any other path with the term 'admin' in it.
 */
$config['ignored_files'] = array('application/config/config.php',
                                 'application/config/github_updater.php',
                                 'application/libraries/Github_updater.php');


/**
 * Flag to indicate if the downloaded and extracted update files
 * should be removed
 */
$config['clean_update_files'] = true;