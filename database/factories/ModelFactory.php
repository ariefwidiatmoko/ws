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
       'name' => $faker->name,
       'alias' => $faker->name
   ];
});

$factory->define(App\Subject::class, function(Faker\Generator $faker) {
   return [
       'name' => $faker->name,
       'alias' => $faker->name,
       'live' => $faker->boolean(),
       'user_id' => function() {
            return \App\User::inRandomOrder()->first()->id;
       },
   ];
});

$factory->define(App\Grade::class, function(Faker\Generator $faker) {
   return [
       'name' => $faker->name,
       'alias' => $faker->name,
       'user_id' => function() {
            return \App\User::inRandomOrder()->first()->id;
       },
   ];
});

$factory->define(App\Classroom::class, function(Faker\Generator $faker) {
   return [
       'name' => $faker->name,
       'alias' => $faker->name,
       'statusActive' => $faker->boolean(),
       'user_id' => function() {
            return \App\User::inRandomOrder()->first()->id;
       },
   ];
});

$factory->define(App\Profile::class, function(Faker\Generator $faker) {
   return [
      'user_id' => $faker->randomDigit,
      'fullname' => $faker->name,
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
       'name' => $faker->name,
       'live' => $faker->boolean(),
       'user_id' => function() {
            return \App\User::inRandomOrder()->first()->id;
       },
   ];
});

$factory->define(App\Employee::class, function(Faker\Generator $faker) {
   return [
       'fullname' => $faker->name,
       'month_id' => $faker->numberBetween($min = 1, $max = 12),
       'noId' => $faker->numberBetween($min = 10000, $max = 19999),
       'dob' => $faker->date($format = 'Y-m-d', $max = 'now'),
       'phone' => $faker->phoneNumber,
       'email' => $faker->unique()->safeEmail,
       'address' => $faker->address,
       'education' => $faker->sentence,
       'quote' => $faker->sentence(random_int(2, 3)),
       'about' => $faker->paragraph(random_int(3, 5)),
       'statusActive' => $faker->boolean(),
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
       'title' => $faker->sentence($nbWords = 6, $variableNbWords = true),
       'slug' => $faker->slug,
       'content' => $faker->paragraph(random_int(30, 50)),
       'published_at' => $faker->dateTimeThisYear($max = 'now'),
       'live' => $faker->boolean(),
       'user_id' => function() {
            return \App\User::inRandomOrder()->first()->id;
       },
       'subject_id' => $faker->numberBetween($min = 1, $max = 10),
   ];
});

$factory->define(App\Note::class, function(Faker\Generator $faker) {
   return [
      'user_id' => $faker->randomDigit,
      'name' => $faker->name,
      'title' => $faker->sentence($nbWords = 6, $variableNbWords = true),
      'description' => $faker->paragraph(random_int(8, 12)),
      'image' => $faker->name,
      'live' => $faker->boolean(),
   ];
});

$factory->define(App\Message::class, function(Faker\Generator $faker) {
   return [
      'user_id' => $faker->randomDigit,
      'name' => $faker->name,
      'email' => $faker->unique()->safeEmail,
      'title' => $faker->sentence,
      'content' => $faker->paragraph(random_int(8, 12)),
   ];
});

$factory->define(App\Student::class, function(Faker\Generator $faker) {
   return [
      'noId' => $faker->year('now').$faker->numberBetween($min = 10000, $max = 19999),
      'noIdNational' => $faker->numberBetween($min = 10000, $max = 19999),
      'user_id' => $faker->numberBetween($min = 1, $max = 2),
      'fullname' => $faker->name,
      'nickName' => $faker->name,
      'statusActive' => $faker->boolean(),
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
      'familyStatus' => $faker->name,
      'childNo' => $faker->numberBetween($min = 1, $max = 4),
      'healthNote' => $faker->sentence($nbWords = 12, $variableNbWords = true),
      'achievementNote' => $faker->sentence($nbWords = 20, $variableNbWords = true),
      'familiyNote' => $faker->sentence($nbWords = 15, $variableNbWords = true),
      'previousSchool' => $faker->sentence($nbWords = 2, $variableNbWords = true),
      'prevScNote' => $faker->sentence($nbWords = 12, $variableNbWords = true),
      'afterScNote' => $faker->sentence($nbWords = 18, $variableNbWords = true),
      'schoolNote' => $faker->sentence($nbWords = 18, $variableNbWords = true),
      'father' => $faker->name,
      'fphone' => $faker->phoneNumber,
      'femail' => $faker->unique()->safeEmail,
      'mother' => $faker->name,
      'mphone' => $faker->phoneNumber,
      'memail' => $faker->unique()->safeEmail,
      'guardian' => $faker->name,
      'gphone' => $faker->phoneNumber,
      'gemail' => $faker->unique()->safeEmail,
      'paddress' => $faker->address,
      'parentNote' => $faker->sentence($nbWords = 18, $variableNbWords = true),
   ];
});

$factory->define(App\Year::class, function(Faker\Generator $faker) {
   return [
      'user_id' => $faker->randomDigit,
      'name' => $faker->name,
      'alias' => $faker->name,
   ];
});

$factory->define(App\Semester::class, function(Faker\Generator $faker) {
   return [
      'user_id' => $faker->randomDigit,
      'name' => $faker->name,
      'alias' => $faker->name,
   ];
});
