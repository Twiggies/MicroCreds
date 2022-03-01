<?php

namespace App\Http\Controllers;

use PDF;
use setasign\Fpdi\Fpdi;
use App\Models\Credential;
use Illuminate\Http\Request;

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
        $name = "Hee";
        $institute = "MMU";
        $educator = "John Doe";
        $position = "Professor/Supervisor";
        $course = "Java Development Beginner Level ";
        $outputFile = 'public/'.'cert.pdf';
        $this->createPDF('public/template.pdf', $outputFile, $name, $institute,$educator, $position, $course);

        return response()->file($outputFile);
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
        $fpdi->setXY(80,180);
        $fpdi->MultiCell(50,5,$educator,0,'C');
        $fpdi->setXY(80,185);
        $fpdi->setFont("helvetica", "", 13);
        $fpdi->MultiCell(50,2,$position,0,'C');
        $fpdi->setXY(150,185);
        $fpdi->setFont("helvetica", "", 15);
        $fpdi->MultiCell(70,2,$institute,0,'C');

        return $fpdi->Output($outputFile,'F');
    }
}
