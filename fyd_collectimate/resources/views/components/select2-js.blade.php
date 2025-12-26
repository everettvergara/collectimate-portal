$(document).ready(function(){
var model_path = {!! json_encode($model_path, JSON_HEX_TAG) !!};
$('.{{ $column }}').select2({
placeholder: '{{ $placeholder ?? 'Select the ' . $column }}',
theme: 'bootstrap-5',
allowClear: true,
ajax: {
type : 'POST',
url: "{{ route('select2') }}",
dataType: 'json',
delay: 500,
data: function(params){
return{
_token: CSRF_TOKEN,
search: params.term,
model_path: model_path,
};
},
processResults: function(response){
return{
results: response
};
},
cache:true
}
});
});
