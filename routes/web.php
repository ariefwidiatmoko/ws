<?php
use App\User;

Route::get('/', function() { return Redirect::to('/login'); });

Route::group(['middleware' => ['web']], function() {
    Route::get('login', ['as' => 'login', 'uses' => 'Auth\LoginController@showLoginForm']);
    Route::post('login', ['as' => 'login.post', 'uses' => 'Auth\LoginController@login']);
    Route::post('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);
    Route::get('register', function() { return Redirect::to('/login'); });
    Route::get('password/reset', function() { return Redirect::to('/login'); });
    Route::get('password/reset/{token}', function() { return Redirect::to('/login'); });
});

Route::group( ['prefix' => 'home', 'middleware' => ['auth', 'web']], function()
{
    //Dashboard
    Route::get('/', 'HomeController@index')->name('home');
    //Academics
    Route::resource('/academics/classroomstudent', 'ClassroomstudentController');
    Route::get('academics/classroomstudent/{id}/{year_id}', 'ClassroomstudentController@showDetail')->name('classroomstudent.showDetail');
    Route::put('/academics/classroomstudent/update-homeroomteacher/{id}', 'ClassroomstudentController@updateHomeroom')->name('classroomstudent.updateHomeroom');
    Route::put('/academics/classroomstudent/update-allocate-student/{id}', 'AllocatestudentController@updateAllocate')->name('allocatestudents.updateAllocate');
    Route::resource('/academics/positions', 'PositionController');
    Route::post('/academics/positions/publish', 'PositionController@publish')->name('positions.publish');
    Route::resource('/academics/students', 'StudentController');
    Route::post('/academics/students/active', 'StudentController@statusActive')->name('students.statusActive');
    Route::resource('/academics/employees', 'EmployeeController');
    Route::post('/academics/employees/active', 'EmployeeController@statusActive')->name('employees.statusActive');
    Route::resource('/academics/alumni', 'AlumniController');
    //scorings
    Route::resource('/scorings/scoringsheets', 'ScoringsheetController');
    Route::get('scorings/scoringsheets/set/{id}', 'ScoringsheetController@setscoringsheet')->name('scoringsheets.setscoringsheet');
    Route::post('scorings/scoringsheets/{year_id}/{semester_id}/{classroom_id}/{subject_id}/update-setting-score', 'ScoringsheetController@updatesettingscore')->name('scoringsheets.updatesettingscore');
    Route::post('scorings/scoringsheets/{classsubject_id}/update-groupscore', 'ScoringsheetController@updategroupscore')->name('scoringsheets.updategroupscore');
    //Scoringsheet
    Route::resource('/scorings/scoringsheets', 'ScoringsheetController');
    Route::get('scorings/scoringsheets/show-score-fullscreen/{id}', 'ScoringsheetController@showfullscreen')->name('scoringsheets.showfullscreen');
    Route::get('scorings/scoringsheets/input-score/{id}', 'ScoringsheetController@inputscore')->name('scoringsheets.inputscore');
    Route::get('scorings/scoringsheets/input-score-fullscreen/{id}', 'ScoringsheetController@inputfullscreen')->name('scoringsheets.inputfullscreen');
    Route::put('/scorings/scoringsheets/update-column-detail/{id}', 'ScoringsheetController@updatecolumndetail')->name('scoringsheets.updatecolumndetail');
    Route::put('/scorings/scoringsheets/update-column-group/{id}', 'ScoringsheetController@updatecolumngroup')->name('scoringsheets.updatecolumngroup');
    Route::put('/scorings/scoringsheets/update-column-competency/{id}', 'ScoringsheetController@updatecolumncompetency')->name('scoringsheets.updatecolumncompetency');
    Route::post('/scorings/scoringsheets/update-score', 'ScoringsheetController@updatescore')->name('scoringsheets.updatescore');
    Route::get('scorings/scoringsheets/set-score/{id}', 'ScoringsheetController@setscore')->name('scoringsheets.setscore');
    //User Management
    Route::resource('/userm/users', 'UserController');
    Route::resource('/userm/roles', 'RoleController');
    Route::resource('/userm/permissions', 'PermissionController');
    Route::resource('/userm/profiles', 'ProfileController');
    Route::get('/myprofile/{name}', 'ProfileController@myprofile')->name('myprofile.show');
    Route::get('/userm/users/showLink/{id}', 'UserController@showLink')->name('users.showLink');
    Route::put('/userm/users/updateLink/{id}','UserController@updateLink')->name('users.updateLink');
    Route::put('/users/delete-link/{id}', 'UserController@deleteLink')->name('users.deleteLink');
    //Contents
    Route::resource('/contents/lessons', 'LessonController');
    Route::resource('/contents/notes', 'NoteController');
    Route::get('/contents/filemanager', function () {
    return view('contents.filemanager.index');
    })->name('filemanager');
    Route::post('/contents/lessons/publish', 'LessonController@publish')->name('lessons.publish');
    Route::post('/contents/notes/publish', 'NoteController@publish')->name('notes.publish');
    Route::resource('/contacts/contacts', 'ContactController');
    Route::get('/contacts/students', 'ContactController@indexStudent')->name('contacts.indexStudent');
    Route::get('/contacts/employees', 'ContactController@indexEmployee')->name('contacts.indexEmployee');
    Route::get('/contacts/users', 'ContactController@indexUser')->name('contacts.indexUser');
    Route::resource('/contacts/messages', 'MessageController');
    //Events
    Route::resource('/events', 'EventController');
    //Settings
    Route::resource('/settings/schools', 'SchoolController');
    Route::get('/settings/schools/edit-year-active/{id}', 'SchoolController@editYear')->name('schools.editYear');
    Route::put('/settings/schools/update-year-active/{id}','SchoolController@updateYear')->name('schools.updateYear');
    Route::resource('/settings/years', 'YearController');
    Route::resource('/settings/semesters', 'SemesterController');
    Route::resource('/settings/grades', 'GradeController');
    //Settings Subjects
    Route::resource('/settings/subjects', 'SubjectController');
    Route::post('/settings/subjects/publish', 'SubjectController@publish')->name('subjects.publish');
    //Settings Classrooms
    Route::resource('/settings/classrooms', 'ClassroomController');
    Route::post('/settings/classrooms/active', 'ClassroomController@statusActive')->name('classrooms.statusActive');
    Route::put('/settings/classrooms/update-year/{id}','ClassroomController@updateYear')->name('classrooms.updateYear');
    Route::put('/settings/classrooms/update-grade/{id}', 'ClassroomController@updateGrade')->name('classrooms.updateGrade');
    Route::post('settings/classrooms/delete-year/{id}', [
    'uses' => 'ClassroomController@delYear',
    'as' => 'classrooms.delYear']);
    Route::post('/settings/classrooms/year-classroom', 'ClassroomController@yearClassroom')->name('classrooms.yearClassroom');
    //Setting Import Student
    Route::get('/settings/import-students', 'ImportstudentController@index')->name('importstudents.index');
    Route::post('/settings/import-students/import', 'ImportstudentController@import')->name('importstudents.import');
    //Allocate Classroom-Student
    Route::get('/settings/allocatestudents', 'AllocatestudentController@index')->name('allocatestudents.index');
    Route::put('/settings/allocatestudents/update', 'AllocatestudentController@update')->name('allocatestudents.update');
    //Typescore
    Route::resource('/settings/types', 'TypeController');
    //Groupscore
    Route::resource('/settings/groups', 'GroupController');
    //Detailscore
    Route::resource('/settings/details', 'DetailController');
    //Change Password
    Route::get('/users/change-password/{id}', 'UserController@changePassword')->name('users.changePassword');
    Route::put('/users/update-password/{id}', 'UserController@updatePassword')->name('users.updatePassword');
});
