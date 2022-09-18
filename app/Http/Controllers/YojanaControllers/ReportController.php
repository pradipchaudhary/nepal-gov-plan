<?php

namespace App\Http\Controllers\YojanaControllers;

use App\Helpers\YojanaHelper;
use App\Http\Controllers\Controller;
use App\Models\SharedModel\FiscalYear;
use App\Models\YojanaModel\consumer;
use App\Models\YojanaModel\plan;
use App\Models\YojanaModel\setting\amanat;
use App\Models\YojanaModel\setting\institutional_committee;
use App\Models\YojanaModel\setting\tole_bikas_samiti;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ReportController extends Controller
{
    public function numericReport(): View
    {
        return view('yojana.report.numeric-report');
    }

    public function generateNumericReport()
    {
        $html = '';

        // total yojana query
        $total_yojana_count = plan::query()
            ->where('type_id', request('type_id'))
            ->when(request('ward_no') != '', function ($q) {
                $q->where('ward_no', request('ward_no'));
            })
            ->whereDoesntHave('Parents')
            ->count();

        $total_yojana_sum = plan::query()
            ->where('type_id', request('type_id'))
            ->when(request('ward_no') != '', function ($q) {
                $q->where('ward_no', request('ward_no'));
            })
            ->whereDoesntHave('Parents')
            ->sum('grant_amount');

        // total yojana without any bibaran filled query
        $total_reg_count_wo_bibaran = plan::query()
            ->where('type_id', request('type_id'))
            ->whereDoesntHave('Parents')
            ->when(request('ward_no') != '', function ($q) {
                $q->where('ward_no', request('ward_no'));
            })
            ->whereDoesntHave('planOperate')
            ->count();

        $total_reg_count_wo_bibaran_sum = plan::query()
            ->where('type_id', request('type_id'))
            ->whereDoesntHave('Parents')
            ->when(request('ward_no') != '', function ($q) {
                $q->where('ward_no', request('ward_no'));
            })
            ->whereDoesntHave('planOperate')
            ->sum('grant_amount');

        // total yojana/program count where bibaran is filled
        $total_reg_count_w_bibaran_count = plan::query()
            ->where('type_id', request('type_id'))
            ->whereDoesntHave('Parents')
            ->when(request('ward_no') != '', function ($q) {
                $q->where('ward_no', request('ward_no'));
            })
            ->whereHas('planOperate')
            ->count();

        $total_reg_count_w_bibaran_sum = plan::query()
            ->where('type_id', request('type_id'))
            ->whereDoesntHave('Parents')
            ->when(request('ward_no') != '', function ($q) {
                $q->where('ward_no', request('ward_no'));
            })
            ->whereHas('planOperate')
            ->sum('grant_amount');

        $html = '<tr>
                    <td class="text-center">कुल ' . config('YOJANA.TYPE.' . request('type_id')) . '</td>
                    <td class="text-center">' . NepaliAmount($total_yojana_count) . '</td>
                    <td class="text-center">' . NepaliAmount($total_yojana_sum) . '</td>
                    <td class="text-center"></td>
                    <td class="text-center"></td>
                    <td class="text-center"><a class="btn btn-sn btn-primary">पुरा बिबरण हेर्नुहोस्</a></td>
                    </tr>
                    <tr>
                        <td class="text-center">दर्ता भएको तर कुनै विवरण नभरिएको</td>
                        <td class="text-center">' . NepaliAmount($total_reg_count_wo_bibaran) . '</td>
                        <td class="text-center">' . NepaliAmount($total_reg_count_wo_bibaran_sum) . '</td>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                        <td class="text-center"><a class="btn btn-sn btn-primary">पुरा बिबरण हेर्नुहोस्</a></td>
                    </tr>
                    <tr>
                        <td class="text-center">दर्ता भई सम्झौता भएका ' . config('YOJANA.TYPE.' . request('type_id')) . '</td>
                        <td class="text-center">' . Nepali($total_reg_count_w_bibaran_count ?? '--') . '</td>
                        <td class="text-center">' . NepaliAmount($total_reg_count_w_bibaran_sum ?? '--') . '</td>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                        <td class="text-center"><a class="btn btn-sn btn-primary">पुरा बिबरण हेर्नुहोस्</a></td>
                    </tr>
                    <tr>
                        <td class="text-center">मुल्यांकनको आधारमा भुक्तानी लागेको ' . config('YOJANA.TYPE.' . request('type_id')) . ' संख्या</td>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                    </tr>
                    <tr>
                        <td class="text-center">पेश्की भुक्तानी लागेको ' . config('YOJANA.TYPE.' . request('type_id')) . ' संख्या</td>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                    </tr>
                    <tr>
                        <td class="text-center">अन्तिम भुक्तानी लागेको आथवा सम्पन्न भएका ' . config('YOJANA.TYPE.' . request('type_id')) . ' संख्या</td>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                    </tr>';
        return response()->json($html);
    }


    public function malepaReport()
    {
        $fiscal_year_id = getCurrentFiscalYear(true)->id;

        return view(
            'yojana.report.malepa_report',
            [
                'reports' => plan::query()
                    ->where('type_id', config('YOJANA.PLAN'))
                    ->whereNull('plan_id')
                    ->whereRelation('kulLagat', function ($query) {
                        $query->where('type_id', config('TYPE.UPABHOKTA_SAMITI'));
                    })
                    ->whereHas('finalPayment')
                    ->with('kulLagat', 'finalPayment', 'Consumer')
                    ->where('fiscal_year_id', $fiscal_year_id)
                    ->paginate(25)
            ]
        );
    }

    public function committeeDashboard()
    {
        return view('yojana.report.committee_dashboard');
    }

    public function committeReport($slug, YojanaHelper $helper)
    {
        abort_if(!in_array($slug, config('TYPE.SLUG')), 404);
        if ($slug == config('TYPE.SLUG.3')) {
            Alert::error(config('YojanaMessage.CLIENT_ERROR'));
        }

        return view('yojana.report.committee_report', [
            'type' => $slug,
            'types' => $helper->getTypeAndChildren($slug)
        ]);
    }
}
