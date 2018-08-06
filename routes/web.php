<?php
use App\User;

//Login Page
Route::get('/', 'WelcomepageController@login')->middleware('web')->name('welcomepage.login');
Route::get('login', 'Auth\LoginController@showLoginForm')->middleware('web')->name('login');
Route::post('login', 'Auth\LoginController@login')->middleware('web')->name('login.post');
Route::post('logout', 'Auth\LoginController@logout')->middleware('web')->name('logout');
Route::get('register', 'WelcomepageController@login')->middleware('web')->name('welcomepage.login');
Route::get('password/reset', 'WelcomepageController@login')->middleware('web')->name('welcomepage.login');
Route::get('password/reset/{token}', 'WelcomepageController@login')->middleware('web')->name('welcomepage.login');

//Dashboard
Route::get('home/', 'HomeController@index')->middleware(['auth', 'web'])->name('home');

//Academics > Import Student
Route::get('home/academics/import-students', 'ImportstudentController@index')->middleware(['auth', 'web'])->name('importstudents.index');
Route::post('home/academics/import-students/import', 'ImportstudentController@import')->middleware(['auth', 'web'])->name('importstudents.import');

//Academics > Allocate Classroom-Student
Route::get('home/academics/allocatestudents', 'AllocatestudentController@index')->middleware(['auth', 'web'])->name('allocatestudents.index');
Route::put('home/academics/allocatestudents/update', 'AllocatestudentController@update')->middleware(['auth', 'web'])->name('allocatestudents.update');

//Academics > Classrooms
Route::get('home/academics/classroomstudent', 'ClassroomstudentController@index')->middleware(['auth', 'web'])->name('classroomstudent.index');
Route::get('home/academics/classroomstudent/{id}/{year_id}', 'ClassroomstudentController@showDetail')->middleware(['auth', 'web'])->name('classroomstudent.showDetail');
Route::put('home/academics/classroomstudent/update-homeroomteacher/{id}', 'ClassroomstudentController@updateHomeroom')->middleware(['auth', 'web'])->name('classroomstudent.updateHomeroom');

//Academics > Positions
Route::resource('home/academics/positions', 'PositionController')->middleware(['auth', 'web']);
Route::post('home/academics/positions/publish', 'PositionController@publish')->middleware(['auth', 'web'])->name('positions.publish');

//Academics > Students
Route::resource('home/academics/students', 'StudentController')->middleware(['auth', 'web']);
Route::post('home/academics/students/import', 'StudentController@import')->middleware(['auth', 'web'])->name('students.import');
Route::post('home/academics/students/active', 'StudentController@statusActive')->middleware(['auth', 'web'])->name('students.statusActive');
Route::post('home/academics/students/add-year-student/{id}', 'StudentController@addyear')->middleware(['auth', 'web'])->name('students.addyear');
Route::put('home/academics/students/update-allocate-student/{id}', 'StudentController@updateAllocate')->middleware(['auth', 'web'])->name('students.updateAllocate');
Route::delete('home/academics/students/destroy/{id}', 'StudentController@destroy')->middleware(['auth', 'web'])->name('students.destroy');

//Academics > Employees
Route::resource('home/academics/employees', 'EmployeeController')->middleware(['auth', 'web']);
Route::post('home/academics/employees/active', 'EmployeeController@statusActive')->middleware(['auth', 'web'])->name('employees.statusActive');

//Academics > Alumni
Route::resource('home/academics/alumni', 'AlumniController')->middleware(['auth', 'web']);

//Gradings > Scorings
Route::get('home/gradings/scoringsheets/set/{id}', 'ScoringsheetController@setscoringsheet')->name('scoringsheets.setscoringsheet')->middleware(['auth', 'web']);
Route::post('home/gradings/scoringsheets/{year_id}/{semester_id}/{classroom_id}/{subject_id}/update-setting-score', 'ScoringsheetController@updatesettingscore')->middleware(['auth', 'web'])->name('scoringsheets.updatesettingscore');

//Gradings > Competencies
Route::get('home/gradings/competencies', 'CompetencyController@index')->middleware(['auth', 'web'])->name('competencies.index');
Route::post('home/gradings/competencies/import', 'CompetencyController@import')->middleware(['auth', 'web'])->name('competencies.import');
Route::get('home/gradings/competencies/show/{type_id}/{subjectgradeyear_id}', 'CompetencyController@show')->middleware(['auth', 'web'])->name('competencies.show');
Route::post('home/gradings/competencies/updatehead', 'CompetencyController@updatehead')->middleware(['auth', 'web'])->name('competencies.updatehead');
Route::post('home/gradings/competencies/updatescale', 'CompetencyController@updatescale')->middleware(['auth', 'web'])->name('competencies.updatescale');
Route::post('home/gradings/competencies/updatedetail', 'CompetencyController@updatedetail')->middleware(['auth', 'web'])->name('competencies.updatedetail');
Route::delete('home/gradings/competencies/destroy/{id}', 'CompetencyController@destroy')->middleware(['auth', 'web'])->name('competencies.destroy');

//Gradings > Scoringsheet
Route::resource('home/gradings/scoringsheets', 'ScoringsheetController')->middleware(['auth', 'web']);
Route::get('home/gradings/scoringsheets/show-score/{type_id}/{id}', 'ScoringsheetController@showscore')->middleware(['auth', 'web'])->name('scoringsheets.showscore');
Route::get('home/gradings/scoringsheets/input-score/{type_id}/{id}', 'ScoringsheetController@inputscore')->middleware(['auth', 'web'])->name('scoringsheets.inputscore');
Route::put('home/gradings/scoringsheets/update-column-detail/{id}', 'ScoringsheetController@updatecolumndetail')->middleware(['auth', 'web'])->name('scoringsheets.updatecolumndetail');
Route::put('home/gradings/scoringsheets/update-column-group/{id}', 'ScoringsheetController@updatecolumngroup')->middleware(['auth', 'web'])->name('scoringsheets.updatecolumngroup');
Route::put('home/gradings/scoringsheets/update-column-competency/{id}', 'ScoringsheetController@updatecolumncompetency')->middleware(['auth', 'web'])->name('scoringsheets.updatecolumncompetency');
Route::post('home/gradings/scoringsheets/update-score', 'ScoringsheetController@updatescore')->middleware(['auth', 'web'])->name('scoringsheets.updatescore');
Route::post('home/gradings/scoringsheets/update-fscore', 'ScoringsheetController@updatefscore')->middleware(['auth', 'web'])->name('scoringsheets.updatefscore');
Route::put('home/gradings/scoringsheets/update-column-score/{id}', 'ScoringsheetController@updatecolumnscore')->middleware(['auth', 'web'])->name('scoringsheets.updatecolumnscore');
Route::get('home/gradings/scoringsheets/export-score/{type_id}/{id}', 'ScoringsheetController@exportscore')->middleware(['auth', 'web'])->name('scoringsheets.exportscore');
//Gradings > Scoringsheet > Competency
Route::get('home/gradings/scoringsheets/show-score-competency/{type_id}/{id}', 'ScoringsheetController@showcompetency')->middleware(['auth', 'web'])->name('scoringsheets.showcompetency');
Route::post('home/gradings/scoringsheets/update-fcompetency', 'ScoringsheetController@updatefcompetency')->middleware(['auth', 'web'])->name('scoringsheets.updatefcompetency');
Route::put('home/gradings/scoringsheets/save-competency/{type_id}/{id}', 'ScoringsheetController@savecompetency')->middleware(['auth', 'web'])->name('scoringsheets.savecompetency');
Route::get('home/gradings/scoringsheets/export-competency/{type_id}/{id}', 'ScoringsheetController@exportcompetency')->middleware(['auth', 'web'])->name('scoringsheets.exportcompetency');
Route::get('home/gradings/scoringsheets/set-score/{id}', 'ScoringsheetController@setscore')->middleware(['auth', 'web'])->name('scoringsheets.setscore');
//Contents > Lessons
Route::resource('home/contents/lessons', 'LessonController')->middleware(['auth', 'web']);
Route::post('home/contents/lessons/publish', 'LessonController@publish')->middleware(['auth', 'web'])->name('lessons.publish');

//Contents > Notes
Route::resource('home/contents/notes', 'NoteController')->middleware(['auth', 'web']);
Route::post('home/contents/notes/publish', 'NoteController@publish')->middleware(['auth', 'web'])->name('notes.publish');

//Contents > Filemanager
Route::get('home/contents/filemanager', 'MessageController@filemanager')->middleware(['auth', 'web'])->name('filemanager');

//Contents > Contacts
Route::resource('home/contacts/contacts', 'ContactController')->middleware(['auth', 'web']);
Route::get('home/contacts/students', 'ContactController@indexStudent')->middleware(['auth', 'web'])->name('contacts.indexStudent');
Route::get('home/contacts/employees', 'ContactController@indexEmployee')->middleware(['auth', 'web'])->name('contacts.indexEmployee');
Route::get('home/contacts/users', 'ContactController@indexUser')->middleware(['auth', 'web'])->name('contacts.indexUser');

//Contents > Messages
Route::resource('home/contacts/messages', 'MessageController')->middleware(['auth', 'web']);

//Events
Route::resource('home/events', 'EventController')->middleware(['auth', 'web']);

//Settings > Schools
Route::resource('home/settings/schools', 'SchoolController')->middleware(['auth', 'web']);
Route::get('home/settings/schools/edit-year-active/{id}', 'SchoolController@editYear')->middleware(['auth', 'web'])->name('schools.editYear');
Route::put('home/settings/schools/update-year-active/{id}','SchoolController@updateYear')->middleware(['auth', 'web'])->name('schools.updateYear');

//Settings > Years
Route::resource('home/settings/years', 'YearController')->middleware(['auth', 'web']);

//Settings > Semesters
Route::resource('home/settings/semesters', 'SemesterController')->middleware(['auth', 'web']);

//Settings > Grades
Route::resource('home/settings/grades', 'GradeController')->middleware(['auth', 'web']);

//Settings > Subjects
Route::resource('home/settings/subjects', 'SubjectController')->middleware(['auth', 'web']);
Route::post('home/settings/subjects/publish', 'SubjectController@publish')->middleware(['auth', 'web'])->name('subjects.publish');

//Settings > Classrooms
Route::resource('home/settings/classrooms', 'ClassroomController')->middleware(['auth', 'web']);
Route::post('home/settings/classrooms/active', 'ClassroomController@statusActive')->middleware(['auth', 'web'])->name('classrooms.statusActive');
Route::put('home/settings/classrooms/update-year/{id}','ClassroomController@updateYear')->middleware(['auth', 'web'])->name('classrooms.updateYear');
Route::put('home/settings/classrooms/update-grade/{id}', 'ClassroomController@updateGrade')->middleware(['auth', 'web'])->name('classrooms.updateGrade');
Route::post('home/settings/classrooms/delete-year/{id}', 'ClassroomController@delYear')->middleware(['auth', 'web'])->name('classrooms.delYear');
Route::post('home/settings/classrooms/year-classroom', 'ClassroomController@yearClassroom')->middleware(['auth', 'web'])->name('classrooms.yearClassroom');

//Setting > Competencyalphas
Route::get('home/settings/competencyalphas', 'CompetencyalphaController@index')->middleware(['auth', 'web'])->name('competencyalphas.index');
Route::delete('home/settings/competencyalphas/destroy/{id}', 'CompetencyalphaController@destroy')->middleware(['auth', 'web'])->name('competencyalphas.destroy');
Route::post('home/settings/competencyalphas/store', 'CompetencyalphaController@store')->middleware(['auth', 'web'])->name('competencyalphas.store');
Route::put('home/settings/competencyalphas/update/{id}', 'CompetencyalphaController@update')->middleware(['auth', 'web'])->name('competencyalphas.update');

//Settings > Typescore
Route::resource('home/settings/types', 'TypeController')->middleware(['auth', 'web']);

//Settings > Groupscore
Route::resource('home/settings/groups', 'GroupController')->middleware(['auth', 'web']);

//Settings > Detailscore
Route::resource('home/settings/details', 'DetailController')->middleware(['auth', 'web']);

//Settings > Gradings
Route::resource('home/settings/gradings', 'GradingController')->middleware(['auth', 'web']);

//User Management > Users
Route::resource('home/userm/users', 'UserController')->middleware(['auth', 'web']);
Route::get('home/userm/users/showLink/{id}', 'UserController@showLink')->middleware(['auth', 'web'])->name('users.showLink');
Route::put('home/userm/users/updateLink/{id}','UserController@updateLink')->middleware(['auth', 'web'])->name('users.updateLink');
Route::put('home/userm/users/delete-link/{id}', 'UserController@deleteLink')->middleware(['auth', 'web'])->name('users.deleteLink');

//User Management > Roles
Route::resource('home/userm/roles', 'RoleController')->middleware(['auth', 'web']);

//User Management > Permissions
Route::resource('home/userm/permissions', 'PermissionController')->middleware(['auth', 'web']);

//User Management > Profiles
Route::resource('home/userm/profiles', 'ProfileController')->middleware(['auth', 'web']);
Route::get('home/myprofile/{name}', 'ProfileController@myprofile')->middleware(['auth', 'web'])->name('myprofile.show');

//Change Password
Route::get('home/users/change-password/{id}', 'UserController@changePassword')->middleware(['auth', 'web'])->name('users.changePassword');
Route::put('home/users/update-password/{id}', 'UserController@updatePassword')->middleware(['auth', 'web'])->name('users.updatePassword');
