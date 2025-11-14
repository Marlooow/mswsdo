<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assistance for Families in Crisis Situation</title>
</head>

<body>
    <div class="container">
        @if (session("error"))
        <div class="alert alert-danger">
            {{ session("error") }}
        </div>
        @endif

        @if (session("success"))
        <div class="alert alert-success">
            {{ session("success") }}
        </div>
        @endif
        <div class="row justify-content-center no-print remove-display-print">
            <div class="col-md-12">
                <div class="status-banner status-{{ strtolower($beneficiary->status) }}">
                    STATUS:
                    @if ($beneficiary->status == "approved")
                    <span>APPROVED</span>
                    @elseif($beneficiary->status == "pending")
                    <span>PENDING</span>
                    @elseif($beneficiary->status == "new")
                    <span>NEW</span>
                    @elseif($beneficiary->status == "renew")
                    <span>RENEW</span>
                    @else
                    <span>DISAPPROVED</span>
                    @endif
                </div>
                <input type="hidden" name="program_id" value="1">
                <input type="hidden" name="form_data[sex]" value="N/A">
                <input type="hidden" name="form_data[civil_status]" value="N/A">
                <input type="hidden" name="form_data[certification]" value="1">
                <input type="hidden" name="form_data[educational_attainment]" value="N/A">
                <input type="hidden" name="form_data[occupation]" value="N/A">
                <div class="d-flex align-items-center">
                    <!-- Logo Section -->
                    <div class="col-auto">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" width="117px" height="auto"
                            class="ml-2 mr-200" class="img-fluid">
                    </div>
                    <!-- Header Section -->
                    <div class="header text-center flex-grow-1 ml-1 mr-0">
                        <p class="text-center fs-5 fst-italic mb-1">Republic of the Philippines</p>
                        <p class="text-center fs-5 mb-1">PROVINCE OF BUKIDNON</p>
                        <p class="text-center fs-5 fw-bold mb-5">MUNICIPALITY OF MANOLO FORTICH</p>
                        <h4 class="letter-spacing text-center fw-bold">CERTIFICATE OF ELIGIBILITY</h4>
                    </div>
                </div>



                <p class="text-end my-5 fw-bold" style="text-align: center;">Date: <input value="{{ $formData['certificate_date'] ?? ''}}" type="date" name="form_data[certificate_date]" class="border-0 border-bottom border-2 border-black date-input mx-2" disabled /></p>

                <p class="mb-0">This is to certify that
                    <input type="text" style="text-align: center;" value="{{ $formData["surname"] ?? "" }}"
                        name="form_data[surname]"
                        class="border-0 border-bottom border-2 border-black fill-input-width straight-fill" disabled />,
                    <input type="text" style="text-align: center;" value="{{ $formData["first_name"] ?? "" }}"
                        name="form_data[surname]"
                        class="border-0 border-bottom border-2 border-black fill-input-width straight-fill" disabled />
                    <input type="text" style="text-align: center;" value="{{ $formData["middle_name"] ?? "" }}"
                        name="form_data[surname]"
                        class="border-0 border-bottom border-2 border-black fill-input-width straight-fill" disabled />,
                    <input type="number" style="text-align: center;" value="{{ $formData["age"] ?? "" }}"
                        name="form_data[age]"
                        class="border-0 border-bottom border-2 border-black fill-age-width straight-fill" disabled />
                    year/s old and presently residing at
                </p>

                <p class="mb-0">
                    <input type="text" style="text-align: center;" value="{{ $formData["address"] ?? "" }}"
                        name="form_data[address]"
                        class="border-0 border-bottom border-2 border-black fill-address-width straight-fill"
                        disabled />,
                    has been found eligible for <span class="text-decoration-underline fw-semibold">Financial
                        Assistance</span> for
                </p>
                <p class="mb-0">
                    <span style="white-space: nowrap;">
                        <input type="text" style="text-align: center; width: 150px;"
                            value="{{ $formData['assistance_type'] ?? '' }}"
                            name="form_data[assistance_type]"
                            class="border-0 border-bottom border-2 border-black straight-fill" disabled />
                        after a thorough assessment has been conducted.
                    </span>
                </p>

                <p class="mb-0">Records of the case such as the following are confidentially filed at the Municipal
                    Social Welfare and Development Office.</p>

                <div class="row px-5 mt-4">
                    <div class="form-check col-6">
                        <input class="form-check-input" style="text-align: center;" type="checkbox"
                            name="form_data[brgy_certification]" id="brgycertcheckbox"
                            {{ isset($formData["brgy_certification"]) && $formData["brgy_certification"] ? "checked" : "" }}
                            disabled>
                        <label class="form-check-label" for="brgycertcheckbox">
                            BRGY. CERTIFICATION OF INDIGENCE
                        </label>
                    </div>
                    <div class="form-check col-6 mb-3">
                        <input class="form-check-input" style="text-align: center;" type="checkbox"
                            name="form_data[death_certificate]" id="deathcertcheckbox"
                            {{ isset($formData["death_certificate"]) && $formData["death_certificate"] ? "checked" : "" }}
                            disabled>
                        <label class="form-check-label" for="deathcertcheckbox">
                            DEATH CERTIFICATE
                        </label>
                    </div>
                    <div class="form-check col-6">
                        <input class="form-check-input" style="text-align: center;" type="checkbox"
                            name="form_data[valid_id_presented]" value="1" id="valididcheckbox"
                            {{ isset($formData["valid_id_presented"]) && $formData["valid_id_presented"] ? "checked" : "" }}
                            disabled>
                        <label class="form-check-label" for="valididcheckbox">
                            VALID ID PRESENTED
                        </label>
                    </div>
                </div>
                <p class="my-4">OTHERS:</p>
                <div class="row px-5 mt-4">
                    <div class="form-check col-6">
                        <input class="form-check-input" type="checkbox" name="form_data[medical_certificate]"
                            value="1" id="medcertcheckbox"
                            {{ isset($formData["medical_certificate"]) && $formData["medical_certificate"] ? "checked" : "" }}
                            disabled>
                        <label class="form-check-label" for="medcertcheckbox">
                            MEDICAL CERTIFICATE/ABSTRACT
                        </label>
                    </div>
                    <div class="form-check col-6 mb-3">
                        <input class="form-check-input" type="checkbox" name="form_data[lab_request]" value="1"
                            id="labreqcheckbox"
                            {{ isset($formData["lab_request"]) && $formData["lab_request"] ? "checked" : "" }}
                            disabled>
                        <label class="form-check-label" for="labreqcheckbox">
                            LAB REQUEST
                        </label>
                    </div>
                    <div class="form-check col-6">
                        <input class="form-check-input" type="checkbox" name="form_data[quotation]" value="1"
                            id="quotcheckbox"
                            {{ isset($formData["quotation"]) && $formData["quotation"] ? "checked" : "" }} disabled>
                        <label class="form-check-label" for="quotcheckbox">
                            QUOTATION
                        </label>
                    </div>
                    <div class="form-check col-6 mb-3">
                        <input class="form-check-input" type="checkbox" name="form_data[charge_slip]" value="1"
                            id="chargeslipcheckbox"
                            {{ isset($formData["charge_slip"]) && $formData["charge_slip"] ? "checked" : "" }}
                            disabled>
                        <label class="form-check-label" for="chargeslipcheckbox">
                            CHARGE SLIP
                        </label>
                    </div>
                    <div class="form-check col-6">
                        <input class="form-check-input" type="checkbox" name="form_data[medical_prescription]"
                            value="1" id="medprescheckbox"
                            {{ isset($formData["medical_prescription"]) && $formData["medical_prescription"] ? "checked" : "" }}
                            disabled>
                        <label class="form-check-label" for="medprescheckbox">
                            MEDICAL PRESCRIPTION
                        </label>
                    </div>
                    <div class="form-check col-6 mb-3">
                        <input class="form-check-input" type="checkbox" name="form_data[statement_of_account]"
                            value="1" id="soacheckbox"
                            {{ isset($formData["statement_of_account"]) && $formData["statement_of_account"] ? "checked" : "" }}
                            disabled>
                        <label class="form-check-label" for="soacheckbox">
                            STATEMENT OF ACCOUNT/HOSPITAL BILL
                        </label>
                    </div>
                    <div class="form-check col-6">
                        <input class="form-check-input" type="checkbox" name="form_data[discharge_summary]"
                            value="1" id="dissumcheckbox"
                            {{ isset($formData["discharge_summary"]) && $formData["discharge_summary"] ? "checked" : "" }}
                            disabled>
                        <label class="form-check-label" for="dissumcheckbox">
                            DISCHARGE SUMMARY
                        </label>
                    </div>
                    <div class="form-check col-6 mb-3">
                        <input class="form-check-input" type="checkbox" name="form_data[vaccination]" value="1"
                            id="vacccheckbox"
                            {{ isset($formData["vaccination"]) && $formData["vaccination"] ? "checked" : "" }}
                            disabled>
                        <label class="form-check-label" for="vacccheckbox">
                            VACCINATION
                        </label>
                    </div>
                    <div class="form-check col-6">
                        {{-- // empty. only for design --}}
                    </div>
                    <div class="form-check col-6 mb-3">
                        <input class="form-check-input" type="checkbox" name="form_data[treatment_protocol]"
                            value="1" id="treatproccheckbox"
                            {{ isset($formData["treatment_protocol"]) && $formData["treatment_protocol"] ? "checked" : "" }}
                            disabled>
                        <label class="form-check-label" for="treatproccheckbox">
                            TREATMENT PROTOCOL
                        </label>
                    </div>
                </div>


                <p class="MB-0">The client is hereby recommended to receive financial assistance for <input
                        type="text" style="text-align: center;"
                        value="{{ $formData["financial_assistance"] ?? "" }}" name="form_data[financial_assistance]"
                        class="border-0 border-bottom border-2 border-black fill-assis-width straight-fill" disabled />
                    in the amount of Php. <input type="text" style="text-align: center;"
                        value="{{ $formData["assistance_amount"] ?? "" }}" name="form_data[assistance_amount]"
                        id="amount"
                        class="border-0 border-bottom border-2 border-black fill-amount-width straight-fill"
                        disabled />
                </p>

                <!-- Conforme section -->
                <div class="row mt-5 text-center">
                    <div class="col-6">
                        <p class="mb-6">CONFORME:</p>
                        <input
                            style="width: 100%; text-align:center; text-transform: uppercase; background-color: transparent; border: 0; border-bottom: 2px solid black;"
                            value="{{ ($formData["first_name"] ?? "") . " " . ($formData["middle_name"] ?? "") . " " . ($formData["surname"] ?? "") }}"
                            disabled>
                        <p>SIGNATURE ABOVE PRINTED NAME OF CLIENT</p>
                    </div>
                    <div class="col-6">
                        <p>APPROVED BY:</p>
                        <input type="text" name="form_data[approved_by]" class="border-0 border-bottom border-2 border-black fill-input-width straight-fill text-center" value="{{ $approverName }}" name="form_data[approved_by]" readonly />
                        <p class="mb-0">MSWDO</p>
                    </div>
                </div>
            </div>
        </div>
        @if(auth()->user()->role_id == 4 || $isAdmin)
        <div class="row justify-content-center printable-area remove-display-print-view neg-mt-aics">
            <div class="col-md-12">
                <div class="d-flex align-items-center">
                    <!-- Logo Section -->
                    <div class="col-auto">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" width="117px" height="auto"
                            class="ml-2 mr-200" class="img-fluid">
                    </div>
                    <!-- Header Section -->
                    <div class="header text-center flex-grow-1 ml-1 mr-0">
                        <p class="text-center fs-5 fst-italic mb-1">Republic of the Philippines</p>
                        <p class="text-center fs-5 mb-1">PROVINCE OF BUKIDNON</p>
                        <p class="text-center fs-5 fw-bold mb-5">MUNICIPALITY OF MANOLO FORTICH</p>
                        <h4 class="letter-spacing text-center fw-bold">CERTIFICATE OF ELIGIBILITY</h4>
                    </div>
                </div>
                <p class="text-end my-5 fw-bold" style="text-align: center;">Date: <input value="{{ $formData['certificate_date'] ?? ''}}" type="date" name="form_data[certificate_date]" class="border-0 border-bottom border-2 border-black date-input mx-2" disabled /></p>

                <p class="mb-0">This is to certify that
                    <input type="text" style="text-align: center;" value="{{ $formData['surname'] ?? ''}}" name="form_data[surname]" class="border-0 border-bottom border-2 border-black fill-input-width-print straight-fill" disabled />,
                    <input type="text" style="text-align: center;" value="{{ $formData['first_name'] ?? ''}}" name="form_data[surname]" class="border-0 border-bottom border-2 border-black fill-input-width-print straight-fill" disabled />
                    <input type="text" style="text-align: center;" value="{{ $formData['middle_name'] ?? ''}}" name="form_data[surname]" class="border-0 border-bottom border-2 border-black fill-input-width-print straight-fill" disabled />,
                    <input type="number" style="text-align: center;" value="{{ $formData['age'] ?? ''}}" name="form_data[age]" class="border-0 border-bottom border-2 border-black fill-age-width straight-fill" disabled /> year/s old and presently residing at 
                    <input type="text" style="text-align: center;" value="{{ $formData['address'] ?? ''}}" name="form_data[address]" class="border-0 border-bottom border-2 border-black fill-address-width-print straight-fill" disabled />,
                    has been found eligible for <span class="text-decoration-underline fw-semibold">Financial Assistance</span> for <input type="text" style="text-align: center;" value="{{ $formData['assistance_type'] ?? ''}}" name="form_data[assistance_type]" class="border-0 border-bottom border-2 border-black fill-input-width-print straight-fill" disabled />
                    after a thorough assessment has been conducted.
                </p>

                <p class="mb-0">
                    <p></p>
                </p>
                <p class="mb-0 mt-1">Records of the case such as the following are confidentially filed at the Municipal Social Welfare and Development Office.</p>

                <div class="row px-5 mt-4">
                    <div class="form-check col-6">
                        <input class="form-check-input" style="text-align: center;" type="checkbox" name="form_data[brgy_certification]"
                            id="brgycertcheckbox"
                            {{ isset($formData['brgy_certification']) && $formData['brgy_certification'] ? 'checked' : '' }} disabled>
                        <label class="form-check-label fs-6-force" for="brgycertcheckbox">
                            BRGY. CERTIFICATION OF INDIGENCE
                        </label>
                    </div>
                    <div class="form-check col-6 mb-1">
                        <input class="form-check-input" style="text-align: center;" type="checkbox" name="form_data[death_certificate]"
                            id="deathcertcheckbox"
                            {{ isset($formData['death_certificate']) && $formData['death_certificate'] ? 'checked' : '' }} disabled>
                        <label class="form-check-label fs-6-force" for="deathcertcheckbox">
                            DEATH CERTIFICATE
                        </label>
                    </div>
                    <div class="form-check col-6">
                        <input class="form-check-input" style="text-align: center;" type="checkbox" name="form_data[valid_id_presented]" value="1" id="valididcheckbox"
                            {{ isset($formData['valid_id_presented']) && $formData['valid_id_presented'] ? 'checked' : '' }} disabled>
                        <label class="form-check-label fs-6-force" for="valididcheckbox">
                            VALID ID PRESENTED
                        </label>
                    </div>
                </div>
                <p class="my-2">OTHERS:</p>
                <div class="row px-5 mt-4">
                    <div class="form-check col-6">
                        <input class="form-check-input" type="checkbox" name="form_data[medical_certificate]" value="1" id="medcertcheckbox"
                            {{ isset($formData['medical_certificate']) && $formData['medical_certificate'] ? 'checked' : '' }} disabled>
                        <label class="form-check-label fs-6-force" for="medcertcheckbox">
                            MEDICAL CERTIFICATE/ABSTRACT
                        </label>
                    </div>
                    <div class="form-check col-6 mb-1">
                        <input class="form-check-input" type="checkbox" name="form_data[lab_request]" value="1" id="labreqcheckbox"
                            {{ isset($formData['lab_request']) && $formData['lab_request'] ? 'checked' : '' }} disabled>
                        <label class="form-check-label fs-6-force" for="labreqcheckbox">
                            LAB REQUEST
                        </label>
                    </div>
                    <div class="form-check col-6">
                        <input class="form-check-input" type="checkbox" name="form_data[quotation]" value="1" id="quotcheckbox"
                            {{ isset($formData['quotation']) && $formData['quotation'] ? 'checked' : '' }} disabled>
                        <label class="form-check-label fs-6-force" for="quotcheckbox">
                            QUOTATION
                        </label>
                    </div>
                    <div class="form-check col-6 mb-1">
                        <input class="form-check-input" type="checkbox" name="form_data[charge_slip]" value="1" id="chargeslipcheckbox"
                            {{ isset($formData['charge_slip']) && $formData['charge_slip'] ? 'checked' : '' }} disabled>
                        <label class="form-check-label fs-6-force" for="chargeslipcheckbox">
                            CHARGE SLIP
                        </label>
                    </div>
                    <div class="form-check col-6">
                        <input class="form-check-input" type="checkbox" name="form_data[medical_prescription]" value="1" id="medprescheckbox"
                            {{ isset($formData['medical_prescription']) && $formData['medical_prescription'] ? 'checked' : '' }} disabled>
                        <label class="form-check-label fs-6-force" for="medprescheckbox">
                            MEDICAL PRESCRIPTION
                        </label>
                    </div>
                    <div class="form-check col-6 mb-1">
                        <input class="form-check-input" type="checkbox" name="form_data[statement_of_account]" value="1" id="soacheckbox"
                            {{ isset($formData['statement_of_account']) && $formData['statement_of_account'] ? 'checked' : '' }} disabled>
                        <label class="form-check-label fs-6-force" for="soacheckbox">
                            STATEMENT OF ACCOUNT/HOSPITAL BILL
                        </label>
                    </div>
                    <div class="form-check col-6">
                        <input class="form-check-input" type="checkbox" name="form_data[discharge_summary]" value="1" id="dissumcheckbox"
                            {{ isset($formData['discharge_summary']) && $formData['discharge_summary'] ? 'checked' : '' }} disabled>
                        <label class="form-check-label fs-6-force" for="dissumcheckbox">
                            DISCHARGE SUMMARY
                        </label>
                    </div>
                    <div class="form-check col-6 mb-1">
                        <input class="form-check-input" type="checkbox" name="form_data[vaccination]" value="1" id="vacccheckbox"
                            {{ isset($formData['vaccination']) && $formData['vaccination'] ? 'checked' : '' }} disabled>
                        <label class="form-check-label fs-6-force" for="vacccheckbox">
                            VACCINATION
                        </label>
                    </div>
                    <div class="form-check col-6">
                        {{-- // empty. only for design --}}
                    </div>
                    <div class="form-check col-6 mb-1">
                        <input class="form-check-input" type="checkbox" name="form_data[treatment_protocol]" value="1" id="treatproccheckbox"
                            {{ isset($formData['treatment_protocol']) && $formData['treatment_protocol'] ? 'checked' : '' }} disabled>
                        <label class="form-check-label fs-6-force" for="treatproccheckbox">
                            TREATMENT PROTOCOL
                        </label>
                    </div>
                </div>


                <p class="MB-0">The client is hereby recommended to receive financial assistance for <input type="text" style="text-align: center;" value="{{ $formData['financial_assistance'] ?? ''}}" name="form_data[financial_assistance]" class="border-0 border-bottom border-2 border-black fill-assis-width straight-fill" disabled />
                    in the amount of Php. <input type="text" style="text-align: center;" value="{{ $formData['assistance_amount'] ?? ''}}" name="form_data[assistance_amount]" id="amount" class="border-0 border-bottom border-2 border-black fill-amount-width straight-fill" disabled />
                </p>

                <!-- Conforme section -->
                <div class="row mt-5 text-center">
                    <div class="col-6">
                        <p class="mb-6">CONFORME:</p>
                        <input
                            style="width: 100%; text-align:center; text-transform: uppercase; background-color: transparent; border: 0; border-bottom: 2px solid black;"
                            value="{{ ($formData['first_name'] ?? '') . ' ' . ($formData['middle_name'] ?? '') . ' ' . ($formData['surname'] ?? '') }}"
                            disabled>
                        <p>SIGNATURE ABOVE PRINTED NAME OF CLIENT</p>
                    </div>
                    <div class="col-6">
                        <p>APPROVED BY:</p>
                        <input type="text" name="form_data[approved_by]" class="border-0 border-bottom border-2 border-black fill-input-width straight-fill text-center" value="{{ $approverName }}" name="form_data[approved_by]" readonly />
                        <p class="mb-0">MSWDO</p>

                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</body>
<style>
    .custom-width {
        width: 57em;
    }


    .letter-spacing {
        letter-spacing: 10px;
    }

    .date-input {
        width: 120px;
    }

    .fill-address-width {
        width: 480px;
    }

    .fill-address-width-print {
        width: 280px;
    }

    .fill-input-width {
        width: 350px;
    }

    .fill-input-width-print {
        width: 150px;
    }

    .fill-assis-width {
        width: 230px;
    }

    .fill-age-width {
        width: 60px;
    }

    .fill-amount-width {
        width: 150px;
    }

    .straight-fill:focus {
        border: none;
        outline: none;
    }

    .status-banner {
        padding: 10px;
        border-radius: 5px;
        border-bottom-left-radius: 0px;
        border-bottom-right-radius: 0px;
        color: white;
        text-align: center;
        font-weight: bold;
    }

    .status-new {
        background-color: lightblue;
    }

    .status-pending {
        background-color: #ffc107;
    }

    .status-renew {
        background-color: orange;
    }

    .status-approved {
        background-color: green;
    }

    .status-disapproved {
        background-color: red;
    }

    .bg-info {
        padding: 5px;
    }

    .neg-mt-aics {
        margin-top: -80px !important;
    }

    .fs-6-force {
        font-size: 14px !important;
    }
</style>
<html>