@if (session('success'))
<script>
$(function() {
    toastr.success("{{ session('success') }}");
});
</script>
@php
session()->forget('success');
@endphp
@endif

@if (session('info'))
<script>
$(function() {
    toastr.info("{{ session('info') }}");
});
</script>
@php
session()->forget('info');
@endphp
@endif

@if (session('error'))
<script>
$(function() {
    toastr.error("{{ session('error') }}");
});
</script>
@php
session()->forget('error');
@endphp
@endif

@if (session('warning'))
<script>
$(function() {
    toastr.warning("{{ session('warning') }}");
});
</script>
@php
session()->forget('warning');
@endphp
@endif
