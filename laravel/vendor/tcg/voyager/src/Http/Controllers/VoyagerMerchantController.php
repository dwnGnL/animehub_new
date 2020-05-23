<?php


namespace TCG\Voyager\Http\Controllers;


use App\Category;
use App\Merchant;
use App\MerchantPayment;
use App\Payment;
use App\Product;
use App\Address;
use \Illuminate\Http\Response;
use Illuminate\Http\Request;
use TCG\Voyager\Facades\Voyager;

class VoyagerMerchantController extends Controller
{
    protected function uploadImage($file, $dir)
    {
        $formats = ['png', 'jpg', 'jpeg', 'gif'];
        if (in_array(strtolower($file->getClientOriginalExtension()), $formats)) {
            $time = time();
            $file->move($dir, $time . $file->getClientOriginalName());
            return $dir . '/' . $time . $file->getClientOriginalName();
        }
        return false;
    }

    public function index()
    {
        $merchants = Merchant::with('category')->orderByDesc('created_at')->paginate();
        return Voyager::view('voyager::merchant.merchant-index', [
            'merchants' => $merchants
        ]);
    }

    public function store(Request $request)
    {
        $merchant = Merchant::create([
            'name' => trim($request->post('name')),
            'slug' => str_replace(' ', '-', strtolower(trim($request->post('slug')))),
            'image' => ($request->hasFile('image')) ? $this->uploadImage($request->file('image'), 'storage/merchants') : '',
            'term' => trim($request->post('term')),
            'category_id' => $request->post('cat')
        ]);
        if ($merchant) {
            $this->createAddress($merchant->id, $request);
            $this->createPayments($merchant->id, $request);
            return redirect(route('voyager.merchant.index'));
        }
    }

    public function create()
    {
        $payments = Payment::all();
        $categories = Category::all();
        return view('voyager::merchant.merchant-create', [
            'payments' => $payments,
            'categories' => $categories
        ]);
    }

    public function destroy($id)
    {
        $merchant = Merchant::find($id);
        if (Merchant::destroy($id)) {
            unlink(public_path($merchant->image));
            Response()->json([
                'status' => 200
            ]);
        }
    }

    public function edit($id)
    {
        $merchant = Merchant::find($id);
        $categories = Category::all();
        $payments = Payment::all();
        return view('voyager::merchant.merchant-edit', [
            'merchant' => $merchant,
            'categories' => $categories,
            'payments' => $payments
        ]);
    }

    public function update(Request $request, $id)
    {
        if ($request->hasFile('image')) {
            $oldData = Merchant::find($id);
            $merchant = Merchant::where('id', $id)
                ->update([
                    'name' => trim($request->post('name')),
                    'slug' => str_replace(' ', '-', strtolower(trim($request->post('slug')))),
                    'image' => $this->uploadImage($request->file('image'), 'storage/merchants'),
                    'category_id' => $request->post('cat'),
                    'term' => trim($request->post('term')),
                ], $id);
            unlink(public_path($oldData->image));
        } else {
            $merchant = $merchant = Merchant::where('id', $id)
                ->update([
                    'name' => trim($request->post('name')),
                    'slug' => str_replace(' ', '-', strtolower(trim($request->post('slug')))),
                    'category_id' => $request->post('cat'),
                    'term' => trim($request->post('term')),
                ]);
        }
        if ($merchant) {
            MerchantPayment::where('merchant_id', $id)->delete();
            $this->createPayments($id, $request);
            Address::where('merchant_id', $id)->delete();
            $this->createAddress($id, $request);
            return redirect(route('voyager.merchant.index'));
        }

    }

    private function createPayments($merchant_id, $request)
    {
        $payments = explode(',', $request->post('payments'));
        foreach ($payments as $payment) {
            $pay = Payment::where('name', $payment)->first();
            MerchantPayment::create([
                'merchant_id' => $merchant_id,
                'payment_id' => $pay->id
            ]);
        }
    }

    private function createAddress($merchant_id, $request)
    {
        for ($i = 1; $i < 100; $i++) {
            if (!empty($request->post('address' . $i)) && !empty($request->post('time_work' . $i)) && !empty($request->post('coor' . $i))) {
                $address = \App\Address::create([
                    'merchant_id' => $merchant_id,
                    'address' => $request->post('address' . $i),
                    'work_time' => $request->post('time_work' . $i),
                    'coordinates' => $request->post('coor' . $i)
                ]);
            } else {
                break;
            }
        }
    }

}
