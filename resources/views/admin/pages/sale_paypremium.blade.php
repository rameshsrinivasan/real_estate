@extends("admin.admin_app")
@section("style")
<link rel="stylesheet" href="{{ URL::asset('admin_assets/css/paypremium.css') }}">
@endsection
@section("content")
<div id="main">
	<div class="page-header">
		<h2>Select Payment Package</h2>
        <a href="{{ URL::to('admin/properties') }}" class="btn btn-default-light btn-xs"><i class="md md-pin-drop"></i> Back to Property List</a>
	</div>
    @if(Session::has('flash_message'))
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        {{ Session::get('flash_message') }}
    </div>
    @endif
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="row db-padding-btm db-attached">
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                <div class="db-wrapper">
                	{!! Form::open(array('route' => 'getCheckout')) !!}
                		{!! Form::hidden('plan_id',$plan[0]['id']) !!}
                		{!! Form::hidden('property_id',$property_id) !!}
                        <div class="db-pricing-eleven db-bk-color-one">
                            <div class="price">
                                <sup>£</sup>{{ $plan[0]['price'] }}
                                    <small>No VAT</small>
                            </div>
                            <div class="type">
                                {{ $plan[0]['title'] }}
                            </div>
                            <ul>
                                <li>Pictures Advert </li>
                                <li>Righmove and Zoopla Adert through out 6months </li>
                                <li>No hidden fee</li>
                            </ul>
                            <div class="pricing-footer">
                                <button class="btn db-button-color-square btn-lg">Pay</button>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                <div class="db-wrapper">
                	{!! Form::open(array('route' => 'getCheckout')) !!}
                		{!! Form::hidden('plan_id',$plan[1]['id']) !!}
                		{!! Form::hidden('property_id',$property_id) !!}
                    <div class="db-pricing-eleven db-bk-color-two popular">
                        <div class="price">
                            <sup>£</sup>{{ $plan[1]['price'] }}
                                    <small>No VAT</small>
                        </div>
                        <div class="type">
                            {{ $plan[1]['title'] }}
                        </div>
                        <ul>
                            <li>Visit the property </li>
                            <li>Pictures ADVERT </li>
                            <li>Dedicated sale member </li>
                            <li>Rightmove and Zoopla Advert through out sale </li>
                            <li>No other hidden fee </li>
                        </ul>
                        <div class="pricing-footer">
                            <button class="btn db-button-color-square btn-lg">Pay</button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                <div class="db-wrapper">
                	{!! Form::open(array('route' => 'getCheckout')) !!}
                		{!! Form::hidden('plan_id',$plan[2]['id']) !!}
                		{!! Form::hidden('property_id',$property_id) !!}
                    <div class="db-pricing-eleven db-bk-color-three">
                        <div class="price">
                            <sup>£</sup>{{ $plan[2]['price'] }}
                                    <small>No VAT</small>
                        </div>
                        <div class="type">
                            {{ $plan[2]['title'] }}
                        </div>
                        <ul>
                            <li>Visit your property </li>
                            <li>Pictures and Floor plan </li>
                            <li>Dedicated sale member </li>
                            <li>Rightmove and Zoopla Advert Through out the sale </li>
                        </ul>
                        <div class="pricing-footer">
                            <button class="btn db-button-color-square btn-lg">Pay</button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection