<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use Paypal;
use App\Properties;
use App\Plan;
use App\Payment;
use Auth;

class PaypalController extends MainAdminController
{

    private $_apiContext;

    public function __construct()
    {
        $this->middleware('auth');
        $this->_apiContext = PayPal::ApiContext(
            config('services.paypal.client_id'),
            config('services.paypal.secret'));

        $this->_apiContext->setConfig(array(
            'mode' => 'sandbox',
            'service.EndPoint' => 'https://api.sandbox.paypal.com',
            'http.ConnectionTimeOut' => 30,
            'log.LogEnabled' => true,
            'log.FileName' => storage_path('logs/paypal.log'),
            'log.LogLevel' => 'FINE'
        ));

    }

    public function payPremium($property_id)
    {
        $property_purpose = Properties::propertyPurpose($property_id);
        if($property_purpose == 'Rent' ) {
            $plan = Plan::where('type','rent')->get()->toArray();
            return view('admin.pages.rent_paypremium',compact('property_id','plan'));
        } else {
            $plan = Plan::where('type','sale')->get()->toArray();
            return view('admin.pages.sale_paypremium',compact('property_id','plan'));
        }
    }

    public function getCheckout(Request $request)
    {
        $plan_id = $request->input('plan_id');
        $property_id = $request->input('property_id');
        $plan = Plan::find($plan_id);
        $total_cost = $plan->price;
        $payer = PayPal::Payer();
        $payer->setPaymentMethod('paypal');

        $amount = PayPal:: Amount();
        $amount->setCurrency('GBP');
        $amount->setTotal($total_cost);

        $transaction = PayPal::Transaction();
        $transaction->setAmount($amount);
        $transaction->setDescription('Buy Premium '.$plan->title.' Plan on '.$plan->price);

        $redirectUrls = PayPal:: RedirectUrls();
        $redirectUrls->setReturnUrl(route('getDone', ['property_id' => $property_id, 'plan_id'=> $plan_id]));
        $redirectUrls->setCancelUrl(route('getCancel',$property_id));

        $payment = PayPal::Payment();
        $payment->setIntent('sale');
        $payment->setPayer($payer);
        $payment->setRedirectUrls($redirectUrls);
        $payment->setTransactions(array($transaction));

        $response = $payment->create($this->_apiContext);
        $redirectUrl = $response->links[1]->href;

        return redirect()->to( $redirectUrl );
    }

    public function getDone(Request $request,$property_id,$plan_id)
    {
        $user_id=Auth::user()->id;
        $plan = Plan::find($plan_id);
        $payment_amount = $plan->price;
        $id = $request->get('paymentId');
        $token = $request->get('token');
        $payer_id = $request->get('PayerID');

        $payment = PayPal::getById($id, $this->_apiContext);

        $paymentExecution = PayPal::PaymentExecution();

        $paymentExecution->setPayerId($payer_id);
        $executePayment = $payment->execute($paymentExecution, $this->_apiContext);

        $paymentObj = new Payment();
        $paymentObj->txnid = $executePayment->id;
        $state = $executePayment->state;
        if($state == 'approved') {
            $paymentObj->status = 1;
        } else {
            $paymentObj->status = 0;
        }
        $paymentObj->payment_status = $executePayment->state;
        $paymentObj->user_id = $user_id;
        $paymentObj->property_id = $property_id;
        $paymentObj->payment_amount = $payment_amount;
        $paymentObj->save();
        if($state == 'approved') {
            $propertiesObj = Properties::find($property_id);
            $propertiesObj->status = 1;
            $propertiesObj->is_paid = 1;
            $propertiesObj->payment_id = $paymentObj->id;
            $propertiesObj->plan_id = $plan_id;
            $propertiesObj->save();
            \Session::flash('flash_message', 'Payment Done Successfully. Invoice number is '.$paymentObj->id);
        } else {
            $propertiesObj = Properties::find($property_id);
            $propertiesObj->status = 0;
            $propertiesObj->is_paid = 0;
            $propertiesObj->payment_id = $paymentObj->id;
            $propertiesObj->plan_id = $plan_id;
            $propertiesObj->save();
            \Session::flash('flash_message', 'Payment not done, Please check with admin.');
        }
        return redirect()->route('admin_property_lists');
    }

    public function getCancel($property_id)
    {
        return redirect()->route('payPremium',$property_id);
    }
}