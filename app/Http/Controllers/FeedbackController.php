<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Feedback;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\FeedbackCreateRequest;
use App\Http\Requests\FeedbackUpdateRequest;

class FeedbackController extends Controller
{


    public function index()
    {
        $feedback = Feedback::paginate(10);

        return view('pages.customer.feedback.feedback', ['type_menu' => '', 'feedbacks' => $feedback]);
    }

    public function create($feedback)
    {
        $feedback = Feedback::where('code', $feedback)->firstOrFail();
        if ($feedback->expired == 1) {
            echo "<script>";
            echo "alert('Feedback telah expired');";
            echo "document.location.href='/'";
            echo "</script>";
        }
        return view('pages.form-pertanyaan', ['type_menu' => '', 'feedback' => $feedback]);
    }

    public function store($feedback, FeedbackUpdateRequest $request)
    {
        $feedback = Feedback::where('code', $feedback)->firstOrFail();
        $params = $request->safe([
            'inp_jawaban1', 'inp_jawaban2', 'inp_jawaban3', 'inp_jawaban4', 'inp_jawaban5'
        ]);

        try {
            DB::transaction(function () use ($params, $feedback) {
                $feedback->update([
                    'jawaban1' => $params['inp_jawaban1'],
                    'jawaban2' => $params['inp_jawaban2'],
                    'jawaban3' => $params['inp_jawaban3'],
                    'jawaban4' => $params['inp_jawaban4'],
                    'jawaban5' => $params['inp_jawaban5'],
                    'expired' => 1
                ]);
            });
            return redirect()->route('login')
                ->with('success', "Data feedback berhasil ditambah");
        } catch (\Throwable $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function show(Feedback $feedback)
    {
        return view('pages.customer.feedback.detail-feedback', [
            'type_menu' => '',
            'feedback' => $feedback
        ]);
    }

    public function update(FeedbackUpdateRequest $request, Feedback $feedback)
    {
        $params = $request->safe([
            'customer_name', 'nohp_customer', 'description'
        ]);

        try {
            DB::transaction(function () use ($params, $request, $feedback) {
                $feedback->update([
                    'customer_name' => $params['customer_name'],
                    'nohp_customer' => $params['nohp_customer'],
                    'description' => $params['description'],
                ]);
            });
            return redirect()->route('admin.feedback.index')
                ->with('success', "Data feedback berhasil diubah");
        } catch (\Throwable $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy(Feedback $feedback)
    {
        try {
            $feedback->delete();
            return redirect()->back()
                ->with('success', "Data feedback berhasil dihapus");
        } catch (\Throwable $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    // public function checkCustomer($no_hp = null)
    // {
    //     $customer = Customer::where('no_hp_customer', $no_hp)->first();
    //     return $customer;
    // }
}
