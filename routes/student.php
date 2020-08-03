<?php

/*
|----------------------------------------------------------------
|   Student Routes
|----------------------------------------------------------------
*/
Route::group(array('prefix' => env('student'),'namespace' => 'Student'), function(){
    Route::get('/','AdminController@root');
    Route::get('login','AdminController@index');
    Route::post('login','AdminController@login');
    Route::get('logout','AdminController@logout');
    Route::post('loginWithID/{id}','AdminController@loginWithID');

    Route::group(['middleware' => 'student'], function(){
        
        /*
        |----------------------------------------------------------------
        |   Dashboard & Account Settings
        |----------------------------------------------------------------
        */
        Route::get('dashboard','AdminController@dashboard');
        Route::get('settings','AdminController@settings');
        Route::post('settings','AdminController@update');

        /*
        |----------------------------------------------------------
        |   Manage Tasks
        |----------------------------------------------------------
        */
        

            // List Self Tasks
            Route::get('self-task','TaskController@index');

           //Send Proof Page
           Route::get('self-task/{id}/send-proof','TaskController@SendProofPage');


           //Proof Submit Route
           Route::post('self-task/{id}/send-proof-submit','TaskController@SendProof');


        /*
        |----------------------------------------------------------
        |   Manage Global Tasks
        |----------------------------------------------------------
        */



        // List Self G-Tasks
        Route::get('student-task','GlobalTaskController@index');

        //Send Proof Page
        Route::get('student-task/{id}/send-proof','GlobalTaskController@SendProofPage');


        //Proof Submit Route
        Route::post('student-task/{id}/send-proof-submit','GlobalTaskController@SendProof');





        /*
        |----------------------------------------------------------
        |   Manage Notifications
        |----------------------------------------------------------
        


        // List Notifications
        Route::get('notifications','NotificationController@index');

        // Delete Notification
        Route::delete('notifications/destroy/{id}','NotificationController@destroy');

        */


        /*
        |----------------------------------------------------------
        |   Manage Reports
        |----------------------------------------------------------
        */
        
        // Reports Index
        Route::get('reports','ReportsController@index');
        Route::get('reports-search','ReportsController@indexSearch')->name('s_reports');

        
    });
});