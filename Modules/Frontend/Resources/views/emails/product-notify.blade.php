<h1>Notify Product</h1>
Product Notify Request
Below are the Product Details
<br><hr>
Product Name : {{$data->product->title}}
<br>
Product Code : {{$data->product->code_number}}
<br>
Product Model : {{$data->product->model_number}}
<br>
Product Specification : {!!$data->product->specification!!}
{{-- User    : {{$data->user->name}} --}}
