<?php

namespace App\Services;

use App\Models\Beneficiary;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class BeneficiarySearchService
{
    public function searchBeneficiaries(Request $request, $programId)
    {
        $search = $request->input('search');

        // Query builder for beneficiaries
        $query = Beneficiary::whereHas('socialWorker', function ($query) use ($programId) {
            $query->where('program_id', $programId);
        });

        // Apply search if a search term is provided
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('status', 'LIKE', "%{$search}%")
                    ->orWhereRaw("JSON_EXTRACT(form_data, '$.address') LIKE ?", ["%{$search}%"])
                    ->orWhereRaw("JSON_EXTRACT(form_data, '$.age') LIKE ?", ["%{$search}%"]);
                //pwede pa ta mag additional ug field search query like dire
            });
        }

        // Sort the beneficiaries in descending order by created_at (or any other column)
        $query->orderBy('created_at', 'desc'); 

        // Paginate the results
        $beneficiaries = $query->paginate(5);

        // Check if the current page is greater than the last page
        if ($beneficiaries->currentPage() > $beneficiaries->lastPage()) {
            throw new NotFoundHttpException('Page not found');
        }

        return $beneficiaries;
    }
}
