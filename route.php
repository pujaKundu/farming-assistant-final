<?php

include('./core/Route.php');
include('./classes/RoleChecker.php');

$uri = rtrim($_SERVER['REQUEST_URI'], '/');

//echo $uri;

//routes ['expression', 'view name', 'middleware']


$p = explode('/', $uri);
$p = $p[count($p) - 1];

Route::get('/farmer/report/:id/edit', function (){
    require './views/farmer/reports/edit.php';
});

Route::get('/farmer/add_report', function (){
   require './views/farmer/reports/add_report.php';
});

Route::get('/report/:id', function (){
   require './views/report.php';
});

Route::get('/farmer/my_reports', function (){
    require './views/farmer/reports/my-reports.php';
});

Route::get('/sell', function (){

});

Route::get('/product/:id', function (){
    require './views/product.php';
});

Route::get('/products', function (){
    require './views/products.php';
});

Route::get('/reports', function (){
   require './views/reports.php';
});

Route::get('/farmer', function (){
   require './views/farmer/home.php';
});

Route::get('', function (){
    require './views/index.php';
});

Route::resolve();

/*switch ($uri) {

    case '/':
        require __DIR__ . '/views/index.php';
        break;
    case '':
        require './views/index.php';
        break;

    case '/farmer/registration':
        require __DIR__ . '/views/farmer/registration.php';
        break;
    case '/farmer/login':
        require __DIR__ . '/views/farmer/login.php';
        break;
    case '/farmer/add_report':
        require __DIR__ . '/views/farmer/reports/add_report.php';
        break;

    case '/farmer/my_reports': RoleChecker::check('farmer', function (){
       require './views/farmer/reports/my-reports.php';
    });
    break;

    case '/farmer':
        RoleChecker::check('farmer', function () {
            require  './views/farmer/home.php';
        });

        break;

    case '/seller/registration':
        require __DIR__ . '/views/seller/registration.php';
        break;
    case '/seller/login':
        require __DIR__ . '/views/seller/login.php';
        break;

    case '/seller/add_products':
        require __DIR__ . '/views/seller/add_products.php';
        break;
    case '/product/' . $p:
        require __DIR__ . '/views/product.php';
        break;
    case '/products':
        require __DIR__ . '/views/products.php';
        break;
    case '/report/' . $p:
        require __DIR__ . '/views/report.php';
        break;
    case '/reports':
        require __DIR__ . '/views/reports.php';
        break;
    //check role first
    case '/seller':
        RoleChecker::check('Seller', function () {
            require __DIR__ . './views/seller/home.php';
        });
        break;
    //admin login
    case '/login' :
        require __DIR__ . '/views/login.php';
        break;
    case '/403':
        require __DIR__ . '/views/forbidden.php';
        break;
    default:
        http_response_code(404);
        require __DIR__ . '/views/404.php';
        break;
}*/