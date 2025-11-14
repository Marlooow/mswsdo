<?php

namespace App\Services;

class ViewResolverService
{
    public function getViewForProgram($program)
    {
        switch ($program) {
            case 'AIFCS':
                return 'partials.aifcs_partial_view';
            case 'Senior Citizen':
                return 'partials.senior_citizen_partial_view';
            case 'Educational Assistance':
                return 'partials.education_assistance_partial_view';
            case 'Solo Parent':
                return 'partials.solo_parent_partial_view';
            default:
                return 'admins.dashboards';
        }
    }
}
