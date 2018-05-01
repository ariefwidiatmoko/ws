<?php

$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => 'secret',
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Month::class, function(Faker\Generator $faker) {
   return [
       'noId' => $faker->randomDigit,
       'monthname' => $faker->name,
       'alias' => $faker->name
   ];
});

$factory->define(App\Subject::class, function(Faker\Generator $faker) {
   return [
       'subjectname' => $faker->name,
       'alias' => $faker->name,
       'subjectactive' => $faker->boolean(),
       'user_id' => function() {
            return \App\User::inRandomOrder()->first()->id;
       },
   ];
});

$factory->define(App\Grade::class, function(Faker\Generator $faker) {
   return [
       'gradename' => $faker->name,
       'alias' => $faker->name,
       'user_id' => function() {
            return \App\User::inRandomOrder()->first()->id;
       },
   ];
});

$factory->define(App\Classroom::class, function(Faker\Generator $faker) {
   return [
       'classroomname' => $faker->name,
       'alias' => $faker->name,
       'classroomactive' => $faker->boolean(),
       'user_id' => function() {
            return \App\User::inRandomOrder()->first()->id;
       },
   ];
});

$factory->define(App\Profile::class, function(Faker\Generator $faker) {
   return [
      'user_id' => $faker->randomDigit,
      'profilename' => $faker->name,
      'dob' => $faker->date($format = 'Y-m-d', $max = 'now'),
      'phone' => $faker->phoneNumber,
      'address' => $faker->address,
      'education' => $faker->sentence,
      'quote' => $faker->sentence(random_int(2, 3)),
      'about' => $faker->paragraph(random_int(3, 5)),
      'updated_by' => function() {
           return \App\User::inRandomOrder()->first()->name;
      },
  ];
});

$factory->define(App\Position::class, function(Faker\Generator $faker) {
   return [
       'positionname' => $faker->name,
       'positionactive' => $faker->boolean(),
       'user_id' => function() {
            return \App\User::inRandomOrder()->first()->id;
       },
   ];
});

$factory->define(App\Employee::class, function(Faker\Generator $faker) {
   return [
       'employeename' => $faker->name,
       'month_id' => $faker->numberBetween($min = 1, $max = 12),
       'noId' => $faker->numberBetween($min = 10000, $max = 19999),
       'dob' => $faker->date($format = 'Y-m-d', $max = 'now'),
       'phone' => $faker->phoneNumber,
       'email' => $faker->unique()->safeEmail,
       'address' => $faker->address,
       'education' => $faker->sentence,
       'quote' => $faker->sentence(random_int(2, 3)),
       'about' => $faker->paragraph(random_int(3, 5)),
       'employeeactive' => $faker->boolean(),
       'created_by' => function() {
            return \App\User::inRandomOrder()->first()->name;
       },
       'updated_by' => function() {
            return \App\User::inRandomOrder()->first()->name;
       },
   ];
});

$factory->define(App\Lesson::class, function(Faker\Generator $faker) {
   return [
       'lessontitle' => $faker->sentence($nbWords = 6, $variableNbWords = true),
       'slug' => $faker->slug,
       'lessoncontent' => $faker->paragraph(random_int(30, 50)),
       'published_at' => $faker->dateTimeThisYear($max = 'now'),
       'lessonactive' => $faker->boolean(),
       'user_id' => function() {
            return \App\User::inRandomOrder()->first()->id;
       },
       'subject_id' => $faker->numberBetween($min = 1, $max = 10),
   ];
});

$factory->define(App\Note::class, function(Faker\Generator $faker) {
   return [
      'user_id' => $faker->randomDigit,
      'notesegment' => $faker->name,
      'notetitle' => $faker->sentence($nbWords = 6, $variableNbWords = true),
      'description' => $faker->paragraph(random_int(8, 12)),
      'image' => $faker->name,
      'noteactive' => $faker->boolean(),
   ];
});

$factory->define(App\Message::class, function(Faker\Generator $faker) {
   return [
      'user_id' => $faker->randomDigit,
      'sender' => $faker->name,
      'email' => $faker->unique()->safeEmail,
      'messagetitle' => $faker->sentence,
      'messagecontent' => $faker->paragraph(random_int(8, 12)),
   ];
});

$factory->define(App\Student::class, function(Faker\Generator $faker) {
   return [
      'noId' => $faker->year('now').$faker->numberBetween($min = 10000, $max = 19999),
      'noIdNational' => $faker->numberBetween($min = 10000, $max = 19999),
      'user_id' => $faker->numberBetween($min = 1, $max = 2),
      'studentname' => $faker->name,
      'studentnick' => $faker->name,
      'studentactive' => $faker->boolean(),
   ];
});

$factory->define(App\Studentprofile::class, function(Faker\Generator $faker) {

   static $snumber = 1;
   return [
      'student_id' => $snumber++,
      'user_id' => $faker->numberBetween($min = 1, $max = 2),
      'month_id' => $faker->randomDigit,
      'gender' => $faker->boolean(),
      'dob' => $faker->date($format = 'Y-m-d', $max = 'now'),
      'phone' => $faker->phoneNumber,
      'email' => $faker->unique()->safeEmail,
      'address' => $faker->address,
      'citizenship' => $faker->country,
      'siblings' => $faker->numberBetween($min = 0, $max = 3),
      'familystatus' => $faker->name,
      'childno' => $faker->numberBetween($min = 1, $max = 4),
      'healthnote' => $faker->sentence($nbWords = 12, $variableNbWords = true),
      'achievementnote' => $faker->sentence($nbWords = 20, $variableNbWords = true),
      'familiynote' => $faker->sentence($nbWords = 15, $variableNbWords = true),
      'prevschool' => $faker->sentence($nbWords = 2, $variableNbWords = true),
      'prevschoolnote' => $faker->sentence($nbWords = 12, $variableNbWords = true),
      'afterschoolnote' => $faker->sentence($nbWords = 18, $variableNbWords = true),
      'schoolNote' => $faker->sentence($nbWords = 18, $variableNbWords = true),
      'father' => $faker->name,
      'fatherphone' => $faker->phoneNumber,
      'fatheremail' => $faker->unique()->safeEmail,
      'mother' => $faker->name,
      'motherphone' => $faker->phoneNumber,
      'motheremail' => $faker->unique()->safeEmail,
      'guardian' => $faker->name,
      'guardianphone' => $faker->phoneNumber,
      'guardianemail' => $faker->unique()->safeEmail,
      'parentaddress' => $faker->address,
      'parentNote' => $faker->sentence($nbWords = 18, $variableNbWords = true),
   ];
});

$factory->define(App\Year::class, function(Faker\Generator $faker) {
   return [
      'user_id' => $faker->randomDigit,
      'yearname' => $faker->name,
      'alias' => $faker->name,
   ];
});

$factory->define(App\Semester::class, function(Faker\Generator $faker) {
   return [
      'user_id' => $faker->randomDigit,
      'semestername' => $faker->name,
      'alias' => $faker->name,
   ];
});
