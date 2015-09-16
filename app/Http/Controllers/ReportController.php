<?php namespace App\Http\Controllers;

use App\Services\ReportService;

class ReportController extends Controller
{
    /**
     * Get simple statistics for reports home page
     */
    public function index()
    {
        $this->data->report = ReportService::basicReport(\Auth::id());

        return $this->view('dashboard.reports');
    }
}
