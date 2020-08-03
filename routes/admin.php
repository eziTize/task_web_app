<?php

/*
|----------------------------------------------------------------
|	Admin Routes
|----------------------------------------------------------------
*/
Route::group(array('prefix' => env('admin'),'namespace' => 'Admin'), function(){
    Route::get('/','AdminController@root');
    Route::get('login','AdminController@index');
    Route::post('login','AdminController@login');
    Route::get('logout','AdminController@logout');

    Route::group(['middleware' => 'admin'], function(){
        
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
        |   Manage Teacher User
        |----------------------------------------------------------
        */
        Route::get('team-members/trash','TeacherController@trash');
        Route::post('team-members/restore/{id}','TeacherController@restore');
        Route::delete('team-members/destroy_permanent/{id}','TeacherController@destroyPermanent');
    
        Route::resource('team-members','TeacherController');

       /*
        |----------------------------------------------------------
        |   Manage Student User
        |----------------------------------------------------------
        */
        Route::get('student/trash','StudentController@trash');
        Route::post('student/restore/{id}','StudentController@restore');
        Route::delete('student/destroy_permanent/{id}','StudentController@destroyPermanent');
        Route::resource('student','StudentController');



        /*
        |----------------------------------------------------------
        |   Manage Tasks
        |----------------------------------------------------------
        */

                        /////// Student Tasks ///////

            // List Student Tasks
            Route::get('student-task','TaskController@studentIndex');
            Route::get('student-task/search','TaskController@studentIndex_search');

            // Create Student Tasks page
            Route::get('student-task/add','TaskController@createStudentTask');

            // Store Student Tasks Route
            Route::post('student-task/store','TaskController@storeStudentTask');

            // Show all Trashed Student Tasks
            Route::get('student-task/trash','TaskController@trashStudent');
            

            // Edit Student Tasks
           Route::get('student-task/{id}/edit','TaskController@StudentEdit');

            // Update Student Tasks
           Route::post('student-task/{id}/update','TaskController@studentUpdate');

            //Destroy Permanent
            Route::delete('student-task/destroy_permanent/{id}','TaskController@destroyPermanent');

            // Destroy (trash)
            Route::patch('student-task/destroy/{id}','TaskController@destroy');

            // Restore (from Trash)
            Route::patch('student-task/restore/{id}','TaskController@restore');


              // Extend Student Task Page
           Route::get('student-task/{id}/extend','TaskController@ExtendStudent');

            // Extend Student Task Submit
           Route::post('student-task/{id}/extend-submit','TaskController@ExtendStudentSubmit');


                            /////// Teacher Tasks ///////

            // List Teacher Tasks
            Route::get('team-members-task','TaskController@TeacherIndex');
            Route::get('team-members-task/search','TaskController@TeacherIndex_search');

            // Create Teacher Tasks page
            Route::get('team-members-task/add','TaskController@createTeacherTask');

            // Store Teacher Tasks Route
            Route::post('team-members-task/store','TaskController@storeTeacherTask');

            // Show all Trashed Teacher Tasks
            Route::get('team-members-task/trash','TaskController@trashTeacher');
            

            // Edit Teacher Tasks
           Route::get('team-members-task/{id}/edit','TaskController@teacherEdit');

            // Update Teacher Tasks
           Route::post('team-members-task/{id}/update','TaskController@teacherUpdate');

            //Destroy Permanent
            Route::delete('team-members-task/destroy_permanent/{id}','TaskController@destroyPermanent');

            // Destroy (trash)
            Route::patch('team-members-task/destroy/{id}','TaskController@destroy');

            // Restore (from Trash)
            Route::patch('team-members-task/restore/{id}','TaskController@restore');



            // Extend Teacher Task Page
           Route::get('team-members-task/{id}/extend','TaskController@ExtendTeacher');

            // Extend Teacher Task Submit
           Route::post('team-members-task/{id}/extend-submit','TaskController@ExtendTeacherSubmit');


                         /////// Approve Requests ///////


         // List Approve Requests
        Route::get('approve-requests','TaskController@ApproveTaskIndex');


        //Search
        Route::get('approve-requests/search','TaskController@ApproveSearch');


        // Approve Task Page
        Route::get('approve-requests/{id}/approve','TaskController@ApproveTasksPage');

        // Approve Tasks Route
        Route::post('approve-requests/{id}/approve-task','TaskController@ApproveTasks');


        //Deny Tasks
        Route::patch('approve-requests/{id}/deny','TaskController@DenyTask');


        //Download Proof
        Route::get('approve-requests/{id}/download-proof','TaskController@downloadProof');



        /*
        |----------------------------------------------------------
        |   Manage GlobalTasks
        |----------------------------------------------------------
        */

        // List GlobalTasks
        Route::get('g-task','GlobalTaskController@index');

        // Create GlobalTask - page
        Route::get('g-task/add','GlobalTaskController@create');

        // Store GlobalTask - Route
        Route::post('g-task/store','GlobalTaskController@store');

        // Show all Trashed GlobalTasks
        Route::get('g-task/trash','GlobalTaskController@trash');
            

        // Edit GlobalTask
        Route::get('g-task/{id}/edit','GlobalTaskController@edit');

        // Update GlobalTask
        Route::post('g-task/{id}/update','GlobalTaskController@update');

        //Destroy Permanent
        Route::delete('g-task/destroy_permanent/{id}','GlobalTaskController@destroyPermanent');

        // Destroy (trash)
        Route::patch('g-task/destroy/{id}','GlobalTaskController@destroy');

        // Restore (from Trash)
        Route::patch('g-task/restore/{id}','GlobalTaskController@restore');


        // Extend GlobalTask - Page
        Route::get('g-task/{id}/extend','GlobalTaskController@extend');

        // Extend GlobalTask - Submit
        Route::post('g-task/{id}/extend-submit','GlobalTaskController@extendSubmit');


         // List Approve Requests
        Route::get('g-task-requests','GlobalTaskController@ApproveTaskIndex');
        Route::get('g-task-requests/approved','GlobalTaskController@ApproveIndex');
        Route::get('g-task-requests/denied','GlobalTaskController@DeniedIndex');


        //Search
        Route::get('g-task-requests/search','GlobalTaskController@ApproveSearch');

        // Approve GlobalTask Page
        Route::get('g-task-requests/{id}/approve','GlobalTaskController@ApproveTasksPage');

        // Approve GlobalTask Route
        Route::post('g-task-requests/{id}/approve-g-task','GlobalTaskController@ApproveTasks');


        //Deny GlobalTask - Request
        Route::patch('g-task-requests/{id}/deny','GlobalTaskController@DenyTask');
        

        //Download Proof
        Route::get('g-task-requests/{id}/download-proof','GlobalTaskController@downloadProof');


        /*
        |----------------------------------------------------------
        |   Manage Extend Requests
        |----------------------------------------------------------
        */


         //Extend request Page
        Route::get('extend-requests','TaskController@ExtendRequests');


        //Extend Request - Approve
        Route::patch('extend-requests/{id}/extend','TaskController@Extend');


        //Extend Request - Remove
        Route::patch('extend-requests/{id}/remove','TaskController@erRemove');



        /*
        |----------------------------------------------------------
        |   Manage Global Tasks Extend Requests
        |----------------------------------------------------------
        */
        

         //Extend request Page
        Route::get('g-extend-requests','GlobalTaskController@ExtendRequests');


        //Extend Request - Approve
        Route::patch('g-extend-requests/{id}/extend','GlobalTaskController@ExtendR');


        //Extend Request - Remove
        Route::patch('g-extend-requests/{id}/remove','GlobalTaskController@erRemove');


        /*
        |----------------------------------------------------------
        |   Manage Reports
        |----------------------------------------------------------
        */

        //Student Index
        Route::get('student-reports','ReportsController@student_index');


        // Student Reports Page
        Route::get('student-reports/{id}','ReportsController@student_report');
        Route::get('student-reports/{id}/search','ReportsController@student_Search');



        //Teacher Index
        Route::get('team-member-reports','ReportsController@teacher_index');


        // Teacher Reports Page
        Route::get('team-member-reports/{id}','ReportsController@teacher_report');
        Route::get('team-member-reports/{id}/search','ReportsController@teacher_Search');


        //All Reports
        Route::get('reports-all','ReportsController@report_all');
        Route::get('reports-all/search','ReportsController@Search_all');



        /*
        |----------------------------------------------------------
        |   Manage Subjects
        |----------------------------------------------------------
        */
        Route::get('subjects/trash','SubjectController@trash');
        Route::post('subjects/restore/{id}','SubjectController@restore');
        Route::delete('subjects/destroy_permanent/{id}','SubjectController@destroyPermanent');
        Route::resource('subjects','SubjectController');


        /*
        |----------------------------------------------------------
        |   Manage Branch
        |----------------------------------------------------------
        */
        Route::get('branch/trash','BranchController@trash');
        Route::post('branch/restore/{id}','BranchController@restore');
        Route::delete('branch/destroy_permanent/{id}','BranchController@destroyPermanent');
        Route::resource('branch','BranchController');

        /*
        |----------------------------------------------------------
        |   Add Subject to Team Member
        |----------------------------------------------------------
        */
        Route::get('team-members/{id}/add_subject','TeacherController@addSubject');
        Route::post('team-members/{id}/add_subject_store','TeacherController@addSubjectStore');

        /*
        |----------------------------------------------------------
        |   Assign Member to a Branch
        |----------------------------------------------------------
        */
        Route::get('team-members/{id}/add_branch','TeacherController@addBranch');
        Route::post('team-members/{id}/add_branch_store','TeacherController@addBranchStore');


        /*
        |----------------------------------------------------------
        |   Manage - Search Work Log
        |----------------------------------------------------------
        */
        
        // Index - Search
        Route::get('work-log','WorkController@workSearch');

        // Edit Work
        Route::get('work-log/{id}/edit','WorkController@edit');

       // Update Work Route
       Route::post('work-log/{id}/update','WorkController@update');

       //Delete
       Route::delete('work-log/{id}/destroy_permanent','WorkController@destroyPermanent');



        /*
        |----------------------------------------------------------
        |   Manage Assign Requests
        |----------------------------------------------------------
        */
        
        // Index Assign Requests
        Route::get('assign-requests','TaskController@AssignRequests');

        //Assign Request - Approve
        Route::patch('assign-requests/{id}/approve','TaskController@Assign_approve');

       //Assign Requests - Delete
       Route::delete('assign-requests/{id}/remove','TaskController@Assign_Remove');

    });
});