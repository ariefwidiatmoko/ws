<?php

namespace App\Listeners;

use App\Events\StudentCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use App\Studentprofile;
use App\Student;

class CreateStudentprofile
{

    public function __construct()
    {
        //
    }

    public function handle(StudentCreated $event)
    {
      $studentprofile = new Studentprofile();

      $studentprofile->user_id = Auth::user()->id;

      $event->student->studentprofile()->save($studentprofile);
    }
}
