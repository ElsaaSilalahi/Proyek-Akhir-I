<!-- JAVASCRIPT -->
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
<script src="{{ asset('assets/libs/feather-icons/feather.min.js') }}"></script>
<script src="{{ asset('assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
<script src="{{ asset('assets/libs/swiper/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/pages/form-input-spin.init.js') }}"></script>
<script src="{{ asset('js/toastr.js') }}"></script>
<script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('js/plugin.js') }}"></script>
<script src="{{ asset('js/method.js') }}"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
@if (Auth::User()->role->id == 1)
    <script src="{{ asset('js/app-admin.min.js') }}"></script>
    <script src="{{ asset('js/plugin.js') }}"></script>
    <script src="{{ asset('js/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('js/notif.js') }}"></script>
    <script>
        localStorage.setItem("route_counter_notif", "{{ route('admin.counter_notif') }}");
        localStorage.setItem("route_notification", "{{ route('admin.notification.index') }}");
    </script>
@else
    <script src="{{ asset('js/plugin.js') }}"></script>
    <script src="{{ asset('js/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('js/notif.js') }}"></script>
    <script>
        localStorage.setItem("route_counter_notif", "{{ route('web.counter_notif') }}");
        localStorage.setItem("route_notification", "{{ route('web.notification.index') }}");
        localStorage.setItem("route_cart", "{{ route('web.counter_cart') }}");
    </script>
    <script src="{{ asset('js/cart.js') }}"></script>
    <script src="{{ asset('js/app.min.js') }}"></script>
@endif
