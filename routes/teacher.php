<?php

/*
|----------------------------------------------------------------
|	Teacher Routes
|----------------------------------------------------------------
*/
Route::group(array('prefix' => env('teacher'),'namespace' => 'Teacher'), function(){
    Route::get('/','AdminController@root');
    Route::get('login','AdminController@index');
    Route::post('login','AdminController@login');
    Route::get('logout','AdminController@logout');
    Route::post('loginWithID/{id}','AdminController@loginWithID');

    Route::group(['middleware' => 'teacher'], function(){
        
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
        |   Manage Task
        |----------------------------------------------------------
        */

            // List Student Tasks
            Route::get('student-task','TaskController@studentIndex');

            // Search Student Tasks
            Route::get('student-task/search','TaskController@studentIndexSearch');

             // List Self Tasks
            Route::get('self-task','TaskController@TeacherIndex');

            // Search Self Tasks
            Route::get('self-task/search','TaskController@TeacherIndexSearch');

            // Extend Request Page
           Route::get('self-task/{id}/extend','TaskController@ExtendRequest');

            // Extend Request Submit
           Route::post('self-task/{id}/extend-submit','TaskController@ExRequest_Submit');




            // Create Student Tasks page
            Route::get('student-task/add','TaskController@createStudentTask');

            // Store Student Tasks Route
            Route::post('student-task/store','TaskController@storeStudentTask');

            // Edit Student Tasks
           Route::get('student-task/{id}/edit','TaskController@StudentEdit');

            // Update Student Tasks
           Route::post('student-task/{id}/update','TaskController@studentUpdate');

            // Destroy (trash)
            Route::patch('student-task/destroy/{id}','TaskController@destroy');


           //Send Proof Page
           Route::get('self-task/{id}/send-proof','TaskController@SendProofPage');


           //Proof Submit Route
           Route::post('self-task/{id}/send-proof-submit','TaskController@SendProof');



            // List Team Member Tasks
            Route::get('team-members-task','TaskController@MemberIndex');

            // Search Team Member Tasks
            Route::get('team-members-task/search','TaskController@MemberIndexSearch');

            // Create Member Tasks page
            Route::get('team-members-task/add','TaskController@createMemberTask');

            // Store Member Tasks Route
            Route::post('team-members-task/store','TaskController@storeMemberTask');

            // Edit Member Tasks
           Route::get('team-members-task/{id}/edit','TaskController@memberEdit');

            // Update Member Tasks
           Route::post('team-members-task/{id}/update','TaskController@memberUpdate');

            // Destroy (trash)
            Route::patch('team-members-task/destroy/{id}','TaskController@destroy');


    


        /*
        |----------------------------------------------------------
        |   Manage GlobalTasks
        |----------------------------------------------------------
        */

        // List GlobalTasks
        Route::get('g-task','GlobalTaskController@index');


        // List Self G-Tasks
        Route::get('teacher-task','GlobalTaskController@selfIndex');

        // Create GlobalTask - page
        Route::get('g-task/add','GlobalTaskController@create');

        // Store GlobalTask - Route
        Route::post('g-task/store','GlobalTaskController@store');

    
        // Edit GlobalTask
        Route::get('g-task/{id}/edit','GlobalTaskController@edit');

        // Update GlobalTask
        Route::post('g-task/{id}/update','GlobalTaskController@update');


        // Destroy (trash)
        Route::patch('g-task/destroy/{id}','GlobalTaskController@destroy');


        // Extend GlobalTask - Page
        Route::get('g-task/{id}/extend','GlobalTaskController@extend');

        // Extend GlobalTask - Submit
        Route::post('g-task/{id}/extend-submit','GlobalTaskController@extendSubmit');


        //Send Proof Page
        Route::get('teacher-task/{id}/send-proof','GlobalTaskController@SendProofPage');


        //Proof Submit Route
        Route::post('teacher-task/{id}/send-proof-submit','GlobalTaskController@SendProof');


        /*
        |----------------------------------------------------------
        |   Manage Reports
        |----------------------------------------------------------
        */
        
        // Reports Index
        Route::get('reports','ReportsController@index');
        Route::get('reports-search','ReportsController@indexSearch')->name('s_reports');



        /*
        |----------------------------------------------------------
        |   Manage Work
        |----------------------------------------------------------
        */
        
        // Work List Page
        Route::get('work-log','WorkController@index');

        // Create Work Page
        Route::get('work-log/add','WorkController@create');

        // Store Work Route
        Route::post('work-log/store','WorkController@store');

        // Edit Work
        Route::get('work-log/{id}/edit','WorkController@edit');

       // Update Work Route
       Route::post('work-log/{id}/update','WorkController@update');

       // End Work Route
       Route::patch('work-log/{id}/end','WorkController@endWork');


       //Search
       Route::get('work-log/search','WorkController@indexSearch');



        // Add Log Field
        Route::get('work-log/addLog','WorkController@addLog');


        // Delete Log Field
        Route::get('work-log/delete_Log/{id}','WorkController@delete_Log');

        
    });
});