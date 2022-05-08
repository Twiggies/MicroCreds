<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use PDF;
use App\Models\Course;
use setasign\Fpdi\Fpdi;
use App\Models\Credential;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Carbon;

class CredentialController extends Controller
{
    //
    public function index() {
        $data = [
            'title' => 'Welcome to Tutsmake.com',
            'date' => date('m/d/Y')
        ];
           
        $pdf = PDF::loadView('test_cert', $data);
     
        return $pdf->download('tutsmake.pdf');
    }

    public function create($id) {
        $credential = Credential::where('course_id', $id)->first();
        return view('courses.manage_cred', compact('id', 'credential'));
    }

    public function store(Request $request) {
        $request->validate([
            'institute' => "required | max:50",
            'certificate' => "required | max:70",
        ]);
        if ($credential = Credential::where('course_id', $request->id)->first()) {
            $credential->institute_name = $request->institute;
            $credential->certificate_name = $request->certificate;
            $credential->educator_title = $request->position;
            $credential->update();
        }
        else {
            Credential::create([
                'course_id' => $request->id,
                'institute_name' => $request->institute,
                'certificate_name' => $request->certificate,
                'educator_title' => $request->position,
            ]);
        }
        return redirect()->route('viewcourse', $request->id);
    }

    public function generate(Request $request) {
        $user = Auth::user();
        $course_id = $request->id;
        $course = Course::find($course_id);
        $author_id = $course->user_id;
        $author = User::find($author_id);
        $name = ucfirst($user->firstname).' '.ucfirst($user->lastname);
        $credential = Credential::where('course_id', $course_id)->first();
        if ($credential != null) {
        $institute = $credential->institute_name;
        $educator = ucfirst($author->firstname).' '.ucfirst($author->lastname);
        $position = $credential->educator_title;
        $course = $credential->certificate_name;
        $destination_path = 'storage/files/certificates/'.$user->id.'/';
        if (!File::exists($destination_path)) {
            File::makeDirectory($destination_path, $mode=0777, true, true);
        }
        $outputFile = $destination_path.$course.'.pdf';
        
        $this->createPDF('public/template.pdf', $outputFile, $name, $institute,$educator, $position, $course);

        Achievement::create([
            'user_id' => $user->id,
            'cert_name' => $course,
        ]);

        //return response()->file($outputFile);
        $request->session()->flash('message', 'You have completed this course and been awarded with a credential.');
        $request->session()->flash('message-type', 'bg-green-400');
        return redirect()->route('viewcourse',$request->id);
        }
        else {
            $request->session()->flash('message', 'You have completed this course.');
            $request->session()->flash('message-type', 'bg-green-400');
            return redirect()->route('viewcourse',$request->id);
        }
    }

    public function createPDF($file, $outputFile, $name, $institute, $educator, $position, $course) {
        $fpdi = new FPDI;
        $fpdi->setSourceFile($file);
        $template = $fpdi->importPage(1);
        $size = $fpdi->getTemplateSize($template);
        $fpdi->AddPage($size['orientation'], array($size['width'], $size['height']));
        $fpdi->useTemplate($template);
        $top = 105;
        $right = 135;
        $fpdi->setFont("helvetica", "", 25);
        $fpdi->setTextColor(25,26,25);
        $fpdi->Text($right, $top, $name);
        $fpdi->setFont("helvetica", "", 14);
        $fpdi->setXY(90,130);
        $fpdi->MultiCell(120,7,$course,0,'C');
        $fpdi->setFont("helvetica", "", 16);
        $fpdi->setXY(128,155);
        $fpdi->MultiCell(40,2,date('Y-m-d'),0,'C');
        $fpdi->setFont("helvetica", "", 14);
        $fpdi->setXY(80,175);
        $fpdi->MultiCell(50,5,$educator,0,'C');
        $fpdi->setXY(80,185);
        $fpdi->setFont("helvetica", "", 13);
        $fpdi->MultiCell(50,2,$position,0,'C');
        $fpdi->setXY(150,185);
        $fpdi->setFont("helvetica", "", 15);
        $fpdi->MultiCell(70,2,$institute,0,'C');

        return $fpdi->Output('F',$outputFile);
    }

    public function download($cert_name) {
        $document = Achievement::where('cert_name', $cert_name)->first();
        $user_id = $document->user_id;
        return Storage::download('public/files/certificates/'.$user_id.'/'.$cert_name.'.pdf');
    }

    public function list(Request $request) {
        $user = Auth::user();
        $earned_certificates = $user->achievement;
        return view('achievement.achievement', compact('earned_certificates'));
    }

}
