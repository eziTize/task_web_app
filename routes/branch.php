<?php



/*

|----------------------------------------------------------------

|	Branch Routes

|----------------------------------------------------------------

*/

Route::group(array('prefix' => env('branch'),'namespace' => 'Branch'), function(){

    Route::get('/','AdminController@root');

    Route::get('login','AdminController@index');

    Route::post('login','AdminController@login');

    Route::get('logout','AdminController@logout');

    Route::post('loginWithID/{id}','AdminController@loginWithID');



    Route::group(['middleware' => 'branch'], function(){

        

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

        |   Manage Telecaller User

        |----------------------------------------------------------

        */

        //Route::resource('telecaller','TelecallerController'); /* As of now Telecaller is not dependent on branch */



        /*

        |----------------------------------------------------------

        |   Manage Tpo User

        |----------------------------------------------------------

        */

        //Route::resource('tpo','TpoController'); /* As of now Tpo is not dependent on branch */



        /*

        |----------------------------------------------------------

        |   Manage Teacher User

        |----------------------------------------------------------

        */

        Route::resource('teacher','TeacherController')->only([

            'index','edit' /* As of now Teacher view is required on branch */

        ]);



        /*

        |----------------------------------------------------------

        |   Manage Student User

        |----------------------------------------------------------

        */

        Route::get('student/addUploadField','StudentController@addUploadField');

        Route::get('student/deleteUploadField/{id}','StudentController@deleteUploadField');

        Route::get('student/makeAdmission/{id}','StudentController@makeAdmission');

        Route::post('student/makeAdmission/{id}','StudentController@makeAdmissionAction');

        //Route::get('student/changeCourse/{id}','StudentController@changeCourse');

        //Route::post('student/changeCourse/{id}','StudentController@changeCourseAction');

        Route::get('student/changebatch/{id}','StudentController@changeBatch');

        Route::post('student/change-batch/{id}','StudentController@changeBatchAction');

        Route::get('student/{id}/course-details','StudentController@CourseDetails');

        Route::patch('student/stop-course/{id}','StudentController@stopCourse');

        Route::get('student/course-details/{id}/view','StudentController@singleCourseView');

        Route::get('student/getIDCard/{id}','StudentController@getIDCard');
        Route::get('student/printIDCard/{id}','StudentController@printIDCard');
        Route::get('student/generateIDCard/{id}','StudentController@generateIDCard');
        Route::post('student/generateIDCard/{id}','StudentController@generateIDCardAction');


        Route::resource('student','StudentController');
    


        /*

        |----------------------------------------------------------

        |   Manage Enquiry Leads

        |----------------------------------------------------------

        */

        Route::get('enquiry_leads/not_replied','EnquiryLeadsController@not_replied');

        Route::post('enquiry_leads/assign/{id}','EnquiryLeadsController@assign');

        Route::resource('enquiry_leads','EnquiryLeadsController');



        /*

        |----------------------------------------------------------

        |   Manage Course

        |----------------------------------------------------------

        */

        Route::get('course/getBatch/{id}','CourseController@getBatch');

        Route::resource('course','CourseController')->only([

            'index','edit'

        ]);



        /*

        |----------------------------------------------------------

        |   Manage Batch

        |----------------------------------------------------------

        */

        Route::resource('media','MediaController');

        Route::get('batch/{id}/start','BatchController@start');
        Route::get('batch/excel_format_download','BatchController@excel_format_download');
        Route::resource('batch','BatchController')->only([
            'index','edit'
        ]);



        /*

        |----------------------------------------------------------

        |   Manage Task

        |----------------------------------------------------------

        */

        Route::post('task/{id}/add_comment','TaskController@addComment');

        Route::post('task/{id}/finish_task','TaskController@finishTask');

        Route::resource('task','TaskController')->only([

            'index'

        ]);


        /*
        |----------------------------------------------------------
        |   Manage Openings
        |----------------------------------------------------------
        */


         // Create Openings page Route
        Route::get('openings/add','OpeningsController@create');

        // Store Openings Route
        Route::post('openings/store','OpeningsController@store');


        // List Openings Route
        Route::get('openings','OpeningsController@index');


        // Edit Openings page Route
        Route::get('openings/{id}/edit','OpeningsController@edit');


        // Update Openings Route
        Route::put('openings/{id}/update','OpeningsController@update');
            

        // Destroy Openings (trash) Route
        Route::patch('openings/destroy/{id}','OpeningsController@destroy');


        /*
        |----------------------------------------------------------
        |   Manage Notifications
        |----------------------------------------------------------
        */


        // List Notifications
        Route::get('notifications','NotificationController@index');

        // Delete Notification
        Route::delete('notifications/destroy/{id}','NotificationController@destroy');

    });

});