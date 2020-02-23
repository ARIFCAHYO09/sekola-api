<?php

namespace Deployer;

require 'recipe/laravel.php';

// Project name
set('application', 'sekola-api');

// Project repository
set('repository', 'git@gitlab.com:layanacorp/sekola-api.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true);

//set('writable_mode', 'chown');

// Shared files/dirs between deploys
add('shared_files', []);
add('shared_dirs', []);

// Writable dirs by web server
add('writable_dirs', []);
set('http_user', 'admin');

// Hosts

host('68.183.187.123')
    ->user('admin')
    // ->identityFile('~/.ssh/layana_server_rsa')
    ->set('deploy_path', '/home/admin/web/api.sekola.id/public_html');

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
    'deploy:shared',
    'deploy:vendors',
    'deploy:writable',
    // 'artisan:storage:link',
    // 'artisan:view:clear',
    // 'artisan:config:cache',
    // 'artisan:optimize',
    'deploy:symlink',
    'share',
    'deploy:unlock',
    'cleanup',
]);
// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');
// Migrate database before symlink new release.
task('share', function () {
    run('rm -f /home/admin/web/api.sekola.id/public_html/current/public/storage && ln -s /home/admin/web/api.sekola.id/public_html/current/storage/app/public/ /home/admin/web/api.sekola.id/public_html/current/public/storage');
});
//before('deploy:symlink', 'artisan:migrate');
