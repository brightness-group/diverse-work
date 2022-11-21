<?php

$all_users = ['allowed_roles' => ['SUP_ADM', 'SUB_ADM']];
$sup_only = ['allowed_roles' => 'SUP_ADM'];
Route::get('/home', array_merge(['uses' => 'Admin\HomeController@index'], $all_users))->name('admin.home');
Route::post('tinymce-image_upload', array_merge(['uses' => 'Admin\TinyMceController@uploadImage'], $all_users))->name('tinymce.image_upload');
/* * ********************************* */
$real_path = realpath(__DIR__) . DIRECTORY_SEPARATOR . 'admin_routes' . DIRECTORY_SEPARATOR;

Route::group(['namespace' => 'Admin'], function () {
    Route::get('/blog_category', 'Blog_categoriesController@index');
    Route::post('/blog_category/create', 'Blog_categoriesController@create');
    Route::post('/blog_category', 'Blog_categoriesController@update');
    Route::delete('/blog_category/{blog_category}', 'Blog_categoriesController@destroy');
    Route::get('/blog_category/get_blog_category_by_id/{blog_category}', 'Blog_categoriesController@get_blog_category_by_id');

    Route::get('/blog', 'BlogsController@index')->name('blog');
    Route::get('/blog/add-new-blog', 'BlogsController@show_form')->name('add-new-blog');
    Route::post('/blog/create', 'BlogsController@create');
    Route::post('/blog/update', 'BlogsController@update');
    Route::delete('/blog/{blog}', 'BlogsController@destroy');
    Route::get('/blog/remove_blog_feature_image/{blog}', 'BlogsController@remove_blog_feature_image');
    Route::get('/blog/get_blog_by_id/{blog}', 'BlogsController@get_blog_by_id');
    Route::get('/blog/edit-blog/{blog}', 'BlogsController@get_blog')->name('edit-blog');
});
