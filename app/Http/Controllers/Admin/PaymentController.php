<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
    public function index()
{
    $payments = Payment::orderBy('id', 'DESC')->paginate(15);
    return view('admin.payments.index', compact('payments'));
}


    public function create()
    {
        return view('admin.payments.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('payments', 'public');
            $validated['logo'] = $path;
        }

        Payment::create($validated);

        return redirect()->route('backend.payments.index')->with('success', 'Payment created successfully');
    }

    public function edit(string $id)
    {
        $payment = Payment::findOrFail($id);
        return view('admin.payments.edit', compact('payment'));
    }

    public function update(Request $request, string $id)
    {
        $payment = Payment::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        

        if ($request->hasFile('logo')) {
            if ($payment->logo) {
                Storage::delete('public/' . $payment->logo);
            }

            $path = $request->file('logo')->store('payments', 'public');
            $payment->logo = $path;
        }

        $payment->name = $validated['name'];
        $payment->save();

        return redirect()->route('backend.payments.index')->with('success', 'Payment updated successfully');
    }

    public function destroy(string $id)
    {
        $payment = Payment::findOrFail($id);

        if ($payment->logo) {
            Storage::delete('public/' . $payment->logo);
        }

        $payment->delete();

        return redirect()->route('backend.payments.index')->with('success', 'Payment deleted successfully');
    }
}
