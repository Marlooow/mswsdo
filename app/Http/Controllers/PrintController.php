<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Beneficiary;
use Illuminate\Http\Request;

class PrintController extends Controller
{
    public function printSoloParent($beneficiaryId)
    {
        // Retrieve the beneficiary and the specific application
        $beneficiary = Beneficiary::findOrFail($beneficiaryId);
        $application = $beneficiary->applications()
            ->where('id', request('application_id', $beneficiary->applications()->latest()->first()->id))
            ->firstOrFail();

        $application->date_released = now();
        $application->save();

        // Decode the JSON form_data
        $formData = json_decode($application->form_data, true) ?? [];

        // Ensure the data keys match what is expected in the view
        // If needed, transform or add defaults for missing keys
        $formData = array_merge([
            'surname' => $beneficiary->surname,
            'first_name' => $beneficiary->first_name,
            'middle_name' => $beneficiary->middle_name,
            'name_extension' => '',
            'age' => '',
            'sex' => '',
            'dob' => '',
            'place_of_birth' => '',
            'address' => '',
            'educational_attainment' => '',
            'civil_status' => '',
            'occupation' => '',
            'religion' => '',
            'company_agency' => '',
            'monthly_income' => '',
            'employment_status' => '',
            'phone_number' => '',
            'pantawid_beneficiary' => false,
            'indigenous_person' => false,
            'lgbtq_plus' => false,
            'family_composition' => [],  // Family composition array
            'classification_circumstances' => '',
            'needs_problems' => '',
            'emergency_contact' => [
                'name' => '',
                'relationship' => '',
                'address' => '',
            ],
            'emergency_contact_number' => '',
        ], $formData);

        $full_name =  $beneficiary->first_name . '_' . $beneficiary->middle_name . '_' . $beneficiary->surname;

        // Generate the PDF with the print view template
        $pdf = PDF::loadView('print-solo-parent', [
            'beneficiary' => $beneficiary,
            'application' => $application,
            'formData' => $formData,
        ]);
        // Return the PDF as a stream
        return $pdf->stream(($full_name) . '.pdf');
    }

    // Add similar methods for other programs
    public function printUI($beneficiaryId)
    {
        // Retrieve the beneficiary and the specific application
        $beneficiary = Beneficiary::findOrFail($beneficiaryId);
        $application = $beneficiary->applications()
            ->where('id', request('application_id', $beneficiary->applications()->latest()->first()->id))
            ->firstOrFail();

        $application->date_released = now();
        $application->save();

        return response()->json(['success' => true, 'message' => ''], 200);
    }

    public function printAifcs($beneficiaryId)
    {
        // Retrieve the beneficiary and the specific application
        $beneficiary = Beneficiary::findOrFail($beneficiaryId);
        $application = $beneficiary->applications()
            ->where('id', request('application_id', $beneficiary->applications()->latest()->first()->id))
            ->firstOrFail();

        $application->date_released = now();
        $application->save();

        // Decode the JSON form_data
        $formData = json_decode($application->form_data, true) ?? [];

        // Ensure the data keys match what is expected in the view
        // Add any defaults for missing keys and adjust the structure for full name
        $formData = array_merge([
            'surname' => $beneficiary->surname,
            'first_name' => $beneficiary->first_name,
            'middle_name' => $beneficiary->middle_name,
            'age' => $beneficiary->age,
            'sex' => $beneficiary->sex,
            'dob' => $beneficiary->dob,
            'place_of_birth' => $beneficiary->place_of_birth,
            'address' => $beneficiary->address,
            'educational_attainment' => $formData['educational_attainment'] ?? '',
            'civil_status' => $formData['civil_status'] ?? '',
            'occupation' => $formData['occupation'] ?? '',
            'religion' => $formData['religion'] ?? '',
            'company_agency' => $formData['company_agency'] ?? '',
            'monthly_income' => $formData['monthly_income'] ?? '',
            'employment_status' => $formData['employment_status'] ?? '',
            'phone_number' => $formData['phone_number'] ?? '',
            'pantawid_beneficiary' => $formData['pantawid_beneficiary'] ?? false,
            'indigenous_person' => $formData['indigenous_person'] ?? false,
            'lgbtq_plus' => $formData['lgbtq_plus'] ?? false,
            'family_composition' => $formData['family_composition'] ?? [],
            'classification_circumstances' => $formData['classification_circumstances'] ?? '',
            'needs_problems' => $formData['needs_problems'] ?? '',
            'emergency_contact' => $formData['emergency_contact'] ?? [
                'name' => '',
                'relationship' => '',
                'address' => '',
            ],
            'emergency_contact_number' => $formData['emergency_contact_number'] ?? '',
            'certificate_date' => $application->created_at->format('Y-m-d'),
        ], $formData);

        // Generate the PDF with the print view template for AIFCS program
        $pdf = PDF::loadView('print-aifcs', [
            'beneficiary' => $beneficiary,
            'application' => $application,
            'formData' => $formData,
        ]);

        // Return the PDF as a stream
        return $pdf->stream('aifcs-application.pdf');
    }



    public function printSeniorCitizen($beneficiaryId)
    {
        // Retrieve the beneficiary and the specific application
        $beneficiary = Beneficiary::findOrFail($beneficiaryId);
        $application = $beneficiary->applications()
            ->where('id', request('application_id', $beneficiary->applications()->latest()->first()->id))
            ->firstOrFail();

        $application->date_released = now();
        $application->save();

        // Decode the JSON form_data
        $formData = json_decode($application->form_data, true) ?? [];

        // Merge form data with defaults if missing
        $formData = array_merge([
            'surname' => $beneficiary->surname,
            'first_name' => $beneficiary->first_name,
            'middle_name' => $beneficiary->middle_name,
            'name_extension' => $beneficiary->name_extension ?? '',
            'sex' => $beneficiary->sex,
            'dob' => $beneficiary->dob,
            'age' => $beneficiary->age,
            'place_of_birth' => $beneficiary->place_of_birth,
            'civil_status' => $beneficiary->civil_status,
            'educational_attainment' => $formData['educational_attainment'] ?? '',
            'occupation' => $formData['occupation'] ?? '',
            'address' => $beneficiary->address,
            'annual_income' => $formData['annual_income'] ?? '',
            'other_skills' => $formData['other_skills'] ?? '',
            'family_composition' => $formData['family_composition'] ?? [],
            'seniorid' => $formData['seniorid'] ?? false,
            'certification' => $formData['certification'] ?? false,
            'certificate_date' => $application->created_at->format('Y-m-d'),
        ], $formData);

        // Generate the PDF with the print view template for Senior Citizen Registration
        $pdf = PDF::loadView('print-senior-citizen', [
            'beneficiary' => $beneficiary,
            'application' => $application,
            'formData' => $formData,
        ]);

        // Return the PDF as a stream
        return $pdf->stream('senior-citizen-application.pdf');
    }


    public function printEducationalAssistance($beneficiaryId)
    {
        // Retrieve the beneficiary and the specific application
        $beneficiary = Beneficiary::findOrFail($beneficiaryId);
        $application = $beneficiary->applications()
            ->where('id', request('application_id', $beneficiary->applications()->latest()->first()->id))
            ->firstOrFail();

        $application->date_released = now();
        $application->save();

        // Decode the JSON form_data
        $formData = json_decode($application->form_data, true) ?? [];

        // Map the form data with expected keys and provide defaults
        $formData = array_merge([
            'surname' => $beneficiary->surname,
            'first_name' => $beneficiary->first_name,
            'middle_name' => $beneficiary->middle_name,
            'name_extension' => $beneficiary->name_extension ?? '',
            'sex' => $beneficiary->sex,
            'dob' => $beneficiary->dob,
            'age' => $beneficiary->age,
            'civil_status' => $beneficiary->civil_status,
            'place_of_birth' => $beneficiary->place_of_birth,
            'address' => $beneficiary->address,
            'referral_slip' => $formData['referral_slip'] ?? false,
            'study_load' => $formData['study_load'] ?? false,
            'student_id' => $formData['student_id'] ?? false,
            'certificate_of_no_scholarship' => $formData['certificate_of_no_scholarship'] ?? false,
            'brgy_cert' => $formData['brgy_cert'] ?? false,
            'cert_ass_off' => $formData['cert_ass_off'] ?? false,
            'certification' => $formData['certification'] ?? false,
            'certificate_date' => $application->created_at->format('Y-m-d'),
        ], $formData);

        // Generate the PDF with the print view template for educational assistance
        $pdf = PDF::loadView('print-educational-assistance', [
            'beneficiary' => $beneficiary,
            'application' => $application,
            'formData' => $formData,
        ]);

        // Return the PDF as a stream
        return $pdf->stream('educational-assistance-application.pdf');
    }
}
