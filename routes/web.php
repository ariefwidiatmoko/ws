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
    Route::get('/', 'HomeController@index')->name('home');
    Route::resource('/userm/users', 'UserController');
    Route::resource('/userm/roles', 'RoleController');
    Route::resource('/userm/permissions', 'PermissionController');
    Route::resource('/userm/profiles', 'ProfileController');
    Route::get('/userm/users/showLink/{id}', 'UserController@showLink')->name('users.showLink');
    Route::put('/userm/users/updateLink/{id}','UserController@updateLink')->name('users.updateLink');
    Route::put('/users/delete-link/{id}', 'UserController@deleteLink')->name('users.deleteLink');
    Route::resource('/contents/lessons', 'LessonController');
    Route::resource('/contents/notes', 'NoteController');
    Route::resource('/contents/subjects', 'SubjectController');
    Route::get('/contents/filemanager', function () {
    return view('filemanager.index');
    })->name('filemanager');
    Route::post('/contents/lessons/publish', 'LessonController@publish')->name('lessons.publish');
    Route::post('/contents/subjects/publish', 'SubjectController@publish')->name('subjects.publish');
    Route::post('/contents/notes/publish', 'NoteController@publish')->name('notes.publish');
    Route::resource('/contacts/contacts', 'ContactController');
    Route::get('/contacts/students', 'ContactController@indexStudent')->name('contacts.indexStudent');
    Route::get('/contacts/employees', 'ContactController@indexEmployee')->name('contacts.indexEmployee');
    Route::get('/contacts/users', 'ContactController@indexUser')->name('contacts.indexUser');
    Route::resource('/contacts/messages', 'MessageController');
    Route::resource('/events', 'EventController');
    Route::resource('/administration/positions', 'PositionController');
    Route::post('/administration/positions/publish', 'PositionController@publish')->name('positions.publish');
    Route::resource('/administration/students', 'StudentController');
    Route::post('/administration/students/active', 'StudentController@statusActive')->name('students.statusActive');
    Route::resource('/administration/employees', 'EmployeeController');
    Route::post('/administration/employees/active', 'EmployeeController@statusActive')->name('employees.statusActive');
    Route::get('/myprofile/{name}', 'MyprofileController@myprofile')->name('myprofile.show');
    Route::resource('/settings/years', 'YearController');
    Route::resource('/settings/semesters', 'SemesterController');
    Route::resource('/settings/grades', 'GradeController');
    Route::resource('/settings/classrooms', 'ClassroomController');
    Route::post('/settings/classrooms/active', 'ClassroomController@statusActive')->name('classrooms.statusActive');
    Route::put('/settings/classrooms/updateyear/{id}','ClassroomController@updateYear')->name('classrooms.updateYear');
    Route::put('/settings/classrooms/updategrade/{id}', 'ClassroomController@updateGrade')->name('classrooms.updateGrade');
    Route::post('settings/classrooms/deleteyear/{id}', [
    'uses' => 'ClassroomController@delYear',
    'as' => 'classrooms.delYear']);
    Route::resource('/settings/setstudents', 'SetstudentController');
    Route::post('settings/setstudents/deleteyear/{id}', [
    'uses' => 'SetstudentController@delYear',
    'as' => 'setstudents.delYear']);
    Route::put('/settings/setstudents/updategrade/{id}', 'SetstudentController@updateGrade')->name('setstudents.updateGrade');
    Route::put('/settings/setstudents/updateyear/{id}','SetstudentController@updateYear')->name('setstudents.updateYear');
    Route::post('/settings/setstudents/import-student', 'SetstudentController@importStudent')->name('setstudents.importStudent');
    Route::get('/users/change-password/{id}', 'UserController@changePassword')->name('users.changePassword');
    Route::put('/users/update-password/{id}', 'UserController@updatePassword')->name('users.updatePassword');
    Route::get('/settings/importcsv/students', 'ImportController@importcsv')->name('importcsv.student');
    Route::post('/settings/importcsv/students/save-csv', 'ImportController@csvStudent')->name('importcsv.studentsSave');
});
