<?php

namespace Deployer;

require 'recipe/laravel.php';

// Project name
set('application', '<sekola-a></sekola-a>pi');

// Project repository
set('repository', 'git@gitlab.com:layanacorp/sekola-api.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true);

//set('writable_mode', 'chown');

// Shared files/dirs between deploys
add('shared_files', []);
add('shared_dirs', ['storage', 'storage/logs']);

// Writable dirs by web server
add('writable_dirs', ['storage', 'storage/logs']);
set('http_user', 'root');

// Hosts

host('123.100.226.151')
    ->user('root')
    ->port(8288)
    // ->identityFile('~/.ssh/layana_server_rsa')
    ->set('deploy_path', '/var/www/html/sekola-api.cahyosoft.xyz/public_html');
set('env', [
    'DB_DATABASE' => 'admin_admin_sekola',
    'DB_USERNAME' => 'admin_sekola',
    'DB_PASSWORD' => 'TV9iTvgXTL',
]);

// Tasks

task('build', function () {
    run('cd {{release_path}} && build');
});
task('deploy', [
    'deploy:info',
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'deploy:update_code',
    // 'deploy:shared',
    'deploy:vendors',
    'deploy:writable',
    // 'artisan:storage:link',
    // 'artisan:view:clear',
    // 'artisan:config:cache',
    // 'artisan:optimize',
    'deploy:symlink',
    'deploy:unlock',
    'cleanup',
]);
// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.

//before('deploy:symlink', 'artisan:migrate');
