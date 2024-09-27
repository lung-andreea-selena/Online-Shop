<?php

require_once __DIR__ . '/../models/report.php';
class ReportController
{
    public function showReport()
    {
        // Fetch report data (returns an array of Report objects)
        $report_entries = Report::fetchReportData();

        // Pass the report data to the view
        include __DIR__ . '/../views/report_view.php';
    }
}
