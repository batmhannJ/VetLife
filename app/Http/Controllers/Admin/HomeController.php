<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Prescription;
use App\Models\Medicine;
use App\Models\Test;
use Illuminate\View\View; // Import the View class

class HomeController extends Controller
{
    /**
     * Display the dashboard view.
     *
     * @return View
     */
    public function index(): View
    {

        $settings1 = [
            'chart_title'           => 'Total Patient',
            'chart_type'            => 'number_block',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\\Patient',
            'group_by_field'        => 'dob',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'group_by_field_format' => 'Y-m-d',
            'column_class'          => 'col-md-3',
            'entries_number'        => '5',
        ];

        $settings1['total_number'] = 0;

        if (class_exists($settings1['model'])) {
            $settings1['total_number'] = $settings1['model']::when(isset($settings1['filter_field']), function ($query) use ($settings1) {
                if (isset($settings1['filter_days'])) {
                    return $query->where(
                        $settings1['filter_field'],
                        '>=',
                        now()->subDays($settings1['filter_days'])->format('Y-m-d')
                    );
                } else if (isset($settings1['filter_period'])) {
                    switch ($settings1['filter_period']) {
                        case 'week':
                            $start  = date('Y-m-d', strtotime('last Monday'));
                            break;
                        case 'month':
                            $start = date('Y-m') . '-01';
                            break;
                        case 'year':
                            $start  = date('Y') . '-01-01';
                            break;
                    }

                    if (isset($start)) {
                        return $query->where($settings1['filter_field'], '>=', $start);
                    }
                }
            })
                ->{$settings1['aggregate_function'] ?? 'count'}($settings1['aggregate_field'] ?? '*');
        }
        
        $settings2 = [
            'chart_title'           => 'Total Prescription',
            'chart_type'            => 'number_block',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\\Prescription',
            'group_by_field'        => 'created_at',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'group_by_field_format' => 'Y-m-d H:i:s',
            'column_class'          => 'col-md-3',
            'entries_number'        => '5',
        ];

        $settings2['total_number'] = 0;

        if (class_exists($settings2['model'])) {
            $settings2['total_number'] = $settings2['model']::when(isset($settings2['filter_field']), function ($query) use ($settings2) {
                if (isset($settings2['filter_days'])) {
                    return $query->where(
                        $settings2['filter_field'],
                        '>=',
                        now()->subDays($settings2['filter_days'])->format('Y-m-d')
                    );
                } else if (isset($settings2['filter_period'])) {
                    switch ($settings2['filter_period']) {
                        case 'week':
                            $start  = date('Y-m-d', strtotime('last Monday'));
                            break;
                        case 'month':
                            $start = date('Y-m') . '-01';
                            break;
                        case 'year':
                            $start  = date('Y') . '-01-01';
                            break;
                    }

                    if (isset($start)) {
                        return $query->where($settings2['filter_field'], '>=', $start);
                    }
                }
            })
                ->{$settings2['aggregate_function'] ?? 'count'}($settings2['aggregate_field'] ?? '*');
        }

        $settings3 = [
            'chart_title'           => 'Total Medicine',
            'chart_type'            => 'number_block',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\\Medicine',
            'group_by_field'        => 'created_at',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'group_by_field_format' => 'Y-m-d H:i:s',
            'column_class'          => 'col-md-3',
            'entries_number'        => '5',
        ];

        $settings3['total_number'] = 0;

        if (class_exists($settings3['model'])) {
            $settings3['total_number'] = $settings3['model']::when(isset($settings3['filter_field']), function ($query) use ($settings3) {
                if (isset($settings3['filter_days'])) {
                    return $query->where(
                        $settings3['filter_field'],
                        '>=',
                        now()->subDays($settings3['filter_days'])->format('Y-m-d')
                    );
                } else if (isset($settings3['filter_period'])) {
                    switch ($settings3['filter_period']) {
                        case 'week':
                            $start  = date('Y-m-d', strtotime('last Monday'));
                            break;
                        case 'month':
                            $start = date('Y-m') . '-01';
                            break;
                        case 'year':
                            $start  = date('Y') . '-01-01';
                            break;
                    }

                    if (isset($start)) {
                        return $query->where($settings3['filter_field'], '>=', $start);
                    }
                }
            })
                ->{$settings3['aggregate_function'] ?? 'count'}($settings3['aggregate_field'] ?? '*');
        }

        $settings4 = [
            'chart_title'           => 'Total Payment Received',
            'chart_type'            => 'number_block',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\\Models\\Payment', // Change from 'App\\Test' to 'App\\Payment'
            'group_by_field'        => 'created_at',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'sum', // Change from 'count' to 'sum'
            'aggregate_field'       => 'amount', // Specify the field to sum
            'filter_field'          => 'created_at',
            'group_by_field_format' => 'Y-m-d H:i:s',
            'column_class'          => 'col-md-3',
            'entries_number'        => '5',
        ];
        
        $settings4['total_number'] = 0;
        
        if (class_exists($settings4['model'])) {
            $settings4['total_number'] = $settings4['model']::when(isset($settings4['filter_field']), function ($query) use ($settings4) {
                if (isset($settings4['filter_days'])) {
                    return $query->where(
                        $settings4['filter_field'],
                        '>=',
                        now()->subDays($settings4['filter_days'])->format('Y-m-d')
                    );
                } elseif (isset($settings4['filter_period'])) {
                    switch ($settings4['filter_period']) {
                        case 'week':
                            $start  = date('Y-m-d', strtotime('last Monday'));
                            break;
                        case 'month':
                            $start = date('Y-m') . '-01';
                            break;
                        case 'year':
                            $start  = date('Y') . '-01-01';
                            break;
                    }
        
                    if (isset($start)) {
                        return $query->where($settings4['filter_field'], '>=', $start);
                    }
                }
            })->sum($settings4['aggregate_field']); // Use sum instead of count
        }
        
        $settings5 = $this->getSettings5Data();
        $settings6 = $this->getSettings6Data();
        $settings7 = $this->getSettings7Data();

        // --- Appointment Data ---
        $appointmentData = $this->getAppointmentData();

        // --- Return the view ---
        return view('home', compact(
            'settings1',
            'settings2',
            'settings3',
            'settings4',
            'settings5',
            'settings6',
            'settings7',
            'appointmentData'
        ));
    }

    /**
     * Get the data for the "Total Patient" number block.
     *
     * @return array
     */
    private function getSettings1Data(): array
    {
        $settings = [
            'chart_title' => 'Total Patient',
            'chart_type' => 'number_block',
            'report_type' => 'group_by_date',
            'model' => 'App\\Models\\Patient', // Corrected model path
            'group_by_field' => 'dob',
            'group_by_period' => 'day',
            'aggregate_function' => 'count',
            'filter_field' => 'created_at',
            'group_by_field_format' => 'Y-m-d',
            'column_class' => 'col-md-3',
            'entries_number' => '5',
        ];

        $settings['total_number'] = 0;

        if (class_exists($settings['model'])) {
            $settings['total_number'] = $settings['model']::when(isset($settings['filter_field']), function ($query) use ($settings) {
                if (isset($settings['filter_days'])) {
                    return $query->where(
                        $settings['filter_field'],
                        '>=',
                        now()->subDays($settings['filter_days'])->format('Y-m-d')
                    );
                } elseif (isset($settings['filter_period'])) {
                    $start = $this->getFilterPeriodStart($settings['filter_period']);
                    if (isset($start)) {
                        return $query->where($settings['filter_field'], '>=', $start);
                    }
                }
            })
                ->{$settings['aggregate_function'] ?? 'count'}($settings['aggregate_field'] ?? '*');
        }

        return $settings;
    }

    /**
     * Get the data for the "Total Prescription" number block.
     *
     * @return array
     */
    private function getSettings2Data(): array
    {
        $settings = [
            'chart_title' => 'Total Prescription',
            'chart_type' => 'number_block',
            'report_type' => 'group_by_date',
            'model' => 'App\\Models\\Prescription', // Corrected model path
            'group_by_field' => 'created_at',
            'group_by_period' => 'day',
            'aggregate_function' => 'count',
            'filter_field' => 'created_at',
            'group_by_field_format' => 'Y-m-d H:i:s',
            'column_class' => 'col-md-3',
            'entries_number' => '5',
        ];

        $settings['total_number'] = 0;

        if (class_exists($settings['model'])) {
            $settings['total_number'] = $settings['model']::when(isset($settings['filter_field']), function ($query) use ($settings) {
                if (isset($settings['filter_days'])) {
                    return $query->where(
                        $settings['filter_field'],
                        '>=',
                        now()->subDays($settings['filter_days'])->format('Y-m-d H:i:s')
                    );
                } elseif (isset($settings['filter_period'])) {
                    $start = $this->getFilterPeriodStart($settings['filter_period']);
                    if (isset($start)) {
                        return $query->where($settings['filter_field'], '>=', $start);
                    }
                }
            })
                ->{$settings['aggregate_function'] ?? 'count'}($settings['aggregate_field'] ?? '*');
        }

        return $settings;
    }

    /**
     * Get the data for the "Total Medicine" number block.
     *
     * @return array
     */
    private function getSettings3Data(): array
    {
        $settings = [
            'chart_title' => 'Total Medicine',
            'chart_type' => 'number_block',
            'report_type' => 'group_by_date',
            'model' => 'App\\Models\\Medicine', // Corrected model path
            'group_by_field' => 'created_at',
            'group_by_period' => 'day',
            'aggregate_function' => 'count',
            'filter_field' => 'created_at',
            'group_by_field_format' => 'Y-m-d H:i:s',
            'column_class' => 'col-md-3',
            'entries_number' => '5',
        ];

        $settings['total_number'] = 0;

        if (class_exists($settings['model'])) {
            $settings['total_number'] = $settings['model']::when(isset($settings['filter_field']), function ($query) use ($settings) {
                if (isset($settings['filter_days'])) {
                    return $query->where(
                        $settings['filter_field'],
                        '>=',
                        now()->subDays($settings['filter_days'])->format('Y-m-d H:i:s')
                    );
                } elseif (isset($settings['filter_period'])) {
                    $start = $this->getFilterPeriodStart($settings['filter_period']);
                    if (isset($start)) {
                        return $query->where($settings['filter_field'], '>=', $start);
                    }
                }
            })
                ->{$settings['aggregate_function'] ?? 'count'}($settings['aggregate_field'] ?? '*');
        }

        return $settings;
    }

    /**
     * Get the data for the "Total Test" number block.
     *
     * @return array
     */
    private function getSettings4Data(): array
    {
        $settings = [
            'chart_title' => 'Total Test',
            'chart_type' => 'number_block',
            'report_type' => 'group_by_date',
            'model' => 'App\\Models\\Test', // Corrected model path
            'group_by_field' => 'created_at',
            'group_by_period' => 'day',
            'aggregate_function' => 'count',
            'filter_field' => 'created_at',
            'group_by_field_format' => 'Y-m-d H:i:s',
            'column_class' => 'col-md-3',
            'entries_number' => '5',
        ];

        $settings['total_number'] = 0;

        if (class_exists($settings['model'])) {
            $settings['total_number'] = $settings['model']::when(isset($settings['filter_field']), function ($query) use ($settings) {
                if (isset($settings['filter_days'])) {
                    return $query->where(
                        $settings['filter_field'],
                        '>=',
                        now()->subDays($settings['filter_days'])->format('Y-m-d H:i:s')
                    );
                } elseif (isset($settings['filter_period'])) {
                    $start = $this->getFilterPeriodStart($settings['filter_period']);
                    if (isset($start)) {
                        return $query->where($settings['filter_field'], '>=', $start);
                    }
                }
            })
                ->{$settings['aggregate_function'] ?? 'count'}($settings['aggregate_field'] ?? '*');
        }

        return $settings;
    }

    /**
     * Get the data for the "Patient List" table.
     *
     * @return array
     */
    private function getSettings5Data(): array
    {
        $settings = [
            'chart_title' => 'Patient List',
            'chart_type' => 'latest_entries',
            'report_type' => 'group_by_date',
            'model' => 'App\\Models\\Patient',  // Corrected model path
            'group_by_field' => 'dob',
            'group_by_period' => 'day',
            'aggregate_function' => 'count',
            'filter_field' => 'created_at',
            'group_by_field_format' => 'Y-m-d',
            'column_class' => 'col-md-12',
            'entries_number' => '5',
            'fields' => [
                'first_name',
                'last_name',
                'pin_code',
                'office',
                'job_type',
            ],
        ];

        $settings['data'] = [];

        if (class_exists($settings['model'])) {
            $settings['data'] = $settings['model']::latest()
                ->take($settings['entries_number'])
                ->get();
        }

        if (!array_key_exists('fields', $settings)) {
            $settings['fields'] = [];
        }

        return $settings;
    }

    /**
     * Get the data for the "Medicine List" table.
     *
     * @return array
     */
    private function getSettings6Data(): array
    {
        $settings = [
            'chart_title' => 'Medicine List',
            'chart_type' => 'latest_entries',
            'report_type' => 'group_by_date',
            'model' => 'App\\Models\\Medicine', // Corrected model path
            'group_by_field' => 'created_at',
            'group_by_period' => 'day',
            'aggregate_function' => 'count',
            'filter_field' => 'created_at',
            'group_by_field_format' => 'Y-m-d H:i:s',
            'column_class' => 'col-md-12',
            'entries_number' => '5',
            'fields' => [
                'name',
                'item_code',
                'type',
                'qty_received',
                'date_received',
                'expiry_date',
            ],
        ];

        $settings['data'] = [];

        if (class_exists($settings['model'])) {
            $settings['data'] = $settings['model']::latest()
                ->take($settings['entries_number'])
                ->get();
        }

        if (!array_key_exists('fields', $settings)) {
            $settings['fields'] = [];
        }

        return $settings;
    }

    /**
     * Get the data for the "Total Drugs Received" number block.
     * @return array
     */
    private function getSettings7Data(): array
    {
        $settings = [
            'chart_title' => 'Total Drugs Received',
            'chart_type' => 'number_block',
            'report_type' => 'group_by_date',
            'model' => 'App\\Models\\Medicine', // Corrected model path
            'group_by_field' => 'created_at',
            'group_by_period' => 'day',
            'aggregate_function' => 'sum',
            'aggregate_field' => 'qty_received',
            'filter_field' => 'created_at',
            'group_by_field_format' => 'Y-m-d H:i:s',
            'column_class' => 'col-md-3',
            'entries_number' => '5',
        ];

        $settings['total_number'] = 0;

        if (class_exists($settings['model'])) {
            $settings['total_number'] = $settings['model']::when(isset($settings['filter_field']), function ($query) use ($settings) {
                if (isset($settings['filter_days'])) {
                    return $query->where(
                        $settings['filter_field'],
                        '>=',
                        now()->subDays($settings['filter_days'])->format('Y-m-d H:i:s')
                    );
                } elseif (isset($settings['filter_period'])) {
                    $start = $this->getFilterPeriodStart($settings['filter_period']);
                    if (isset($start)) {
                        return $query->where($settings['filter_field'], '>=', $start);
                    }
                }
            })
                ->{$settings['aggregate_function'] ?? 'count'}($settings['aggregate_field'] ?? '*');
        }

        return $settings;
    }

    /**
     * Get the appointment data for the chart.
     *
     * @return array
     */
    private function getAppointmentData(): array
    {
        $appointmentData = Appointment::select(
            'status',
            DB::raw('count(*) as count')
        )
            ->groupBy('status')
            ->get()
            ->pluck('count', 'status')
            ->toArray();

        $allStatuses = ['Pending', 'Approved', 'Completed', 'Cancelled'];
        foreach ($allStatuses as $status) {
            if (!isset($appointmentData[$status])) {
                $appointmentData[$status] = 0;
            }
        }
        return $appointmentData;
    }

     /**
     * Get the start date for a given filter period.
     *
     * @param string $period The filter period ('week', 'month', 'year').
     * @return string|null The start date in 'Y-m-d' format, or null if invalid period.
     */
    private function getFilterPeriodStart(string $period): ?string
    {
        switch ($period) {
            case 'week':
                return date('Y-m-d', strtotime('last Monday'));
            case 'month':
                return date('Y-m') . '-01';
            case 'year':
                return date('Y') . '-01-01';
            default:
                return null;
        }
    }
}