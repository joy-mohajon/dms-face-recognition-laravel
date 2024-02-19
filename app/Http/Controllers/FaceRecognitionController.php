<?php

namespace App\Http\Controllers;

use App\Models\AttendanceSheet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FaceRecognitionController extends Controller
{
    public function recognizeFaces()
    {
        $pythonScriptPath = storage_path('scripts/face_recognition_script.py');

        // Get the list of student images from the storage directory
        $studentImages = Storage::files('public/images');

        // Construct student details array
        $studentDetails = [];
        foreach ($studentImages as $imagePath) {
            $name = pathinfo($imagePath, PATHINFO_FILENAME);
            $studentDetails[] = [$name, storage_path("app/$imagePath")];
        }
        // dd($studentDetails);
        // Construct the command to execute the Python script
        $command = "python $pythonScriptPath";
        foreach ($studentDetails as $detail) {
            $command .= " " . implode(" ", $detail);
        }

        // Execute the command
        $result = shell_exec($command);

       // Handle the result accordingly
       if (str_contains($result, 'Recognized')) {
            // If recognized, save to attendance_sheets table
            $recognizedData = explode(" ", trim(str_replace(["\n", "Recognized:"], "", $result)));
            $name = $recognizedData[0];
            $date = $recognizedData[2];

            AttendanceSheet::create([
                'name' => $name,
                'date' => $date,
                'user_id' => Auth::user()->id,
            ]);

            return Redirect()->route('get.profile')->with('success', 'Your attendance has been recorded successfully.');
        }

        // Handle the result accordingly
        // You may choose to return a response or redirect as needed
        return Redirect()->route('get.profile')->with('error', 'Sorry! Face unrecognized. Please check your profile picture.');
    }
}
